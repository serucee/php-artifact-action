<?php


namespace ArtifactCreation\Helper;

use ArtifactCreation\Exception\MissingFileException;

/**
 * Abstract file parser
 *
 * Class ParserAbstract
 * @package ArtifactCreation\Helper
 */
abstract class ParserAbstract implements Parser
{
    /** @var string $file */
    protected $file;

    /**
     * ParserAbstract constructor.
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
