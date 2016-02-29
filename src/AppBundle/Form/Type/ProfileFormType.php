<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array('translation_domain' => 'AppBundle'))
            ->add('surname',null,array('translation_domain' => 'AppBundle'))
            ->add('website',null,array('translation_domain' => 'AppBundle'))
            ->add('phone',null,array('translation_domain' => 'AppBundle'))
            ->add('address',null,array('translation_domain' => 'AppBundle'));
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }
    public function getName()
    {
        return 'app_user_profile';
    }
}