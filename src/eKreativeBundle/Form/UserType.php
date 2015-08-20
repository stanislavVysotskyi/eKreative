<?php

namespace eKreativeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text',
                array(
                    'attr' => array('placeholder' => 'Your first name')
                )
            )
            ->add('lastName', 'text',
                array(
                    'attr' => array('placeholder' => 'Your last name')
                )
            )
            ->add('email', 'email',
                array(
                    'attr' => array('placeholder' => 'Email')
                )
            )
            ->add('save', 'submit', array('label' => 'Create User'))
        ;
        $builder->setAction('new-user');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'eKreativeBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ekreativebundle_user';
    }
}