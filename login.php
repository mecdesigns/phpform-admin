<?php
    /* Your password */
    $password = 'admin';

    /* Redirects here after login */
    $redirect_after_login = 'admin.php';

    /* Will not ask password again for */
    $remember_password = strtotime('+30 days'); // 30 days

    if (isset($_POST['password']) && $_POST['password'] == $password) {
        setcookie("password", $password, $remember_password);
        header('Location: ' . $redirect_after_login);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password protected</title>
</head>
<body>
<?php include 'header.php'; ?>
<div id="main">
    <div style="text-align:center;margin-top:50px;">
        You must enter the password to view this content.<br />
		Hint password is admin.<br /><br />
        <form method="POST">
            <input class="blue" type="text" name="password">
			<input type="submit" name="submit" class="submit btn" value="Submit"/>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>