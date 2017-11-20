<?php
  require 'includes/db.php';
  require 'includes/comments.php';

  $db = new DB();
  $comments = new comments();
?>
<!DOCTYPE html>
<html>
  <head>

    <!-- META START -->
    <meta charset="utf-8">
    <meta name="author" content="Jesse Izeboud">
    <title>Gastenboek</title>
    <!-- META END -->

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS END -->

  </head>
  <body>
      <nav>
        <div class="container">
          <div class="nav-wrapper">
            <a href="#" class="brand-logo">Gastenboek</a>
          </div>
        </div>
      </nav>
    <div class="container">
      <div class="row">
        <div class="col s12">
            <form action="" method="post">
              <div class="input-field col s12">
               <textarea id="comment" name="comment" class="materialize-textarea"></textarea>
               <label for="comment">Comment</label>
               <?php
                 if(isset($_POST["comment"]) && !empty($_POST["comment"])) {
                   if($comments->checkProfanity($_POST["comment"])) {
                     $comments->addComment($_POST["comment"]);
                   } else {
                     ?>
                     <div class="chip" style="margin-bottom:20px;">
                      Contains profanity, please remove these words and try again.
                     </div>
                     <?php
                   }
                 }
               ?>

               <button type="submit" class="waves-effect waves-light btn" style="width:100%;">Submit</button>

             </div>
            </form>
        </div>
      </div>



          <?php
            foreach($comments->getComments() as $comment) {
             ?>
             <div class="row" style="margin-top">
               <div class="col s12">
                 <div class="col s12 m12" style="margin:auto; ">
                   <div class="card">
                     <div class="card-content">
                       <span class="card-title">Guest</span>
                       <p><?php echo $comment["comment"]; ?></p>
                     </div>
                     <div class="card-action">
                       <p style="color:rgb(241, 93, 67); "><i class="material-icons" style="position:relative; top:6px; right:5px;">access_time</i><?php echo $comment["timestamp"]; ?></p>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <?php
            }
          ?>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  </body>
</html>
