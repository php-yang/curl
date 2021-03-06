<?php

namespace Yang\Curl\Http;

use ArrayAccess;

/**
 * Class Response
 * @package Yang\Curl\Http
 */
class Response implements ArrayAccess
{
    /**
     * @var int
     */
    protected $status;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var mixed
     */
    protected $jsonCache;

    /**
     * Response constructor.
     * @param int $status
     * @param string $reason
     * @param array $headers
     * @param string $body
     */
    public function __construct(int $status = 200, string $reason = 'OK', array $headers = [], string $body = '')
    {
        $this->status = $status;
        $this->reason = $reason;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return string
     */
    public function getHeader(string $key, $default = ''): string
    {
        return $this->headers[strtolower($key)] ?? $default;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function body($key, $default = null)
    {
        $data = $this->jsonDecodeBody();

        return $data[$key] ?? $default;
    }

    /**
     * @return mixed
     */
    public function jsonDecodeBody()
    {
        return $this->jsonCache ?: $this->jsonCache = json_decode($this->body, true);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->body;
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        $data = $this->jsonDecodeBody();

        return isset($data[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->body($offset);
    }

    /**
     * readonly
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        return;
    }

    /**
     * readonly
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        return;
    }
}
