<?php
/*namespace api;

use \api\UserFunctions as UserFunctions;
*/
/*
 *  Class to consume APIs 
 *  
 *  @date       Thuresday, Apr 02, 2020
 *  @author     G PRASAD <LAMP.Engineer@gmail.com>
 *  @modified   Friday, Apr 03, 2020
 *
 */
class Consume
{

	/**
	 * $url to call API
	 * 
	 * @var string
	 */
	private $url='';


	/**
	 * method to be use for api call
	 * POST, GET, PUT etc
	 * 
	 * @var string
	 */
	private $method='';

	/**
	 * This is optional, if data need to 
	 * pass with api call
	 * 
	 * @var array
	 */
	private $data = [];

	/**
	 * Class cunstructur
	 * 
	 * @paaram string url for API call
	 */

	function __construct($url, $method, $data = false){

		$this->url = $url;

		$this->method = $method;

		$this->data = $data;


	}


	/**
	 * Call API with url. This uses cURL to call api.
	 * 
	 * @return array 	data on success 		i.e 1
	 *         string 	message on unsuccess 	i.e 0
	 *         
	 * @catch exception if fails.
	 */
	public function callAPI()
    {

    	// curl client class
    	$userfunctions = new UserFunctions();
    	
    	try{
				$response = $userfunctions->curlcall($this->url, $this->method, $this->data);

			} catch(\Exception $e){

				echo $e->getMessage();
			}

    	//if success i.e 1
    	if($response->status){

    				//data
    		return $response->data;

    	} else {

    				//error message
    		return $response->message;

    	}


    }



}