<?php

namespace Repository;

use Interface\Identifiable;

interface RepositoryInterface
{

    public function add(Identifiable $identifiable): void;

    public function findById(string|int $id);
}