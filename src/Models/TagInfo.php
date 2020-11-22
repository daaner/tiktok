<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class TagInfo extends TikTok
{
    protected $url;
    protected $arrayPrimary;
    protected $arraySecondary;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.tag_info.link');
        $this->arrayPrimary = config('tiktok.tag_info.array_primary');
        $this->arraySecondary = config('tiktok.tag_info.array_secondary');
    }

    /**
     * @param string $tag
     * @return array
     */
    public function getTag($tag)
    {
        //add settings
        $this->ModelSettings();

        $tag = str_replace('#', '', $tag);

        if (! $tag) {
            return [
                'success' => false,
                'result' => null,
                'info' => __('tiktok::tiktok.error_tag'),
            ];
        }

        $response = $this->getResponse($this->url.$tag);

        return $response;
    }

    /**
     * @param string $tag
     * @return array
     */
    public function getTagInfo($tag)
    {
        $data = $this->getTag($tag);

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
            $result['info'] = __('tiktok::tiktok.user_no_found');
            $result['success'] = false;
        }

        return $result;
    }
}
