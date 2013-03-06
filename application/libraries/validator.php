<?php

class Validator extends Laravel\Validator {

	/** 
	 * override default implicit() method to always run required_without and required_for_new_thread
	 */

	protected function implicit($rule)
	{
		return $rule == 'required' or $rule == 'accepted' or $rule == 'required_with' or $rule == 'required_without' or $rule == 'required_for_new_thread';
	}

	/**
	 * override default validate_image to check for embed rar files and make bmp invalid image type
	 */

	protected function validate_image($attribute, $value)
	{
		if (extension_loaded('rar')) {
			$rar = @RarArchive::open($value['tmp_name'], null);
			if ($rar !== false) { 
				$rar->close();
				return false;
			}
		}

		return $this->validate_mimes($attribute, $value, array('jpg', 'png', 'gif'));
	}

	/**
	 * check if a board exists
	 */

	protected function validate_board($attribute, $value, $parameters)
	{
		$board = Board::where('id', '=', $value)->count();

		return $board !== 0;
	}

	/**
	 * check if parent_id is a valid thread
	 */

	protected function validate_parent($attribute, $value, $parameters)
	{
		if ($value == 0) {
			return true;
		}

		$parent = Post::where('id', '=', $value)
		->where('board', '=', $this->attributes['board_id'])
		->where('parent_id', '=', 0)
		->count();

		return $parent !== 0;
	}

	/**
	 * Make an attribute mandatory if another is empty
	 */ 

	protected function validate_required_without($attribute, $value, $parameters)
	{
		$other = $parameters[0];
		$other_value = array_get($this->attributes, $other);		

		if (!$this->validate_required($other, $other_value)) {
			return $this->validate_required($attribute, $value);
		}

		return true;
	}

	/**
	 * Check if file is submited when creating a new thread
	 */	

	protected function validate_required_for_new_thread($attribute, $value, $parameters) 
	{
		if ($this->attributes['parent_id'] == 0 && !$this->validate_required('file', $this->attributes['file'])) {
			return false;
		}

		return true;
	}

}