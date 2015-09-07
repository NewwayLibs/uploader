<?php namespace Newway\Imagene\Schemes;

use Illuminate\Support\Facades\File;


/**
 * Class AbstractScheme
 * @package Newway\Imagene\Schemes
 */
abstract class AbstractScheme
{

    protected $basePath;
    protected $subdir;

    protected $filename;
    /**
     * @var null
     */
    protected $extension;

    /**
     * SchemeConstructor
     *
     * @param $basePath
     * @param $filename
     */
    public function __construct($basePath, $filename)
    {

        $this->basePath = rtrim($basePath, '/\\');
        $this->filename = $filename;
        $this->extension = pathinfo($filename, PATHINFO_EXTENSION);

        $this->_touchDirectory($basePath);

    }


    /**
     * @param $subdir
     */
    public function setSubdir($subdir){

        $this->subdir = $subdir;
    }

    /**
     * Toch directory recursively
     * @param $path
     */
    protected function _touchDirectory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Return file extension
     * @return mixed
     */
    public function getExtention()
    {
        return $this->extension;
    }

    /**
     * Return file base name
     * @return mixed
     */
    public function getBasename()
    {
        return md5(microtime(true) . $this->filename);
    }

    /**
     * Get generated or original filename
     *
     * @return string
     */
    public function getFilename()
    {

        return  $this->getBasename($this->filename) . '.' . strtolower($this->extension);
    }

    /**
     * Get absolute destination directory
     *
     * @return string
     */
    public function getDestinationFolder()
    {

        $destination = public_path($this->getPath());

        $this->_touchDirectory($destination);

        return $destination;
    }

    /**
     * Get relative file path
     *
     * @return string
     */
    public function getTargetPath()
    {

        return $this->getPath() . DIRECTORY_SEPARATOR . $this->getFilename();
    }

    /**
     * Generate directory path
     *
     * @return string
     */
    protected abstract function getPath();



}