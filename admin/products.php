<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){
   //Lấy dữ liệu nhập vào
   $sl = $_POST['sl'];
   $name = $_POST['name'];
   $price = $_POST['price'];
   $discount = $_POST['discount'];
   $details = $_POST['details'];
   $import_price = $_POST['import_price'];

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

   // Tạo đối tượng repared select products
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    // Gán giá trị vào tham số
   $select_products->execute([$name]);


   // nếu select_products trả về name select lớn > 0 thì sản phẩm đã tồn tại
   if($select_products->rowCount() > 0){
      $info_msg[] = 'tên sản phẩm đã tồn tại!';
   }else{
      // Tạo đối tượng repared insert dữ liệu vào products
      $insert_products = $conn->prepare("INSERT INTO `products`(name, quantity_sp, details, import_price, price, discount, image_01, image_02, image_03) VALUES(?,?,?,?,?,?,?,?,?)"); 
      // Gán giá trị vào các tham số
      $insert_products->execute([$name, $sl, $details, $import_price, $price, $discount, $image_01, $image_02, $image_03]);

      if($insert_products){
         // nếu kích thước ảnh lớn hơn 2 000 000 px thì in ra màn hình
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $warning_msg[] = 'kích thước hình ảnh là quá lớn!';
         }else{
            //di chuyển ảnh vào kho_ảnh
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $success_msg[] = 'sản phẩm đã được thêm vào!';
         }

      }

   }  

};
// xóa sản phẩm
if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $success_msg[] = 'xóa sản phẩm thành công!';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>các sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">Thêm sản phẩm</h1>
   <div class="box-container">
      <div class="box">
         <?php
            $loai = 'laptop';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-solid fa-laptop"></i> </h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_laptop.php" class="btn">thêm lap top</a>
      </div>
      <div class="box">
         <?php
            $loai = 'điện thoại';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-solid fa-mobile-button"></i></h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_điện_thoại.php" class="btn">thêm linh kiện</a>
      </div>
     
      <div class="box">
         <?php
            $loai = 'loa Bluetooth';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-brands fa-bluetooth"></i></h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_loa_bluetooth.php" class="btn">thêm loa</a>
      </div>
      <div class="box">
         <?php
            $loai = 'chuột';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-solid fa-computer-mouse"></i></h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_chuột.php" class="btn">thêm chuột</a>
      </div>
      <div class="box">
         <?php
            $loai = 'bàn phím';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-regular fa-keyboard"></i></h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_bàn_phím.php" class="btn">thêm bàn phím</a>
      </div>
      <div class="box">
         <?php
            $loai = 'cáp';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-solid fa-calendar-plus"></i> </h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_cáp.php" class="btn">thêm cáp</a>
      </div>
      <div class="box">
         <?php
            $loai = 'sạc';
            $select_loai = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$loai}%'");
            $select_loai->execute();
            $number_of_products = $select_loai->rowCount() 
              
         ?>
         <h3 class="add"><i class="fa-solid fa-charging-station"></i></h3>
         <p><?= $number_of_products; ?> sản phẩm</p>
         <a href="add_sạc.php" class="btn">thêm sạc</a>
      </div>
   </div>

  
</section>
<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" id="menu_search" placeholder="tìm kiếm sản phẩm..." maxlength="100" class="box" onkeyup="searchfunc()" onclick="timkiemToggle()" required>
   </form>
</section>
<div class="products-bg">
   <section class="shopping-cart products">
      <div class="box-container">
      <form action="" method="post" class="box-cart" style="background-color: black;color:#fff;">
            <div class="id"> Id SP</div>
            <div class="name"> Tên SP</div>
            <div class="ngay"> Ảnh</div>
            <div class="vote"> Hãng</div>
            <div class="tieude"> Giá nhập</div>
            <div class="tieude"> Giá bán</div>
            <div class="tieude"> Giá giảm</div>
            <div class="binhluan"> Thông tin</div>
            <a href="#" class="option-btn" style="color: #fff;background-color: black;">---</a>
            <a href="#" class="delete-btn" style="color: #fff;background-color: black;">---</a>
            
         </form>
         <?php
             
               $select_products = $conn->prepare("SELECT * FROM `products` ");
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                     
         ?>
         <form action="" method="post" class="box-cart" id="menu_item">
            <div class="id"> <?= $fetch_products['id']; ?></div>
            <div class="name" > <?= $fetch_products['name']; ?><span style="color: #FF3030;">(<?= $fetch_products['quantity_sp']; ?>)</span></div>
            <div class="ngay"><img src="../kho_ảnh/<?= $fetch_products['image_01']; ?>" alt=""></div>
            <div class="vote"> <?= $fetch_products['brand']; ?></div>
            <div class="tieude"><?= number_format($fetch_products['import_price']); ?></div>
            <div class="tieude"><?= number_format($fetch_products['price']); ?></div>
            <div class="tieude"><?= number_format($fetch_products['discount']); ?></div>
            <div class="binhluan"> <?= $fetch_products['details']; ?></div>
            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">sửa</a>
            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('xóa tin nhắn này?');"></a>
            
         </form>
         <?php
          }
         }else{
            echo '<p class="empty">chưa có sản phẩm nào!</p>';
         }
         
         ?>
      </div>
   </section>
</div>









<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 
<script src="../js/admin_script.js"></script>
<script>
   function searchfunc(){
    let menusearch=document.querySelector('#menu_search');
    let menuitem=Array.from(document.querySelectorAll('#menu_item'));
    console.log("menu item",menuitem);
    let value  = menusearch.value
    const convertToLowerCase  = value.toLowerCase()
    menuitem.forEach(function(el){

        let text=el.innerText;
        if(text.toLowerCase().indexOf(convertToLowerCase)>-1)
        el.style.display=""
        else el.style.display="none"
    })
}
  searchfunc()
</script>
   
</body>
</html>