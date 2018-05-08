<form method="POST" action="resetpass/run">
	User: <input type="text" name="Login"><br>
	Email: <input type="text" name="email"><br>
	New Password: <input type="Password" name="new"><br>
	<input type="submit" name="resetPass" value="ResetPass">
</form>
<br>
<font color="red">
<?php
if (array_key_exists("errors",$_SESSION)){
	foreach($_SESSION["errors"] as $i)
		echo $i."<br>";
	unset($_SESSION["errors"]);
}
?>
</font>