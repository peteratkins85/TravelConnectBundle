<?php

namespace Oni\TravelPortBundle\Form\Front\Constraints;

use Symfony\Component\Validator\Constraint;

class CheckOutCheckIn extends Constraint{

	public $message = 'Checkout data must be greater than checkIn.';

	

}