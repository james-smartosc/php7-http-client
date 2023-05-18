<?php

declare(strict_types=1);

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function ($class) {
            $namespaces = [
                'Http\\' => 'src/Http/'
            ];

            foreach ($namespaces as $namespace => $dir) {
                $namespaceLength = strlen($namespace);
                $relativeClass = substr($class, $namespaceLength);

                $file = $dir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

                if (file_exists($file)) {
                    require $file;
                }
            }
        });
    }
}
