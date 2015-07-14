<?
error_reporting(0);
set_time_limit(0);
ini_set('error_log',NULL);
ini_set('max_execution_time',0);
ini_set('log_errors',0);


if(file_exists("function.php")){ include('function.php'); }else{ echo "<h1><center>function.php not found ! </center></h1>";die(); }
if(file_exists("config.php")){ include('config.php'); }else{ echo "<h1><center>config.php not found ! </center></h1>";die();  }
include("plugins/chartlyrics_com.php"); // Include plugins
$class = new lyrics;
$class->getFirstResult(strip_tags($_GET["name"]), "chart.php");

?>
