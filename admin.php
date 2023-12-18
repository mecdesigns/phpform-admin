<?php include 'header.php'; ?>
<h2 class="center">Form Submissions</h2>
<div id="main">
<?php
require_once('protect-this.php'); 
$row = 1;
if (($handle = fopen("formdata-submissions.csv", "r")) !== FALSE) {
	
	echo "<table>
		<tr>
			<th style='width:33%'>Name</th>
			<th style='width:33%'>Email</th>
			<th style='width:33%'>Image</th>
		</tr>";

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //$num = count($data);
        // echo "<p> $num fields in line $row: </p>\n";

        $row++;

        // Assuming that the CSV structure is Name,Email,Image
        $name = $data[0];
        $email = $data[1];
        $coverimage = $data[2];
        echo "<tr><td style='width:33%'>" . $name . "</td><td style='width:33%'>" . $email . "</td><td style='width:33%'><a href='image/$coverimage'><img src='image/$coverimage' height='40' width='auto' /></a></td></tr>\n";
    }
	echo "</table>";

    fclose($handle);
}
?>
<br />
<br />
<p class="center"><a href="formdata-submissions.csv" class="csv admin" target="_blank">Download CSV File</a></p>
</div>
<?php include 'footer.php'; ?>