<?php
//fetch.php
if(isset($_POST["post_id"]))
{
 $connect = mysqli_connect("us-cdbr-east-05.cleardb.net", "b486c2ce39e1e0", "5632fdf3", "heroku_4e16bdc658af346");
 $output = '';
 $query = "SELECT * FROM usuario WHERE usr_id = '".$_POST["post_id"]."'";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <h2>'.$row["usr_id"].'</h2>
  <p><label>Author By - '.$row["usr_nome"].'</label></p>
  <p>'.$row["usr_nomeFull"].'</p>
  ';
  $query_1 = "SELECT usr_id FROM usuario WHERE usr_id < '".$_POST['post_id']."' ORDER BY usr_id DESC LIMIT 1";
  $result_1 = mysqli_query($connect, $query_1);
  $row_cnt_1 = mysqli_num_rows($result_1);
  $data_1 = mysqli_fetch_assoc($result_1);
  $query_2 = "SELECT usr_id FROM usuario WHERE usr_id > '".$_POST['post_id']."' ORDER BY usr_id ASC LIMIT 1";
  $result_2 = mysqli_query($connect, $query_2);
  $data_2 = mysqli_fetch_assoc($result_2);
  $row_cnt_2 = mysqli_num_rows($result_2);
  $if_previous_disable = '';
  $if_next_disable = '';
  if($row_cnt_1 == null || $row_cnt_1 == 0 || $row_cnt_1 == '')
  {
   $if_previous_disable = 'disabled';
   $data_1['usr_id']=null;
  }
  if($row_cnt_2 == null || $row_cnt_2 == 0 || $row_cnt_2 == '')
  {
   $if_next_disable = 'disabled';
   $data_2['usr_id']=null;
  }
  $output .= '
  <br /><br />
  <div align="center">
   <button type="button" name="previous" class="btn btn-warning btn-sm previous" id="'.$data_1["usr_id"].'" '.$if_previous_disable.'>Previous</button>
   <button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$data_2["usr_id"].'" '.$if_next_disable.'>Next</button>
  </div>
  <br /><br />
  ';
 }
 echo $output;
}

?>