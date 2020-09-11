<?php


namespace Framework\Model;

/**
 * Class Query represents query.
 * @package Framework\Model
 */
class Query
{
    /**
     * Shortcut for creating query and replacing query params to values.
     * @param string $queryString
     * @param array $params
     * @param bool $quotes
     * @return string
     */
    public static function construct(string $queryString, array $params, bool $quotes = true): string
    {
        foreach ($params as $name => $value)
        {
            $name = ":$name";

            $position = strrpos($queryString, $name);

            if ($position === false)
                continue;

            if (is_string($value))
            {
                $value = str_replace(['\\', '\'','"'],['\\\\','\\\'','\"'], $value);

                if ($quotes)
                    $value = "'$value'";
            }

            $queryString = substr_replace($queryString, $value, $position, strlen($name));
        }

        return $queryString;
    }
}