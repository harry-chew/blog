<?php
  include_once('inc/classes/autoload.php');
  include_once('inc/classes/config.php');

  $db = new db(config::$server,config::$username,config::$password,config::$dbname);

  $post = $db->selectMostRecent('post', 'b_created');

  $title = $post[0]['b_title'];
  $data = $post[0]['b_data'];
  $author = $post[0]['b_author'];
  $created = $post[0]['b_created'];
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
      </div>
      <div id="post-data" class="blog rem2">
        <div class="full-blog-post">
          <div id='editor'>
            
          </div>
          <div class="blog-extra">
            <p><?php echo $author; ?></p>
            <p><?php echo $created; ?></p>
          </div>
        </div>


      </div>
    </div>
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
  <script type="text/javascript">

    let editor = new Quill('#editor');
    let data = <?php echo $data;?>;
    console.log(data);
    editor.setContents(data);
  </script>
  </body>
</html>
