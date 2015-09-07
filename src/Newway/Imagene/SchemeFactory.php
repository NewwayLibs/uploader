<?php namespace Newway\Imagene;

use Newway\Imagene\Exceptions\ImageneException;
use Newway\Imagene\Schemes\Hashed;
use Newway\Imagene\Schemes\Linear;


/**
 * Class SchemeFactory
 * @package Newway\Imagene
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
     * @throws ImageneException
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
                throw new ImageneException('Scheme ' . $scheme . ' not allowed');
        }


    }
}
 