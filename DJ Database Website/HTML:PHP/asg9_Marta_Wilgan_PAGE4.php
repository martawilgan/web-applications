#!/usr/local/bin/php

<html>
<head>
	<title>DJ Database Select</title>
	<link href="http://i5.nyu.edu/~mmw319/asg9_Marta_Wilgan_CSS.css" rel="stylesheet" type="text/css" />
<head>
<body>
<?php include("asg9_Marta_Wilgan_MENU.txt"); ?>

<?php

/* ===========================PHP VARIABLES=========================== */

	$dj = $_POST['dj'];			/* value from dj radio box */
	$cd = $_POST['cd'];			/* value from cd radio box */
	$perf = $_POST['perf'];		/* value from perf radio box */
	$msg;						/* printed message to user */
	$query;						/* MySQL query */
	$result;					/* MySQL result from query */
	$most_plat = 5;				/* number of highest plat cds from one dj */
	
/* ======================CONNECTING TO DATABASE======================== */

	$link = mysql_connect("", 'mmw319', 'mmw319') or die("Could not connect : " . mysql_error());
	mysql_select_db("mmw319") or die("Could not select database");	
	
/* ====================PHP USER DEFINED FUNCTIONS====================== */

/*
 * select_dj - creates drop down box with all dj names in dj table
 */
function select_dj($name)
{
	$query="SELECT dj_name FROM dj ORDER BY dj_name";
	select_any($name, $query);	
}

/*
 * select_genre - creates drop down box with all genres in genre table
 */
function select_genre($name)
{
	$query="SELECT genre_type FROM genre ORDER BY genre_type";
	select_any($name, $query);
}

/*
 * select_plat_num - creates drop down box from 0 to $most_plat
 */
function select_plat_num($name, $most_plat)
{
	echo"<select name = $name>";
	for($i=0;$i<=$most_plat;$i++)
	{
		echo"<option value=\"$i\">$i</option>";
	}
	echo"</select>";
}

/*
 * select_country - creates drop down box with all countries in country table
 */
function select_country($name)
{
	$query="SELECT country_name FROM country ORDER BY country_name";
	select_any($name, $query);
}

/*
 * select_city - creates drop down box with all cities in city table
 */
function select_city($name)
{
	$query="SELECT city_name FROM city ORDER BY city_name";
	select_any($name, $query);
}

/*
 * select_any - creates a drop down box based on the query
 */
function select_any($name, $query)
{
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	
	/* Creating select drop down based on query */
	echo"<select name = $name>";
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{		
			foreach($line as $col_value)
			{
				echo"<option value=\"$col_value\">$col_value</option>";
			}
		}
	echo"</select>";	
}

/*
 * select_sort - creates a drop down box to sort the search results on next page
 */
function select_sort($dj,$cd,$perf)
{

	echo"<select name = sort>"; 
	
	if(!(empty($dj))) /* If user wants to search for djs */
	{
		echo"<option value=\"dj_name\">dj's name</option>";
		echo"<option value=\"dj_plat_cds DESC\">most platinum cds</option>";
		echo"<option value=\"dj_birth\">age (oldest to youngest)</option>";
		echo"<option value=\"dj_birth DESC\">age (youngest to oldest)</option>"; 
	}
	if(!(empty($cd))) /* If user wants to search for cds */
	{
		echo"<option value=\"cd_name\">title of cd</option>";
		echo"<option value=\"cd_dj\">cd dj</option>";
		echo"<option value=\"cd_release\">release date (old to new)</option>";
		echo"<option value=\"cd_release DESC\">release date (new to old)</option>"; 
	}
	if(!(empty($perf))) /* If user wants to search for performances */
	{
		echo"<option value=\"perf_date\">date</option>";
		echo"<option value=\"perf_venue\">venue</option>";
		echo"<option value=\"perf_low_price\">price (cheapest to most expensive)</option>";
	}	
	echo"</select>";
}
/* =======================PHP TO HTML OUTPUT======================= */	
	
	/* Creating form with select boxes */
	echo"<form action=\"http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE5.php\" method =\"post\">";
	
	if(!(empty($dj)))	/* If user wants to search for djs */
	{
		$msg="You have chosen to search for dj information by ";
		switch($dj)
		{
			case "dj_genre":
				$msg.="genre.</br><h4>Please choose a genre to continue.</h4>\n";
				echo"$msg";
				echo"genre:";
				select_genre($dj);
				break;	
			case "dj_plat_cds":
				$msg.="number of platinum cds achieved by the dj so far.
					</br><h4>Please choose a number to continue.</h4>\n";
				echo"$msg";
				echo"number of platinum cds:";
				select_plat_num($dj, $most_plat);
				break;	
		}	
		
	}
	if(!(empty($cd)))	/* If user wants to search for cds */
	{
		$msg="You have chosen to search for cd information by ";
		switch($cd)
		{
			case "dj_country":
				$msg.="the dj's nationality.</br><h4>Please choose a country to continue.</h4\n";
				echo"$msg";
				echo"country:";
				select_country($cd);
				break;
			case "cd_genre":
				$msg.="genre.</br><h4>Please select a genre to continue.</h4>\n";
				echo"$msg";
				echo"genre:";
				select_genre($cd);		
				break;	
		}
	}
	if(!(empty($perf)))	/* If user wants to search for performances */
	{
		$msg="You have chosen to search for performance information by ";
		switch($perf)
		{
			case "perf_dj":
				$msg.="dj.</br><h4>Please select a dj to continue</h4>\n";
				echo"$msg";
				echo"dj:";
				select_dj($perf);
				break;
			case "perf_city":
				$msg.="location.</br><h4>Please select a city and genre to continue</h4>\n";
				echo"$msg";
				echo"city:";
				select_city($perf);
				echo"genre:";
				select_genre("perf_genre");
				break;	
		}
	}

	echo"sort by:";
	select_sort($dj,$cd,$perf);
	echo"\t\t<input type=\"submit\" value=\"get results\"></p>\n";
	echo"</form>";

/* ==================================================================== */
?>
</div>
</div>
</body>
</html>