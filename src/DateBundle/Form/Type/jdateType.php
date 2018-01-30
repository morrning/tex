<?php
/**
 * Created by PhpStorm.
 * User: sarkesh
 * Date: 12/11/17
 * Time: 12:42 PM
 */

namespace DateBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class jdateType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [

            ]
        );
    }

    public function getParent()
    {
        return TextType::class;
    }

    public function getName()
    {
        return 'jdate';
    }


}