<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 14-3-2015
 * Time: 14:33
 */

namespace Nav\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text')
            ->add('email', 'email')
            ->add('message', 'textarea')
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'contact';
    }

}
