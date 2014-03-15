<?php
session_start();

define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

define ( "MY_APP", 1 );

/* Prevent unauthorised access */
include_once(APPLICATION_PATH . "/inc/session.inc.php");

include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");

include (APPLICATION_PATH . "/inc/functions.inc.php");
include (APPLICATION_PATH . "/inc/queries.inc.php");

include (APPLICATION_PATH . "/inc/ui_helpers.inc.php");

//	$product = array();
//	$product['title'] = htmlspecialchars(strip_tags("first"));
//	$product['description'] = htmlspecialchars(strip_tags(""));
//	$product['price'] = 124;
//	$product['taste'] = htmlspecialchars(strip_tags("Sweet"));
//	$product['mf_id'] = (int) htmlspecialchars(strip_tags("MF 2"));
//        $product['product_id'] = 0;
//        
//         if ($product['product_id'] == 0) {
//         //New! Save Movie returns the id of the record inserted         
//		$product_id = saveproduct($product);
//	//	uploadFiles($product_id);
//		
//		
//		$flashMessage = "Record has been saved";
//                } 
//                else {
//                    
//                    updateMovie($product);
//                }

$path = realpath( dirname(dirname(__FILE__))) . "/uploads/";
  include (TEMPLATE_PATH . "/header.html");      
?>
<div class="container">
    <div class='row'>
        <div class='span6'><?php echo $path; ?></div>
        <div class='span6'>Label</div>
    </div>
<?php 

				$records = mf_get_all();
	
				$arrayItems=array();

				$count = sizeof($records);
				for($i=0; $i < $count; $i++) {

				$arrayItems[$i]["label"]=$records[$i]['mf_title'];
				$arrayItems[$i]["id"]=$records[$i]['mf_id'];
                                
                                echo "<div class='row'>";
                                echo "<div class='span6'>";
                                 echo $arrayItems[$i]["id"] . " ";
                                 echo "</div>";
                                 echo "<div class='span6'>";
                                 echo $arrayItems[$i]["label"];
                                 echo "</div>";
                                 echo "</div>";
                                }?>
    </div>
  <?php                                
include (TEMPLATE_PATH . "/footer.html");
				 ?>