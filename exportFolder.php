<?php
/// START Additional CODE : move the DB Folder from root directory to mysql folder
								$Ignore = array(".","..","Thumbs.db");
								$OriginalFileRoot = "C:/xampp/mysql/data/afaq3db_new";
								$OriginalFiles = scandir($OriginalFileRoot);
        $DestinationRoot = exec('echo %SystemDrive%') . '\\Users\\' . get_current_user() . '\\Desktop\\afaq3db_new';
								# Check to see if "afaq3db_new" exists
								if(!is_dir($DestinationRoot)){
												mkdir($DestinationRoot,0777,true);
								}
								foreach($OriginalFiles as $OriginalFile){
												if(!in_array($OriginalFile,$Ignore)){
																$FileExt = pathinfo($OriginalFileRoot."\\".$OriginalFile, PATHINFO_EXTENSION); // Get the file extension
																$Filename = basename($OriginalFile, ".".$FileExt); // Get the filename
																$DestinationFile = $DestinationRoot."\\".$Filename.".".$FileExt; // Create the destination filename 
																copy($OriginalFileRoot."\\".$OriginalFile, $DestinationFile); // rename the file            
            }
            echo "<script>alert('تم استخراج قاعدة البيانات بنجاح! تفقد سطح المكتب')</script>";
            echo '<script>window.location.href = "index.php"</script>';// redirect to index.php
								}
     //END ADDITIONAL Code Moving///

?>