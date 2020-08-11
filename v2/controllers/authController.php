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

	public function indexAction() : bool
	{
		$url = $this->config::AUTH_LOGIN_URL_V2;			
		$method = 'POST';
		
		$data['email']    = 'admin@gmail.com';
		$data['password'] = 'admin123';

		// api call
		$api_response = $this->apihandler->callAPI($url, $method, $data);

		if(is_object($api_response)){
			$this->token = $api_response->jwt;
			header("Location: ./items");
			//exit();
			$response = true;

			/*$url = $this->config::ITEM_API_URL_V2;			
			$method = 'GET';
			$jwt_token = $this->token;

			// api call
			$content = $this->apihandler->callAPI($url, $method, false, $jwt_token);
			var_dump($content);
			die;
			$response = $content;*/

		} else {
			$response = false;
		}
		
		return $response;
	}
	
}