<?php

class ExceptionHandlerController extends AbstractController
{

	/**
	 * Catch error
	 *
	 * @param integer $errno
	 * @param string $errstr
	 * @param string $errfile
	 * @param integer $errline
	 * @param array $errcontext
	 * @return boolean
	 */
	public function errorHandler(int $errno, string $errstr, string $errfile, int $errline): bool
	{
		if (!(error_reporting() & $errno)) {
			return false;
		}

		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}

	/**
	 * Catch Exception
	 *
	 * @param [type] $exception
	 * @return boolean
	 */
    public function displayException($exception): bool {
		ob_get_clean ();

		$this->render("error", ['exception' => $exception]);
        return true;
    }

}