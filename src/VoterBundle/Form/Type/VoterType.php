<?php

namespace VoterBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class VoterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('select', CheckboxType::class, [
                'label' => 'form.yes',
                'required' => false,
            ])
            ->add('save', 'submit', ['label' => 'security.registration.voter'])
        ;
    }
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'VoterBundle\Model\VoterModel',
        );
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoterBundle\Model\VoterModel',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'form_voter';
    }
}