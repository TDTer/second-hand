<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $mssv = $_POST['mssv'];
   $mssv = filter_var($mssv, FILTER_SANITIZE_STRING);
   $gender = $_POST['gender'];
   $gender = filter_var($gender, FILTER_SANITIZE_STRING);
   $nationality = $_POST['nationality'];
   $nationality = filter_var($nationality, FILTER_SANITIZE_STRING);
   $detail = $_POST['detail'];
   $detail = filter_var($detail, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $hobbies = $_POST['hobbies'];
  

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);


   if($select_user->rowCount() > 0){
      $message[] = 'Email Đã Tồn Tại!';
   }else{
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE mssv = ?");
      $select_user->execute([$mssv,]);
      $row = $select_user->fetch(PDO::FETCH_ASSOC);

      if($select_user->rowCount() > 0){
         $message[] = 'MSSV Đã Tồn Tại!';
      }else{
         $hb = implode(",", $hobbies);
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, mssv, gender, nationality, hobbies, detail) VALUES(?, ?,?,?,?,?,?)");
         $insert_user->execute([$name, $email, $mssv, $gender, $nationality, $hb, $detail]);
         $message[] = 'Đăng Kí Thành Công, Đăng Nhập Ngay!';
         
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Đăng Ký Ngay</h3>
      <input type="text" name="name" required placeholder="Nhập Tên Người Dùng..." maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="Nhập Email..." maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="mssv" required placeholder="Nhập MSSV" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <label for="gender" ><h4>Giới tính</h4></label>
      
      <label for="male" >Nam &nbsp;</label>
    <input checked="checked" type="radio" id="male" name="gender" value="male" required>
    &emsp;
    <label for="female" >Nữ &nbsp;</label>
    <input type="radio" id="female" name="gender" value="female" required>
    <label for="hobbies"><h4>Sở thích</h4></label>
    
    <label for="readbook">Đọc sách:&nbsp;</label>
    <input type="checkbox" id="readbook" name="hobbies[]" value="readbook" >&emsp;

    <label for="travel">Du lịch:&nbsp;</label>
    <input type="checkbox" id="travel" name="hobbies[]" value="travel" >&emsp;

    <label for="music">Âm nhạc:&nbsp;</label>
    <input type="checkbox" id="music" name="hobbies[]" value="music" >&emsp;

    <label for="another">Khác:&nbsp;</label>
    <input type="checkbox" id="another" name="hobbies[]" value="another" >&emsp;

    <label for="nationality"><h4>Quốc tịch:</h4></label>
<select id="nationality" name="nationality">
<option value="vietnam">Việt Nam</option>
  <option value="usa">Mỹ</option>
  <option value="canada">Canada</option>
  <option value="japan">Nhật</option>
  <option value="china">Trung Quốc</option>
  <option value="india">Ấn Độ</option>
  <option value="uk">Anh</option>
  <option value="france">Pháp</option>
  <option value="germany">Đức</option>
  <option value="italy">Ý</option>
  <option value="another">Khác</option>
</select>
<input type="text" name="detail" placeholder="Nhập ghi chú" maxlength="200"  class="big-box">

      <input type="submit" value="Đăng Ký Ngay" class="btn" name="submit">
      <p>Đã có tài khoản?</p>
      <a href="user_login.php" class="option-btn">Đăng Nhập Ngay</a>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>