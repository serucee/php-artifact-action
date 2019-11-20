<?php


namespace ArtifactCreation\Helper;


use mysql_xdevapi\Exception;

class ConfigurationParser
{
    const CONFIGURATION_KEY_COMPOSER = 'composer';
    const CONFIGURATION_KEY_PACKAGE = 'package';

    public static function parseJsonFile($fullyQualifiedFileName)
    {
        $fileContentRaw = file_get_contents($fullyQualifiedFileName);
        if ($fileContentRaw === false) {
            throw new Exception('Could not load configuration file!');
        }

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