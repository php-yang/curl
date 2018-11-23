<?php

namespace Yang\Curl\Tests;

use PHPUnit\Framework\TestCase;
use Yang\Curl\Http;

/**
 * Class ClientTest
 * @package Yang\Curl\Tests
 */
class ClientTest extends TestCase
{
    public function testGet()
    {
        $response = Http::url('https://www.baidu.com')->get();

        $this->assertEquals($response->getStatus(), 200);
    }
}
