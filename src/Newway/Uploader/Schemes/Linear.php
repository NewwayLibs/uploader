<?php namespace Newway\Uploader\Schemes;

/**
 * Class Linear
 * @package Newway\Uploader\Schemes
 */
class Linear extends AbstractScheme
{

    /**
     * Generate directory path
     *
     * @return string
     */
    protected function getPath()
    {

        $path = $this->basePath . DIRECTORY_SEPARATOR . ($this->subdir !== null ? $this->subdir . DIRECTORY_SEPARATOR : '');

        return rtrim($path, '/\\');

    }

}