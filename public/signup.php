<?php

session_start();

include_once '../sys/core/init.inc.php';



if ( isset($_POST['signup']) )
{

	

	// $sql = "INSERT INTO users (user_name, email, password) VALUES ()";

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

    <title>Sign Up</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <style>
		.error {
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
         </div>
    </nav>

         
          
       

    <!-- Page Content -->
    <div class="container">

            <div class="col-lg-6 col-lg-offset-3">

               <form role="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

               		<h3>SIGN UP</h3>

               		<?php 

               		echo "<p class=\"error\">";

               		if ( isset($_POST['signup']) )
					{

					$pass1 = $_POST['pass'];
					$pass2 = $_POST['confirmpass'];
					$username = $_POST['user'];
					$email = $_POST['email'];

					$_SESSION['currentuser'] = $username;

					$sql = "INSERT INTO `users` (`user_name`, `email`, `password`) VALUES (:user, :email, :password)";

					$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

					if (filter_var($cleanEmail, FILTER_VALIDATE_EMAIL))
					{
						$validEmail = $cleanEmail;

						if ($pass1 == $pass2)
						{
							$hash = sha1($pass1);
							try
        						{
            						$stmt = $dbo->prepare($sql);

            						$stmt->bindValue(":user", $username, PDO::PARAM_STR);
            						$stmt->bindValue(":email", $validEmail, PDO::PARAM_STR);
            						$stmt->bindValue(":password", $hash, PDO::PARAM_STR);
            

            						$stmt->execute();
            						$stmt->closeCursor();
            						header ('Location: ./index.php');
								}

        					catch ( Exception $e )
        						{
            						die ( $e->getMessage() );

        						}

						} else { echo "Your passwords did not match. <br />"; }
					} else { echo "You did not enter a valid e-mail. <br/>"; }
						
					} 
				


					

					echo "</p>";

					



               		?>
                    
                    <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="user" class="form-control" />
                    </div>

                    <div class="form-group">

                      <label for="password">Password</label>
                    <input type="password" id="password" name="pass" class="form-control" />

                    </div>

                     <div class="form-group">

                      <label for="passwordconfirmation">Confirm Password</label>
                    <input type="password" id="passwordconfirmation" name="confirmpass" class="form-control" />

                    </div>

                    <div class="form-group">

                   <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" />

                    </div>

                    <input type="submit" class="btn btn-success" name="signup" value="Sign Up" /> <br /><br />Already A User? <button type="button" class="btn btn-link"> 
                    <a href="login.php">Log In</a></button>
                    



                </form>

                
            </div>

       </div>

<?php     
include_once 'assets/common/footer.inc.php';
?>
