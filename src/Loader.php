<?php

/**
 * Class Loader needed for load php scripts.
 */
class Loader
{
    /**
     * Loads scripts from path from given array.
     * @param string $rootPath
     * @param array $paths
     */
    public static function load(string $rootPath,array $paths)
    {
        foreach ($paths as $path)
        {
            /**
             * Load all files from directory or not.
             */
            $all = false;

            /**
             * If path contains * then load all files.
             */
            if (strrpos($path, '*') !== false)
                $all = true;

            /**
             * Gets dirname.
             */
            $dir = dirname($rootPath.$path);

            if ($all)
            {
                /**
                 * Gets files from directory.
                 */
                $files = scandir($dir);

                foreach ($files as $value)
                {
                    if ($value === '..' || $value === '.')
                        continue;

                    /**
                     * If file is not directory then require him.
                     */
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