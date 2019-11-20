<?php


namespace ArtifactCreation\Core;

use ArtifactCreation\Helper\Composer;
use ArtifactCreation\Helper\ConfigurationParser;
use ArtifactCreation\Helper\Package;
use Exception;

require __DIR__ . '/../vendor/autoload.php';
$fullyQualifiedConfigurationFileName = '/github/workspace/.github/artifact-configuration.json';

try {
    $configuration = ConfigurationParser::parseJsonFile($fullyQualifiedConfigurationFileName);
} catch (Exception $e) {
    die('Configuration file not provided!');
}
$composerConfiguration = ConfigurationParser::parseComposerConfiguration($configuration);
$packageConfiguration  = ConfigurationParser::parsePackageConfiguration($configuration);
if ($packageConfiguration === null) {
    var_dump($configuration);
    var_dump($packageConfiguration);
    die('No package configuration provided at .github/artifact-configuration.json');
}

if ($composerConfiguration !== null) {
    $composer = new Composer($composerConfiguration);
    $composer->run();
}

$package = new Package($packageConfiguration);
$package->run();