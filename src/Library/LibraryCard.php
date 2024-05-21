<?php
namespace Library;

use Exceptions\BookNotFoundException;
use Interface\Identifiable;

class LibraryCard implements Identifiable
{
    private string $cardNumber;
    private array $issuedBooks;

    public function __construct()
    {
        $this->cardNumber = uniqid('card_');
        $this->issuedBooks = [];
    }

    public function getId(): string|int
    {
       return $this->cardNumber;
    }

    public function issueBook(Book $book): void
    {
        if ($this->alreadyGiven($book)) {
            throw new BookNotFoundException('Нельзя взять книгу повторно!');
        }
        $author = $book->getAuthor();
        $title = $book->getTitle();
        $this->issuedBooks[$book->getId()] = $book;
        echo "Выдана книга автора $author $title" . PHP_EOL;
    }

    public function returnBook(Book $book): void
    {
        if (!array_key_exists($book->getId(), $this->issuedBooks)) {
            throw new BookNotFoundException('Книгу вам не выдавали');
        }
        unset($this->issuedBooks[$book->getId()]);
        echo 'Вы вернули книгу ' . $book->getAuthor() . ' ' . $book->getTitle() . PHP_EOL;
    }

    public function listIssuedBooks(): void
    {
        foreach ($this->issuedBooks as $book) {
            $author = $book->getAuthor();
            $title = $book->getTitle();
            echo "Книга автора $author $title" . PHP_EOL;
        }
    }

    private function alreadyGiven(Book $book): bool
    {
        return !empty(array_filter($this->issuedBooks, function($item) use ($book) {
            return $item->getTitle() == $book->getTitle();
        }));
    }

    public function __toString(): string
    {
        return 'Номер карты: ' . $this->cardNumber . ', полученные книги: '. implode(', ', $this->issuedBooks);
    }
}