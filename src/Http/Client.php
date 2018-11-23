<?php

namespace Yang\Curl\Http;

/**
 * Class Client
 * @package Yang\Curl\Http
 */
class Client
{
    use Options, Headers, Posters;

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_HEAD = 'HEAD';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_PATCH = 'PATCH';

    /**
     * @var string
     */
    protected $url;

    /**
     * Http constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param array $headers
     * @return Response
     */
    public function get(array $headers = []): Response
    {
        return $this->exec(static::METHOD_GET, $headers);
    }

    /**
     * @param string|null $data
     * @param array $headers
     * @return Response
     */
    public function post(string $data = null, array $headers = []): Response
    {
        $options = $data ? [CURLOPT_POSTFIELDS => $data] : [];

        return $this->exec(static::METHOD_POST, $headers, $options);
    }

    /**
     * @param string $method
     * @param array $headers
     * @param array $options
     * @return Response
     */
    protected function exec(string $method, array $headers, array $options = []): Response
    {
        $options[CURLOPT_URL] = $this->url;
        $options[CURLOPT_CUSTOMREQUEST] = $method;
        $options[CURLOPT_RETURNTRANSFER] = true;
        $options[CURLOPT_HEADER] = true;

        $outHeaders = [];
        foreach ($headers + $this->headers as $key => $value) {
            $outHeaders[] = "{$key}: {$value}";
        }
        $options[CURLOPT_HTTPHEADER] = $outHeaders;

        $handle = curl_init();
        curl_setopt_array($handle, $options + $this->options);

        try {
            $ret = curl_exec($handle);
        } finally {
            curl_close($handle);
        }

        return $this->makeResponse($ret);
    }

    /**
     * @param string|bool $content
     * @return Response
     */
    protected function makeResponse($content): Response
    {
        if (!$content) {
            return new Response(0, 'ERROR');
        }

        list($header, $body) = explode("\r\n\r\n", $content, 2);
        list($statusLine, $header) = explode("\r\n", $header, 2);
        list(, $status, $reason) = explode(' ', $statusLine . ' ', 3);

        $headers = [];
        foreach (explode("\r\n", $header) as $line) {
            list($key, $value) = explode(':', $line, 2);

            $headers[strtolower(trim($key))] = trim($value);
        }

        return new Response((int)$status, trim($reason), $headers, $body);
    }
}
