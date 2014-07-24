<?php

class BaseController extends Controller
{
    use Efficiently\JqueryLaravel\ControllerAdditions;

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.application';

    // Be sure to call parent::__construct() when needed
    public function __construct()
    {
        // Perform CSRF check on all post/put/patch/delete requests
        //if (\App::environment() === "production") {
        $this->beforeFilter('csrf'/*, ['on' => ['post', 'put', 'patch', 'delete']]*/);
        //}
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }
}
