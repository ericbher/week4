<?php

session_start();

//Passwords are as follows for Eric and Marina respectively: cX7jEhDE, sqAwkdnC

$users = ['Eric' => '8e324223ddbf08e6bcd22076723fbab9', 'Marina' => 'fde966f5590f51d92d7c45f46b962061'];

include_once '../sys/core/init.inc.php';

if ( isset($_POST['submit']) ){


$username = $_POST['user'];
$password = $_POST['pass'];





// $sanEmail=filter_var($username,FILTER_SANITIZE_EMAIL);
// $valEmail=filter_var($sanEmail,FILTER_VALIDATE_EMAIL);


// $firstName = stristr($username, "@codervox.com", true);
// $uppercase = strtoupper($firstName);

$_SESSION['currentuser'] = $username;


    if(array_key_exists($username, $users ))
    {
        if ( md5($password) == $users[$username] )
        {
            header ('Location: ./');
        } else {
            echo "<h3>Your password did not match.</h3>";
        }
       
    } else {
        echo "<h3>That username does not exist.</h3>";
    }
    
       


   



}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <style>
        .copyright{
            text-align: center;
        }

        label{
            color: #777;
        }

        a{
            text-decoration: none;
        }

        h3{
            text-align: center;
            color: red;
        }
    
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Week 4 Pair Programming</a>
            </div>

            <form role="form" action="login.php" method="POST" class="form-inline navbar-form pull-right">
                    
                    <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="user" class="form-control" />
                    </div>

                    <div class="form-group">

                      <label for="password">Password</label>
                    <input type="password" id="password" name="pass" class="form-control" />

                    </div>

                    <input type="submit" class="btn btn-primary" name="submit" value="Login" />
                    



                </form>
            <!-- Collect the nav links, forms, and other content for toggling -->
           
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

            <div class="col-lg-12">

            <a href = "signup.php"><input type="button" class="btn btn-success center-block btn-lg" name="signup" value= "Sign Up" /></a>

                
            </div>

       </div>

<?php     
include_once 'assets/common/footer.inc.php';
?>
