<?php namespace ArtifactActionTest;

use ArtifactCreation\Exception\MissingParameterException;
use ArtifactCreation\Helper\ArrayHelper;

/**
 * Class ArrayHelperTest
 *
 * @group wrapper
 * @package ArtifactActionTest
 *
 * @since 0.0.1
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
     * Test if exception is raised on a missing required parameter
     *
     * @doesNotPerformAssertions
     * @small
     *
     * @since 0.0.1
     */
    public function testExpectedExceptionIsRaised()
    {
        $nullValueArray = [
            'key0' => 'test',
            'abc' => ['hello', 'world'],
            self::KEY
        ];

        $this->expectException(MissingParameterException::class);
        ArrayHelper::valueByKey($nullValueArray, self::KEY, true);
    }

    /**
     * @param $array
     * @param $key
     * @param $required
     * @param $default
     * @param $expected
     *
     * @dataProvider valueByKeyDataProvider
     * @small
     *
     * @throws MissingParameterException
     * @since 0.0.1
     */
    public function testValueByKey($array, $key, $required, $default, $expected)
    {
        $result = ArrayHelper::valueByKey($array, $key, $required, $default);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for testValueByKey()
     *
     * @since 0.0.1
     */
    public function valueByKeyDataProvider()
    {
        $validArray = [
            'key0' => 'test',
            'abc' => ['hello', 'world'],
            self::KEY => self::KEY_VALUE
        ];

         yield   'Value by key returned'  => [
             $validArray,
             self::KEY,
             false,
             null,
             self::KEY_VALUE
         ];

         yield   'Value by key returned with required parameter' => [
             $validArray,
             self::KEY,
             true,
             null,
             self::KEY_VALUE
         ];

         yield   'Passed default value returned if key-value not exists' => [
             $validArray,
             'non existing key',
             false, 'fallbackValue',
             'fallbackValue',
         ];
    }

}