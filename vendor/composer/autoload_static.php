<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22afa2b3fa1e0404db2db71dd6b91f9d
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22afa2b3fa1e0404db2db71dd6b91f9d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22afa2b3fa1e0404db2db71dd6b91f9d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}