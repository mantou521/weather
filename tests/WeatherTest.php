<?php
/**
 * Created by .
 * Author: hushufeng
 * Date:   2022/4/22
 * Time:   17:53
 */
namespace Mantou521\Weather\Tests;

use Mantou521\Weather\Exceptions\InvalidArgumentException;
use Mantou521\Weather\Weather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    //检查 $type 参数
    public function testGetWeatherWithInvalidType()
    {
        $w = new Weather('mock-key');

        $this->expectException(InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid type value(base/all): foo');

        $w->getWeather('深圳', 'foo');

        $this->fail('Failed to assert getWeather throw exception with invalid argument.');
    }

    //检查 $format 参数
    public function testGetWeatherWithInvalidFormat()
    {
        $w = new Weather('mock-key');

        $this->expectException(InvalidArgumentException::class);
    }


    public function testGetWeather()
    {

    }

    public function testGetHttpClient()
    {

    }

    public function testSetGuzzleOptions()
    {

    }


}
