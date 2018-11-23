<?php

namespace Yang\Curl;

use Yang\Curl\Http\Client;

/**
 * Class Http
 * @package Yang\Curl
 */
final class Http
{
    /**
     * @param string $url
     * @return Client
     */
    public static function url(string $url): Client
    {
        return new Client($url);
    }
}
