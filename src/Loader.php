<?php


class Loader
{
    public static function load(string $rootPath,array $paths)
    {
        foreach ($paths as $path)
        {
            $all = false;

            if (strrpos($path, '*') !== false)
                $all = true;

            $dir = dirname($rootPath.$path);

            if ($all)
            {
                $files = scandir($dir);

                foreach ($files as $value)
                {
                    if ($value === '..' || $value === '.')
                        continue;

                    if (is_dir($dir.'/'.$value))
                        continue;


                    require_once $dir.'/'.$value;
                }
            }
            else
            {
                require_once $rootPath.$path;
            }
        }
    }
}