<?php namespace Newway\Uploader;

use Newway\Uploader\Exceptions\UploaderException;
use Newway\Uploader\Schemes\Hashed;
use Newway\Uploader\Schemes\Linear;


/**
 * Class SchemeFactory
 * @package Newway\Uploader
 */

class SchemeFactory
{

    /**
     * @param $scheme
     * @param $path
     * @param $filename
     * @param $hash_levels
     *
     * @return Linear
     * @throws UploaderException
     */
    public static function make($scheme, $path, $filename, $hash_levels)
    {

        switch ($scheme) {
            case 'linear':
                return new Linear($path, $filename);
                break;
            case 'hash':
                return new Hashed($path, $filename, $hash_levels);
                break;
            default:
                // there is no such scheme
                throw new UploaderException('Scheme ' . $scheme . ' not allowed');
        }


    }
}
 