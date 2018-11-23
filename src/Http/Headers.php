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

    /**
     * @return $this
     */
    public function formContent()
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';

        return $this;
    }

    /**
     * @return $this
     */
    public function plainContent()
    {
        $this->headers['Content-Type'] = 'text/plain';

        return $this;
    }

    /**
     * @return $this
     */
    public function xmlContent()
    {
        $this->headers['Content-Type'] = 'application/xml';

        return $this;
    }
}
