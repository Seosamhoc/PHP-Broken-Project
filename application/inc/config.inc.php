<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');

/*
 * Declare a number of constants that you can change depending on your application
 */
define("DB_HOST","localhost");//server
define("DB_USER","root");//user
define("DB_PASSWORD","root");//password
define("DB_DATABASE","movietutorial");//database
//defines added 19:10 26/11/2013

/*
 * Declare a number of constants that you can change depending on your application
*/

define("VERSION_NUMBER","1.0");

define("COMPANY_NAME","Digital Hub");

define("APPLICATION_NAME","WebElevate Confectionary Products");

define("UPLOAD_PATH",  realpath(dirname(dirname(__FILE__))) . "/uploads/"); //fixed upload path 19:05 11/12/2013