<?php

session_start();

#if (!isset($_SESSION['currentuser'])){
#    header ('Location: ./login.php');
#}

include_once '../sys/core/init.inc.php';

$sql = "SELECT posts.id, posts.date_created, posts.title, users.user_name, posts.body FROM posts INNER JOIN users ON posts.author=users.id ORDER BY posts.date_created DESC";

$sql2 = "SELECT posts.id, comments.date_created, users.user_name, comments.comment, comments.post_id FROM posts LEFT JOIN comments ON comments.post_id=posts.id INNER JOIN users ON comments.author=users.id WHERE comments.approved=1 ORDER BY comments.date_created;";


$stmt = $dbo->prepare($sql);
$comment_stmt = $dbo->prepare($sql2);




$stmt->execute();
$comment_stmt->execute();


$results = $stmt->fetchAll(PDO::FETCH_ASSOC); //this grabs each row and returns it as an associative array
$comment_results = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);




$stmt->closeCursor();
$comment_stmt->closeCursor();




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
                        <?php if (isset($_SESSION['currentuser'])) echo "<a href=\"#\">Welcome " . $_SESSION['currentuser'] . " !</a>"  ?>
                    <li>
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

                <!-- Blog Post -->
                <?php
                foreach ($results as $posts){
                
                $date = date('F d Y H:i:s', strtotime($posts['date_created']));
                echo "<row>";
                echo "<h1>" . $posts['title'] . "<small> by " . $posts['user_name'] . " <span class=\"glyphicon glyphicon-time\"></span> Posted on " . $date . "</small></h1>";
                echo "<hr>";
                echo "<h4>" . $posts['body'] . "</h4>";
                echo "<hr></row>";
            

                foreach ($comment_results as $comment){
                 if ($comment['post_id'] == $posts['id']) {
                    echo "<row>";
                    echo "<div class='col-md-offset-2 col-md-10'>";
                    echo "<small>Created on " . $comment['date_created'] . " by " . $comment['user_name'] . "</small>";
                    echo "<p>" . $comment['comment'] . "</p>";
                    echo "</div></row>";
                }
            }
            echo "<hr><row></row>";
        }
                
                
            

?>                

          </div>

    </div>

<?php include_once 'assets/common/footer.inc.php'; ?>