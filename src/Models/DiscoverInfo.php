<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class DiscoverInfo extends TikTok
{
    protected $url;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.discover_info.link');
    }

    /**
     * @return array
     */
    public function getDiscover()
    {
        //add settings
        $this->ModelSettings();

        $response = $this->getResponse($this->url);

        return $response;
    }

}
