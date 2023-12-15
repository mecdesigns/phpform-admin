<?php include 'header.php';
require_once('protect-this.php'); 
$row = 1;
if (($handle = fopen("formdata-submissions.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: </p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo "<p class='center'>" . $data[$c] . "</p>\n";
			
        }
    }
    fclose($handle);
}
?>
<br />
<br />
<a href="formdata-submissions.csv" class="admin" target="_blank">Download CSV File</a>
<br />
<br />
<a href="image/" target="_blank">View Uploaded Images</a>
<?php include 'footer.php'; ?>