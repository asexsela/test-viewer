<?php

namespace App\Helper;

use RuntimeException;
use InvalidArgumentException;

class Env
{
    private $path;

    public function __construct(String $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf("%s файл не найден", $path));
        }

        $this->path = $path;
    }

    public function load()
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException(sprintf("%s файл нельзя прочитать", $path));
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
            }
        }
    }

}