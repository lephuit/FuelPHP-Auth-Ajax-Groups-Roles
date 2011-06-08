<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Common {
	public function action_index()
	{
        $this->template->title = "Welcome";
		$this->template->content = View::factory('welcome/index'); 
	}
	public function action_404()
	{
        Log::info('ERROR 404: ' . $_SERVER['REDIRECT_URL']);
        $this->response->status = 404;
        $this->template->title = "404";
		$this->template->content = View::factory('welcome/404');
	}
}

/* End of file welcome.php */