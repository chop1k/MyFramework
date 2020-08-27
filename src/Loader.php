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
            elseif (strrpos($name, '.php', -1) !== false)
            {
                require_once $dir.$name;
            }
        }
    }
}