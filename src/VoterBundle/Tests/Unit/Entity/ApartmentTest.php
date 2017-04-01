<?php

namespace VoterBundle\Tests\Unit\Entity;

use Symfony\Component\PropertyAccess\PropertyAccess;


use VoterBundle\Entity\Apartment;

class ApartmentTest extends \PHPUnit_Framework_TestCase
{
    public function testIdGetter()
    {
        $obj = new Apartment();

        $this->setId($obj, 1);
        $this->assertEquals(1, $obj->getId());
    }

    /**
     * @dataProvider getSetDataProvider
     * @param string $property
     * @param mixed  $value
     */
    public function testSettersAndGetters($property, $value)
    {
        $obj = new Apartment();

        $accessor = PropertyAccess::createPropertyAccessor();
        $accessor->setValue($obj, $property, $value);
        $this->assertEquals($value, $accessor->getValue($obj, $property));
    }

    public function testToString()
    {
        $obj = new Apartment();
        $obj->setApartmentArea('test subject');
        $this->assertEquals('test subject', (string)$obj);
    }

    /**
     * @param mixed $obj
     * @param mixed $val
     */
    protected function setId($obj, $val)
    {
        $class = new \ReflectionClass($obj);
        $prop  = $class->getProperty('id');
        $prop->setAccessible(true);

        $prop->setValue($obj, $val);
    }

}