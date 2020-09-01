<?php


namespace Framework\Data;


/**
 * Class Url represents parsed url.
 * @package Framework\Data
 */
class Url
{
    /**
     * Url constructor.
     * @param string $url Url string to parse.
     */
    public function __construct(string $url)
    {
        $this->setUrl($url);

        $parsedUrl = parse_url($url);

        foreach ($parsedUrl as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if ($key === 'pass')
                $method = 'setPassword';

            $this->$method($value);
        }

    }

    /**
     * Contains raw url string.
     * @var string $url
     */
    private string $url;

    /**
     * Returns raw url string.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets raw url string.
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * Contains url scheme.
     * @var string $scheme
     */
    private string $scheme;

    /**
     * Returns url scheme.
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * Sets url scheme.
     * @param string $scheme
     */
    public function setScheme(string $scheme): void
    {
        $this->scheme = $scheme;
    }

    /**
     * Contains url hostname.
     * @var string $hostname
     */
    private string $hostname;

    /**
     * Return url hostname.
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * Sets url hostname.
     * @param string $hostname
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    /**
     * Contains url port.
     * @var int $port
     */
    private int $port;

    /**
     * Returns url port.
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Sets url port.
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * Contains url user.
     * @var string $user
     */
    private string $user;

    /**
     * Returns url user.
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Sets url user.
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * Contains url password.
     * @var string $password
     */
    private string $password;

    /**
     * Returns url password.
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets url password.
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Contains url path.
     * @var string $path
     */
    private string $path;

    /**
     * Returns url path.
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets url path.
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * Contains url query.
     * @var string $query
     */
    private string $query;

    /**
     * Returns url query.
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Sets url query.
     * @param string $query
     */
    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    /**
     * Contains url fragment
     * @var string $fragment
     */
    private string $fragment;

    /**
     * Returns url fragment.
     * @return string
     */
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * Sets url fragment.
     * @param string $fragment
     */
    public function setFragment(string $fragment): void
    {
        $this->fragment = $fragment;
    }
}