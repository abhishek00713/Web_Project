<?php 
if(isset($_POST['btnCreate'])){
    $err = [];
    // $username = $_POST['username'];
    // if(strlen($username)>8){
    //   //use image of cross here and display an alert notice like a box etc
    //     $err['username'] = "no";
    // }
    // else{
    //     $err['username'] = "yes";
    // }
      $password = $_POST['password'];
      $confrim_password = $_POST['confirm_password'];
      if(strlen($password) < 10){
        $err['password'] = "length not ok ";
        
      }
      else{
        
      }
      if(strcmp($password,$confrim_password) == 0){
        
      }
      else{
        $err['confirm_password'] = "passwords dont match ";
      }
      
      $email = $_POST['email']; 
      if(!preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" , $email)){
        $err['email'] = "email invalid";
      }
      else{
        
      }
      $phone = $_POST['phone'];
      if(!preg_match("/^([0-9]{9})$/" , $phone)){
        
          
        
      }
      else{
        $err['phone'] = "phone invalid";
      }
      
      require_once "connect.php";
  
  $sql = "select * from customer where password = \"$password \" or email = \"$email\" or phone = \"$phone\"";
  
  $result = $connect->query($sql);
  
  if($connect-> affected_rows >= 1){
      $err['phone'] = "incorrect";
      $err['email'] = "incorrect";
      $err['password'] = "not strong"; 


  }
  else{
  
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];
    if(count($err) == 0){
      require_once "connect.php";
      $sqls= "insert into customer(firstname,middlename,lastname,email,phone,password) values ('$firstname','$middlename','$lastname','$email','$phone','$password')";
      print_r($sqls);
      $connect->query($sqls);
      if($connect->affected_rows == 1 && $connect->insert_id>0){
          $success="Creation successfull";
          print_r($success);

      }else{
          $failed="Creation unsuccess";
          print_r($failed);
      }
  }
  }

}

    ?>
    
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="utf-8">
    <title>Ticket Resrvation</title>
        <link rel="stylesheet" type="text/css" href="login and register.css">
</head>
<body>
  
  <!-- </header> -->
  <div class="login-page">
    <div class="form">
      
     
      <!-- <form class="login-form">
        <input type="text" placeholder="username"/>
        <input type="password" placeholder="password"/>
        <button>Login</button>
        <p class="message">Not Registered??<a href="#">Register</a></p>

      </form> -->
      
      <form action = "" method = "post" enctype = "multipart/form-data" onsubmit = "return validate()" name = "register_form">
        <input type="text" placeholder="First Name" name="first_name" required/> 
        <input type="text" placeholder="Middle Name" name ="middle_name" />
        <input type="text" placeholder="Last Name" name="last_name" required/>
        <input type="email" placeholder="email id" name="email" required/>
        <?php if(isset($err['email'])){?>
            <span class="text-danger"><?php echo $err['email']?></span>
       <?php }?>
        <input type="password" placeholder="password" name ="password" required/>
        <?php if(isset($err['password'])){?>
            <span class="text-danger"><?php echo $err['password']?></span>
       <?php }?>
        <input type="password" placeholder="confirm password" name="confirm_password" required/>
        <?php if(isset($err['confirm_password'])){?>
            <span class="text-danger"><?php echo $err['confirm_password']?></span>
       <?php }?>
        <input type="text" placeholder="Cell Number" name="phone" required/>
        <?php if(isset($err['phone'])){?>
            <span class="text-danger"><?php echo $err['phone']?></span>
       <?php }?>
        <button class="submit-btn" type="submit" name="btnCreate">Create</button>
        
      </form>

    </div>
  </div>
  <script type="text/javascript" src="loginform.js">
    </script>
  <script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    
  </script>
  <script type="text/javascript">
    $('.message a').click(function(){
      $('form').animate({heigth:"toggle",opacity:"toggle"},"fast"); 
    });
  </script>
 
</body>
</html>