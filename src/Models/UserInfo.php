<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;

class UserInfo extends TikTok
{
    protected $url;
    protected $arrayPrimary;
    protected $arraySecondary;

    /**
     * @return $this
     */
    public function ModelSettings()
    {
        $this->url = config('tiktok.user_info.link');
        $this->arrayPrimary = config('tiktok.user_info.array_primary');
        $this->arraySecondary = config('tiktok.user_info.array_secondary');
    }

    /**
     * @param string $userName
     * @return array
     */
    public function getUser($userName)
    {
        /* add settings */
        $this->ModelSettings();

        $userName = '@'.str_replace('@', '', $userName);

        if (! $userName) {
            return [
                'success' => false,
                'result' => null,
                'info' => __('tiktok::tiktok.error_username'),
            ];
        }

        $response = $this->getResponse($this->url.$userName);

        return $response;
    }

    /**
     * @param string $userName
     * @return array
     */
    public function getUserInfo($userName)
    {
        $data = $this->getUser($userName);

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
