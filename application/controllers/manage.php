<?php

class Manage_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_index()
	{
		if (!Auth::check()) {
			return Redirect::to_route('login');
		}

		return View::make('manage/index');
	}

	public function get_login() 
	{
		return View::make('manage/login');
	}

	public function post_login() 
	{
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($credentials)) {
			return Redirect::to_route('manage');
		}

		return Redirect::to_route('login')->with_errors('Usuário e/ou senha invalido(s).');
	}

	public function get_logout()
	{
		Auth::logout();

		return Redirect::to('/');
	}
}