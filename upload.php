<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/uikit.min.css" />
	<script src="js/uikit.min.js"></script>
 <script src="js/uikit-icons.min.js"></script>
</head>
</html>
<?php 
include "connection.php";

/// Upload The Old DB ///
if(isset($_POST['upload_old'])){
 $foldername="afaq3db_old";
 if(!is_dir($foldername)) mkdir($foldername);

 foreach($_FILES['files']['name'] as $i => $name){
  		    if(strlen($_FILES['files']['name'][$i]) > 1){
									move_uploaded_file($_FILES['files']['tmp_name'][$i],$foldername."/".$name);
								}
					// START Additional CODE : move the DB Folder from root directory to mysql folder
								$Ignore = array(".","..","Thumbs.db");
								$OriginalFileRoot = "afaq3db_old";
								$OriginalFiles = scandir($OriginalFileRoot);
								$DestinationRoot = "C:/xampp/mysql/data/afaq3db_old";
								# Check to see if "afaq3db_old" exists
								if(!is_dir($DestinationRoot)){
												mkdir($DestinationRoot,0777,true);
								}

								foreach($OriginalFiles as $OriginalFile){
												if(!in_array($OriginalFile,$Ignore)){
																$FileExt = pathinfo($OriginalFileRoot."\\".$OriginalFile, PATHINFO_EXTENSION); // Get the file extension
																$Filename = basename($OriginalFile, ".".$FileExt); // Get the filename
																$DestinationFile = $DestinationRoot."\\".$Filename.".".$FileExt; // Create the destination filename 
																rename($OriginalFileRoot."\\".$OriginalFile, $DestinationFile); // rename the file            
												}
								}
					//END ADDITIONAL Code Moving///
	}
					//2nd Addit code Remove FOlder in root directory after moving to mysql folder
								$path = "afaq3db_old";
								if(!rmdir($path)) {
										echo ("Could not remove $path");
								}
					///END Remove folder in root Directory//
																	echo'
																	<div class="uk-alert-success uk-text-center" uk-alert>
																	<a class="uk-alert-close" uk-close></a>
																	<h4>تم رفع قاعدة البيانات القديمة بنجاح</h4>
																	</div>';
																	header( "refresh:1;url=index.php" );
}

/// Upload The New DB ///
if(isset($_POST['upload_new'])){
 $foldername="afaq3db_new";
 if(!is_dir($foldername)) mkdir($foldername);

 foreach($_FILES['files']['name'] as $i => $name){
  		    if(strlen($_FILES['files']['name'][$i]) > 1){
         move_uploaded_file($_FILES['files']['tmp_name'][$i],$foldername."/".$name);
								}
					/// START Additional CODE : move the DB Folder from root directory to mysql folder
								$Ignore = array(".","..","Thumbs.db");
								$OriginalFileRoot = "afaq3db_new";
								$OriginalFiles = scandir($OriginalFileRoot);
								$DestinationRoot = "C:/xampp/mysql/data/afaq3db_new";
								# Check to see if "afaq3db_new" exists
								if(!is_dir($DestinationRoot)){
												mkdir($DestinationRoot,0777,true);
								}
								foreach($OriginalFiles as $OriginalFile){
												if(!in_array($OriginalFile,$Ignore)){
																$FileExt = pathinfo($OriginalFileRoot."\\".$OriginalFile, PATHINFO_EXTENSION); // Get the file extension
																$Filename = basename($OriginalFile, ".".$FileExt); // Get the filename
																$DestinationFile = $DestinationRoot."\\".$Filename.".".$FileExt; // Create the destination filename 
																rename($OriginalFileRoot."\\".$OriginalFile, $DestinationFile); // rename the file            
												}
								}
					//END ADDITIONAL Code Moving///
	}
					/// 2nd Additional code Remove FOlder in root directory after moving to mysql folder
								$path = "afaq3db_new";
								if(!rmdir($path)) {
										echo ("Could not remove $path");
								}
					///END Remove folder in root Directory//
																	echo'
																	<div class="uk-alert-success uk-text-center" uk-alert>
																	<a class="uk-alert-close" uk-close></a>
																	<h4>تم رفع قاعدة بيانات الطالبات بنجاح</h4>
																	</div>';
																	header( "refresh:1;url=index.php" );
}

 ?>