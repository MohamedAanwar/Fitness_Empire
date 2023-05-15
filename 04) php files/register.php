
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo.png" type="image">
    <title>Sign UP</title>
    <style>
     @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap');

:root {
    --primary-color: hsl(180,12%,8%);
    --secondary-color: red;
    --tertiary-color: #8b0000;
    --light-color: #efefef;
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
    padding: 25px;
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
    font-size: 25px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 35px;
    color: hsl(180,12%,8%);
    font-family: 'Raleway';
}

.box form div {
    display: flex;
    align-items: center;
    background-color: var(--light-color);
    border-radius: 250px;
    margin-bottom: 25px;
    padding: 10px;
}

.box form div i {
    font-size: 15px;
    margin: 0 10px;
    color: var(--gray-color);
}

.box form div:hover i {
    color: var(--secondary-color);
}

.box form div input {
    background-color: inherit;
    font-size: 12px;
    outline: none;
    border: none;
    padding: 5px;
    min-width: 0;
    flex: 1;
}

.box form div input::placeholder {
    opacity: 1;
    color: var(--gray-color);
    font-size: 12px;
}

.box form div input[type="date"] {
    color: var(--gray-color);
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
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
    border-radius: 250px;
}

.box form input[type="submit"]:hover {
    background-color: var(--tertiary-color);
    cursor: pointer;
}

.box span {
    margin-top: 25px;
    font-size: 12px;
    color: var(--gray-color);
    display: block;
    text-align: center;
}

.box span a {
    font-weight: 500;
    text-decoration: none;
    color: var(--secondary-color);
}

.box span a:hover {
    color: var(--tertiary-color);
}
.errorms{
    background:#F2DEDE;
    color: #A94442;
    padding: 10px;
    width: 95%;
    border-radius: 5px;
    margin: 20px auto;
    font-weight: 500;
    text-align: justify;
    line-height: 18px;
}
.suc{
    background:#d4edda;
    color: #40754c;
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

if(isset($_POST['submit'])){
include 'conn-db.php';
   $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING); 
   $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
   $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
   $confirm=filter_var($_POST['confirm'],FILTER_SANITIZE_STRING);
   $phone=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
   $date=filter_var($_POST['date'],FILTER_SANITIZE_STRING);

   $errors=[];
   $uppercase=preg_match('@[A-Z]@',$password);
   $number=preg_match('@[0-9]@',$password);
   $sp=preg_match('@[^\w]@',$password);
   // validate name
   
   if(empty($name)&&empty($email)&&empty($password)){
       $errors[]="Name and ID and Password are Required";
   }elseif(empty($name)){
    $errors[]="Name is Required";
   }elseif(strlen($name)>100){
       $errors[]="Name must not be more than 100 characters";
   }elseif(empty($email)&&empty($password)){
    $errors[]="ID and Password are Required";
   }elseif(empty($email))
   {
    $errors[]="ID is Required";
   }elseif(strlen($email)<8){
        $errors[]="ID should be at least 8 numbers";
        $_POST['email']='';
   }elseif(strlen($email)>8){
    $errors[]="ID should not be more 8 numbers";
    $_POST['email']='';
   }
   elseif(substr($email,0,1)==='0')
{
    $errors[]="ID should not start with 0";
    $_POST['email']='';
}
   elseif(empty($password)){
    $errors[]="Password is Required";
   }
   elseif(!$uppercase||!$sp||!$number||strlen($password)<8){
    $errors[]="Weak Password!Password should be at least 8 characters and should include upercase letter, numer and symbol";
}elseif($confirm!=$password){
 $errors[]="Password don't match";
}
elseif(empty($phone)){
    $errors[]="Phone is Required";
}elseif(strlen($phone)<11 ||strlen($phone)>11 )
{
    $errors[]="Wrong Phone Number";
}elseif(empty($date))
{
    $errors[]="Date is Required";
}
   

  
// validte  id
   $stm="SELECT userid FROM users WHERE userid ='$email'";
   $q=$conn->prepare($stm);
   $q->execute();
   $data=$q->fetch();
   
   if($data){
     $errors[]="ID already exists";
     $_POST['email']='';
   }

// validate phone

   $stm="SELECT phone FROM users WHERE phone ='$phone'";
   $q=$conn->prepare($stm);
   $q->execute();
   $data=$q->fetch();
   
   if($data){
     $errors[]="Phone already exists";
     $_POST['phone']='';
   }


   // insert or errros 
   if(empty($errors)){
      // echo "insert db";
      $password=password_hash($password,PASSWORD_DEFAULT);
      $stm="INSERT INTO users (name,userid,password,phone,date) VALUES ('$name','$email','$password','$phone','$date')";
      $conn->prepare($stm)->execute();
      $_POST['name']='';
      $_POST['email']='';
      $_POST['phone']='';
      $_POST['date']='';

      $_SESSION['userrrr']=[
        "name"=>$name,
        "email"=>$email,
        "phone"=>$phone,
        "date"=>$date,
        
      ];
      header("Location: register.php?success=Your Account Has Been Created Successfully");
   }
}

?>
 <div class="container">
        <div class="box">
            <h1>Sign Up</h1>
            <form action="register.php" method="POST" onsubmit="welcome()">
            <?php 
        if(isset($errors)){
            if(!empty($errors)){
                foreach($errors as $msg){
                  ?> <p id="errorms" class="errorms"><?php echo $msg . "<br>";?></p><?php
                }
            }
        }else{
            if(isset($_GET['success'])){
                ?> <p id="suc" class="suc"><?php echo $_GET['success'] . "<br>";?></p><?php
            }
        }
    ?>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="nam" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" name="name" placeholder="Enter Your Name">
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>
                    <input type="number" id="em" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" name="email" placeholder="Enter Your ID" title="ID should not start with 0 and should be at least 8 numbers " >
                </div>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="pas"  name="password" placeholder="Enter Your Password" title="Password should be at least 8 characters and should include upercase letter, numer and symbol">
                </div>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="pas" name="confirm" placeholder="Confirm Password">
                </div>
                <div>
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" name="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>" placeholder="Enter Your Phone" pattern="01[0-9]{9}" >
                </div>
                <div>
                    <i class="fa-solid fa-calendar"></i>
                    <input type="date" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>" name="date">
                </div>
             
                <input type="submit" name="submit" value="Sign up" >
            </form>
            <span><b>Already have an account?</b>
                <a href="index.php"><b>Home</b></a></span>
        </div>
    </div>





</body>
</html>
