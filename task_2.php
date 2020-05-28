<?php
require_once "database.php";


// if ($result = $mysqli -> query("SELECT cr.*,c.Name 
// FROM `catetory_relations` cr 
// inner join category c on c.id=cr.`ParentcategoryId`
// order by `ParentcategoryId` asc")) {
//   //echo "Returned rows are: " . $result -> num_rows;
//   // Free result set

//    echo "<ul>";
                                

//   while($row = mysqli_fetch_array($result)){





  
//   	echo "<li>".$row['Name']."</li>";

//     $parent = $row['categoryId'];

//     echo "SELECT cr.*,c.Name 
//     FROM `catetory_relations` cr 
//     inner join category c on c.id=cr.`ParentcategoryId`
//     where cr.ParentcategoryId = $parent";


//     $result_child = $mysqli -> query("SELECT cr.*,c.Name 
//     FROM `catetory_relations` cr 
//     inner join category c on c.id=cr.`ParentcategoryId`
//     where cr.ParentcategoryId = $parent");


//     echo "<ul>";
//     while($row_child = mysqli_fetch_array($result_child)){
//       echo "<li>".$row['Name']."</li>";

//     }
//     echo "</ul>";
//     //echo $result -> num_rows;


  
//   }

//   echo "</ul>";


//   $result -> free_result();
//   //print_r($result);die();
// }



function get_menu_tree($parent_id) 
{
  $con=mysqli_connect("localhost","root","","ecommerce");// we have used db name test you can change your db name
  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $menu = "";
  $sqlquery = " SELECT *,c.Name 
  FROM catetory_relations cr
  inner join category c on c.id=cr.`categoryId`
  where ParentcategoryId='" .$parent_id . "' ";

  $res=mysqli_query($con,$sqlquery);
  while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
  {
           $menu .="<li><a href=''>".$row['Name']."</a>";
       
       $menu .= "<ul>".get_menu_tree($row['categoryId'])."</ul>"; //call  recursively
       
       $menu .= "</li>";
 
    }
    
    return $menu;
} 


echo get_menu_tree(1);



$mysqli -> close();

