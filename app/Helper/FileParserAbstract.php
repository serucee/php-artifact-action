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
     */
    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new MissingFileException('Specified file does not exist!');
        }
        $this->file = $file;
    }
}
