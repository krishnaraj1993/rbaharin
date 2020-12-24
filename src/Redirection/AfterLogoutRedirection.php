<?php

namespace App\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Security;

class AfterLogoutRedirection implements LogoutSuccessHandlerInterface
{
	/**
	 * @var RouterInterface
	 */
	private $router;
	/**
	 * @var Security
	 */
	private $security;

	/**
	 * @param RouterInterface $router
	 * @param Security $security
	 */
	public function __construct(RouterInterface $router, Security $security)
	{
		$this->router = $router;
		$this->security = $security;
	}
	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function onLogoutSuccess(Request $request)
	{
		dump("logouted"); die;
	}
}