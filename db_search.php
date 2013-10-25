<html>
<head>
<Title>Search Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search here!</h1>
<a href="http://minhlongcomp2013.azurewebsites.net/index.php">Register here</a>
<p>Fill in your name and email address, then click <strong>Submit</strong> to search.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
      Company <input type="text" name="company" id="company"/></br>
      Email <input type="text" name="email" id="email"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
	// DB connection info
	//TODO: Update the values for $host, $user, $pwd, and $db
	//using the values you retrieved earlier from the portal.
	$host = "eu-cdbr-azure-west-b.cloudapp.net";
	$user = "bae74695f9d00f";
	$pwd = "1fe84b0f";
	$db = "minhlonAxoP7zDDA";

	// Connect to database.
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(Exception $e) {
		die(var_dump($e));
	}
	//Query database
	if(!empty($_POST)) {
		try {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$company = $_POST['company'];
			// search database
			$sql_search = "SELECT * from registration_tbl where name = "$name" || email = "$email" || company = "$company" ";
			$stmt = $conn->query($sql_search);
			$search_result = $stmt->fetchAll();
			if(count($search_result) > 0) {
				echo "<h2>Search result</h2>";
				echo "<table>";
				echo "<tr><th>Name</th>";
				echo "<th>Company name</th>";
				echo "<th>Email</th>";
				echo "<th>Data</th></tr>";
			}
}
?>
</body>
</html>
