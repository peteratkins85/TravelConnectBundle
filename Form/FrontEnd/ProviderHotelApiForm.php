<?php

namespace Oni\TravelPortBundle\Form\FrontEnd;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderHotelApiForm  extends AbstractType
{


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('destination')
          ->add('check_in')
          ->add('check_out')
          ->add('nights')
          ->add('nationality')
          ->add('availableOnly')
          ->add('rating')
          ->add('currency')
          ->add('room-type')
          ->add('number-of-rooms')
          ->add('hotel-name')
          ->add('mark-up')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
          'data_class' => 'Oni\TravelPortBundle\Entity\TravelPortUsers'
        ));
    }

}