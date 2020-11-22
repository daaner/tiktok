<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class MusicInfo extends TikTok
{
    protected $url;
    protected $arrayPrimary;
    protected $arraySecondary;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.music_info.link');
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
