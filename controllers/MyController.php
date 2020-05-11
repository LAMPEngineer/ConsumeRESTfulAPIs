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
	public $config='';

	/**
	 * initialize config 
	 */
	public function __construct()
	{
		// config 		
		$this->config = ucfirst('property') . 'Config';

	}

	/**
	 * to get view object
	 * 
	 * @param  string $view_name 
	 * @return object         
	 */
	public function getView(string $view_name): object
	{
		// view 
		$view_name = ucfirst($view_name) . 'View';

		if(class_exists($view_name)){

			$view = new $view_name();	
		}

		return $view;

	}

}