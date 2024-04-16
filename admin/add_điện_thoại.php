<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $sl = $_POST['sl'];
   $name = $_POST['name'];
   $key_word = $_POST['key_word'];
   $price = $_POST['price'];
   $discount = $_POST['discount'];
   $details = $_POST['details'];
   $import_price = $_POST['import_price'];
   $brand = $_POST['brand'];
   $details_1 = $_POST['details_1'];
   $details_2 = $_POST['details_2'];
   $details_3 = $_POST['details_3'];
   $details_4 = $_POST['details_4'];
   $details_5 = $_POST['details_5'];
   $details_6 = $_POST['details_6'];
   $details_7 = $_POST['details_7'];
   $details_8 = $_POST['details_8'];
   $details_9 = $_POST['details_9'];

   $image_01 = $_FILES['image_01']['name'];
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../kho_ảnh/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../kho_ảnh/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../kho_ảnh/'.$image_03;


   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);


   if($select_products->rowCount() > 0){
      $info_msg[] = 'tên sản phẩm đã tồn tại!';
   }else{
      $insert_products = $conn->prepare("INSERT INTO `products`(name, key_word, brand, quantity_sp, details, import_price, price, discount, image_01, image_02, image_03, details_1, details_2, details_3, details_4, details_5, details_6, details_7, details_8, details_9) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); 
      $insert_products->execute([$name, $key_word, $brand, $sl, $details, $import_price, $price, $discount, $image_01, $image_02, $image_03, $details_1, $details_2, $details_3, $details_4, $details_5, $details_6, $details_7, $details_8, $details_9]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $warning_msg[] = 'kích thước hình ảnh là quá lớn!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $success_msg[] = 'sản phẩm đã được thêm vào!';
         }

      }

   }  

};



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>điện thoại</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Thêm sản phẩm</h1>
  
   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>tên sản phẩm <p>*</p></span>
            <input type="text" class="box" required maxlength="100" placeholder="nhập tên sản phẩm" name="name">
         </div>
         <div class="inputBox">
            <span>hãng sản phẩm <p>*</p></span>
            <input type="text" class="box" required maxlength="100" placeholder="nhập hãng sản phẩm" name="brand">
         </div>
         <div class="inputBox">
            <span>từ khóa sản phẩm<p>*</p></span>
            <input type="text" class="box"  value ="dtdd" name="key_word" readonly>
         </div>
         <div class="inputBox">
            <span>số lượng sản phẩm <p>*</p></span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder=" nhập số lượng sản phẩm" onkeypress="if(this.value.length == 10) return false;" name="sl">
         </div>
         <div class="inputBox">
            <span>giá sản phẩm nhập vào <p>*</p></span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder=" nhập giá sản phẩm" onkeypress="if(this.value.length == 10) return false;" name="import_price">
         </div>
         <div class="inputBox">
            <span>giá bán sản phẩm <p>*</p></span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder=" nhập giá bán" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
         <div class="inputBox">
            <span>giảm giá sản phẩm <p>*</p></span>
            <input type="number" min="0" class="box"  max="9999999999" placeholder="nhập giá giảm " onkeypress="if(this.value.length == 10) return false;" name="discount">
         </div>
        <div class="inputBox">
            <span>Ảnh 01 <p>*</p></span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Ảnh 02 <p>*</p></span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Ảnh 03 <p>*</p></span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>Màn hình (nêú có) <p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_1">
         </div>
         <div class="inputBox">
            <span>Hệ điều hành (nêú có)<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_2">
         </div>
         <div class="inputBox">
            <span>Tốc độ (nêú có)<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_3">
         </div>
         <div class="inputBox">
            <span>Giao diện kết nối (nêú có)<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_4">
         </div>
         <div class="inputBox">
            <span>Kích thước<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_5">
         </div>
         <div class="inputBox">
            <span> Bảo Hành (nêú có) <p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_6">
         </div>
         <div class="inputBox">
            <span>Dung lượng lưu trữ (nêú có)<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_7">
         </div>
         <div class="inputBox">
            <span>Mã part (nêú có) <p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_8">
         </div>
         <div class="inputBox">
            <span>Pin, Sạc (nêú có)<p>*</p></span>
            <input type="text" class="box" required maxlength="1000" placeholder="" name="details_9">
         </div>
         <div class="inputBox">
            <span>Chi tiết sản phẩm <p>*</p></span>
            <textarea name="details" placeholder="nhập chi tiết sản phẩm" class="box" required maxlength="10000" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="Thêm sản phẩm" class="btn" name="add_product">
   </form>

</section>








<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 
<script src="../js/admin_script.js"></script>
   
</body>
</html>