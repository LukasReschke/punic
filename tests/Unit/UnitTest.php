<?php
use \Punic\Unit;

class UnitTest extends PHPUnit_Framework_TestCase
{

    public function providerFormat()
    {
        return array(
            array(
                '1 millisecond',
                array(1, 'millisecond', 'long', 'en')
            ),
            array(
                '1 millisecond',
                array(1, 'duration/millisecond', 'long', 'en')
            ),
            array(
                '2 milliseconds',
                array(2, 'millisecond', 'long', 'en')
            ),
            array(
                '0 milliseconds',
                array(0, 'millisecond', 'long', 'en')
            ),
            array(
                '0 milliseconde',
                array(0, 'millisecond', 'long', 'fr')
            ),
            array(
                '1 milliseconde',
                array(1, 'millisecond', 'long', 'fr')
            ),
            array(
                '2 millisecondes',
                array(2, 'millisecond', 'long', 'fr')
            ),
            array(
                '2 ms',
                array(2, 'millisecond', 'short', 'en')
            ),
            array(
                '2ms',
                array(2, 'millisecond', 'narrow', 'en')
            ),
            array(
                '0.2ms',
                array(.2, 'millisecond', 'narrow', 'en')
            ),
            array(
                '2.0ms',
                array('2.0', 'millisecond', 'narrow', 'en')
            ),
            array(
                '2.0 milliseconds',
                array(2, 'millisecond', 'long,1', 'en')
            ),
            array(
                '2.0 milliseconds',
                array(2., 'millisecond', 'long,1', 'en')
            ),
            array(
                '2.0 milliseconds',
                array('2.', 'millisecond', 'long,1', 'en')
            ),
            array(
                '2.0 milliseconds',
                array('2.0123', 'millisecond', 'long,1', 'en')
            ),
            array(
                '2.0 ms',
                array('2.0123', 'millisecond', '1', 'en')
            ),
            array(
                '2.0 ms',
                array('2.0123', 'millisecond', 1, 'en')
            ),
            array(
                '2,0 millisecondi',
                array('2.0123', 'millisecond', 'long,1', 'it')
            ),
        );
    }

    /**
     * test format
     * @dataProvider providerFormat
     */
    public function testFormat($result, $parameters)
    {
        $this->assertSame(
            $result,
            Unit::format($parameters[0], $parameters[1], $parameters[2], $parameters[3])
        );
    }

    public function testValueNotInListExceptionGetValue()
    {
        try {
            Unit::format(2, 'milisecond', 'does-not-exist');
        } catch (\Punic\Exception\ValueNotInList $ex) {
            $this->assertSame('does-not-exist', $ex->getValue());
            $this->assertSame(array('long', 'short', 'narrow'), $ex->getAllowedValues());
        }
    }

    public function testValueNotInListException()
    {
        $this->setExpectedException('\\Punic\\Exception\\ValueNotInList');
        Unit::format(2, 'milisecond', 'does-not-exist');
    }

    public function testInvalidUnit()
    {
        $this->setExpectedException('\\Punic\\Exception\\ValueNotInList');
        Unit::format(2, 'invalid-unit');
    }

}
