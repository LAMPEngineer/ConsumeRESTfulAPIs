<?php

/*
 *  Items controller to have actions for items
 */
class AuthController extends MyController
{

	private $token;

	// setter & getter
	public function setToken($token){$this->token = $token; }
	public function getToken(){ return $this->token; }

	public function indexAction(): string
	{
		$url = $this->config::AUTH_LOGIN_URL_V2;			
		$method = 'POST';
		
		$data['email']    = 'admin@gmail.com';
		$data['password'] = 'admin123';

		// api call
		$api_response = $this->apihandler->callAPI($url, $method, $data);

		if(is_object($api_response)){
			$this->token = $api_response->jwt;
			//$response = "Login Successful";

			$url = $this->config::ITEM_API_URL_V2;			
			$method = 'GET';
			$jwt_token = $this->token;

			// api call
			$content = $this->apihandler->callAPI($url, $method, false, $jwt_token);
			$response = $content;

		} else {
			$response = $api_response;
		}
		
		return $response;
	}
	
}