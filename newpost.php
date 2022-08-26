<?php
$title = $_POST['t'];
$author = $_POST['a'];
$data = $_POST['d'];

if($title == null || $author == null || $data == null) {
  echo "Incomplete Data";
} else {
  //store into database
  include_once('inc/classes/autoload.php');
  include_once('inc/classes/config.php');

  $db = new db(config::$server, config::$username, config::$password, config::$dbname);

  $dataFields = array('b_title', 'b_data', 'b_author');
  $dataContent = array($title, $data, $author);
  $query = $db->insert($dataFields, 'post', $dataContent);

  echo "Data submitted";
  //echo $title . " " . $author . "<br>" . $data;
}
