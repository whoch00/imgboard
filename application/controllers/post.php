<?php

class Post_Controller extends Base_Controller {

	public $restful = true;

	private static $rules = array(
		'board_id' => 'required|integer|board',
		'parent_id' => 'required|integer|parent',
		'file' => 'image|required_without:message|required_for_new_thread',
		// 'message' => 'required_without:file'
		'message' => 'max:8152|min:3|required_without:file'
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function post_index() 
	{
		$validation = Validator::make(Input::all(), static::$rules);		

		if ($validation->fails()) {
			return Redirect::back()->with_errors($validation->errors->all())->with_input();
		}

		$data = array(
			'board_id' => Input::get('board_id'),
			'parent_id' => Input::get('parent_id'),
			'name' => Input::get('name'),
			'tripcode' => null,
			'email' => Input::get('email'),
			'subject' => Input::get('subject'),
			'message' => Input::get('message'),
			'password' => Input::get('password'),
			'ip_address' => Request::ip(),
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
		);

		$post = Post::create($data);

		if (Input::get('parent_id') > 0) {
			$parent::find(Input::get('parent_id'));
			$parent->touch();
		}

		if (Input::file('file')) {
			$filename = time() . mt_rand(10, 99) . '.' . File::extension(Input::file('file.name'));
			$size = getimagesize(Input::file('file.tmp_name'));
			$sha1 = sha1_file(Input::file('file.tmp_name'));

			$resize = Resizer::open(Input::file('file'))
			                 ->resize(200, 200, 'auto')
			                 ->save(path('public') . 'uploads/thumbs/' . $filename, 90);

			Input::upload('file', path('public') . 'uploads/files', $filename);			

			$data = array(
				'board_id' => Input::get('board_id'),
				'post_id' => $post->id,
				'filename' => $filename,
				'filename_original' => Input::file('file.name'),
				'sha1' => $sha1,
				'size' => Input::file('file.size'),
				'res_x' => $size[0],
				'res_y' => $size[1]
			);

			Image::create($data);
		}

		return Redirect::back();
	}
}

// TODO: tripcode
//       verificacao contra flood
