<?php


namespace ArtifactCreation\Helper;

use ArtifactCreation\Exception\MissingFileException;

/**
 * Abstract file parser
 *
 * Class FileParserAbstract
 * @package ArtifactCreation\Helper
 */
abstract class FileParserAbstract implements Parser
{
    /** @var string $file */
    protected $file;

    /**
     * FileParserAbstract constructor.
     *
     * @param string $file
     *
     * @throws MissingFileException
     *
     * @since 0.0.1
     */
    public function __construct($file)
    {
        $this->setFile($file);
    }

    /**
     * @param $file
     *
     * @throws MissingFileException
     *
     * @since 0.0.1
     */
    protected function setFile($file)
    {
        if (!file_exists($file)) {
            throw new MissingFileException('Specified file does not exist!');
        }

        $this->file = $file;
    }

    /**
     * @return string
     *
     * @since 0.0.1
     */
    protected function getFile()
    {
        return $this->file;
    }
}
