<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite9d0b856627b3ef3761cac3268924284
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite9d0b856627b3ef3761cac3268924284::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite9d0b856627b3ef3761cac3268924284::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}