<?php namespace Newway\Imagene;

use Newway\Imagene\Exceptions\ImageneException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Class Uploader
 * @package Newway\Imagene
 */
class Uploader
{

    protected $file;

    /**
     * Core path to save files
     * @var
     */
    private $basePath;

    /**
     * Subdirectory inside module
     * @var
     */
    private $subdir;

    /**
     * Scheme of directory path generator
     * @var
     */
    private $scheme;

    /**
     * @var array
     */
    private $hash_levels;


    /**
     * @param $basePath
     * @param $scheme
     * @param array $hash_levels
     */
    public function __construct($basePath, $scheme, array $hash_levels = [])
    {

        $this->basePath = $basePath;
        $this->scheme = $scheme;
        $this->hash_levels = $hash_levels;
    }

    /**
     * @param UploadedFile $file
     *
     * @return Uploader
     *
     * @throws ImageneException
     */
    public function init(UploadedFile $file)
    {

        // check if file correct
        if (!$file->isValid()){
            throw new ImageneException($file->getErrorMessage());
        }

        $this->file = $file;

        return $this;
    }

    /**
     * Magic methods to the Uploader instance
     *
     * @param  string $method
     * @param  array $arguments
     *
     * @return Uploader
     *
     * @throws ImageneException
     */
    public function __call($method, $arguments)
    {

        if (count($arguments) === 0){
            throw new ImageneException('An argument required to execute ' . $method . ' method');
        }

        switch ($method){
            case 'to':
                $this->basePath = $arguments[0];
                break;

            case 'scheme':
            case 'subdir':
                $this->$method = $arguments[0];
                break;

            default:
                throw new ImageneException('Method ' . $method . ' not allowed');
        }


        return $this;

    }

    /**
     * @return string
     * @throws ImageneException
     */
    public function upload()
    {

        $scheme = SchemeFactory::make($this->scheme, $this->basePath, $this->file->getClientOriginalName(), $this->hash_levels);
        $scheme->setSubdir($this->subdir);

        // generate file path
        $destination = $scheme->getDestinationFolder();

        // generate file name
        $filename = $scheme->getFilename();

        // move uploaded file
        try {

            $target = $this->file->move($destination, $filename);

            if ($target) {
                return $scheme->getTargetPath();
            }

        } catch (FileException $e){
            throw new ImageneException($e->getMessage());
        }

        throw new ImageneException('Internal error');

    }

}
 