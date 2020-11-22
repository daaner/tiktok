<?php

namespace Daaner\TikTok;

use Daaner\TikTok\Contracts\TikTokInterface;
use Illuminate\Support\Facades\Http;

use Daaner\TikTok\Traits\UserAgent;
use Daaner\TikTok\Traits\Header;


class TikTok implements TikTokInterface
{

    protected $primaryHeader;

    use UserAgent, Header;

    protected $baseUri = 'https://api.tiktok.com/';

    /**
     * TikTok constructor main settings.
     */
    public function __construct()
    {
      $this->primaryHeader = config('tiktok.primary_header');


    }

    /**
     * This default response method
     *
     * @param string $url
     * @param array|null $body
     * @param array|null $headers
     *
     * @return array
     */
    public function getResponse($url, $body = null, $headers = null)
    {
        $userAgent = $this->getUserAgent();
        $header = $this->getHeader($headers);

        $response = Http::timeout(config('tiktok.tt_timeout'))
            ->retry(config('tiktok.tt_retry.number', 1), config('tiktok.tt_retry.time', 200))
            ->withHeaders($header)
            ->get($url, $body);

        if ($response->failed()) {
            return [
                'success' => false,
                'result' => null,
                'info' => __('tiktok::tiktok.error_data'),
            ];
        }

        $answer = $response->json();

        return [
            'success' => true,
            'result' => $answer,
            'info' => '',
        ];
    }

}
