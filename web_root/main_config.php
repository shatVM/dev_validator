<?php
$b_is_local = true;
$is_local = 0;
$s_domain;

if ($is_local == 1) {
  $s_domain = "http://localhost/";  //local server
}else {

  $s_domain = "https://dev-validator.ztu.edu.ua/";  //remote server
 
}



$b_use_access_wall = true;   //login required
$b_do_debug = false;		 //do debug global

$s_web_root = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR;
$s_v_app_root = $s_web_root."validator".DIRECTORY_SEPARATOR;

if($b_is_local == true){    

  $_SESSION["s_domain"] = $s_domain;
  $_SESSION["s_project_url"] = $s_domain . "/validator/";
  $b_use_access_wall = false;
  $_SESSION["s_user_name"] = "anonymous";
  $_SESSION["s_user_email"] = "anonymous";
}

if($b_do_debug){
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $_SESSION["b_debug"] = true;
}else{
  $_SESSION["b_debug"] = false;
}
function _get_task_url(){
  return $_SESSION["s_domain"] . $_SESSION["s_task_page"];
}
function _dbg($data){
  $output = $data;
  if ( is_array( $output ) )
    $output = implode( ',', $output);
  echo "<script>console.log('" . addslashes($output) . "');</script>";
}
?>