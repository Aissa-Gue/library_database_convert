<?php
// ******************************** import old db **************************** //
if (isset($_FILES['upload'])){
  echo "hello";
  $file= $_FILES['afaq3db_old'];
  $file_name= $_FILES['db']['name'];
  $file_type= $_FILES['db']['type'];
  $file_size= $_FILES['db']['size'];
  $file_temp= $_FILES['db']['tmp_name'];
  move_uploaded_file($file_temp,"$file_name");


function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
  $conn=mysqli_connect($dbHost, $dbUsername, $dbPassword);
  //Solve arabic lang prblms
  //mysqli_set_charset($conn, 'utf8');

    //drop existing db
    $sql_drop_db = "DROP DATABASE afaq3db_old";
    if(mysqli_query($conn,$sql_drop_db)){
      echo "db droped successfully";
    }

  $db_selected = mysqli_select_db($conn,$dbName);
  if (!$db_selected) {
    //create new DB if it dosn't exist.
    $sql = "CREATE DATABASE afaq3db_old";
    if (mysqli_query($conn,$sql)) {
        echo "Database 'afaq3db_old' created successfully\n";
    }else{
        echo 'Error creating database: ' . mysqli_error($conn) . "\n";
    }
  }

    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Temporary variable, used to store current query
    $templine = '';

    // Read in entire file
    $lines = file($filePath);

    $error = '';

    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}

$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'afaq3db_old';
$filePath   = $file_name;
if(restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath)
and $file_name!=""){
  unlink( "$file_name" );
  echo "<script>alert('تمت إضافة قاعدة البيانات بنجاح!')</script>";
  //echo '<script>window.location.href = "index.php"</script>';// redirect to index.php
}else {
  echo "<script>alert('حدثت مشكلة: لم يتم إضافة قاعدة البيانات!')</script>";
  echo '<script>window.location.href = "index.php"</script>';// redirect to index.php
}
}

// ******************************** import new db **************************** //
if (isset($_FILES['afaq3db_new'])){
  $file= $_FILES['afaq3db_new'];
  $file_name= $_FILES['db']['name'];
  $file_type= $_FILES['db']['type'];
  $file_size= $_FILES['db']['size'];
  $file_temp= $_FILES['db']['tmp_name'];
  move_uploaded_file($file_temp,"$file_name");


function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
  $conn=mysqli_connect($dbHost, $dbUsername, $dbPassword);
  //Solve arabic lang prblms
  //mysqli_set_charset($conn, 'utf8');

    //drop existing db
    $sql_drop_db = "DROP DATABASE afaq3db_new";
    if(mysqli_query($conn,$sql_drop_db)){
      echo "db droped successfully";
    }

  $db_selected = mysqli_select_db($conn,$dbName);
  if (!$db_selected) {
    //create new DB if it dosn't exist.
    $sql = "CREATE DATABASE afaq3db_new";
    if (mysqli_query($conn,$sql)) {
        echo "Database 'afaq3db_new' created successfully\n";
    }else{
        echo 'Error creating database: ' . mysqli_error($conn) . "\n";
    }
  }

    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Temporary variable, used to store current query
    $templine = '';

    // Read in entire file
    $lines = file($filePath);

    $error = '';

    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }

            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}

$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = 'root';
$dbName     = 'afaq3db_new';
$filePath   = $file_name;
if(restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath)
and $file_name!=""){
  unlink( "$file_name" );
  echo "<script>alert('تمت إضافة قاعدة البيانات بنجاح!')</script>";
  echo '<script>window.location.href = "index.php"</script>';// redirect to index.php
}else {
  echo "<script>alert('حدثت مشكلة: لم يتم إضافة قاعدة البيانات!')</script>";
  echo '<script>window.location.href = "index.php"</script>';// redirect to index.php
}
}
?>
