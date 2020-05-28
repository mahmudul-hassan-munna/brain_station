<?php
require_once "database.php";


if ($result = $mysqli -> query("select * from 
(
SELECT c.Name,count(`categoryId`) as total_items
FROM `item_category_relations` icr
inner join category c on c.id=icr.`categoryId`
group by `categoryId`
) a 
order by a.total_items desc")) {
 

   echo "<table class='table table-bordered table-striped'>";
	echo "<thead>";
	    echo "<tr>";
	        
	        echo "<th>Category Name</th>";
	        echo "<th>Total Items</th>";
	        
	    echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

  while($row = mysqli_fetch_array($result)){
  	echo "<tr>";
  	echo "<td>".$row['Name']."</td>";
  	echo "<td>".$row['total_items']."</td>";
  	echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";


  $result -> free_result();
  //print_r($result);die();
}

$mysqli -> close();

