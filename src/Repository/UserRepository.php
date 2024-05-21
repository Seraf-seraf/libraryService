<?php

namespace Repository;

use SplObserver;

class UserRepository extends Repository
{
    public function __construct(SplObserver $logger)
    {
        parent::__construct($logger);
        $this->notify('Создан репозиторий: ', self::class);
    }
}