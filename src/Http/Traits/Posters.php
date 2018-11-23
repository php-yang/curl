<?php

namespace Yang\Curl\Http\Traits;

use Yang\Curl\Http\Response;

/**
 * Trait Posters
 * @package Yang\Curl\Http\Traits
 */
trait Posters
{
    /**
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function postJson(array $data, array $headers = []): Response
    {
        $this->jsonContent();

        return $this->post(json_encode($data), $headers);
    }

    /**
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function postForm(array $data, array $headers = []): Response
    {
        $this->formContent();

        return $this->post(http_build_query($data), $headers);
    }

    /**
     * @param string $data
     * @param array $headers
     * @return Response
     */
    public function postText(string $data, array $headers = []): Response
    {
        $this->plainContent();

        return $this->post($data, $headers);
    }

    /**
     * @param array $data
     * @param array $headers
     * @return Response
     */
    public function postXml(array $data, array $headers = []): Response
    {
        $this->xmlContent();

        return $this->post(static::buildXml($data), $headers);
    }

    /**
     * @param array|object $data
     * @return string
     */
    protected static function iBuildXml($data): string
    {
        $xml = '';
        foreach ($data as $k => $v) {
            if (is_array($v) || is_object($v)) {
                $v = static::iBuildXml($v);
            }
            $xml .= '<' . $k . '>' . $v . '</' . $k . '>';
        }

        return $xml;
    }

    /**
     * @param array $data
     * @return string
     */
    protected static function buildXml(array $data): string
    {
        return '<xml>' . static::iBuildXml($data) . '</xml>';
    }
}
