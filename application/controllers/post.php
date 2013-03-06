<?php

class Post_Controller extends Base_Controller {

	public $restful = true;

	private static $rules = array(
		'board_id' => 'required|integer|board',
		'parent_id' => 'required|integer|parent',
		'file' => 'image|required_without:message|required_for_new_thread',
		// 'message' => 'required_without:file'
		'message' => 'max:8152|min:3'
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function post_index() 
	{
		$validation = Validator::make(Input::all(), static::$rules);		

		if ($validation->fails()) {
			return Redirect::back()->with_errors($validation);
		}

		echo 'ok';
	}
}