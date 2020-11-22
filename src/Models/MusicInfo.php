<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class MusicInfo extends TikTok
{
    protected $url;
    protected $url_api;
    protected $api_field;
    protected $arrayPrimary;
    protected $arraySecondary;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.music_info.link');
        $this->url_api = config('tiktok.music_info.link_api');
        $this->api_field = config('tiktok.music_info.api_field');
        $this->arrayPrimary = config('tiktok.music_info.array_primary');
        $this->arraySecondary = config('tiktok.music_info.array_secondary');
    }

    /**
     * @param string $music
     * @return array
     */
    public function getMusic($music)
    {
        //add settings
        $this->ModelSettings();

        $response = $this->getResponse($this->url.$music);

        return $response;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getMusicApi($id, $count = 30, $cursor = 0)
    {
        //add settings
        $this->ModelSettings();

        $body = [
            $this->api_field => $id,
            'count' => $count,
            'cursor' => $cursor,
        ];

        $body = array_merge($body, config('tiktok.primary_body_api'));

        $response = $this->getResponse($this->url_api, $body);

        return $response;
    }

    /**
     * @param string $music
     * @return array
     */
    public function getMusicInfo($music)
    {
        $data = $this->getMusic($music);

        $result = [];
        $result['success'] = $data['success'];

        if ($data['success'] && isset($data['result']['statusCode']) && $data['result']['statusCode'] == 0) {
            if (isset($data['result'][$this->arrayPrimary])) {
                $result['primary'] = $data['result'][$this->arrayPrimary];
            }

            if ($this->arraySecondary && isset($data['result'][$this->arrayPrimary])) {
                $result['secondary'] = $data['result'][$this->arraySecondary];
            }
        } else {
            $result['info'] = __('tiktok::tiktok.music_no_found');
            $result['success'] = false;
        }

        return $result;
    }
}
