<?php
    include("dbconfig.php");

    $email_error="";
    $password_error="";
    
    

    $post=false;

        if(isset($_POST["submit"]))
            
        {
            $post=true;
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

        if(empty($_POST["u_Password"]))
            {
                $password_error="<p>Enter password</p>";
            
            
            }

        }
        if( $email_error==""  && $password_error=="")
        {


                    if (isset($_POST['submit'])) 
                    {

                        $st=$con->prepare("select * from user where u_email='" . $_POST["u_Email"] . "'and u_password='" .$_POST["u_Password"] ."' ");
                        $st->execute();
                        $records=$st->fetch(PDO::FETCH_ASSOC);
                    
                           if($records==true)
                           
                            {
                          
                                session_start();
                            
                            

                              $u_email=$_POST['u_Email'];
                              $_SESSION['u_Email']="";
                              $_SESSION['u_Email']=$u_email;
                              

                              header('Location:profile.php');

                            }
                             else
                        {
                           // echo $_POST['u_Name'];
                            header("Location:signin.php?failure=1");         
                        } 

             

                    }
       
            
        }
         
?>
<!doctype html>
<!DOCTYPE html>
<html>
<head>
    <title>Signin</title>
</head>
<style type="text/css">
.error{
    color: red;
}
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
    /* shadows and rounded borders */

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

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
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

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
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
    <h2 style="color: white"><center>Login Form</center></h2>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="image/user.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" name="u_Email" placeholder="Email "  autofocus>
                <div class="error"><?php  echo $email_error; ?></div>
                <input type="password" id="inputPassword" name="u_Password" class="form-control" placeholder="Password" >
                <div class="error"><?php  echo $password_error; ?></div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" name="submit" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="index.php" class="forgot-password">
                Do not have account?Register now
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html>
