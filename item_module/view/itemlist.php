<?php 
	$response = "<h1>Item List</h1>
					<table>
						<thead>
							<tr>
								<th><u>Item</u></th>
								<th><u>Action 1</u></th>
								<th><u>Action 2</u></th>
								<th><u>Action 3</u></th>
							</tr>
						</thead>
						<tbody>";
							foreach ($this->items as $item) {
								
				   $response .= "<tr>
									<td>".$item->name."</td>
									<td>				
										<a href='./item/".$item->id."'>Show</a>
									</td>
									<td>				
										<a href='./edit/".$item->id."'>Edit</a>
									</td>
									<td>				
										<a href='./delete/".$item->id."'>Delete</a>
									</td>
								</tr>";
							}
							

			$response .= "</tbody>
					</table>";

	
	$response .= "<br/><br/><a href=./add/>Add An Item</a>";

	$response .= "<br/><br/><a href=../>Go Back</a>";

	echo $response;

