<?php namespace Newway\Uploader\Schemes;

/**
 * Class Hashed
 * @package Newway\Uploader\Schemes
 */
class Hashed extends  AbstractScheme
{

    /**
     * @var array
     */
    private $hash_levels;

    /**
     * SchemeConstructor
     *
     * @param $basePath
     * @param $origin_filename
     * @param array $hash_levels
     */
    public function __construct($basePath, $origin_filename, $hash_levels = [])
    {

        parent::__construct($basePath, $origin_filename);

        $this->hash_levels = $hash_levels;
    }

    /**
     * Generate directory path
     *
     * @return string
     */
    protected function getPath()
    {

        $path = $this->basePath . DIRECTORY_SEPARATOR . ($this->subdir !== null ? $this->subdir . DIRECTORY_SEPARATOR : '');

        if(!empty($this->hash_levels)) {

            $name = $this->getBasename();

            $dir = '';
            $start = 0;
            foreach ($this->hash_levels as $level){
                $dir .= substr($name, $start, $level) . DIRECTORY_SEPARATOR;
                $start += $level;
            }
            $path .= $dir;
        }


        return rtrim($path, '/\\');

    }


}