<?php

namespace Repository;

use Interface\Identifiable;
use Library\LibraryCard;
use Repository\RepositoryInterface;
use SplObserver;

class LibraryCardRepository extends Repository
{
    public function __construct(SplObserver $logger)
    {
        parent::__construct($logger);
        $this->notify('Создан репозиторий: ', self::class);
    }
}