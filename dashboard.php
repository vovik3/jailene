<?php
//place this code on top of all the pages which you need to authenticate

//--- Authenticate code begins here ---
session_start();
//checks if the login session is true
if(!$_SESSION['username']){
header("location:index.php");
}
$username = $_SESSION['username'];

// --- Authenticate code ends here ---
?>

<?php include ('jailene/header.php'); ?> 

<?php
$delete = $_GET['delete'];
$document_get = mysql_query("SELECT * FROM users WHERE username='$username'");
$match_value = mysql_fetch_array($document_get);
$fullname = $match_value['fullname'];
$location = $match_value['location'];
$gender = $match_value['gender'];
$user_id = $match_value['id'];
?>
<br/>

 <div style="float:right">  <a href="add.php" class="btn btn-warning"> Add New List </a>  <a class="btn btn-info" href="settings.php" > Settings </a>  <a class="btn btn-danger logout" href="logout.php" > Logout</a> </div>

 <fieldset>
    <legend>Welcome <?php echo $username; ?>, </legend>
	
	<br/>
	<?php
	if($delete) {
		
		$success = mysql_query("DELETE FROM todolist WHERE id='$delete'");
		
	if($success) {
		echo '<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> Successfully Deleted! </strong>. </div>';
	}
	}
	?>
	<br/>
	<div style="width:100%">  <b> My ToDo Lists </b> </div>
	<hr/>
	

<table style="width:100%">
<tr>
<th> Completed?  </th>
<th> About Task </th>
<th> Actions </th>
</tr>
<tr>
<td colspan="3"> <br/> </td>
</tr>
<?php
$document_get = mysql_query("SELECT * FROM todolist WHERE user_id='$user_id' ORDER BY id DESC");
while($match_value = mysql_fetch_array($document_get)) { 
?>

<tr> 
<td style="vertical-align:top; padding-right: 20px; width: 20%; text-align:center;" > 
<input id="id" type="hidden" /> 
<input id="<?php echo $match_value['id']; ?>"  onchange="javascript:getcheck(this)" type="checkbox" <?php if($match_value['check_value'] == 'true') echo 'checked';  ?>/>  
</td> 
<td> 
<textarea id="<?php echo $match_value['id']; ?>" class="<?php echo $match_value['id']; ?>" onchange="javascript:getText(this)" <?php if($match_value['check_value'] == 'true') { echo 'disabled '; echo ' style="text-decoration:line-through"'; } ?> ><?php echo $match_value['description']; ?></textarea> 
</td> 
<td style="text-align:center;">
<a class="btn btn-danger delete" href="?delete=<?php echo $match_value['id']; ?>"> <span class="glyphicon glyphicon-remove"></span> Delete </a>
</td>
</tr>


<?php
}
?>
</table>



<script>

function getText(text){

	var id = text.id;
	var text = text.value;
	model = {
            id: id,
			text: text
             };
	 $.ajax({
      url: "save.php",
      type: "post",
      data: model,
      success: function(data){
		  $('.success_msg').show().fadeIn(2000).fadeOut(4000);
      },
      error:function(){
          alert('error is saving');
      }   
    }); 
}



function getcheck(check){

	var id = check.id;
	var check = check.checked;
	if(check == true) {
	 $("."+id).prop('disabled', true).attr('style','text-decoration:line-through');
	} else {
	 $("."+id).prop('disabled', false).attr('style','text-decoration:none');
	}
	model = {
            id: id,
			check: check
             };
	 $.ajax({
      url: "save.php",
      type: "post",
      data: model,
      success: function(data){
		    $('.success_msg').show().fadeIn(2000).fadeOut(4000);
      },
      error:function(){
          alert('error is saving');
      }   
    }); 
}

</script>
	
	
	
	
	
 <script>
 $('.logout').click(function(){
    return confirm("Are you sure you want to Logout?");
});
$('.delete').click(function(){
    return confirm("Are you sure you want to Delete it?");
});
</script>
<?php include ('jailene/footer.php'); ?> 
