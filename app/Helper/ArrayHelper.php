<?php


namespace ArtifactCreation\Helper;


use Exception;

class ArrayHelper
{
    /**
     * @param $array
     * @param $key
     * @param null $defaultValue
     * @param bool $requiredParameter
     *
     * @return array|string|null
     *
     * @throws Exception
     */
    public static function valueByKeySave($array, $key, $defaultValue = null, $requiredParameter = false) {

        if (is_array($array) && isset($array[$key])) {
            return $array[$key];
        }

        if ($requiredParameter) {
            throw new Exception('Required parameter missing!:: array: ' . json_encode($array) . 'key: ' . $key);
        }

        return $defaultValue;
    }
}