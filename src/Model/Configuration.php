<?php


namespace ArtifactCreation\Model;

use ArtifactCreation\Builder\PackageConfigurationBuilder;
use ArtifactCreation\Exception\MissingConfigurationException;
use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;
use ArtifactCreation\Helper\Parser;

/**
 * Parses the mandatory configuration file
 * and acts as a DTO
 *
 * Class Configuration
 * @package ArtifactCreation\Helper
 */
class Configuration
{
    /** @var string CONFIGURATION_KEY_COMPOSER */
    const CONFIGURATION_KEY_COMPOSER = 'composer';
    /** @var string CONFIGURATION_KEY_PACKAGE */
    const CONFIGURATION_KEY_PACKAGE = 'package';
    /** @var string CONFIGURATION_KEY_PACKAGE_TYPE */
    const CONFIGURATION_KEY_PACKAGE_TYPE = 'type';

    /** @var array $configuration */
    protected $configuration;
    /** @var ComposerConfiguration|null $composerConfiguration */
    protected $composerConfiguration;
    /** @var PackageConfigurationAbstract $packageConfiguration */
    protected $packageConfiguration;
    /** @var Parser $parser */
    protected $parser;

    /**
     * Configuration constructor.
     *
     * @param Parser $parser
     *
     * @since 0.0.1
     */
    public function __construct(Parser $parser)
    {
       $this->setParser($parser);
    }

    /**
     * Initialize configurations
     *
     * @return $this
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     *
     * @since 0.0.1
     */
    public function init()
    {
        $this->setConfiguration();
        $this->initPackageConfiguration();
        $this->initComposerConfiguration();

        return $this;
    }

    /**
     * Set configuration property
     *
     * @since 0.0.1
     */
    protected function setConfiguration()
    {
        $this->configuration = $this->parser->parse();
    }

    /**
     * Set parser property
     *
     * @param Parser $parser
     *
     * @since 0.0.1
     */
    protected function setParser(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Initialize the package configuration
     *
     * @throws MissingConfigurationException
     * @throws MissingParameterException
     */
    protected function initPackageConfiguration()
    {
        $packageConfiguration = ArrayHelper::valueByKey(
            $this->configuration,
            self::CONFIGURATION_KEY_PACKAGE,
            true
        );

        $this->packageConfiguration = (new PackageConfigurationBuilder())->build($packageConfiguration);
    }

    /**
     * Initialize the composer configuration
     *
     * @throws MissingParameterException
     */
    protected function initComposerConfiguration()
    {
        $composerConfiguration = ArrayHelper::valueByKey($this->configuration, self::CONFIGURATION_KEY_COMPOSER);

        if ($composerConfiguration !== null) {
            $composerConfiguration = new ComposerConfiguration($composerConfiguration);
            $composerConfiguration->setCommand();
        }

        $this->composerConfiguration = $composerConfiguration;
    }

    /**
     * Get the composer configuration
     *
     * @return ComposerConfiguration|null
     */
    public function getComposerConfiguration()
    {
        return $this->composerConfiguration;
    }

    /**
     * Get the package configuration
     *
     * @return PackageConfigurationAbstract
     */
    public function getPackageConfiguration()
    {
        return $this->packageConfiguration;
    }

    /**
     * Check if composer configuration exists
     *
     * @return bool
     */
    public function hasComposerConfiguration()
    {
        if ($this->composerConfiguration === null) {
            return false;
        }

        return true;
    }
}
