<?php
  include_once('inc/classes/autoload.php');
  include_once('inc/classes/config.php');
  include_once('inc/util/functions.php');
  $db = new db(config::$server,config::$username,config::$password,config::$dbname);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <title>Blog</title>
  </head>
  <body>
    <h1>Harry Chew</h1>


    <div class="content">
      <div class="sidebar">
        <a href="add-blog-post.php">Add New Post</a>
        <a href="latest-post.php">Latest Post</a>
      </div>
      <div class="blog">
        <?php
        $dataArray = array('b_id', 'b_title', 'b_data', 'b_author', 'b_created');
        $posts = $db->select($dataArray, "post");

        foreach($posts as $post) {
          $id = $post['b_id'];
          $title = $post['b_title'];
          $data = $post['b_data'];
          $created = $post['b_created'];
          echo '<a href="view.php?id='.$id.'" class="post"><strong>' . $title . '</strong>';
          echo    '<p class="post-data">' . formatPostData($data) . '</p>';
          echo    '<p class="post-date">' . formatDate($created) . '</p>';
          echo  "</a>";
        }
        ?>
      </div>
    </div>


  </body>
</html>
