<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9fd4cfc2b412bd55b74f99d440f01728
{
    public static $files = array (
        '9dad98ea5c4ff3f1148e51389a591092' => __DIR__ . '/../..' . '/env.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Atomstudio\\Atomacore\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Atomstudio\\Atomacore\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9fd4cfc2b412bd55b74f99d440f01728::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9fd4cfc2b412bd55b74f99d440f01728::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9fd4cfc2b412bd55b74f99d440f01728::$classMap;

        }, null, ClassLoader::class);
    }
}
