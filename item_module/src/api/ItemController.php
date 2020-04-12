<?php

/*
 *  Class item controller to have actions for items
 *  
 *  @date       Tuesday, Apr 07, 2020
 *  @author     G PRASAD <LAMP.Engineer@gmail.com>
 *  @modified   Thursday, Apr 09, 2020
 *
 */
class ItemController
{
	/**
	 * items array
	 * @var array
	 */
	private $items = [];


	/**
	 * URL to call api
	 * @var string
	 */
	private $url='';




	/**
	 * Class cunstructur
	 * 
	 * @paaram string url 		URL to call api 
	 */

	function __construct($url='')
	{
		
		if(!empty($url)){
			$this->url = $url;
			$this->items = $this->getItemList();

		}		

	}

	/**
	 * Function to show item list with actions
	 *	 
	 * @return string 	item list of item
	 *         error 	if item is not available
	 */
	public function showItemsWithActions()
	{
	
		if(is_array($this->items)){
			  

				include(__DIR__.'/../../view/itemlist.php');

			} else {
				
			echo "<p>Error: ".$this->items ."</p>";

			}
			
	}

	/**
	 * Function to show one individual item 
	 * 
	 * @param  int $itemId item id
	 * @return string 	details of item
	 *         error 	if item is not available
	 */
	public function showItem($itemId)
	{
		// get item array for  itemId
		$arrItem = $this->getItemArray($itemId);

		include(__DIR__.'/../../view/showitem.php');

		//return $response;
	}


	public function editItem($itemId)
	{
		// get item array for itemId
		$arrItem = $this->getItemArray($itemId);

		include(__DIR__.'/../../view/edititem.php');

	}


	public function updateItem($postArray, $url)
	{
		$arrUpdateItem = (object)array(
					'id' => $postArray['id'],
					'name' => $postArray['name'],
					'description' => $postArray['description']
		);

		echo "API call to update= <b>".$url."</b>";
		echo "<pre>";
		print_r($arrUpdateItem);
		echo "</pre>";

		$data = json_encode($arrUpdateItem );

		echo "JSON Data = ".$data;

/*		//object of comsume api
		 $consumeapi = new Consume($this->url, 'PUT', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();*/

		echo "<br/><br/><a href=../>Go Back</a>";


	}


	public function deleteItem($itemId, $url)
	{

		// get item array for the item id
		$arrItem = $this->getItemArray($itemId);

		echo "API call to delete= <b>".$url."</b>";
		echo "<pre>";
		print_r($arrItem);
		echo "</pre>";

		$data = json_encode($arrItem );

		echo "JSON data = ".$data;

/*		//object of comsume api
		 $consumeapi = new Consume($this->url, 'DELETE', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();*/

		echo "<br/><br/><a href=../>Go Back</a>";

	}


	public function addItem()
	{


		include(__DIR__.'/../../view/additem.php');

		//echo "<br/><br/><a href=../>Go Back</a>";


	}

	public function createItem($postArray, $url)
	{
		$arrCreateItem = (object)array(					
					'name' => $postArray['name'],
					'description' => $postArray['description']
		);

		echo "API call to create= <b>".$url."</b>";
		echo "<pre>";
		print_r($arrCreateItem);
		echo "</pre>";

		$data = json_encode($arrCreateItem );

		echo "JSON Data = ".$data;

/*		//object of comsume api
		 $consumeapi = new Consume($url, 'POST', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();*/

		echo "<br/><br/><a href=../>Go Back</a>";


	}

	/**
	 * Function to get item list from api cal
	 * 
	 * @return array item list array
	 */
	private function getItemList(): array
	{		
		 //object of comsume api
		 $consumeapi = new Consume($this->url, 'GET');

		//get item list
		 $itemlist = $consumeapi->callAPI();

		 return $itemlist;
	}


	/**
	 * Class function to get one item 
	 * 
	 * @param  int 		$itemId item id
	 * @return array    item details
	 *         string   error if fails
	 */
	private function getItemArray($itemId)
	{

		if(is_array($this->items)){
			
			foreach($this->items as $item){

				if($item->id==$itemId){
					$arrItem = (object)array(
							        'id' => $item->id,
							        'name' => $item->name,
							        'description' => $item->description			        
							    	);			
				}
				
			}

			//include(__DIR__.'/../../view/item.php');
		return $arrItem;
			
		} else {

			echo "<p>Error: ". $this->items."</p>";
		}

	}


}


