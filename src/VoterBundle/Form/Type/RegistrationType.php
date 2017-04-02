<?php

namespace VoterBundle\Form\Type;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text', ['label' => 'security.registration.username'])
            ->add('area','text', ['label' => 'security.registration.area'])
            ->add('email','text')
            ->add('owner',CheckboxType::class, array(
                'required' => false,
                'label' => 'security.registration.owner'
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('apartment', 'entity', array(
                'label' => 'security.registration.apartment',
                'class' => 'VoterBundle:Apartment',
                'choice_label' => 'apartmentArea'
            ))
            ->add('house', 'entity', array(
                'label' => 'security.registration.house',
                'class' => 'VoterBundle:house',
                'query_builder' => function (EntityRepository $entity) use ($options) {
                    $r = $entity->createQueryBuilder('s')->where('s.id = :bool')
                        ->setParameter('bool', 1);

                    return $r;

                },
                'choice_label' => 'sum_area'
            ))
            ->add('save', 'submit', ['label' => 'security.registration.save'])
        ;
    }
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'VoterBundle\Entity\User',
        );
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'VoterBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}