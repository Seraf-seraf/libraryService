<?php
require_once 'autoload.php';

use Service\LibraryService;
use Library\LibraryCard;
use Library\Book;

$libraryService = LibraryService::getInstance();

$card_1 = $libraryService->registerUser('Серафим', 'Кравчук');
$card_2 = $libraryService->registerUser('Михаил', 'Зубенко');
$card_3 = $libraryService->registerUser('Петр', 'Петух');
$card_4 = $libraryService->registerUser('Жамшут', 'Чубупеля');
$card_5 = $libraryService->registerUser('Мария', 'Гончарова');


$fakeCard_1 = new LibraryCard();
$fakeCard_2 = new LibraryCard();
$fakeBook_1 = new Book("Пивное застолье или история лысой бошки", "Зубенко Михаил Петрович", "1337");
$fakeBook_2 = new Book("Пивное застолье или история лысой бошки", "Зубенко Михаил Петрович", "1337");

$book_1 = $libraryService->registerBook("Преступление и наказание", "Федор Достоевский", "1");
$book_2 = $libraryService->registerBook("Преступление и наказание", "Федор Достоевский", "1");

$book_3 = $libraryService->registerBook("Война и мир", "Лев Толстой", "978-5-00057-040-3");
$book_4 = $libraryService->registerBook("Мастер и Маргарита", "Михаил Булгаков", "978-5-699-67680-2");
$book_5 = $libraryService->registerBook("Идиот", "Федор Достоевский", "978-5-17-118366-0");
$book_6 = $libraryService->registerBook("Анна Каренина", "Лев Толстой", "978-5-389-06438-6");
$book_7 = $libraryService->registerBook("Анна Каренина", "Лев Толстой", "978-5-389-06438-6");

// Проверка на возврат несущестующей книги
//$libraryService->returnBook($card_1, $fakeBook_1); //Ошибка BookNotFoundException: Книгу вам не выдавали
//$libraryService->returnBook($card_2, $fakeBook_1); //Ошибка BookNotFoundException: Книгу вам не выдавали

// Проверка на получение книги, которой нет в библиотеке
//$libraryService->issueBook($card_3, $fakeBook_1); // Ошибка BookNotFoundException: Книга не найдена в репозитории!
//$libraryService->issueBook($card_5, $fakeBook_2); // Ошибка BookNotFoundException: Книга не найдена в репозитории!

// Получение книги
//$libraryService->issueBook($card_1, $book_3); // Выдана книга автора Лев Толстой Война и мир
//$libraryService->issueBook($card_1, $book_3); // Ошибка BookNotFoundException: Книга не найдена в репозитории!

//$libraryService->issueBook($card_2, $book_3); // Ошибка BookNotFoundException: Книга не найдена в репозитории! (ее уже взяли)
//$libraryService->issueBook($card_2, $book_4); // Выдана книга автора Михаил Булгаков Мастер и Маргарита

// Получение и возврат книги
//$libraryService->issueBook($card_4, $book_3); // Выдана книга автора Лев Толстой Война и мир
//$libraryService->returnBook($card_4, $book_3); // Вы вернули книгу Лев Толстой Война и мир

//$libraryService->returnBook($card_5, $book_4); // Ошибка BookNotFoundException: Книгу вам не выдавали

// Попытка получить книгу по фейковой библиотечной карте
//$libraryService->issueBook($fakeCard_1, $book_3); // Ошибка LibraryCardException: Карточка библиотеки не найдена!
//$libraryService->issueBook($fakeCard_2, $book_5); // Ошибка LibraryCardException: Карточка библиотеки не найдена!

// Пробуем получить книгу, которую уже взяли
//$libraryService->issueBook($card_4, $book_1);
//$libraryService->issueBook($card_4, $book_6);
//
//$libraryService->issueBook($card_4, $book_1); // Ошибка BookNotFoundException: Книга не найдена в репозитории!
//
//$libraryService->issueBook($card_4, $book_2); // Ошибка BookNotFoundException: Нельзя взять книгу повторно!
//$libraryService->issueBook($card_4, $book_7); // Ошибка BookNotFoundException: Нельзя взять книгу повторно!

// Берем книги и смотрим список
//$libraryService->issueBook($card_5, $book_3); // Выдана книга автора Лев Толстой Война и мир
//$libraryService->issueBook($card_5, $book_4); // Выдана книга автора Михаил Булгаков Мастер и Маргарита
//$libraryService->issueBook($card_5, $book_5); // Выдана книга автора Федор Достоевский Идиот
//
//$libraryService->issueBook($card_2, $book_1); // Выдана книга автора Федор Достоевский Преступление и наказание
//
//echo $card_5->getId() . ':' . PHP_EOL;
//$card_5->listIssuedBooks();
//
//echo $card_2->getId() . ':' . PHP_EOL;
//$card_2->listIssuedBooks();