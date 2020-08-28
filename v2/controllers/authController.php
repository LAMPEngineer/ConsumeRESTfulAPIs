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

			$items = new ItemsController();
			$items->setToken($this->token);
			$response = $items->indexAction();

			
			/**
			 * Set JWT token to cookie
			 * 
			 * we can change the 15 in setcookie() to amount of days the cookie will expire in.
			 * The "/" in setcookie is important, because it ensures the cookies will be available on every page the user visits on our website.
			 * 
			 */
			setcookie('jwtaccesstoken',$this->token, time()+(3600 * 24 * 15),"/");

			}

		}

		return $response;
	}


	public function processRequest($action, $resource_id, $controller=null): string
	{
		if(!empty($controller)){

			// get jwt token from cookie		
			$jwt_token = $_COOKIE['jwtaccesstoken'];

			if(!empty($jwt_token)){

				$controller->setToken($jwt_token);

				// route to controller action
				$response = $controller->$action($resource_id);

			} else {
				$response = "JWT token not set!";
			}
			
		}else{
			$response = $this->$action();
		}

		return $response;
	}
	
}