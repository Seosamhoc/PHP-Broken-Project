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

//Set up variable so 'active' class set on navbar link
$activeManu = "active";

include (TEMPLATE_PATH . "/header.html");  


?>
<div class="container">
    <div class='row'>
        <?php 
        $records = mf_get_all();

        $arrayItems=array();

        $count = sizeof($records);
        $htmlString = "";
        $htmlString .= "<div class='row'>";
        $htmlString .= "<div class='span6'>";
        $htmlString .= "<table class='table table-bordered table-striped' border='1'>\n";
        $htmlString .= "<tr>";
        $htmlString .= "<th>ID</th>";
        $htmlString .= "<th>Manufacturer</th>";
        $htmlString .= "<th>Remove</th>";
        $htmlString .= "</tr>";

        for($i=0; $i < $count; $i++) {

            $arrayItems[$i]["label"]=$records[$i]['mf_title'];
            $arrayItems[$i]["id"]=$records[$i]['mf_id'];
            $id = $arrayItems[$i]["id"];

            $htmlString .=  "<td>";
            $htmlString .= $arrayItems[$i]["id"];
            $htmlString .=  "</td>";
            $htmlString .=  "<td>";
            $htmlString .= $arrayItems[$i]["label"];
            $htmlString .=  "</td>";
            $htmlString .=  "<td>";
            $htmlString .=  "<a href='deleteMF.php?id=$id'>Delete</a>";
            $htmlString .=  "</td>";

            $htmlString .=  "</tr>\n";
        }

        $htmlString .= "<tr>";

        $htmlString .=  "<td>";
        $htmlString .=  $records[$count-1]['mf_id']+1;
        $htmlString .=  "</td>";
        $htmlString .=  "<form class='form-horizontal' method='post' action='newManu.php' enctype='multipart/form-data' >";

        $htmlString .=  "<td>";
        $htmlString .=  "<input type='text' id='inputMFID' name='mf_title' placeholder='New Manufacturer' value='MF ";
        $htmlString .=  $records[$count-1]['mf_id']+1;
        $htmlString .=  "'>";
                
        $htmlString .=  "</td>";

        $htmlString .=  "<td class='control-group'>";
        $htmlString .=  "<div class='controls'>";
        $htmlString .=  "<button type='submit' class='btn'>Create</button>";
        $htmlString .=  "</div>";
        $htmlString .=  "</td>";

        $htmlString .=  "</form>";
        $htmlString .= "</tr>";
        $htmlString .=  "</table>\n";

        echo $htmlString;
        ?>
    </div>
</div>
  <?php                                
include (TEMPLATE_PATH . "/footer.html");
				 ?>