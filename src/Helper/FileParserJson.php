<?php


namespace ArtifactCreation\Helper;

use ArtifactCreation\Exception\InvalidFileException;
use ArtifactCreation\Exception\MissingFileException;

/**
 * Parse json file to array
 *
 * Class FileParserJson
 * @package ArtifactCreation\Helper
 */
class FileParserJson extends FileParserAbstract
{
    /**
     * Parse json file to array
     *
     * @return array
     *
     * @throws InvalidFileException
     * @throws MissingFileException
     */
    public function parse()
    {
        $fileContentRaw = file_get_contents($this->getFile());
        if ($fileContentRaw === false) {
            throw new MissingFileException('Could not load configuration file!');
        }

        $fileContent = json_decode($fileContentRaw, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new InvalidFileException('Configuration file is not valid json!');
        }

        if (!is_array($fileContent)) {
            throw new InvalidFileException('Configuration file could not be parsed as an array');
        }

        return $fileContent;
    }
}
