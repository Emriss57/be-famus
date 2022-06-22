<?php

class HomeController extends AbstractController
{
	
	/**
	 * @param $context
	 * @Route(path="/", name="home", method="GET")
	 */
	public function index($context): void
	{	
		$this->render("index", $context);
	}

	
	// /**
	//  * @param $context
	//  * @Route(path="/user/register", name="register", method="GET")
	//  */
	// public function registerUser($context): void {
	// 	$this->render("RegisterUser", $context);
	// }


	/**
	 * @param $context
	 * @Route(path="/mentions-legales", name="legales-notice", method="GET")
	 */
	public function legalNotice($context): void
	{
		$this->render("index", $context);
	}

}