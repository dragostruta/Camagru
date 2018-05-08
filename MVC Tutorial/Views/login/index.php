<h1>Login</h1>
<form method="POST" action="login/run">
Login: <input type="text" name="Login" placeholder="Login">
Password: <input type="password" name="Pass" placeholder="Password">
<input type="submit" name="Button">
</form>
<form action="resetpass">
	<input type="submit" name="resetPass" value="Did you forgot the password?">
</form>
<?php
if(!empty(Session::get("errors")))
{
	echo Session::get("errors");
}
//var_dump($_SESSION);
/*
var_dump($_SESSION);
if (array_key_exists("errors",$_SESSION)){
	foreach($_SESSION["errors"] as $i){
		echo $i."<br>";
	}
	unset($_SESSION["errors"]);

}
*/
?>