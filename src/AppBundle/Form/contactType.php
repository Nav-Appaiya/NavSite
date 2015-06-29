<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 29-6-2015
 * Time: 23:23
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class contactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('email', 'text')
            ->add('message', 'textarea')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\contact'
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}
