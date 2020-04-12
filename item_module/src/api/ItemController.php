<?php

/*
 *  Class item controller to have CURD actions for items
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
	 * @paaram string url URL to call api 
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
				
				return "<p>Error: ".$this->items ."</p>";

			}
			
	}

	/**
	 * Function to show one individual item 
	 * 
	 * @param  int $itemId item id
	 * @return string view template
	 *         error if item is not available
	 */
	public function showItem($itemId)
	{
		// get item array for  itemId
		$arrItem = $this->getItemArray($itemId);

		include(__DIR__.'/../../view/showitem.php');

	}

	/**
	 * Function to get data and pass it 
	 * to pre filled edit form
	 * 
	 * @param  int $itemId item id
	 * @return string view template
	 */
	public function editItem($itemId)
	{
		// get item array for itemId
		$arrItem = $this->getItemArray($itemId);

		include(__DIR__.'/../../view/edititem.php');

	}

	/**
	 * Function to call update api with data
	 * 
	 * @param  array  $postArray post data
	 * @param  string $url       api url
	 * @return string            response
	 */
	public function updateItem($postArray, $url):string
	{
		$arrUpdateItem = (object)array(
					'id' => $postArray['id'],
					'name' => $postArray['name'],
					'description' => $postArray['description']
		);

		$data = json_encode($arrUpdateItem );

		//object of comsume api
		 $consumeapi = new Consume($this->url, 'PUT', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();

		 return $response;

	}

	/**
	 * Function to delete an item
	 * 
	 * @param  int $itemId    item id
	 * @param  string $url    api url    
	 * @return string         response
	 */
	public function deleteItem($itemId, $url):string
	{

		// get item array for the item id
		$arrItem = $this->getItemArray($itemId);

		$data = json_encode($arrItem );

		//object of comsume api
		 $consumeapi = new Consume($this->url, 'DELETE', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();

		 return $response;
	
	}

	/**
	 * Function to populate add item form
	 * 
	 */
	public function addItem()
	{
		include(__DIR__.'/../../view/additem.php');
	}

	/**
	 * Function to call create api with data
	 * 
	 * @param  array $postArray  post data
	 * @param  string $url       api url
	 * @return string            response
	 */
	public function createItem($postArray, $url)
	{
		$arrCreateItem = (object)array(					
					'name' => $postArray['name'],
					'description' => $postArray['description']
		);

		$data = json_encode($arrCreateItem );


		//object of comsume api
		 $consumeapi = new Consume($url, 'POST', $data);

		 //call api and get response
		 $response = $consumeapi->callAPI();

		 return $response;
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

		return $arrItem;
			
		} else {

			return "<p>Error: ". $this->items."</p>";
		}

	}


}


