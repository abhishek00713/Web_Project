<?php 
if(isset($_COOKIE['admin_username'])){
  session_start();
  $_SESSION['admin_username']=$_COOKIE['admin_username'];
  header('location:index.php');
}
if(isset($_POST['btnCreate'])){
    $err = [];
   
      $password = $_POST['password'];
      
      $email = $_POST['email']; 
      
      
      require_once "connect.php";
  
  $sql = "select * from customer where password = \"$password \" or email = \"$email\"";
  print_r($sql);
  
  $result = $connect->query($sql);

  
  if($connect-> affected_rows == 0){
      $err['phone'] = "incorrect";
      $err['email'] = "incorrect";
      $err['password'] = "not strong"; 


  }
  else{
    if(isset($_POST['remember'])){
      //set cookies
      setcookie('admin_username',$email,time()+24*60*60);
  }


session_start();
$_SESSION['admin_username'] = $usernames;
$username =  substr($usernames,0,-10);
header('location:index.php');

  
    
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
      
     
    <form action = "" method = "post" enctype = "multipart/form-data" onsubmit = "return validate()" name = "register_form">
        <input type="email" placeholder="email id" name="email" required/>
        <?php if(isset($err['email'])){?>
            <span class="text-danger"><?php echo $err['email']?></span>
       <?php }?>
        <input type="text" placeholder="password" name ="password" required/>
        <?php if(isset($err['password'])){?>
            <span class="text-danger"><?php echo $err['password']?></span>
       <?php }?>
          <input type="checkbox" value="" name="remember">Remember me
              
        <button class="submit-btn" type="submit" name="btnCreate">Login</button>
        <p class="message">Not Registered??<a href="login.php">Register</a></p>
        
      </form>

    </div>
  </div>
  
  <script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    
  </script>
  <script type="text/javascript">
    $('.message a').click(function(){
      $('form').animate({heigth:"toggle",opacity:"toggle"},"fast"); 
    });
  </script>
 
</body>
</html>