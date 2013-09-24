#!/usr/local/bin/php

<html>
<head>
	<title>DJ Database Select</title>
	<link href="http://i5.nyu.edu/~mmw319/asg9_Marta_Wilgan_CSS.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("asg9_Marta_Wilgan_MENU.txt"); ?>

<form action="http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE3.php" method ="post">
	<h4>What do you wish to search for?</h4>

	<select name = "search">
	<option value="" selected="selected"></option>
	<option value="dj">DJ</option>
	<option value="cd">CD</option>
	<option value="perf">Performance</option>
	</select>
	<input type = "submit" value="start search">
</form>

<?php


	/* Variables */
	$search = $_POST['search'];
	
	/* 
	 * Dynamically generating radio buttons 
	 * with criteria based on the search selected by user
	 * if search is not empty 
	 */
	if(!(empty($search)))	
	{
		/* Creating form and radio buttons */
		echo"<form action=\"http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE4.php\" method =\"post\">";
		if ($search=="dj")
		{
			echo"\t\t<p><h4>Search for a dj by:</h4>\n";
			echo"\t\t<input type=\"radio\" name =\"dj\" value=\"dj_genre\">genre of music</br>\n";
			echo"\t\t<input type=\"radio\" name =\"dj\" value=\"dj_plat_cds\">number of platinum cds</br>\n";
		}
		else if ($search=="cd")
		{
			echo"\t\t<p><h4>Search for a cd by:</h4>\n";
			echo"\t\t<input type=\"radio\" name =\"cd\" value=\"dj_country\">dj's nationality</br>\n";
			echo"\t\t<input type=\"radio\" name =\"cd\" value=\"cd_genre\">genre of music</br>\n";
		}
		else if ($search=="perf")
		{
			echo"\t\t<p><h4>Search for a performance by:</h4>\n";
			echo"\t\t<input type=\"radio\" name =\"perf\" value=\"perf_dj\">dj's name</br>\n";
			echo"\t\t<input type=\"radio\" name =\"perf\" value=\"perf_city\">city</br>\n";
		}
	
		echo"<input type=\"hidden\" name=\"table\" value=\"$search\"/>\n"; /* hidden from user */
		echo"\t\t<input type=\"submit\" value=\"continue search\"></p>\n";
		echo"</form>";
	}
	else	/* User has not selected which type of search should be performed */
	{
		echo"Please select a search option to continue";
	}
	

?> 
</div>
</div>
<body>
</html>