<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function sanitize_str($s) {
		$sanitized = str_replace('"', "'", $s);
		return eval('return "'.$sanitized.'";');
 	}
}