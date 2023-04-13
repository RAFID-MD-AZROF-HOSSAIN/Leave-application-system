<?php
session_start();
if ($_SESSION["whologin"] != "admin")
{
	header('Location: login.php');
}

if (isset($_POST['submit']))
{
	if((isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_level'])))
	{
		include 'db_conn.php';
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$userlevel = $_POST['user_level'];
		
		try {
			  
			  $sql = "INSERT INTO users(username, password, user_level) VALUES ('".$username."','".$password."','".$userlevel."')";
			  if($conn->exec($sql) == TRUE)
			  {
				  echo "<h3 style='color:green'><b>New User added successfully.</b> <a href='admin_dashboard.php'> Go to Dashboard!</a> </h3>";
			  }
			  else
			  {
				  echo "<h3 style='color:red'><b>User could not be added. Try Again!</b></h3>";
			  }
			}
			catch(PDOException $e)
			{
			  echo "Error: " . $e->getMessage();
			} 
	}		
}

?>


<html>
<head>
<title> Add New User </title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<h1> LEAVE APPLICATION SYSTEM </h1>

<h3> Add New User </h3>

<form name="form_add_user" action="add_admin.php" onsubmit="return validateAddUser()" method="POST" >
  <label> Set Username: </label>
  <input type="text" id="username" name="username"><br><br>
   <label> Set Password: </label>
  <input type="password" id="password" name="password"><br><br>
  <label> Choose User Level: </label>

	<select name="user_level" id="user_level">
	  <option value="#">Select User Level</option>
	  <option value="admin">Admin</option>
	  <option value="manager">Manager</option>
	  <option value="staff">Staff</option>
	</select>
  
  <br> <br>
  <input type="submit" name="submit" value="Add User" /> <br> <br>
  
</form>

<button value='Go to Dashboard' onclick='gotoDashboard()'> Go to Dashboard </button>

<script>

function validateAddUser()
{
  let un = document.forms["form_add_user"]["username"].value;
  let ps = document.forms["form_add_user"]["password"].value;
  let ul = document.forms["form_add_user"]["user_level"].value;
  
  if (un == "" || ps == "" || ul == "#")
  {
	  alert("Select all fields to continue.");
	  return false;
  }
}

function gotoDashboard()
{
	location.href = 'admin_dashboard.php';
}

</script>

</body>

</html>