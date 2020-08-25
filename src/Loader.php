<?php


class Loader
{
    public static function load(string $dir)
    {
        $dirs = scandir($dir);

        foreach ($dirs as $name)
        {
            if ($name === '..' || $name === '.')
                continue;

            if (is_dir($dir.$name))
                Loader::load($dir.$name.'/');
            else
            {
                require_once $dir.$name;
            }
        }
    }
}