<?php


namespace ArtifactCreation\Helper;


class ConfigurationParser
{
    const CONFIGURATION_KEY_COMPOSER = 'composer';
    const CONFIGURATION_KEY_PACKAGE = 'package';

    public static function parseJsonFile($fullyQualifiedFileName)
    {
        $fileContentRaw = file_get_contents($fullyQualifiedFileName);

        return json_decode($fileContentRaw, true);
    }

    public static function parseComposerConfiguration($configuration)
    {
        return ArrayHelper::valueByKeySave($configuration, self::CONFIGURATION_KEY_COMPOSER);
    }

    public static function parsePackageConfiguration($configuration)
    {
        return ArrayHelper::valueByKeySave($configuration, self::CONFIGURATION_KEY_PACKAGE);
    }
}