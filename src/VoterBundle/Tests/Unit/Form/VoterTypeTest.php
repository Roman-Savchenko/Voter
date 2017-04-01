<?php

namespace VoterBundle\Tests\Unit\Form\Type;

use VoterBundle\Form\Type\VoterType;

class VoterTypeTest extends \PHPUnit_Framework_TestCase
{
    /** @var VoterType */
    protected $type;

    protected function setUp()
    {
        $this->type = new VoterType();
    }

    protected function tearDown()
    {
        unset($this->type);
    }

    public function testFields()
    {
        $builder = $this->getMockBuilder('Symfony\Component\Form\FormBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $voterModel = $this
            ->getMockBuilder('VoterBundle\Model\VoterModel')
            ->disableOriginalConstructor()
            ->getMock();

        $voterModel->expects($this->any())->method('getId')->willReturn(null);
        $builder->expects($this->any())->method('add')->willReturn($builder);
        $options = [];

        $this->type->buildForm($builder, $options);
    }

    public function testConfigureOptions()
    {
        $resolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with($this->isType('array'));
        $this->type->configureOptions($resolver);
    }

    public function testHasName()
    {
        $this->assertEquals('form_voter', $this->type->getName());
    }
}
