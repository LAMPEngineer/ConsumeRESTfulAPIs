<?php
/**
 * Request handler for item module
 *
 * All request comes here and this file respond 
 * back the client
 * 
 *  @date       Tuesday, Apr 07, 2020
 *  @author     G PRASAD <LAMP.Engineer@gmail.com>
 *  @modified   Friday, Apr 10, 2020
 * 
 */

require_once(__DIR__.'/config.php');

//autoloader
 spl_autoload_register(function ($class){
	require_once(__DIR__.'/src/api/'.$class.'.php');
});


//get the request URI
$url_array = explode('/', $_SERVER['REQUEST_URI']);
array_shift($url_array); // remove first value as it's empty
array_shift($url_array); // remove first value as it's empty


if($url_array[0]=='item_module'){

	//html head tags
	include(__DIR__.'/view/htmlstart.php');

	//object of item controller
	$itemcontroller = new ItemController($config->item_list_url);

	switch ($url_array[1]) {

	    case 'item' :
	    	
			if(empty($url_array[2])){
				echo "<p>Error: Item id missing.</p>";
				return;
			}else{
				$itemId = $url_array[2];
		        //show item with id
		        echo $itemcontroller->showItem($itemId);
	        }	

	        break;

	    case 'edit' :
	    	
			if(empty($url_array[2])){
				echo "<p>Error: Item id missing.</p>";
				return;
			}else{
				$itemId = $url_array[2];
				//edit item with id
		        echo $itemcontroller->editItem($itemId);
	        }

	        break;

	    case 'update' :

	    	//update item with id
			if(empty($url_array[2])){
				echo "<p>Error: Item id missing.</p>";
				return;
			}else{
		       	
		        echo $itemcontroller->updateItem($_POST, $config->item_update_url);
	        }

	        break;


	    case 'delete' :
	    	//delete item having id
			if(empty($url_array[2])){
				echo "<p>Error: Item id missing.</p>";
				return;
			}else{
				$itemId = $url_array[2];

		        echo $itemcontroller->deleteItem($itemId, $config->item_delete_url);
	        }
	        break;

	    case 'add' :

	    	//object of item controller
			$itemcontroller = new ItemController();

	    	//add an item 	
	        echo $itemcontroller->addItem();
	        
	        break;

	    case 'cerate' :

	    	//create item 	
	        echo $itemcontroller->createItem($_POST, $config->item_create_url);
	        
	        break;

	    case 'items' :
	        echo "<p>Error: Invalid request.</p>";
	        break;


	    default :
	        // show all items with actions
	        echo $itemcontroller->showItemsWithActions();
	        break;

	}

	//html end tags
	include(__DIR__.'/view/htmlend.php');

} else{

	//redirect to home
	header('Location: http://gprasad.digitalhorizons.net/');
	exit;
}
