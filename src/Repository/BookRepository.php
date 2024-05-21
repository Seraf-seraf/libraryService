<?php

namespace Repository;

use Exceptions\BookNotFoundException;
use SplObserver;

class BookRepository extends Repository
{

    public function __construct(SplObserver $logger)
    {
        parent::__construct($logger);
        $this->notify('Создан репозиторий: ', self::class);
    }

    public function findById(string|int $id)
    {
        $book = $this->storage[$id] ?? [];

        if (!$book) {
            $this->notify('Error: ', 'BookNotFoundException Книга не найдена в репозитории!');
            throw new BookNotFoundException('Книга не найдена в репозитории!');
        }

        return $book;
    }

    public function getBookFromRepository(string|int $id)
    {
        $book = $this->findById($id);

        unset($this->storage[$id]);

        return $book;
    }
}