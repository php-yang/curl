<?php

namespace Yang\Curl\Http;

/**
 * Trait Headers
 * @package Yang\Curl\Http
 */
trait Headers
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @return $this
     */
    public function acceptJson()
    {
        $this->headers['Accept'] = 'application/json';

        return $this;
    }

    /**
     * @return $this
     */
    public function jsonContent()
    {
        $this->headers['Content-Type'] = 'application/json';

        return $this;
    }
}
