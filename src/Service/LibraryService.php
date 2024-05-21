<?php

namespace Service;

use Exceptions\BookNotFoundException;
use Exceptions\LibraryCardException;
use Exceptions\UserException;
use Factory\RepositoryFactory;
use Library\Book;
use Library\LibraryCard;
use Observer\EventLogger;
use Repository\RepositoryInterface;
use User\User;

class LibraryService
{
    private RepositoryInterface $libraryCardRepository;
    private RepositoryInterface $userRepository;
    private RepositoryInterface $bookRepository;

    private static ?LibraryService $instance = null;

    private function __construct()
    {
        RepositoryFactory::setLogger(new EventLogger());
        $this->userRepository = RepositoryFactory::createRepository('user');
        $this->libraryCardRepository = RepositoryFactory::createRepository('card');
        $this->bookRepository = RepositoryFactory::createRepository('book');
    }

    public static function getInstance(): LibraryService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function registerUser(string $firstName, string $lastName): ?LibraryCard
    {
        try {
            $user = new User($firstName, $lastName);
            $this->userRepository->add($user);

            $card = new LibraryCard();
            $this->libraryCardRepository->add($card);

            return $card;
        } catch (UserException $e) {
            $this->libraryCardRepository->notify('Error: ', 'Ошибка UserException: ' . $e->getMessage());
            echo 'Ошибка UserException: ' . $e->getMessage() . PHP_EOL . PHP_EOL;
        }

        return null;
    }

    public function registerBook(string $title, string $author, string $isbn): Book
    {
        $book = new Book($title, $author, $isbn);
        $this->bookRepository->add($book);
        return $book;
    }

    public function issueBook(LibraryCard $card, Book $book): void
    {
        try {
            $card = $this->findLibraryCard($card);

            $book = $this->bookRepository->getBookFromRepository($book->getId());

            $card->issueBook($book);
        } catch (LibraryCardException $e) {
            $this->libraryCardRepository->notify('Error: ', 'Ошибка LibraryCardException: ' . $e->getMessage());
            echo 'Ошибка LibraryCardException: ' . $e->getMessage() . PHP_EOL;
        } catch (BookNotFoundException $e) {
            $this->bookRepository->notify('Error: ', 'Ошибка BookNotFoundException: ' . $e->getMessage());
            echo 'Ошибка BookNotFoundException: ' . $e->getMessage() . PHP_EOL;
        } finally {
            echo 'Спасибо за обращение!' . PHP_EOL . PHP_EOL;
        }
    }

    public function returnBook(LibraryCard $card, Book $book): void
    {
        $card = $this->findLibraryCard($card);
        try {
            $card->returnBook($book);
            $this->bookRepository->add($book);
        } catch (LibraryCardException $e) {
            $this->libraryCardRepository->notify('Error: ', 'Ошибка LibraryCardException: ' . $e->getMessage());
            echo 'Ошибка LibraryCardException: ' . $e->getMessage() . PHP_EOL;
        } catch (BookNotFoundException $e) {
            $this->bookRepository->notify('Error: ', 'Ошибка BookNotFoundException: ' . $e->getMessage());
            echo 'Ошибка BookNotFoundException: ' . $e->getMessage() . PHP_EOL;
        } finally {
            echo 'Спасибо за обращение!' . PHP_EOL . PHP_EOL;
        }
    }

    private function findLibraryCard(LibraryCard $card): LibraryCard
    {
        $card = $this->libraryCardRepository->findById($card->getId());

        if (!$card) {
            $this->libraryCardRepository->notify('Error: ', 'Ошибка LibraryCardException: Карточка библиотеки не найдена!');
            throw new LibraryCardException('Карточка библиотеки не найдена!');
        }

        return $card;
    }
}