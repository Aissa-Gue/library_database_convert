<?php
include "connection.php";
if(isset($_POST['convert'])){
 $old_msid=$_POST['old_msid'];
 $new_msid=$_POST['new_msid'];
 
 //update new db
 $old_mdesc_query="SELECT mdesc FROM afaq3db_old.mdt WHERE msid='$old_msid'";
 $old_mdesc= mysqli_query($conn,$old_mdesc_query);
 $old_mdesc_r = mysqli_fetch_assoc($old_mdesc);
 $old_mdesc_string = $old_mdesc_r["mdesc"];

 $update="UPDATE mdt SET mdesc = '$old_mdesc_string' WHERE msid='$new_msid'";

 if(mysqli_query($conn_new,$update)){
  // Get the name of the two books
  //old book:
  $old_book_query="SELECT mname FROM mdt WHERE msid='$old_msid'";
  $old_book_name= mysqli_query($conn_old,$old_book_query);
  $old_book_name_r = mysqli_fetch_assoc($old_book_name);
  $old_book_name_string = $old_book_name_r["mname"];
  //updated book name:
  $new_book_query="SELECT mname FROM mdt WHERE msid='$new_msid'";
  $new_book_name= mysqli_query($conn_new,$new_book_query);
  $new_book_name_r = mysqli_fetch_assoc($new_book_name);
  $new_book_name_string = $new_book_name_r["mname"];
  header('location: index.php');
 }else{
  echo"data not converted" .mysqli_error($conn);
 }
 
}
?>