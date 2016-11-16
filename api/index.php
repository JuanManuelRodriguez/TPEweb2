<?php
  require 'PeliculaApi.php';

  try {
    $api_handler = new PeliculaApi($_REQUEST['request']);
    echo $api_handler->processAPI();
  } catch (Exception $e) {
      echo json_encode(Array('error' => $e->getMessage()));
  }

 ?>
