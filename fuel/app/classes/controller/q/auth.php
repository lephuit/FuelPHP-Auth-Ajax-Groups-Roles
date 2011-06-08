<?php

class Controller_Q_Auth extends Controller_Rest {
    public function get_check()
    {
        Log::info('get_check called..');
        $this->response(array('check' => true, 'message' => 'This is the response for your get query.'), 200);
    }
    public function post_check()
    {
        // pull the username/password from the post data
        $username = html_entity_decode(Input::post('username'));
        $password = html_entity_decode(Input::post('password'));

        // check if the login/password is valid
        $auth = Auth::instance();
        if($auth->login($username, $password))
        {
            // username/password is valid
            $this->response(array('valid' => true, 'redirect' => '/'), 200);
        }
        else
        {
            // username/password is not valid, lets also add a little error message
            $this->response(array('valid' => false, 'error' => 'Invalid user name or password, please try again'), 200);
        }
    }
}

/* End of file q_auth.php */