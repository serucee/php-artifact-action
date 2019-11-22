<?php


namespace ArtifactCreation\Core;

use ArtifactCreation\Helper\ConfigurationParser;
use ArtifactCreation\Helper\ExceptionHelper;
use ArtifactCreation\Helper\Runner;
use Exception;

require __DIR__ . 'vendor/autoload.php';
$fullyQualifiedConfigurationFileName = '/github/workspace/.github/artifact-configuration.json';

try {
    $configuration = new ConfigurationParser($fullyQualifiedConfigurationFileName);
} catch (Exception $e) {
    ExceptionHelper::dieWithError('main::', $e);
}

$runner = new Runner();

if ($configuration->hasComposerConfiguration()) {
    $runner->execute($configuration->getComposerConfiguration());
}

$runner->execute($configuration->getPackageConfiguration());

exit(0);
