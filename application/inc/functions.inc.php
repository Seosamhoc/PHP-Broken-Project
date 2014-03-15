<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');


function validateproduct($product) {
	
	
	return false;
	
	
}

function saveProduct($product ) { //changed $item to $product 01:49 29/11/2013
	//fixed syntax and spelling in sqlQuery 01:49 29/11/2013
    
	$sqlQuery = "INSERT INTO `products` (`title`, `mf_id`, `price`, `taste`, `description`, `country`)";
	$sqlQuery .= "VALUES ('{$product['title']}','{$product['mf_id']}', {$product['price']},'{$product['taste']}', '{$product['description']}', '{$product['country']}')";
	
	$result = mysql_query($sqlQuery);
	
    
    //echo $sqlQuery;

	
	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
	
	
	return mysql_insert_id();
	
}
/* 
 * Realistically, you would pass function $_FILES array, but here we are assuming it's available
 * UPLOAD_PATH is defined in config.inc.php
 */
function uploadFiles($product_id) {
	//echo UPLOAD_PATH;
	//echo $_FILES['uploadedfile']['tmp_name'];
    $imageUpload = UPLOAD_PATH . $_FILES["uploadedfile"]["name"];//Made variable $imageUpload to save image in the correct way  19:10 11/12/2013
        if($_FILES["uploadedfile"]["name"]!=null){
//added condition so that if user decides not to change image it doesn't delete previous image
            
            if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $imageUpload)) {
		
		saveImageRecord($product_id, basename( $_FILES['uploadedfile']['name']));
		
	
            } else{
		echo "<p>There was an error uploading the file, please try again!</p>";//added closing p tag 22:50 11/12/2013
	}
        }
	
	
}


function saveImageRecord($product_id, $imageName) {
	
	
	$sqlQuery = "UPDATE `products` SET `imagefile` = '$imageName' where `product_id` = $product_id";
//fixed spelling and syntax errors, changed movie_id to product_id 
	$result = mysql_query($sqlQuery);
	
	
	
	
	
	
	
	
}

/*
 * Typical things that go wrong with next script
 * You must update the insert.php file to capture any new fields
 * You must ensure there are commas on any new lines you create
 * To resolve issues, uncomment the lines which echo the $sqlQuery  and die();
 */


function updateMovie($product) {
    $productID = (int) $product['product_id'];//changed movie to product 01:17 29/11/2013
    $sqlQuery = "UPDATE `products` SET ";//added missing '' 20:53 27/11/2013
     $sqlQuery .= " `taste` = '" . $product['taste'] . "',";//added missing t at end of product 00:47 27/11/2013
     $sqlQuery .= " `price` = ". $product['price'] . ",";
     $sqlQuery .= " `title` = '". $product['title'] . "',";//added missing i in title and added . before = 00:53 27/11/2013
     $sqlQuery .= " `description` = '". $product['description'] . "',";//added . before = 00:54 27/11/2013
     $sqlQuery .= " `mf_id` = '". $product['mf_id'] . "',";
     $sqlQuery .= " `country` = '". $product['country'] . "'"; //added country 21:55 11/12/2013
    
    $sqlQuery .= " WHERE `product_id` = $productID";//added missing _ after product 00:47 27/11/2013
    
    //echo $sqlQuery;
   //die("...");
    
    $result = mysql_query($sqlQuery);
	
    
    
	if (!$result) {
		die("error" . mysql_error());
        }
	
    
}


function deleteMovie($id) {
    $productID = (int) $id;
    $sqlQuery = "DELETE FROM `products`  WHERE `product_id` = $productID";//added `products` and `` around product_id, capitalised WHERE 01:04 27/11/2013
    
    $result = mysql_query($sqlQuery);
    if (!$result) {
		die("error" . mysql_error());
        }
}


function retrieveMovie($id) {

	$sqlQuery = "SELECT * FROM `products` WHERE `product_id` = $id";//added `products` and `` around product_id, capitalised FROM 01:02 27/11/2013

	$result = mysql_query($sqlQuery);
	
	if(!$result) die("error" . mysql_error());
	
	
	//echo $sqlQuery;


	return mysql_fetch_assoc($result);
	
}




function output_edit_link($id) {
	
	return "<a href='edit.php?id=$id'>Edit</a>";
        //link fixed 19:25 26/11/2013
	
	
}
function output_delete_link($id) {

	return "<a href='delete.php?id=$id'>Delete</a>";
        //link fixed 19:25 26/11/2013

}

function output_selected($currentValue, $valueToMatch) {
	
	
	if ($currentValue == $valueToMatch) {
		
		return "selected ='selected'";
		
	}
	
}

function authenticate($username, $password) {   
    $boolAuthenticated = false;
    
    $sqlQuery = "SELECT * from adminusers WHERE ";
    $sqlQuery .= "username = '" . $username . "'";
    $sqlQuery .= " AND ";
    $sqlQuery .= "password = '" .$password . "'";
    
    $result = mysql_query($sqlQuery);
    
    if (!$result)  die("Error: " . $sqlQuery . mysql_error());
    
    if (mysql_num_rows($result)==1) {
        $boolAuthenticated = true;
    }
    
    return $boolAuthenticated;
}

//Added function to add a new manufacturer 23:11 29/11/2013
function createMF($manufacturer) {
    $sqlQuery = "INSERT INTO `mfs` (`mf_title`)";
	$sqlQuery .= "VALUES ('{$manufacturer['mf_title']}')";
	
	$result = mysql_query($sqlQuery);
	
    
    //echo $sqlQuery;

	
	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
}

//Added function to delete a manufacturer 23:31 29/11/2013
function deleteMF($id) {
    $productID = (int) $id;
    $sqlQuery = "DELETE FROM `mfs`  WHERE `mf_id` = $productID";//added `products` and `` around product_id, capitalised WHERE 01:04 27/11/2013
    
    $result = mysql_query($sqlQuery);
    if (!$result) {
		die("error" . mysql_error());
        }
}