<?php


namespace Framework\Env;


use Exception;

class Env
{
    /**
     * @param string $path
     * @throws Exception
     */
    public static function fromJson(string $path)
    {
        $data = file_get_contents($path);

        if ($data === false)
            throw new Exception('fffff'); // TODO: need a normal exception

        $json = json_decode($data);

        if (is_null($json))
            throw new Exception('ddd'); // TODO: need a normal exception

        foreach ($json as $key => $value)
        {
            $_ENV[$key] = $value;
        }
    }
}