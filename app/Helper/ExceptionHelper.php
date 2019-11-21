<?php


namespace ArtifactCreation\Helper;


use Exception;

class ExceptionHelper
{
    /**
     * @param string $context
     * @param Exception $error
     */
    public static function dieWithError($context,Exception $error) {
        $msg = sprintf(
            'Could not execute %s:: %s',
            $context,
            $error->getMessage()
        );
        echo $msg;
        die();
    }
}