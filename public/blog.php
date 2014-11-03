<?php
session_start();

include_once '../sys/core/init.inc.php';

if (isset ($_POST['submit']))
{

$post = htmlentities($_POST['newPost'], ENT_QUOTES);
$title = htmlentities($_POST['title'], ENT_QUOTES);
$author = $_SESSION['currentuser'];

$sql = "INSERT INTO `posts` (`title`, `author`, `body`) VALUES (:title, :author, :post)";

try
        {
            $stmt = $dbo->prepare($sql);

            $stmt->bindValue(":title", $title, PDO::PARAM_STR);
            $stmt->bindValue(":author", $author, PDO::PARAM_STR);
            $stmt->bindValue(":post", $post, PDO::PARAM_STR);
            

            $stmt->execute();
            $stmt->closeCursor();



        }

        catch ( Exception $e )
        {
            die ( $e->getMessage() );

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
        .errors{
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
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <?php echo "<a href=\"#\">Welcome " . $_SESSION['currentuser'] . " !</a>"  ?>
                    </li>
                    <li>
                        <a href="blog.php">Create New Blog Entry</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-8">
                
                  <h1>New Blog Entry</h1>

                  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group">

                  <input type="text" name = "title" placeholder="Title of Post" class="form-control" /><br /><br />

                  <textarea name="newPost" id="post" class="form-control" rows="20" ></textarea><br />


                  <span class="errors pull-left">
                      <?php 
                        if( isset($_POST['submit'])){
                            $msg = $_POST['newPost'];
                          
                            
                            if ($msg == '')
                            {
                                echo "You did not enter anything.";
                            }
                        }


                      ?>
                  </span>
                  <input type="submit" class="btn btn-primary pull-right" name="submit" value="Submit">
                  <input type="hidden" name="author" value="$_SESSION[currentuser]" />

                  </form>

                  

            </div>
        

         <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>

 

       

<?php     
include_once 'assets/common/footer.inc.php';
?>
