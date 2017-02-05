require_once "authorization.class.php";
$obj=Authorization::getInstance();
$name=$obj->check($_POST['name']);
$password=$obj->check($_POST['password']);
$email=$obj->check($_POST['email']);
if(empty($name)or empty($email)){
	echo "Please fill all the fields";
}else{
	$name=$obj->escapeString($name);
		$password=$obj->escapeString($password);
			$email=$obj->escapeString($email);
			$email=$obj->checkEmail($email);
$result=$obj->query("INSERT INTO authorization(name,password,email)VALUES('$name','$password','$email')");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Authorization</title>
</head>
<body>
<form name="main" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
Name: <br />
<input name="name"  id="name" type="text"  /> <br />
Email: <br />
<input name="email" id="email" type="text"  /> <br />
Password: <br />
<input name="password" type="password" id="password" maxlength="8"  /> <br />
<input type="submit" name="enter" id="button" value="Enter" />
<button name="show">Show last user</button>
<button name="delete">Delete last user</button>
</form>
</body>
</html>
<?php
if(isset($_POST['show'])){
	$show=$obj->query("SELECT name,email FROM authorization");
	$row=$show->fetch_object();
	echo $row->name;
	echo "<br />";
	echo $row->email;
	echo "<hr>";
}
if(isset($_POST['delete'])){
	$delete=$obj->query("DELETE * FROM authorization WHERE id=MAX(id)");
	echo "DELETED";
}
?>
