<?php

namespace Daaner\TikTok\Traits;

trait Header
{
    protected $userAgent;
    protected $headers = [];

    /**
     * @param array $addition_headers
     * @return this
     */
    public function setHeaders($addition_headers)
    {
        if (is_array($addition_headers) && ! empty($addition_headers)) {
            $this->headers = array_merge($this->headers, $addition_headers);
        }

        return $this;
    }

    /**
     * @return array $headers
     */
    public function getHeader($headers)
    {
        /* add UserAgent Header */
        $this->getUserAgent();
        $this->headers = array_merge($this->headers, ['user-agent' => $this->userAgent]);

        /* add from config - primary_header */
        $this->headers = array_merge($this->headers, config('tiktok.primary_header'));

        /* add from config - use_header_referer */
        if (config('tiktok.use_header_referer')) {
            $this->headers = array_merge($this->headers, config('tiktok.referer'));
        }

        /* add from config - use_header_lang */
        if (config('tiktok.use_header_lang')) {
            $this->headers = array_merge($this->headers, config('tiktok.lang'));
        }

        /* add from config - use_header_browser */
        if (config('tiktok.use_header_browser')) {
            $this->headers = array_merge($this->headers, config('tiktok.browser'));
        }

        /* add from config - use_header_browser_ver */
        if (config('tiktok.use_header_browser_ver')) {
            $this->headers = array_merge($this->headers, config('tiktok.browser_ver'));
        }

        /* add from config - use_header_personal */
        if (config('tiktok.use_header_personal')) {
            $this->headers = array_merge($this->headers, config('tiktok.personal'));
        }

        /* add from config - use_header_personal_addition */
        if (config('tiktok.use_header_personal_addition')) {
            $this->headers = array_merge($this->headers, config('tiktok.personal_addition'));
        }

        /* add from config - verifyFp */
        if (config('tiktok.verifyFp')) {
            $this->headers = array_merge($this->headers, ['verifyFp' => config('tiktok.verifyFp')]);
        }

        /* add Response headers */
        if ($headers) {
            $this->headers = array_merge($this->headers, $headers);
        }

        return $this->headers;
    }

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
