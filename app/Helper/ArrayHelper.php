<?php


namespace ArtifactCreation\Helper;


use ArtifactCreation\Exception\MissingParameterException;

/**
 * Contains useful array methods
 *
 * Class ArrayHelper
 * @package ArtifactCreation\Helper
 */
class ArrayHelper
{
    /**
     * @param array $array
     * @param string|int $key
     * @param bool $requiredParameter
     * @param null $defaultValue
     *
     * @return array|string|null|
     *
     * @throws MissingParameterException
     */
    public static function valueByKey($array, $key, $requiredParameter = false, $defaultValue = null) {

        if (is_array($array) && isset($array[$key])) {
            return $array[$key];
        }

        if ($requiredParameter) {
            throw new MissingParameterException('Required parameter missing!:: array: ' . json_encode($array) . 'key: ' . $key);
        }

        return $defaultValue;
    }
}