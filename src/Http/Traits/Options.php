<?php

namespace Yang\Curl\Http\Traits;

/**
 * Trait Options
 * @package Yang\Curl\Http\Traits
 */
trait Options
{
    /**
     * @var array
     */
    protected $options = [
        CURLOPT_AUTOREFERER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 16,
        CURLOPT_TIMEOUT => 3,
    ];

    /**
     * @param int $seconds
     * @return $this
     */
    public function timeout(int $seconds)
    {
        $this->options[CURLOPT_TIMEOUT] = $seconds;

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function set(array $options)
    {
        $this->options = $options + $this->options;

        return $this;
    }
}
