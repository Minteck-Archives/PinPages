<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit07f9698a82d4b7435979b953ce761d48
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'ColorThief\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ColorThief\\' => 
        array (
            0 => __DIR__ . '/..' . '/ksubileau/color-thief-php/lib/ColorThief',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit07f9698a82d4b7435979b953ce761d48::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit07f9698a82d4b7435979b953ce761d48::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}