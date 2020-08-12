<?php

/*
 *  Auth controller to have actions for authentication
 */
class AuthController extends MyController
{

	private $token;

	// setter & getter
	public function setToken($token){$this->token = $token; }
	public function getToken(){ return $this->token; }

	public function indexAction(): string
	{
		// get view and render
		$response = $this->getView('login');

		if(!empty($_POST)){

			$data['email']    = htmlspecialchars(strip_tags($_POST['email']));
			$data['password'] = htmlspecialchars(strip_tags($_POST['password']));
			
			$url = $this->config::AUTH_LOGIN_URL_V2;			
			$method = 'POST';

			// api call
			$api_response = $this->apihandler->callAPI($url, $method, $data);

			if(is_object($api_response)){
			$this->token = $api_response->jwt;

			header("Location: ./items");
			exit();			
			}

		}

		return $response;
	}
	
}