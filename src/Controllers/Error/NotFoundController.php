<?php

/**
 * @Route(name="page")
 */
class NotFoundController extends AbstractController
{
        
	/**
	 * @param $context
	 * @Route(path="/404", name="_not_found", method="GET")
	 */
	public function pageNotFound($context): void
	{
		header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		$this->render("404", $context);
	}

}