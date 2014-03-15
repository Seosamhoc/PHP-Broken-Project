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
include (APPLICATION_PATH . "/inc/functions.inc.php");
include (APPLICATION_PATH . "/inc/queries.inc.php");
include (APPLICATION_PATH . "/inc/ui_helpers.inc.php");
$product = array();
//moved $product[] values into else statement below 01:38 29/11/2013



if (!empty($_POST)) {
	
	//deleted $product = array(); as it is already done above 23:48 11/12/2013
	$product['title'] = htmlspecialchars(strip_tags($_POST["title"]));
	$product['description'] = htmlspecialchars(strip_tags($_POST["description"]));
	$product['price'] = htmlspecialchars(strip_tags($_POST["price"]));// Added price to post 00:37 27/11/2013
	$product['taste'] = htmlspecialchars(strip_tags($_POST["taste"]));// Fixed typo in taste 00:38 27/11/2013
	$product['mf_id'] = (int) htmlspecialchars(strip_tags($_POST["mf_id"]));
        $product['country'] = htmlspecialchars(strip_tags($_POST["country"])); //added country 21:50 11/12/2013
        
        
        $product['product_id'] = isset($_POST["product_id"]) ? (int) $_POST["product_id"] : 0;
        
	$flashMessage = "";
	//deleted validateProduct 02:13 27/11/2013
		if ($product['product_id'] == 0) {
         //New! Save Movie returns the id of the record inserted         
		$product_id = saveProduct($product); //capitalised P in saveProduct 02:05 29/11/2013
                
		uploadFiles($product_id);
		
		
		$flashMessage = "Record has been saved";
                } 
                else {
                    
                    updateMovie($product);
                    uploadFiles($product['product_id']); //added uploadFiles so that picture can be uploaded from edit 20:10 11/12/2013
                    if(!headers_sent()){
                    header("Location: admin.php");}
                }
		

	
	}//end post
        else
        {
          $product['title'] = "";
          $product['description'] = "";
          $product['price'] =""; // Fixed typo in price 00:37 27/11/2013
          $product['taste'] =""; // deleted "G" 20:25 27/11/2013
          $product['mf_id'] =0;
          $product['product_id']=0; //changed movie to product 01:36 29/11/2013
          $product['country'] = ""; //added country 21:50 11/12/2013
        }
	

?>
<?php 
$activeInsert = "active";
$buttonLabel = "Insert Product Record";//changed Movie to Product 01:34 27/11/2013
include (TEMPLATE_PATH . "/header.html");
include (TEMPLATE_PATH . "/form_insert.html");
include (TEMPLATE_PATH . "/footer.html");
?>