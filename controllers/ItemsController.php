<?php

/*
 *  Items controller to have actions for items
 */
class ItemsController extends MyController
{
	/**
	 * to get all items by api call
	 * and list it to view
	 * 
	 * @return string view HTML
	 */
	public function indexAction(): string
	{
		$api_handler = ucfirst('Handle') . 'Api';
		
		if(class_exists($api_handler)){

			$url = $this->config::ITEM_API_URL;			
			$method = 'GET';

			// get api handler
			$apihandler = new $api_handler($url, $method);
		} 
		
		// api call
		$content = $apihandler->callAPI();

		// get view and render
		$view = $this->getView('index');
		$response= $view->render($content);

		return $response;

	}

	public function getAction($view, $resource_id)
	{
		$response = array('message' => 'you requested to list item ID = '.$resource_id,'status' => '1');

		return $response;
	}
}