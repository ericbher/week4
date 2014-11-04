<?php

session_start();
include_once '../sys/core/init.inc.php';

if (isset($_SESSION['currentuser'])){
    $author=$_SESSION['currentuser'];
    $authors_req="SELECT `id` FROM `users` WHERE `user_name`= \"$author\"";
    $stmt2 = $dbo->query($authors_req);
    $results = $stmt2->fetchAll(PDO::FETCH_NUM);
    $author = $results[0][0];

}
else $author=3;

#get a list of posts
$posts_req="SELECT `id`, `title` FROM `posts`";
$stmt = $dbo->prepare($posts_req);
$stmt->execute();
$post_list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$stmt->closeCursor();

#prepare the new comment for entry

if (isset ($_POST['submit']))
{
$post_id=$_POST['posts'];

$comment = htmlentities($_POST['comment'], ENT_QUOTES);

$sql = "INSERT INTO `comments` (`post_id`, `author`, `comment`) VALUES (:post_id, :author, :comment)";

try
        {
            $stmt = $dbo->prepare($sql);
            $stmt->bindValue(":author", $author, PDO::PARAM_INT);
            $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
            $stmt->bindValue(":post_id", $post_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->closeCursor();
        }

        catch ( Exception $e )
        {
            die ( $e->getMessage() );

        }
        header ('Location: ./');
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
    <title>Add an Entry</title>
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
                        
                    </li>
                    <li>
                        <a href="blog.php">Add a Comment</a>
                    </li>
                    <?php if (isset($_SESSION['currentuser']))
                    echo '<li><a href="logout.php">Logout</a></li>';
                    else echo '<li><a href="login.php">Login</a></li>';
            
                ?>
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
                
                  <h1>New Comment</h1>

                  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="form-group">
<p>
               	Choose a post to comment on: <select name="posts" class="form_control">
	<?php foreach ($post_list as $post): ?>
	<option class="form-control" value="<?= $post['id'] ?>"><?= $post['title'] ?></option>
	<?php endforeach ?>
               	</select>
</p>
                  <textarea name="comment" id="post" class="form-control" rows="10" ></textarea><br />


                  <span class="errors pull-left">
                      <?php 
                        if( isset($_POST['submit'])){
                            $msg = $_POST['comment'];
                          
                            
                            if ($msg == '')
                            {
                                echo "You did not enter anything.";
                            }
                        }


                      ?>
                  </span>
                  <input type="submit" class="btn btn-primary pull-right" name="submit" value="Submit">
 				

                  </form>

                  

            </div>
             

<?php     
include_once 'assets/common/footer.inc.php';
?>

