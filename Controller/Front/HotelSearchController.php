<?php

namespace Oni\TravelPortBundle\Controller\Front;

use Oni\CoreBundle\Controller\CoreController;
use Oni\CoreBundle\Doctrine\Spec\CitySearch;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Repository\CityRepository;
use Oni\TravelPortBundle\Form\Front\HotelSearchForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HotelSearchController extends CoreController
{

    /**
     * @var \Oni\TravelPortBundle\Form\Front\HotelSearchForm
     */
    protected $hotelSearchForm;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    public function __construct(HotelSearchForm $hotelSearchForm) {

        $this->hotelSearchForm = $hotelSearchForm;
        $this->request = new Request();

    }

    public function indexAction()
    {

        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');

        
        $hotelSearchForm = $this->createForm(HotelSearchForm::class);

        if ($this->request->isMethod('POST')) {

            $hotelSearchForm->handleRequest($this->request);

            if ($hotelSearchForm->isSubmitted() && $hotelSearchForm->isValid()) {

                $this->addFlash('notice',$this->translator->trans('product_bundle.product.category.deleted'));

            }else{

                $this->flashErrors($hotelSearchForm);

            }

        }


        return $this->render('@travel_port/'.$this->travelPortTheme.'/hotel_search.html.twig', array(
            'hotelSearchForm' => $hotelSearchForm->createView()
        ));

    }

    public function hotelResultsAction(Request $request)
    {

        

    }

}
