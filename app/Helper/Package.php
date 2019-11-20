<?php


namespace ArtifactCreation\Helper;


use Exception;

class Package extends ExecutionAbstract implements RunnableInterface
{
    const KEY_FOLDER_BLACKLIST = 'folder-blacklist';
    const KEY_FILE_BLACKLIST = 'file-blacklist';
    const KEY_ARTIFACT_FILENAME = 'artifact-name';
    const CMD_ZIP = 'zip -r ';
    const DEFAULT_FILENAME_ARTIFACT = 'artifact.zip';

    protected $cmd;
    protected $artifactFilename;

    /**
     * Run zip
     */
    public function run()
    {
        try {
            $this->setExecutionPath();
        } catch (Exception $e) {
            $this->dieWithError('Package/Zip', $e);
        }

        echo "Package::setArtifactFilename() called";
        $this->setArtifactFilename();
        echo "ArtifactFilename::" . $this->artifactFilename;
        echo "Package::buildCommand() called";
        $this->buildCommand();
        echo "ExecutionPath::" . $this->executionPath;
        echo "Cmd::" . $this->cmd;
        echo "Package::zip() called";
        $this->zip();
    }

    /**
     * Execute zip command
     */
    protected function zip()
    {
        $fullCommand = sprintf(
            'cd %s && %s',
            $this->executionPath,
            $this->cmd
        );

        var_dump(shell_exec($fullCommand));
    }

    protected function buildCommand() {
        $command = self::CMD_ZIP . $this->artifactFilename . ' . ';

        if (!$this->blacklistEmpty()) {
            $command .= $this->createBlacklist();
        }

        $this->cmd = $command;
    }

    protected function setArtifactFilename() {
        $filename = ArrayHelper::valueByKeySave($this->configuration, self::KEY_ARTIFACT_FILENAME);
        if ($filename === null) {
            $filename = self::DEFAULT_FILENAME_ARTIFACT;
        }

        $this->artifactFilename = $filename;
    }

    protected function blacklistEmpty() {
        return ArrayHelper::valueByKeySave($this->configuration, self::KEY_FILE_BLACKLIST) === null
            && ArrayHelper::valueByKeySave($this->configuration, self::KEY_FOLDER_BLACKLIST) === null;
    }

    protected function createBlacklist() {
        $command = '';
        if ($this->blacklistEmpty()) {
            return $command;
        }
        $command = ' -x';

        $command .= $this->getCommandParametersFromConfigurationArray(self::KEY_FOLDER_BLACKLIST);
        $command .= $this->getCommandParametersFromConfigurationArray(self::KEY_FILE_BLACKLIST);

        return $command;
    }

    protected function getCommandParametersFromConfigurationArray($key, $glue = ' ') {
        $command    = '';
        $valueArray = ArrayHelper::valueByKeySave($this->configuration, $key);
        if ($valueArray !== null && is_array($valueArray)) {
            $command .= ' ';
            $command .= implode($glue, $valueArray);
        }

        return $command;
    }
}