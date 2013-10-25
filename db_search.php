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
      Company <input type="text" name="compamy" id="company"/></br>
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
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }

    // starting to get data

    $name=$_POST['name'];
    $email=$_POST['email'];
    $company=$_POST['company'];

    // Retrieve data
    if(empty($_POST('name')) && empty($_POST('email')) && empty($_POST('company'))) {
   	echo "<h3>Please enter keyword.</h3>";
    }
    else {
	try {
		$sql_query_search = ("SELECT * FROM registration_tbl WHERE name = '$name' || email = '$email' || company_name = '$company'");
		$stmt = $conn->prepare($sql_query_search);
		$search_result = $stmt->execute();

		if(count($search_result) > 0) {
			echo "<h2>Search result.</h2>";
			echo "<table>";
			echo "<tr><th>Name</th>";
			echo "<th>Company name</th>";
			echo "<th>Email</th>";
			echo "<th>Date</th>";
			foreach($search_result as $found) {
				echo "<tr><td>".$found['name']."</td>";
				echo "<td>".$found['Company_Name']."</td>";
				echo "<td>".$found['email']."</td>";
				echo "<td>".$found['date']."</td></tr>";
			}
			echo "</table>";
		}
		else {
			echo "<h3>No result.</h3>";
		}
	}
	catch(Exception $e) {
		die(var_dump($e));
	}
    }
?>
</body>
</html>
