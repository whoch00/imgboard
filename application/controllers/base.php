<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	/** 
	 * csrf protection
	 *
	 * I dont wanna to have to type it in every file, so let inherit this instead.
	 */

	public function __construct()
	{
		$this->filter('before', 'csrf')->on('post');
	}

}