<?php

class Board_Controller extends Base_Controller {

	public $restful = true;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_index($board)
	{
		$board = Board::where('directory', '=', $board)->first();

		if (!count($board)) {
			return Response::error(404);
		}

		return View::make('board.index')->with('board', $board);
	}
}