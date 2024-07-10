<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitede2c71f9380e42f90699568241acde2
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'E' => 
        array (
            'ElephantIO\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'ElephantIO\\' => 
        array (
            0 => __DIR__ . '/..' . '/wisembly/elephant.io/src',
            1 => __DIR__ . '/..' . '/wisembly/elephant.io/test',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitede2c71f9380e42f90699568241acde2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitede2c71f9380e42f90699568241acde2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
