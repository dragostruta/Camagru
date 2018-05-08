<form method="POST" action="signup/run">
<div>
	<label for="Signusername">Username</label>
	<input type="text" name="Signusername" value="">
</div>
<div>
	<label for="Signpassword">Password</label>
	<input type="password" name="Signpassword">
</div>
<div>
	<label for="email">Email</label>
	<input type="text" name="email">
</div>
<input type="submit" name="Create" value="Signup">
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