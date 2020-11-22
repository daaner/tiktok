<?php

namespace Daaner\TikTok\Traits;

trait UserAgent
{
    protected $userAgent;

    /**
     * @param string $userAgent
     * @return this
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string $this->userAgent
     */
    public function getUserAgent()
    {
        if (! $this->userAgent) {
            $this->userAgent = config('tiktok.user_agent');
        }

        return $this->userAgent;
    }
}
