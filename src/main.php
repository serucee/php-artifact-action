<?php


namespace ArtifactCreation\Core;

use ArtifactCreation\Model\Configuration;
use ArtifactCreation\Helper\ExceptionHelper;
use ArtifactCreation\Helper\FileParserJson;
use ArtifactCreation\Helper\Runner;
use Exception;

require __DIR__ . '/../vendor/autoload.php';
// Currently the configuration filename is hardcoded
// If necessary it can be a parameter passed to this file
$fullyQualifiedConfigurationFileName = '/github/workspace/.github/artifact-configuration.json';

try {
    $parserJson = new FileParserJson($fullyQualifiedConfigurationFileName);
    $configuration = (new Configuration($parserJson))->init();
} catch (Exception $e) {
    ExceptionHelper::dieWithError('main ', $e);
}

$runner = new Runner();

if ($configuration->hasComposerConfiguration()) {
    $runner->execute($configuration->getComposerConfiguration());
}

$runner->execute($configuration->getPackageConfiguration());

exit(0);
