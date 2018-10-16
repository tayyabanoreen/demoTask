<?php

    include("dbconfig.php");
     session_start();
    $name_error="";
    $email_error="";
    $password_error="";
    $warning="";

    $post=false;

        if(isset($_POST["submit"]))
            
        {
            $post=true;
            $name=$_POST["u_Name"];
            if(empty($_POST["u_Name"]))
            {
                $name_error="<p>Enter name</p>";
        
         
            }
            else
            {
                if (!preg_match("/^[a-zA-Z ]*$/", $_POST["u_Name"])) 
                {
                    $name_error="<p>only letters allowed</p>";
            
            
                }
            }

            if(empty($_POST["u_Email"]))
            {

                $email_error="<p>Enter email</p>";
        
            }
            else
            {
                if (!filter_var($_POST["u_Email"],FILTER_VALIDATE_EMAIL)) 
                {
                    $email_error="<p>Invalid Email</p>";
            
            
                }
            }
            $password = trim($_POST['u_Password']);
            if(empty($_POST["u_Password"]))
            {
                $password_error="<p>Enter password</p>";
        
            }
            else
            {
                if(strlen(trim($password)) >12 || strlen(trim($password)) <8)
                {
                    $password_error="<p>password length should be greater than 8 and less than 12</p>";
                }

            } 
  
        }
        if( $name_error=="" && $email_error=="" && $password_error=="" )
        {

        

                if(isset($_POST['submit'])){
                    $u_name=$_POST['u_Name'];
                    $email=$_POST['u_Email'];
                    $password=$_POST['u_Password'];
                    
                    $statement=$con->prepare("select * from user where u_email=:em");
                    $statement->bindParam(":em",$email);
                    $statement->execute();

                     $records=$statement->fetchAll();
                  //  var_dump($records);
                    if($records==true)
                    {
                       $warning= "email already exixt";
                    }
                    else{
                    //    session_start();
                    $_SESSION['u_Email']=$email;

                    $statement=$con->prepare("insert into user values('  ','$u_name','$email','$password')");
                    
                    $statement->execute(); 

                    if($statement->rowCount()>0){
                        
                        // header("Location:signupp.php?signup_status=success");
                         echo $_SESSION['u_Email'];
                         header("Location:signin.php");
                    }

                    else{
                         header("Location:signupp.php?signup_status=failure");
                    }
                    


                    }

                    
                                

                
                                   
                
                    
            }       
            
        }
?>
<!doctype html>
<!DOCTYPE html>
<html>
<head>
    <title>signup</title>
</head>
<style type="text/css">
    body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
}

.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 20px;
    border-radius: 5px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signup #inputEmail,
.form-signup #inputPassword,
.form-signup #inputName {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signup input[type=email],
.form-signup input[type=password],
.form-signup input[type=text],
.form-signup button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signup .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signup {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}
.error{
    color: red;
}

.btn.btn-signup:hover,
.btn.btn-signup:active,
.btn.btn-signup:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
</style>
<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <h2 style="color: white"><center>Registration Form</center></h2>
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="image/user.jpg"/>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signup" method="post" >
                <div class="error"><center><?php  echo $warning; ?></center></div>
                <br>
            <input type="text" id="inputName" class="form-control" placeholder="Name " name="u_Name" autofocus>
            <div class="error"><?php  echo $name_error; ?></div>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" name="u_Email" placeholder="Email address" >
                <div class="error"><?php  echo $email_error; ?></div>
                <input type="password" id="inputPassword" name="u_Password" class="form-control" placeholder="Password" >
                <div class="error"><?php  echo $password_error; ?></div>
                <button class="btn btn-lg btn-primary btn-block btn-signup" name="submit" type="submit">Register </button>
            </form><!-- /form -->
            <a href="signin.php" class="forgot-password">
                Already have account?Login
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>
