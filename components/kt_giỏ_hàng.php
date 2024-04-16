<?php

if(isset($_POST['add_to_cart'])){
      $sp = $_POST['sp'];
      $sl = $_POST['quantity_sp'];
      if($user_id == ''){
         header('location:login.php');
      
      
      
      }
      elseif($sl == 0){
         $error_msg[] = 'hết hàng!';
      }
      
      else{
        
         
         $sp = $_POST['sp'];
         
         $name = $_POST['name'];

         $import_price = $_POST['import_price'];

         $discount = $_POST['discount'];

         $image = $_POST['image'];

         $qty = $_POST['qty'];

         $key_word = $_POST['key_word'];
         
         $total = $_POST['discount'] * $_POST['qty'];
         $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
         $check_cart_numbers->execute([$name, $user_id]);

         if($check_cart_numbers->rowCount() > 0){
            $warning_msg[] = 'sản phẩm này đã có sẵn trong giỏ hàng!';
         
         }
         else{
            if($qty > $sl){
               $error_msg[] = 'không đủ hàng!';
            }
            else{
               $insert_details_order = $conn->prepare("INSERT INTO `details_order`(user_id, products_id, key_word, price, quantity, total) VALUES(?,?,?,?,?,?)");
               $insert_details_order->execute([$user_id, $sp, $key_word, $discount, $qty, $total]);
               $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, sp, name, key_word_sp, import_price, price, quantity, image) VALUES(?,?,?,?,?,?,?,?)");
               $insert_cart->execute([$user_id, $sp, $name, $key_word, $import_price, $discount, $qty, $image]);
               $success_msg[] = 'đã thêm vào giỏ hàng!';
            }

            

            
            
         }

     
   }

}

?>




