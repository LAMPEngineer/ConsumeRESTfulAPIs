<?php
/**
 *  parent controller
 *  it gets config properties 
 */
class MyController
{
	/**
	 * config variable
	 * @var string
	 */
	protected $config='';

	/**
	 * to hold object of Handle API
	 * 
	 * @var object
	 */
	protected $apihandler;

	/**
	 * to hold api url
	 * @var string
	 */
	protected $api_url;

	/**
	 * to hold jwt token
	 * @var string
	 */
	protected $jwt_token;

	/**
	 * initialize config 
	 */
	public function __construct()
	{
		// config 		
		$this->config = ucfirst('property') . 'Config';

		$this->apiHandle();

		$this->api_url = $this->config::ITEM_API_URL_V2;

	}

	// setter & getter
	public function setToken($jwt_token){$this->jwt_token = $jwt_token; }
	public function getToken(){ return $this->jwt_token; }

	/**
	 * to get view object
	 * 
	 * @param  string $view_name 
	 * @param  array  $content
	 * @return string HTML       
	 */
	public function getView(string $view_name, $content=null): string
	{
		// view 
		$view_name = ucfirst($view_name) . 'View';

		if(class_exists($view_name)){

			$view = new $view_name();	
		}

		$response = $view->render($content);

		return $response;

	}

	/**
	 * create object of api handler 
	 * 
	 * @return void
	 */
	public function apiHandle(): void
	{
		$api_handler = ucfirst('Handle') . 'Api';
		
		if(class_exists($api_handler)){
			// get api handler
			$this->apihandler = new $api_handler();
		} 
	}

}