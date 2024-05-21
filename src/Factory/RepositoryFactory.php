<?php

namespace Factory;

use SplObserver;
use Repository\BookRepository;
use Repository\LibraryCardRepository;
use Repository\RepositoryInterface;
use Repository\UserRepository;

class RepositoryFactory
{
    private static $logger;

    public static function setLogger(SplObserver $logger)
    {
        self::$logger = $logger;
    }

    public static function createRepository(string $type): RepositoryInterface
    {
        return match ($type) {
            'book' => new BookRepository(self::$logger),
            'user' => new UserRepository(self::$logger),
            'card' => new LibraryCardRepository(self::$logger),
            default => throw new \TypeError('Неизвестный тип репозитория: ' . $type),
        };
    }
}