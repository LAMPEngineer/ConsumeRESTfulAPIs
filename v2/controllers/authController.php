<?php

/*
 *  Items controller to have actions for items
 */
class AuthController extends MyController
{


	public function indexAction(): string
	{
		$url = $this->config::AUTH_LOGIN_URL_V2;			
		$method = 'POST';
		
		$data['email']    = 'admin@gmail.com';
		$data['password'] = 'admin123';

		// api call
		$response = $this->apihandler->callAPI($url, $method, $data);

		$response = "Message= ".$response['message']. " Status = ". $response['status']."jwt = ".$response['jwt'];

		return $response;

	}

}