<?php namespace Newway\Uploader;

/**
 * Class Uploader
 * @package Newway\Uploader
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'uploader';
    }
}