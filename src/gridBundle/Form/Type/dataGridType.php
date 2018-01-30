<?php
/**
 * Created by PhpStorm.
 * User: rwd
 * Date: 11/27/17
 * Time: 12:28 AM
 */

namespace gridBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class dataGridType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Standard Shipping' => 'standard',
                'Expedited Shipping' => 'expedited',
                'Priority Shipping' => 'priority',
            ),
            'choices_as_values' => true,
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
