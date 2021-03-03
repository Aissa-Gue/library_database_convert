<?php
  //the line bellow used to ignore php errors
  //error_reporting(E_ERROR | E_PARSE);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname1 = "afaq3db_old";
  $dbname2 = "afaq3db_new";


  // Create connection
  $conn= mysqli_connect($servername, $username, $password);
  //$conn_old = mysqli_connect($servername, $username, $password, $dbname1);
  //$conn_new = mysqli_connect($servername, $username, $password, $dbname2);


  //Solve arabic lang prblms
  //mysqli_set_charset($conn, 'utf8');