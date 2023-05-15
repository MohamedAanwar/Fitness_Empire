<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo.png" type="image">
    <title>Admin login</title>
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
   
$program=$_POST['program'];
$id=$_POST['id'];
$code=$_POST['code'];
$s=[];
$errors=[];

$lowercase=preg_match('@[a-z]@',$code);
$number=preg_match('@[0-9]@',$code);

if(empty($id)&& empty($code)){
    $errors[]="User ID and Code are Required";
}
elseif(empty($id)){
    $errors[]="User ID is Required";
}elseif(empty($code)){
    $errors[]="Code is Required";
}
elseif(!$lowercase||!$number||strlen($code)<8   )
{
    $errors[]="Weak Code! Code should be at least 8 characters and should include numbers and letters";
}

if(!empty($id)&& !empty($code)){
$stm="SELECT userid FROM users WHERE userid ='$id'";
   $q=$conn->prepare($stm);
   $q->execute();
   $data=$q->fetch();
   
   if(!$data){
     $errors[]="ID not found";
     $_POST['id']='';
   }
}


if($program=="Push-Pull-Leg")
{

    if(empty($errors)){
        
        $stm="INSERT INTO pplcode (userid,code) VALUES ('$id','$code')";
        $conn->prepare($stm)->execute();
        $_POST['code']='';
        
        $s[]="Code has been added successfully";
         }
}elseif($program=="Upper-Lower"){
    if(empty($errors)){
        // echo "insert db";
        
        $stm="INSERT INTO uplocode (userid,code) VALUES ('$id','$code')";
        $conn->prepare($stm)->execute();
        $_POST['code']='';
       
        
        $s[]="Code has been added successfully";
     }
}elseif($program=="Brosplit"){
    if(empty($errors)){
        // echo "insert db";
        
        $stm="INSERT INTO brosplitcode (userid,code) VALUES ('$id','$code')";
        $conn->prepare($stm)->execute();
        $_POST['code']='';
       
  
        $s[]="Code has been added successfully";
     }
}

}
?>


<div class="container">
        <div class="box">
            <h1>Add Code</h1>
            <form action="admin.php" method="post">
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
                <label for=""><b>Program</b></label>
                <div class="selectc">
                <i class="fa-solid fa-list"></i>
                    <select class="selectb" name="program" id="">
                        <option value="Push-Pull-Leg">Push-Pull-Leg</option>
                        <option value="Upper-Lower">Upper-Lower</option>
                        <option value="Brosplit">Brosplit</option>
                    </select>
                </div>
                <label><b>User ID</b></label>
                <div>
                <i class="fa-solid fa-user"></i>
                    <input type="number"   name="id" placeholder="Enter User ID" maxlength="8" minlength="8">
                </div>
                <br><br>
                <label><b>Code</b></label>
                <div>
                <i class="fa-solid fa-code"></i>
                    <input type="text" id="g"  name="code" placeholder="Enter Code" >
                </div>
                <a id="btn" class="sign-up"><b>Generate Code</b></a>
                <input type="submit" name="submit" value="Add">
            </form>
            <a href="index.php" class="sign-up"><b>HOME</b></a>
     </div>
 </div>

 
<script type="text/javascript">
  
  
    let button = document.getElementById('btn');

button.addEventListener('click', () => {

    var chars="0123456789abcdefghijklmnopqrstuvwxyz0123456789";
        var code="";
        for(var i=0;i<8;i++)
        {
            var randomn=Math.floor(Math.random()*chars.length);
            code+=chars.charAt(randomn);
        }
        document.getElementById("g").value=code;    

});
</script>
</body>
</html>