<?php include 'header.php'; ?>

<h2 class="center">PHP Form with Image upload to CSV example</h2>

<?php
// Define variables and set to empty values
$name = $email = $coverimage = "";

// Upload Image
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect the form data.
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);

    $imgFile = $_FILES['coverimg']['name'];
    $tmp_dir = $_FILES['coverimg']['tmp_name'];
    $imgSize = $_FILES['coverimg']['size'];

    if (!empty($imgFile)) {
        $upload_dir = 'image/'; // upload directory
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $coverpic = rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '1MB'
            if ($imgSize < 1000000) {
                move_uploaded_file($tmp_dir, $upload_dir . $coverpic);
                echo "<p class='center green'>The Uploaded file has completed successfully and we have received your information.</p>
                <p class='center green'>Thank you for your contribution</p>";
                $coverimage = $coverpic; // Assign the file name to $coverimage
            } else {
                $errMSG = "<p class='red center'>Sorry, your file is too large. 1MB is the limit.</p>";
            }
        } else {
            $errMSG = "<p class='red center'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
        }
    }

    $errors = array();
    // Check if Name is set.
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    // Check if email is set.
    if (empty($email)) {
        $errors[] = 'Email is required';
    }

    // Validate the email address.
    // $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    // if (!preg_match($pattern, $email)) {
    //    $errors[] = 'Please enter a valid email address';
    // }

    // If no errors, carry on.
    if (empty($errors)) {
        // The header row of the CSV.
        $header = "Name,Email,Image\n";
        // The data of the CSV.
        $data = "$name,$email,$coverimage\n";

        /*
         * The file name of the CSV.
         *
         * NB: __DIR__ describes the location in which this file resides.
         * To go up one level use "dirname(__DIR__)".
         *
         * NB: You will not be able to append data to an existing file if you use time components
         * (hour, minutes, seconds) inside the file name. Imagine that you are creating a file
         * right now, at 12:18:43 o'clock. Then the file will be named "formdata-09-01-18-12-38-43.csv".
         * One second later you will not be able to append data to it because the time will be "12:38:44".
         * Then a new file "formdata-09-01-18-12-38-44.csv" will be created.
         *
         * I suggest using only the date without the time in the file name.
         *
         * @todo Read the comment above!
         */
        $fileName = __DIR__ . "/formdata-submissions.csv";

        /*
         * Create the CSV file.
         * If file exists, append the data to it. Otherwise create the file.
         */
        if (file_exists($fileName)) {
            // Add only data. The header is already added in the existing file.
            file_put_contents($fileName, $data, FILE_APPEND);
        } else {
            // Add CSV header and data.
            file_put_contents($fileName, $header . $data);
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<div id="main">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <div>
            <input class="blue" type="text" name="name" required="required" placeholder="Name">
        </div>
        <div>
            <input class="blue" type="text" name="email" required="required" placeholder="Email">
        </div>
        <div>
            <input type="file" name="coverimg" required="required" />
        </div>
        <div>
            <p class="center"><input type="submit" name="submit" class="submit btn btn-warning" value="Submit" /></p>
        </div>
    </form>
</div>

<!--<?php include 'mail_handler.php'; ?>-->
</div>
<?php include 'footer.php'; ?>
</body>
</html>