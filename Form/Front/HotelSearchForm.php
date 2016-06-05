<?php

namespace Oni\TravelPortBundle\Form\Front;


use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Country;
use Oni\CoreBundle\Entity\Currency;
use Oni\CoreBundle\Entity\Nationality;
use Oni\CoreBundle\Service\CountryService;
use Oni\TravelPortBundle\Form\Front\Constraints\CheckOutCheckIn;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class HotelSearchForm  extends AbstractType
{

    /**
     * @var \Oni\CoreBundle\Service\CountryService
     */
    protected $countryService;

    /**
     * @var array
     */
    protected $availableCurrencies;

    /**
     * @var array
     */
    protected $cities = [];

     public function __construct(
         CountryService $countryService,
         array $availableCurrencies,
         array $formData){

         $this->availableCurrencies = $availableCurrencies;
         $this->countryService = $countryService;
         $this->cities = !empty($formData['cities']) ? $formData['cities'] : [] ;

     }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $cities = $this->cities;


        $builder
            ->add('country', ChoiceType::class , array(
                'label' => 'Country',
                'placeholder' => 'Select Country',
                'choices' => $this->countryService->getCountries(),
                'choice_label' => function($country, $key, $index) {
                    /** @var $country  Country */
                    return $country->getNiceName();
                },
                'choice_value' => 'id'
            ))
            ->add('city', EntityType::class , array(
                'label' => 'City',
                'class' => 'Oni\CoreBundle\Entity\City',
                'placeholder' => 'Select City',
                'choices' => $cities,
                'choice_label' => function($city, $key, $index) {
                    /** @var $city  City */
                    return $city->getCityName();
                },
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
                    new GreaterThanOrEqual('today'),
                    //new CheckOutCheckIn()
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
                    new GreaterThan('today'),
                    //new CheckOutCheckIn()
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


            ->add('numberOfRooms', ChoiceType::class , array(
              'label' => 'Rooms',
              'required' => true,
              'choices' => [ 1 => 1 ,2,3,4,5,6,7,8,9,10 ]
            ))
            ->add('adults', ChoiceType::class , array(
                'label' => 'Adults',
                'required' => true,
                'choices' => [ 1 => 1 ,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 ]
            ))
            ->add('children', ChoiceType::class , array(
                'label' => 'Children',
                'placeholder' => '0',
                'required' => false,
                'choices' => [ 1 => 1 ,2,3,4,5,6,7,8,9,10 ]
            ))
            ->add('search', SubmitType::class , array(
                'label' => 'Search'
            ));
        if ($this->availableCurrencies) {
            $builder->add( 'currency', ChoiceType::class, array(
                    'label' => 'Currency',
                    'placeholder' => 'Select Currency',
                    'choices' => $this->countryService->getCurrenciesByCurrencyCodes($this->availableCurrencies),
                    'choice_label' => function($currency, $key, $index) {
                        /** @var Currency $currency */
                        return $currency->getCurrencyName();
                    },
                    'choice_value' => 'id'
                )
            );
        }

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