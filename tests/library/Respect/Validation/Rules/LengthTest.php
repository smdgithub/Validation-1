<?php

namespace Respect\Validation\Rules;

class LengthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidLenght
     */
    public function testLengthValid($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertTrue($validator->assert($string));
    }

    /**
     * @dataProvider providerForInvalidLenghtInclusive
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function testLengthInvalidInclusive($string, $min, $max)
    {
        $validator = new Length($min, $max, false);
        $this->assertfalse($validator->validate($string));
        $this->assertfalse($validator->assert($string));
    }

    /**
     * @dataProvider providerForInvalidLenght
     * @expectedException Respect\Validation\Exceptions\LengthException
     */
    public function testLengthInvalid($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertFalse($validator->validate($string));
        $this->assertFalse($validator->assert($string));
    }

    /**
     * @dataProvider providerForComponentException
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testLengthComponentException($string, $min, $max)
    {
        $validator = new Length($min, $max);
        $this->assertFalse($validator->validate($string));
        $this->assertFalse($validator->assert($string));
    }

    public function providerForValidLenght()
    {
        return array(
            array('alganet', 1, 15),
            array(range(1, 20), 1, 30),
            array((object) array('foo'=>'bar', 'bar'=>'baz'), 1, 2),
            array('alganet', 1, null), //null is a valid max length, means "no maximum",
            array('alganet', null, 15) //null is a valid min length, means "no minimum"
        );
    }

    public function providerForInvalidLenghtInclusive()
    {
        return array(
            array('alganet', 1, 7),
            array(range(1, 20), 1, 20),
            array('alganet', 7, null), //null is a valid max length, means "no maximum",
            array('alganet', null, 7) //null is a valid min length, means "no minimum"
        );
    }

    public function providerForInvalidLenght()
    {
        return array(
            array('alganet', 1, 3),
            array((object) array('foo'=>'bar', 'bar'=>'baz'), 3, 5),
            array(range(1, 50), 1, 30),
        );
    }

    public function providerForComponentException()
    {
        return array(
            array('alganet', 'a', 15),
            array('alganet', 1, 'abc d'),
            array('alganet', 10, 1),
        );
    }

}