
<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Reem+Kufi&display=swap" rel="stylesheet">

    <title>Library2</title>
  </head>
  <body>
    <div class="uk-text-center">
      <a class="home_link"href="index.php"><div class="uk-background-cover uk-height-small uk-panel uk-flex uk-flex-center uk-flex-middle head_cover" style="background-image: url(img/banner1.jpg);">
      <p class="uk-h3">مؤسسة الشيخ عمي سعيد - المكتبة المركزية</p>
      </div></a>
    </div>
    <!-- main page -->
    <div>
      <div
        class="uk-background-cover body_cover"
        style="background-image: url(img/pexels-stas-knop-1340588.jpg)"
      >
        <div class="uk-container">
          <!-- START import databases -->
          <div
            class="uk-card uk-card-default uk-card-body uk-margin-top uk-margin-bottom"
          >
            <h3 class="uk-card-title uk-text-center" id="h3">إدخال قاعدتي البيانات</h3>

            <form
              class="uk-text-center first_form"
              action="upload.php"
              method="POST"
              enctype="multipart/form-data"
            >
              <input
                class="uk-input uk-width-1-3 inp"
                type="file"
                name="files[]"
                multiple directory=""
                webkitdirectory=""
                moxdirectory=""
                required
              />
              <!-- <input
                class="uk-input uk-width-1-3 inp"
                type="file"
                name="afaq3db_new"
              /> -->
              <input
                class="uk-input uk-width-1-6 uk-button uk-button-primary"
                type="submit"
                name="upload_old"
                value="قاعدة البيانات القديمة"
              />
              <input
                class="uk-input uk-width-1-6 uk-button uk-button-primary"
                type="submit"
                name="upload_new"
                value="قاعدة البيانات الجديدة"
              />
            </form>
            <!-- success alert -->
            <!-- <div
              class="uk-alert-success uk-width-1-2 uk-align-center uk-margin uk-text-center"
              uk-alert
            >
              <a class="uk-alert-close" uk-close></a>
              <p>تم إدخال قاعدتي البيانات بنجاح</p>
            </div> -->
          </div>
          <!-- END import data base Section -->

          <!-- input book reference -->
          <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
            <h3 class="uk-card-title uk-text-center" id="h3">رقم طلب الكتاب</h3>
            <form class="uk-text-center" action="index.php" method="POST">
              <input
                class="uk-input uk-width-1-3 uk-text-center inp"
                type="text"
                name=old_msid
                placeholder="أدخل رقم الطلب القديم"
                required
              />
              <input
                class="uk-input uk-width-1-3 uk-text-center inp"
                type="text"
                name=new_msid
                placeholder="أدخل رقم الطلب الجديد (الطالبات)"
                required
              />
              <input
                class="uk-input uk-width-1-6 uk-button uk-button-primary"
                type="submit"
                name="convert"
                value="تحويل"
                onclick="return confirm('<?php echo $old_book_name_string. '  /  '. $new_book_name_string ?>')";
              />
            </form>
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
              $result= mysqli_query($conn_new,$update);
              if($result==TRUE){
                // Get the name of the two books
                $old_book_query="SELECT mname FROM mdt WHERE msid='$old_msid'";
                $new_book_query="SELECT mname FROM mdt WHERE msid='$new_msid'";
                $old_book_name= mysqli_query($conn_old,$old_book_query);
                $new_book_name= mysqli_query($conn_new,$new_book_query);

                if(mysqli_num_rows($old_book_name)>0 && mysqli_num_rows($new_book_name)>0){
                    $old_book_name_r = mysqli_fetch_assoc($old_book_name);
                    $old_book_name_string = $old_book_name_r["mname"];

                    $new_book_name_r = mysqli_fetch_assoc($new_book_name);
                    $new_book_name_string = $new_book_name_r["mname"];
                    echo '
                    <!-- book title Alert / Success Alert -->
                    <div
                      class="uk-alert-success uk-width-1-2 uk-align-center uk-text-center uk-margin"
                      uk-alert
                    >
                      <a class="uk-alert-close" uk-close></a>
                      <h4>تم التحويل بنجاح!</h4>
                      <p> <strong>قاعدة البيانات القديمة / كتاب: </strong>'. $old_book_name_string.' </p>
                      <p> <strong>قاعدة بيانات الطالبات / كتاب: </strong>'. $new_book_name_string.'</p>
                    </div>
                    ';

                }else{
                  echo "<script> alert('تأكد من صحة رقم الطلب الذي أدخلته!') </script>";
                }
                
              }else{
                echo"data not converted" .mysqli_error($conn);
              }

            }
            ?>

            <!-- export btn -->
            <a
              class="uk-button uk-button-danger uk-align-center uk-width-1-4 exp"
              href="exportSql.php"
            >
              استخراج قاعدة البيانات (SQL)
            </a>
            <a
              class="uk-button uk-button-danger uk-align-center uk-width-1-4 exp"
              href="exportFolder.php"
            >
              استخراج قاعدة البيانات (مجلد)
            </a>
          </div>
        </div>
      </div>
    </div>

    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
  </body>
</html>
