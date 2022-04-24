<?php
/**
 * Created by .
 * Author: hushufeng
 * Date:   2022/4/21
 * Time:   17:57
 */

namespace Mantou521\Weather;


use GuzzleHttp\Client;
use Mantou521\Weather\Exceptions\HttpException;
use Mantou521\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;
    protected $guzzleOptions;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }
    /**
     * @param array $guzzleOptions
     */
    public function setGuzzleOptions(array $guzzleOptions)
    {
        $this->guzzleOptions = $guzzleOptions;
    }


    public function getWeather($city, string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo?parameters';

        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: ' . $format);
        }

        if (\in_array(strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(vase/all): ' . $type);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => \strtolower($format),
            'extensions' => \strtolower($type),
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' === $format ? json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }


}
