<?php 


	echo " <h1>Edit Item</h1>
		<form method=\"post\" action=\"./../update/$arrItem->id\" >	  
			<input type=\"hidden\" name=\"id\" value=\"$arrItem->id\">
				<div>
					<label>Name</label>
					<input type=\"text\" name=\"name\" value=\"$arrItem->name\">
				</div>
				<div>
					<label>Description</label>
			<input type=\"text\" name=\"description\" value=\"$arrItem->description\">
				</div>
				<div>
					<button type=\"submit\" name=\"\" >Update</button>
				</div>
		</form>";

?>
