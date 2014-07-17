<?php

class BaseController extends Controller {

	use Efficiently\JqueryLaravel\ControllerAdditions;
    
	/**
	 * The layout that should be used for responses.
	 */
	protected $layout = 'layouts.application';
    
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

}
