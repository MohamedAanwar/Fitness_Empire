<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo.png" type="image">
    <title>Forgot ID</title>
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
    padding: 38px;
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
    margin-top: 25px;
    text-align: center;
    text-transform: uppercase;
}
.errorms{
    background:#F2DEDE;
    color: #A94442;
    padding: 8px;
    width: 95%;
    border-radius: 5px;
    margin: 20px auto;
    font-weight: 500;
    line-height: 18px;
}
.suc{
    background:#d4edda;
    color: #40754c;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin: 2px auto;
    font-weight: 500;
}
.selectc{
    display: flex;
    justify-content: center;
    position: relative;
    min-width: 250px;
    height: 40px;
    font-family: sans-serif;
    font-weight: 500;
}
.selectb{
    border: none;
    appearance: none;
    padding: 0 30px 0 15px;
    width: 100%;
    height: 25px;
    color: black;
    background: white;
    font-size: 17px;
    font-family: sans-serif;
    border-radius: 5px;
    font-weight: 400;
}
#g{
    font-family: sans-serif;
    font-weight: 500;
    font-size: 17px;
}
#btn{
    cursor: pointer;
}
    </style>
</head>
<body>
<?php

if(isset($_POST['submit'])){
    include 'conn-db.php';

$phone=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
$password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
 $errors=[];

if(empty($password)&&empty($phone)){
    $errors[]="Please enter Phone and Password";
}
 elseif(empty($phone))
{
    $errors[]="Please enter your phone";
}
elseif(empty($password))
{
    $errors[]="Please enter your Password";
}

if(!empty($phone)&& !empty($password)){
$stm="SELECT phone FROM users WHERE phone ='$phone'";
   $q=$conn->prepare($stm);
   $q->execute();
   $data=$q->fetch();
   
   if(!$data){
     $errors[]="This phone does not have an account";
     $_POST['phone']='';
   }

}


if(empty($errors))
{
    $stmm="SELECT * FROM users " ;
   $qq=$conn->prepare($stmm);
   $qq->execute();
   $dataa=$qq->fetch();
   $password_hash=$dataa['password']; 
        
        if(!password_verify($password,$password_hash)){
           $errors[] = "Invalid Password";
           $_POST['password']='';
        }else{
            $stm="SELECT * FROM users WHERE phone ='$phone'" ;
            $q=$conn->prepare($stm);
            $q->execute();
            $data=$q->fetch();
            
            $_SESSION['id']=$data['userid'];
        }
    
    
}
}


?>


<div class="container">
        <div class="box">
            <h1>Forgot ID</h1>
            <form action="forgotID.php" method="post">
            <?php 
        if(isset($errors)){
            if(!empty($errors)){
                foreach($errors as $msg){
                  ?> <p id="errorms" class="errorms"><?php echo $msg . "<br>";?></p><?php
                }
            }
        }
        if(isset($s))
        {
            if(!empty($s)){
                foreach($s as $msgg){
                  ?> <p id="suc" class="suc"><?php echo $msgg . "<br>";?></p><?php
                }
            }
        }
    ?>
                
                <label><b>Phone</b></label>
                <div>
                <i class="fa-solid fa-phone"></i>
                    <input type="tel" name="phone"  placeholder="Enter Your Phone" pattern="01[0-9]{9}" >
                </div>
                <label><b>Password</b></label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="pas"  name="password" placeholder="Enter Your Password" title="Password should be at least 8 characters and should include upercase letter, numer and symbol">
                </div>
                <br><br>
                <?php
                if(isset($_POST['submit'])){
                    if(empty($errors)){
                   ?> <p class="suc">
                     <?php if(isset($_POST['submit'])){ if(empty($errors)) {echo "<b>Your ID: </b>".$_SESSION['id'];}}?>
                </p>
                  <?php  }
                  } ?>
               
                
                <input type="submit" name="submit" value="Continue">
            </form>
            <a href="login.php" class="sign-up"><b>Login</b></a>
     </div>
 </div>
</body>
</html>