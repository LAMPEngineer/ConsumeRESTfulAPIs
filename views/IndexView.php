<?php
/**
 *  Index view 
 */
class IndexView
{

	/**
	 * Resource list view 
	 * @param  array $content 
	 * @return string       
	 */
	public function render($content)
	{
/*		header('Content-Type: application/json charset=utf8');
		echo json_encode($content);
		return true;*/

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
							foreach ($content as $resource) {
								
				   $response .= "<tr>
									<td>".$resource->name."</td>
									<td>				
										<a href='./items/get/".$resource->id."'>Show</a>
									</td>
									<td>				
										<a href='./items/edit/".$resource->id."'>Edit</a>
									</td>
									<td>				
										<a href='./items/delete/".$resource->id."'>Delete</a>
									</td>
								</tr>";
							}
							

			$response .= "</tbody>
					</table>";

	
		$response .= "<br/><br/><a href=./items/add/>Add An Item</a>";

		$response .= "<br/><br/><a href=../>Go Back</a>";

		return $response;
	}
}