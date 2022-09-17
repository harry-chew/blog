<?php
  include_once('inc/classes/autoload.php');
  include_once('inc/classes/config.php');

  if(isset($_GET['id'])) {
    $db = new db(config::$server,config::$username,config::$password,config::$dbname);
    $id = $_GET['id'];
    $post = $db->selectWhere("*", "post", "b_id={$id}");

    $title = $post[0]['b_title'];
    $data = json_encode($post[0]['b_data']);
    $author = $post[0]['b_author'];
    $created = $post[0]['b_created'];
  } else {
    header('location:index.php');
  }


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <title><?php echo $title; ?></title>
  </head>
  <body>
    <h1><?php echo $title; ?></h1>
    <div class="content">
      <div class="sidebar">
        <a href="index.php">Back to Home</a>
        <a href="add-blog-post.php">Add New Post</a>
        <a href="latest-post.php">Latest Post</a>
      </div>
      <div id="post-data" class="blog">
        <div id="editor"></div>
        <div class="blog-extra">
          <p><?php echo $author; ?></p>
          <p><?php echo $created; ?></p>
        </div>

      </div>
    </div>


    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
        <script type="text/javascript">
            const editor = new Quill('#editor', {
                        theme: 'snow',
            });



        </script>
  </body>
</html>
