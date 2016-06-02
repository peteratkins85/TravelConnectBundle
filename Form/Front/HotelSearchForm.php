<?php

namespace Oni\TravelPortBundle\Form\Front;

use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Country;
use Oni\CoreBundle\Entity\Nationality;
use Oni\CoreBundle\Service\CountryService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Tests\Session\Storage\Proxy\ConcreteSessionHandlerInterfaceProxy;
use Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class HotelSearchForm  extends AbstractType
{

    /**
     * @var \Oni\CoreBundle\Service\CountryService
     */
    private $countryService;

     public function __construct(CountryService $countryService){

         $this->countryService = $countryService;

     }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $cities = array();

        $builder
            ->add('country', ChoiceType::class , array(
                'label' => 'Country',
                'placeholder' => 'Select Country',
                'choices' => $this->countryService->getCountries(),
                'choice_label' => function($country, $key, $index) {
                    /** @var $country  Country */
                    return $country->getNiceName();
                },
            ))
            ->add('city', EntityType::class , array(
                'label' => 'City',
                'class' => 'Oni\CoreBundle\Entity\City',
                'placeholder' => 'Select City',
                'choices' => $cities,
                'empty_data'  => '__select country first__'
            ))
            ->add('nationality', ChoiceType::class , array(
                'label' => 'Nationality',
                'choices' => $this->countryService->getNationalities(),
                'choice_label' => function($nationality, $key, $index) {
                    /** @var $nationality  Nationality */
                    return $nationality->getNationality();
                },
            ))
            ->add('cityId', HiddenType::class , array(
                'required' => true
            ))
            ->add('checkIn', DateType::class , array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5'  => false,
                'attr'   => array(
                    'class' => 'checkin-date'
                ),
                'constraints' => array(
                    new Date(),
                    new GreaterThanOrEqual('today')
                ),
            ))
            ->add('checkOut', DateType::class , array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5'  => false,
                'attr'   => array(
                    'class' => 'checkout-date'
                ),
                'constraints' => array(
                    new Date(),
                    new GreaterThan('today')
                ),
            ))
            ->add('nationality', ChoiceType::class , array(
                'label' => 'Nationality',
                'choices' => $this->countryService->getNationalities(),
                'choice_label' => function($nationality, $key, $index) {
                    /** @var $nationality  Nationality */
                    return $nationality->getNationality();
                },

            ))
//            ->add('availableOnly', CheckboxType::class, array(
//              'label' => 'Available Only',
//              'required' => false
//            ))
            ->add('rating', ChoiceType::class, array(
                'label' =>  'Rating',
                'choices' => array(
                    '1 star' => 1,
                    '2 star' => 2,
                    '3 star' => 3,
                    '4 star' => 4,
                    '5 star' => 5
                ),
                'multiple' => true
            ))
            ->add('currency', CurrencyType::class)
            ->add('roomType', ChoiceType::class, array(
                'label' => 'Room Type',
                'choices' => array(
                    'Single' => 0,
                    'Double' => 1,
                    'King'   => 3
                ),
                'multiple' => false
            ))
            ->add('numberOfRooms', ChoiceType::class , array(
              'label' => 'Rooms',
              'required' => true,
              'choices' => [ 1,2,3,4,5,6,7,8,9,10 ]
            ))
            ->add('search', SubmitType::class , array(
                'label' => 'Search'
            ))
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

}