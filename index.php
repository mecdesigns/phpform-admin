<?php
// define variables and set to empty values
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php include 'create-csv.php'; ?>

<?php include 'header.php'; ?>

<h2 class="center">PHP Form with Image upload to CSV example</h2>

<?php

//Upload Image

if(isset($_POST['submit']))
{

$imgFile = $_FILES['coverimg']['name'];
$tmp_dir = $_FILES['coverimg']['tmp_name'];
$imgSize = $_FILES['coverimg']['size'];

if(!empty($imgFile))
{

$upload_dir = 'image/'; // upload directory

$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
$coverpic = rand(1000,1000000).".".$imgExt;

// allow valid image file formats
if(in_array($imgExt, $valid_extensions))
{
// Check file size '5MB'
if($imgSize < 5000000)
{
move_uploaded_file($tmp_dir,$upload_dir.$coverpic);
echo "<p class='center green'>Submission and Upload have completed successfully.</p>
	  <p class='center green'>A copy of the submission has been sent to your email address</p>";
}
else{
$errMSG = "<p class='red center'>Sorry, your file is too large.</p>";
}
}
else{
$errMSG = "<p class='red center'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
}
}
}

?>
<div id="main">
<form method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data"> 
<table>
  <tr>
	<th>
		<p>User Name:</p>
	</th>
	<th>
		<input type="text" name="name" required="required">
	</th>
  </tr>
  <tr>
	<th>
		<p>E-mail:</p> 
	</th>
	<th>
		<input type="text" name="email" required="required">
	</th>
  </tr>
  <tr>
    <th></th>
	<th>
	    <input type="file" name="coverimg" required="required" />
	</th>
  </tr>
  <tr>
    <th></th>
    <th>
	<!--<p><input type="submit" name="cover_up" class="submit btn btn-warning" value="Upload Image"/></p>--> 
	</th>
  </tr>
    <tr>
    <th></th>
    <th>
	<p><input type="submit" name="submit" class="submit btn btn-warning" value="Submit"/></p> 
	</th>
  </tr>
</table>
</form>


<?php include 'mail_handler.php'; ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>