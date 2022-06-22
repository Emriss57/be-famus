<?php

/**
 * @Route(path="/_debug", name="debug")
 */
class DebugController extends AbstractController
{
        
	/**
	 * @param $context
	 * @Route(path="/", name="_routes", method="GET")
	 */
	public function listRoutes($context): void
	{
		$this->render("routes", $context);
	}

}