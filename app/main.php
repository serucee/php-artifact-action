<?php

namespace ArtifactCreation\Core;

use ArtifactCreation\Helper\Composer;
use ArtifactCreation\Helper\ConfigurationParser;
use ArtifactCreation\Helper\Package;

$fullyQualifiedConfigurationFileName = '/github/workspace/.github/artifact-configuration.json';

$configuration         = ConfigurationParser::parseJsonFile($fullyQualifiedConfigurationFileName);
$composerConfiguration = ConfigurationParser::parseComposerConfiguration($configuration);
$packageConfiguration  = ConfigurationParser::parsePackageConfiguration($configuration);
if ($packageConfiguration === null) {
    die('No package configuration provided at .github/artifact-configuration.json');
}

if ($composerConfiguration !== null) {
    $composer = new Composer($composerConfiguration);
    $composer->run();
}

$package = new Package($packageConfiguration);
$package->run();