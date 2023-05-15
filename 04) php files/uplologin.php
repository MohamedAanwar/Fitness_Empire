
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo.png" type="image">
    <title>UL Login</title>
 <style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap');

:root {
    --primary-color:  hsl(180,12%,8%);
    --secondary-color: red;
    --tertiary-color: #8b0000;
    --gray-color: #b0b0b0;
}

* {
    box-sizing: border-box;
    font-family:  sans-serif;
    line-height: 1;
    padding: 0;
    margin: 0;
}

.container {
    background-color: var(--primary-color);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.box {
    background-color: white;
    border-radius: 10px;
    padding: 45px;
    width: 375px;
    max-width: 95%;
    box-shadow: 5px 5px 10px 1px rgb(0, 0, 0, 10%);
}

@media (max-width: 480px) {
    .box {
        padding: 75px 25px;
    }
}

.box h1 {
    font-size: 35px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 45px;
    color:  hsl(180,12%,8%);
    font-family: 'Raleway';
}

.box form label {
    display: block;
    font-size: 12px;
    margin-bottom: 3px;
    
}

.box form div {
    display: flex;
    align-items: center;
    border-bottom: 1px solid var(--gray-color);
}

.box form div:hover {
    border-bottom-color: var(--secondary-color);
}

.box form div:first-of-type {
    margin-bottom: 35px;
}

.box form div i {
    font-size: 15px;
    padding-left: 10px;
    color: var(--gray-color);
}

.box form div:hover i {
    color: var(--secondary-color);
}

.box form div input {
    font-size: 12px;
    outline: none;
    border: none;
    padding: 10px;
    min-width: 0;
    flex: 1;
    font-family: sans-serif;
}

.box form div input::placeholder {
    opacity: 1;
    color: var(--gray-color);
    font-size: 12px;
}

.box a {
    color: var(--gray-color);
    text-decoration: none;
    font-size: 12px;
    display: block;
}

.box a:hover {
    color: var(--secondary-color);
}

.box form .forgot {
    margin-top: 15px;
    float: right;
}

.box form input[type="submit"] {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    background-color: var(--secondary-color);
    color: white;
    border: none;
    width: 100%;
    padding: 15px;
    margin-top: 45px;
    border-radius: 250px;
}

.box form input[type="submit"]:hover {
    background-color: var(--tertiary-color);
    cursor: pointer;
}

.box .sign-up {
    margin-top: 19px;
    text-align: center;
    text-transform: uppercase;
}
.errorms{
    background:#F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin: 20px auto;
    font-weight: 500;
}
 </style>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['userr'])){
    header('location:uplo.php');
   
}
if(isset($_POST['submit'])){
 include 'conn-db.php';
   $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
   $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
   $code=filter_var($_POST['code'],FILTER_SANITIZE_EMAIL) ;

   $errors=[];
   

   // validate email
 

if(empty($password)&&empty($email)){
    $errors[]="Email and Password are Required";
}elseif(empty($email))
{
    $errors[]="Email is Required";
}elseif(empty($password))
{
    $errors[]="Password is Required";
}elseif(empty($code))
{
    $errors[]="Code is Required";
}
if($email=="FEADMIN"&&$password=="FEADMIN"&&$code=="FEADMIN")
{
    header('location:admin.php');
}


   // insert or errros 
   if(empty($errors)){
   
      // echo "check db";

      $stm="SELECT * FROM uplocode WHERE userid ='$email' && code='$code'" ;
      $q=$conn->prepare($stm);
      $q->execute();
      $data=$q->fetch();
      if(!$data){
         $errors[] = "Invalid ID or Password or Code";
      }
      else{
  
          $stmm="SELECT * FROM users " ;
      $qq=$conn->prepare($stmm);
      $qq->execute();
      $dataa=$qq->fetch();
      $password_hash=$dataa['password']; 
           
           if(!password_verify($password,$password_hash)){
              $errors[] = "Invalid ID or Password or Code";
           }else{
              $_SESSION['userr']=$dataa['name'];
              header('location:ppl.php');
  
           }
      }
    
   }
}

?>




    

<div class="container">
        <div class="box">
            <h1>Login</h1>
            <form action="uplologin.php" method="post">
            <?php 
        if(isset($errors)){
            if(!empty($errors)){
                foreach($errors as $msg){
                  ?> <p class="errorms"><?php echo $msg . "<br>";?></p><?php
                }
            }
        }
    ?>
                <label><b>ID</b></label>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="email" placeholder="Enter ID" maxlength="8" minlength="8">
                </div>
                <label><b>Password</b></label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <br><BR>
                <label><b>Code</b></label>
                <div>
                <i class="fa-solid fa-code"></i>
                    <input type="password" name="code" placeholder="Enter Code" title="Contact us to pay to get code">
                </div>
              
                <input type="submit" name="submit" value="Login">
            </form>
            <a href="register.php" class="sign-up"><b>Don't Have Account?</b><b> Sign Up</b></a>
            <a href="forgotID.php" class="sign-up"><b>Forgot ID?</b></a>
     </div>
 </div>

 

    

</body>
</html>
