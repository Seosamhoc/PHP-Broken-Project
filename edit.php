<?php
session_start();
/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

/* Prevent unauthorised access */
include_once(APPLICATION_PATH . "/inc/session.inc.php");


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/ui_helpers.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");
include (APPLICATION_PATH . "/inc/queries.inc.php");


if (!empty($_GET) && isset($_GET['id'])) {
	
	//echo "Page is posted";
	
	$movieID = (int) $_GET['id'];
	
	$movie = retrieveMovie($movieID);
	
	$buttonLabel = "Update Product"; //changed Movie to Product 01:29 27/11/2013
	

	//start added code 01:26 27/11/2013
	$product = array();
	$product['title'] = htmlspecialchars(strip_tags($movie["title"]));
	$product['description'] = htmlspecialchars(strip_tags($movie["description"]));
	$product['price'] = htmlspecialchars(strip_tags($movie["price"]));
	$product['taste'] = htmlspecialchars(strip_tags($movie["taste"]));
	$product['mf_id'] = (int) htmlspecialchars(strip_tags($movie["mf_id"]));
        $product['country'] = htmlspecialchars(strip_tags($movie["country"]));
        
        
        $product['product_id'] = isset($movie["product_id"]) ? (int) $movie["product_id"] : 0;
	//end added code 01:26 27/11/2013
	


        
	}//end post
        else
        {
            header("Location: insert.php");
        }
	
?>
<?php 
$activeInsert = "active";

include (TEMPLATE_PATH . "/header.html");
include (TEMPLATE_PATH . "/form_insert.html");
include (TEMPLATE_PATH . "/footer.html");
?>