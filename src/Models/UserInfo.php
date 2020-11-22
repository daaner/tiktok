<?php

namespace Daaner\TikTok\Models;

use Daaner\TikTok\TikTok;


class UserInfo extends TikTok
{
    protected $url;
    protected $arrayMain;
    protected $arraySecondary;


    /**
     * @return this
     */
    public function UserSettings() {
        $this->url = config('tiktok.user_info.link');
        $this->arrayMain = config('tiktok.user_info.array_main');
        $this->arraySecondary = config('tiktok.user_info.array_secondary');
    }


    /**
     * @param string $userName
     * @return array
     */
    public function getUser($userName)
    {
        //add settings
        $this->UserSettings();

        $userName = '@' . str_replace('@', '', $userName);

        if (!$userName) {
            return [
                'success' => false,
                'result' => null,
                'info' => __('tiktok::tiktok.error_username'),
            ];
        }

        $response = $this->getResponse($this->url . $userName);

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

        if ($data['success']) {
            if (isset($data['result'][$this->arrayMain])) {
                $result[$this->arrayMain] = $data['result'][$this->arrayMain];
            }
            if ($this->arraySecondary && isset($data['result'][$this->arrayMain])) {
                $result[$this->arraySecondary] = $data['result'][$this->arraySecondary];
            }
        }

        return $result;
    }

}
