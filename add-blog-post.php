<?php
  include_once('inc/classes/autoload.php');
  include_once('inc/classes/config.php');


  $db = new db(config::$server,config::$username,config::$password,config::$dbname);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
    <title>Add Blog Post</title>
  </head>
  <body>
    <h1>Add Post</h1>
    <div class="content">
      <div class="sidebar">
        <a href="index.php">Back to Home</a>
        <a href="add-blog-post.php">Add New Post</a>
        <a href="latest-post.php">Latest Post</a>
      </div>
      <div class="blog">

        <div class="editor-container">
          <form>
            <div class="post-content">
              <input id="post-title" class="post-title rem2" type="text" name="post-title" value="" placeholder="Title... " autofocus>
              <select id="post-author" class="post-author rem2" name="post-author">
                <option value="Harry Chew">Harry Chew</option>
              </select>
            </div>

            <!-- Create the editor container -->
            <div id="editor"></div>
            <button id="save-post" class="save-post" type="button" name="save-post">Save</button>
            <p id="serverResponse"></p>
          </form>
        </div>




        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script type="text/javascript">

        const toolbarOptions = [
          ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          ['blockquote', 'code-block'],

          [{ 'header': 1 }, { 'header': 2 }],               // custom button values
          [{ 'list': 'ordered'}, { 'list': 'bullet' }],
          [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
          [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
          [{ 'direction': 'rtl' }],                         // text direction

          [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

          [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
          [{ 'font': [] }],
          [{ 'align': [] }],

          ['clean']                                         // remove formatting button
        ];
          const editor = new Quill('#editor', {
            modules: { toolbar: toolbarOptions },
            theme: 'snow',
          });


        </script>
        <script type="text/javascript">
            const postTitle = document.getElementById('post-title');
            const postAuthor = document.getElementById('post-author');

            const savePost = document.getElementById('save-post');
            savePost.addEventListener("click", GetContents);


          function GetContents() {
            let title = postTitle.value;
            let author = postAuthor.value;
            let delta = editor.getContents();
            let data = editor.root.innerHTML;
            SavePost(title, author, delta);
          }

          function SavePost(title, author, delta) {

            const xmlhttp = new XMLHttpRequest();

            xmlhttp.onload = function() {
              document.getElementById("serverResponse").innerHTML = xmlhttp.responseText;
            }
            let string = JSON.stringify(delta);
            console.log(string);
            xmlhttp.open("POST", "newpost.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("t="+title+"&a="+author+"&d="+string);
          }

        </script>
      </div>
    </div>

  </body>
</html>
