<?php

namespace Library;

use Interface\Identifiable;

class Book implements Identifiable
{
    private string $title;
    private string $author;

    private string $isbn;
    private string $bookId;

    public function __construct(string $title, string $author, string $isbn)
    {
        $this->bookId = uniqid('book_');
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getISBN(): string
    {
        return $this->isbn;
    }

    public function getId(): string|int
    {
        return $this->bookId;
    }

    public function __toString(): string
    {
        return "Книга: " . $this->title . ", Автор: " . $this->author;
    }
}