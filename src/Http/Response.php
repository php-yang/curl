<?php

namespace Yang\Curl\Http;

/**
 * Class Response
 * @package Yang\Curl\Http
 */
class Response
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
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->body;
    }
}
