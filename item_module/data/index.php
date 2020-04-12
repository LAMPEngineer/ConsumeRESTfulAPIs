<?php

/*
 *  Class to get json data for test
 */

class Jsondata
{

	/**
	 *  Get item list json
	 *  
	 * @return json data
	 */
	public function getItemList()
	{

		$data = [];

			// make data for item list   
			$data[0] = array(
		        'id' => 1,
		        'name' => 'Item One',
		        'description' => 'This is the description of item one. This is the description of item one. This is the description of item one. This is the description of item one. This is the description of item one.'			        
		    	);
			$data[1] = array(
			    'id' => 2,
			    'name' => 'Item Two',
			    'description' => 'This is the description of item two. This is the description of item two.This is the description of item two.This is the description of item two.This is the description of item two.'			        
		    	);
			$data[2] = array(
			    'id' => 3,
			    'name' => 'Item Three',
			    'description' => 'This is the description of item three. This is the description of item three. This is the description of item three. This is the description of item three. This is the description of item three.',			        
		    	);
			   
			if(!empty($data)){

				$response = json_encode(array('data' => $data, 'status' => 1, 'message'=>'success'));

			} else {

				$response = json_encode(array('data' => null, 'status' => 0, 'message'=>'unsuccessful'));
			}

			return $response;
	}

}

 $testdata = new Jsondata();

 $itemlist = $testdata->getItemList();

 echo $itemlist;