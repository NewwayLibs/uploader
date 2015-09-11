<?php namespace Newway\Uploader\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Uploader
 * @package Newway\Uploader\Facades
 */
class Uploader extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'uploader';
    }
}