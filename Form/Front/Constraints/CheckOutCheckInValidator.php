<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 03/06/2016
 * Time: 21:11
 */

namespace Oni\TravelPortBundle\Form\Front\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CheckOutCheckInValidator extends ConstraintValidator{

	public function validate($protocol, Constraint $constraint)
	{
		if ($protocol->getFoo() != $protocol->getBar()) {
			$this->context->buildViolation($constraint->message)
			              ->atPath('foo')
			              ->addViolation();
		}
	}

}