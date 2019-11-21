<?php


namespace ArtifactCreation\Model;

use ArtifactCreation\Helper\ArrayHelper;

class PackageZipConfiguration extends ConfigurationAbstract
{
    const PACKAGE_TYPE = 'zip';
    const KEY_FOLDER_BLACKLIST = 'folder-blacklist';
    const KEY_FILE_BLACKLIST = 'file-blacklist';

    protected $blackList;

    public function __construct($configuration)
    {
        parent::__construct($configuration);

        $this->blackList = $this->setBlackList();
    }

    protected function setCommand()
    {
        $command = 'zip -r artifact.zip .';
        if ($this->hasBlackList()) {
            $command .= ' -x ' . $this->blackList;
        }

        $this->command = $command;
    }

    protected function setBlackList()
    {
        $blacklist = '';
        $blacklist .= $this->fetchBlackListParameters(self::KEY_FOLDER_BLACKLIST);
        $blacklist .= $this->fetchBlackListParameters(self::KEY_FILE_BLACKLIST);

        $this->blackList = $blacklist;
    }

    protected function fetchBlackListParameters($key, $glue = ' ') {
        $parameters    = '';
        $valueArray = ArrayHelper::valueByKeySave($this->configurationArray, $key);
        if ($valueArray !== null && is_array($valueArray)) {
            $parameters .= ' ';
            $parameters .= implode($glue, $valueArray);
        }

        return $parameters;
    }

    public function hasBlackList()
    {
        if ($this->blackList === '') {
            return false;
        }

        return true;
    }
}