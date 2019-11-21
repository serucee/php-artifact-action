<?php


namespace ArtifactCreation\Helper;


use Exception;

/**
 * Wrapper for handling exceptions
 *
 * Class ExceptionHelper
 * @package ArtifactCreation\Helper
 */
class ExceptionHelper
{
    /**
     * End the script if an exception is thrown
     * @todo Pass error to action!
     *
     * @param string $context
     * @param Exception $error
     */
    public static function dieWithError($context, Exception $error) {
        $msg = sprintf(
            'Could not execute %s:: %s',
            $context,
            $error->getMessage()
        );
        echo $msg;
        die();
    }
}