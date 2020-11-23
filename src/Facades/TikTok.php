<?php

namespace Daaner\TikTok\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getResponse($url, $body)
 *
 * @see \Daaner\TikTok
 */
class TikTok extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tiktok';
    }
}
