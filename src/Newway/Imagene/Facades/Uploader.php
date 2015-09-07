<?php namespace Newway\Imagene\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Uploader
 * @package Newway\Imagene\Facades
 */
class  Uploader extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'imagene_uploader';
    }
}