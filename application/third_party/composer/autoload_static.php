<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa7d8e95ba24f4d3b9b9a58f3202eb77
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'Hautelook' => 
            array (
                0 => __DIR__ . '/..' . '/hautelook/phpass/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa7d8e95ba24f4d3b9b9a58f3202eb77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa7d8e95ba24f4d3b9b9a58f3202eb77::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitaa7d8e95ba24f4d3b9b9a58f3202eb77::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
