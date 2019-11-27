<?php namespace ArtifactActionTest;

use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;

/**
 * Class ArrayHelperTest
 *
 * @group Wrappers
 * @package ArtifactActionTest
 */
class ArrayHelperTest extends \Codeception\Test\Unit
{
    /** @var string KEY */
    const KEY = 'myKey';
    /** @var string KEY_VALUE */
    const KEY_VALUE = 'myValue';
    /** @var array $array */
    protected $validArray;
    /** @var array $nullValueArray */
    protected $nullValueArray;

    /**
     * Set arrays for later usage
     *
     * @since 0.0.1
     */
    protected function _before()
    {
        $this->validArray = [
            'key0' => 'test',
            'abc' => ['hello', 'world'],
            self::KEY => self::KEY_VALUE
        ];

        $this->nullValueArray = [
            'key0' => 'test',
            'abc' => ['hello', 'world'],
            self::KEY
        ];
    }

    // tests

    /**
     * Test value returned by key
     *
     * @since 0.0.1
     */
    public function testValueByKey()
    {
        $value = ArrayHelper::valueByKey($this->validArray, self::KEY);
        $this->assertEquals(self::KEY_VALUE, $value);
    }

    /**
     * Test value returned by key with required parameter
     *
     * @since 0.0.1
     */
    public function testValueByKeyWithRequiredParameter()
    {
        $value = ArrayHelper::valueByKey($this->validArray, self::KEY, true);
        $this->assertEquals(self::KEY_VALUE, $value);
    }

    /**
     * Test default value returned if key doesn't exist
     *
     * @since 0.0.1
     */
    public function testNullReturnedAsFallback()
    {
        $value = ArrayHelper::valueByKey($this->validArray, 'non-existing-key');
        $this->assertEquals(null, $value);
    }

    /**
     * Test passed default value returned if key doesn't exist
     *
     * @since 0.0.1
     */
    public function testPassedDefaultValueReturned()
    {
        $defaultValue = 'default-value';
        $value = ArrayHelper::valueByKey($this->validArray, 'non-existing-key', false, $defaultValue);
        $this->assertEquals($defaultValue, $value);
    }

    /**
     * Test if exception is raised on a missing required parameter
     *
     * @doesNotPerformAssertions
     *
     * @since 0.0.1
     */
    public function testExpectedExceptionIsRaised()
    {
        $this->expectException(MissingParameterException::class);
        ArrayHelper::valueByKey($this->nullValueArray, self::KEY, true);
    }
}