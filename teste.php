<?php 
//index.php
$connect = mysqli_connect("localhost", "root", "1234", "cartoloucos");
$query = "SELECT * FROM usuario ORDER BY usr_id ASC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Modal with Dynamic Previous & Next Data Button by Ajax PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
 </head>
 <body>
  <br /><br />
    <div class="container">
        <h2 align="center">Modal with Dynamic Previous & Next Data Button by Ajax PHP</h2>
        <br />
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Post</th>
                    <th>Post Title</th>
                    <th>Author</th>
                    <th>View</th>
                </tr>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    echo '
                    <tr>
                        <td>'.$row["usr_id"].'</td>
                        <td>'.$row["usr_nome"].'</td>
                        <td>'.$row["usr_nomeFull"].'</td>
                        <td><button type="button" name="view" class="btn btn-info view" id="'.$row["usr_id"].'" >View</button></td>
                    </tr>
                    ';
                }
                ?>
            </table>
        </div>
    </div>
    <div class="container">
        Teste 
        <div class="modal-body" id="serase">
        <div align="center">
            1<br>
            <button type="button" name="pserase" class="btn btn-warning btn-sm pserase" id="0" disabled>Voltar</button>
            <button type="button" name="nserase" class="btn btn-warning btn-sm nserase" id="2">Avançar</button>
        </div>
        </div>
    </div>
 </body>
</html>

<div id="post_modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content"> 
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Post Details</h4>
   </div>
   <div class="modal-body" id="post_detail">

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


<script>
$(document).ready(function(){
 
 function fetch_post_data(post_id)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{post_id:post_id},
   success:function(data)
   {
    $('#post_modal').modal('show');
    $('#post_detail').html(data);
   }
  });
 }

 function fetch_post_dataserase(post_id)
 {
  $.ajax({
   url:"fetchserase.php",
   method:"POST",
   data:{post_id:post_id},
   success:function(data)
   {
    //$('#post_modal').modal('show');
    $('#serase').html(data);
   }
  });
 }

 $(document).on('click', '.view', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });

 $(document).on('click', '.previous', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });

 $(document).on('click', '.next', function(){
  var post_id = $(this).attr("id");
  fetch_post_data(post_id);
 });
 
 $(document).on('click', '.pserase', function(){
  var post_id = $(this).attr("id");
  fetch_post_dataserase(post_id);
 });

 $(document).on('click', '.nserase', function(){
  var post_id = $(this).attr("id");
  fetch_post_dataserase(post_id);
 });

});
</script>