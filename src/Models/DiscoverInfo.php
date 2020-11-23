<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class DiscoverInfo extends TikTok
{
    protected $url;
    protected $url_api;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.discover_info.link');
        $this->url_api = config('tiktok.discover_info.link_api');
    }

    /**
     * @return array
     */
    public function getDiscover()
    {
        /* add settings */
        $this->ModelSettings();

        $response = $this->getResponse($this->url);

        return $response;
    }

    /**
     * @param string $type
     * @param int|null $count
     * @param int|null $offset
     * @param bool $needItemList
     * @param bool $useRecommend
     *
     * $discoverType only 0
     * $keyWord not used
     *
     * @return array
     */
    public function getDiscoverApi($type, $count = 20, $offset = 0, $needItemList = true, $useRecommend = false)
    {
        /* add settings */
        $this->ModelSettings();

        $body = [
            'offset' => $offset,
            'count' => $count,
            'needItemList' => $needItemList,
            'useRecommend' => $useRecommend,
            'keyWord' => '',
            'discoverType' => 0,
        ];

        $body = array_merge($body, config('tiktok.primary_body_api'));

        $response = $this->getResponse($this->url_api.$type, $body);

        return $response;
    }
}
