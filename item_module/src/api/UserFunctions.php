<?php
//namespace api;

/*
 *  Class for global user functions 
 *  
 *  @date       Thuresday, Apr 02, 2020
 *  @author     G PRASAD <LAMP.Engineer@gmail.com>
 *  @modified   Friday, Apr 03, 2020
 *
 */
class UserFunctions
{
	/**
	 * Function to execute cURL
	 * 
	 * @param  string 	$url 		API call url
	 * @param  string 	$method 	metho to use [POST, GET, PUT, etc]
	 * @param  array 	$data 		data to be pass (optionat)
	 * 
	 * @return array object    		response data in array
	 * 
	 * @throws Exception If cURL request fails.
	 */
	public function curlcall($url, $method, $data = false)
    {

 		// init curl
		 $client = curl_init($url);

		 switch ($method) 
		 {
		 	case 'POST':
		 		curl_setopt($client, CURLOPT_POST, 1);

		 		if($data)
		 			curl_setopt($client, CURLOPT_POSTFIELDS, $data);
		 		break;

		 	case 'PUT':
		 		curl_setopt($client, CURLOPT_PUT, 1);
		 		break;

		 	default:
		 		if($data)
		 			$sprintf("%s?%s", $url, http_build_query($data));
		 		break;
		 }


		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);


		// execute curl
		$response = curl_exec($client);

		// throw exception if fails
		if(curl_errno($client)){

        	throw new Exception(curl_error($client));
    	}

		// close curl resource to free up system resources
		curl_close($client);
		

		//JSON decode to the response
		 $result = json_decode($response);

		 // return response 
		 return $result;
    }

}