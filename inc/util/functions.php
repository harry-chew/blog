<?php

function formatDate($date) {
  $date = substr($date,0,10);
  $date_time_Obj = date_create($date);
  $format = date_format($date_time_Obj, "d-m-y");

  return $format;
}

function formatPostData($data) {
  $data = substr($data,0,100);

  return $data;
}


?>
