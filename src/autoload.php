<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new \Error('Класс не найден!');
    }
});