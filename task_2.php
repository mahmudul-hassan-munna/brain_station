<?php
require_once "database.php";



function get_menu_tree($parent_id) 
{
  $con=mysqli_connect("localhost","root","","ecommerce");// we have used db name test you can change your db name
  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $menu = "";

  // if($parent_id == 0)
  // {
  //   $sqlquery = "select * from 
  //   (
  //   SELECT cr.*,c.Name 
  //   FROM `catetory_relations` cr 
  //   inner join category c on c.id=cr.`ParentcategoryId`
  //   order by `ParentcategoryId` asc
  //   ) a 
  //   where a.`categoryId` != a.`ParentcategoryId`";
  // }
  // else
  // {
    $sqlquery = " SELECT *,c.Name 
    FROM catetory_relations cr
    inner join category c on c.id=cr.`categoryId`
    where ParentcategoryId='" .$parent_id . "' ";
  //}
  

  $res=mysqli_query($con,$sqlquery);
  while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
  {
      $menu .="<li>".$row['Name']."";
       
       $menu .= "<ul>".get_menu_tree($row['categoryId'])."</ul>"; //call  recursively
       
       $menu .= "</li>";
 
    }
    
    return $menu;
} 


echo get_menu_tree(1);



$mysqli -> close();

