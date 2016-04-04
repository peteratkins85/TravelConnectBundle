<?php

namespace Oni\TravelConnectBundle\Controller\FrontEnd;

use Oni\CoreBundle\Controller\CoreController;
use Oni\TravelConnectBundle\Entity\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
class AuthController extends CoreController
{

    public function loginAction(Request $request)
    {

        $session = $request->getSession();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $error = $error->getMessage();
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        }

        echo $error;

        return $this->render('@travel_connect/'.$this->travelConnectTheme.'/login.html.twig', array(
          'last_username' => $lastUsername,
          'error' => $error,
          'csrf_token' => $csrfToken,
        ));
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }



}