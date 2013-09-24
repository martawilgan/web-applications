#!/usr/local/bin/php

<html>
<head>
	<title>DJ Database Results</title>
	<link href="http://i5.nyu.edu/~mmw319/asg9_Marta_Wilgan_CSS.css" rel="stylesheet" type="text/css" />
<head>
<body>

<?php include("asg9_Marta_Wilgan_MENU.txt"); ?>
<?php

/* ===========================PHP VARIABLES=========================== */

	$criteria;					/* criteria user has chosen to search for */
	$secondary_criteria;		/* other criteria user has chosen */
	$select_name;				/* name of select drop down criteria came from */
	$secondrary_select_name;	/* name of select for secondary criteria */
	$sortkey;					/* what to order the results by */
	$table;						/* table to search within */
	$query;						/* MySQL query */
	$results;					/* MySQL result from query */
		
/* ====================PHP USER DEFINED FUNCTIONS====================== */

/*
 * change_field_name - change the field names to make them more readable
 */
	function change_field_name($result)
	{
		/* Printing field names */	
			$num_of_fields = mysql_num_fields($result);
			echo"\t<tr>\n";
			for ($i = 0; $i< $num_of_fields; $i++)
			{
				$field = mysql_field_name($result, $i);
				$print; /* user friendly version of field name */
				
				switch($field)
				{
					case "dj_name":
						$print="Name";
						break;
					case "dj_country":
						$print="Country of birth";
						break;
					case "dj_birth":
						$print="Date of birth";
						break;
					case "dj_genre": 
					case "cd_genre": 
					case "perf_genre":
						$print="Genre of music";
						break;	
					case "dj_website":
						$print="Website link";
						break;
					case "dj_ccd":
						$print="Recently released cd";
						break;
					case "dj_plat_cds":
						$print="Number of platinum cds sold";
						break;
					case "cd_id": 
					case "perf_id":
						$print="Id number";
						break;	
					case "cd_pic":
						$print="Cover";
						break;
					case "cd_name":
						$print="Title";
						break;
					case "cd_dj": 
					case "perf_dj":
						$print="Dj";
						break;
					case "cd_release":
						$print="Release date";
						break;
					case "cd_plat":
						$print="Platinum?";
						break;		
					case "cd_price":
						$print="Price";
						break;
					case "cd_num_tracks":
						$print="Number of tracks";
						break;
					case "perf_date":
						$print="Date of performance";
						break;	
					case "perf_venue":
						$print="Venue";
						break;
					case "perf_city":
						$print="City";
						break;
					case "perf_sp":
						$print="State or Province";
						break;
					case "perf_country":
						$print="Country";
						break;
					case "perf_available":
						$print="Tickets avaialbe?";
						break;
					case "perf_low_price":
						$print="Lowest price";
						break;
					case "perf_high_price":
						$print="Highest price";
						break;
					default:
						break;
				} /* end of switch*/			
				echo"\t\t<th>$print</th>\n";			
			}	/* end of for */
			echo"\t</tr>\n";			
	} /* end of change_field_name */

/*
 * print_result - prints the result in a table with images and hyperlinks
 */

	function print_result($result)
	{
	
	/* Printing records in $result */
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{	
			echo"\t<tr>\n";
			foreach($line as $col_value)
			{
				/* Picture */
				if ((substr($col_value, -3) == "jpg") || (substr($col_value, -3) == "gif"))
        			echo "\t\t<td><img src=\"http://i5.nyu.edu/~mmw319/$col_value\" width=100px></td>\n";
				/* Hyperlink */
				else if (substr($col_value, -3) == "com") 
					 echo "\t\t<td><a href=\"http://www.$col_value\">$col_value</a></td>\n";
				/* Prices */
				else if ( substr($col_value, -3, 1) == ".")
					echo"\t\t<td>\$$col_value</td>\n";
				/* Text */
				else
					echo"\t\t<td>$col_value</td>\n";
			}
			echo"\t</tr>\n";
		}
	} /* end of print_result */

/* ======================CONNECTING TO DATABASE======================== */

	$link = mysql_connect("", 'mmw319', 'mmw319') or die("Could not connect : " . mysql_error());
	mysql_select_db("mmw319") or die("Could not select database");	

/* ========================GRABBING USER INFO========================== */	

	/* Grabbing user input from previous page */
	if(!empty($_POST['dj_genre']))
	{
		$criteria = $_POST['dj_genre'];
		$select_name = "dj_genre";
		$table = "dj";
	}
	if(!empty($_POST['dj_plat_cds']))
	{
		$criteria = $_POST['dj_plat_cds'];
		$select_name = "dj_plat_cds";
		$table = "dj";
	}
	if(!empty($_POST['dj_country']))
	{
		$criteria = $_POST['dj_country'];
		$select_name = "dj_country";
		$table = "cd";
	}
	if(!empty($_POST['cd_genre']))
	{
		$criteria = $_POST['cd_genre'];
		$select_name = "cd_genre";
		$table = "cd";
	}
	if(!empty($_POST['perf_dj']))
	{
		$criteria = $_POST['perf_dj'];
		$select_name = "perf_dj";
		$table = "perf";
	}
	if(!empty($_POST['perf_city']))
	{
		$criteria = $_POST['perf_city'];
		$select_name = "perf_city";
		$table = "perf";
	}
	if(!empty($_POST['perf_genre']))
	{
		$secondary_criteria = $_POST['perf_genre'];
		$secondary_select_name = "perf_genre";
	}
		
	/* Creating the query */
	if(!empty($criteria))
	{
		$sortkey = $_POST['sort']; /* what user wishes to order results by */
		
		/* Simple query with one criteria and order by */
		if((empty($secondary_criteria)) && ($select_name!="dj_country"))
		{
			$query = "SELECT * FROM $table WHERE $select_name = '$criteria' ORDER BY $sortkey";	
		}
		else if (!empty($secondary_criteria))
		{
			$query = "SELECT * FROM $table WHERE $select_name = '$criteria'
				AND $secondary_select_name = '$secondary_criteria' ORDER BY $sortkey";
		}
		else if($select_name="dj_country")
		{
			$query = "SELECT cd_name, dj_name, dj_country, cd_genre, cd_price, cd_num_tracks, cd_release, cd_plat
				FROM $table, dj 
				WHERE cd_dj = dj_name
				AND $select_name = '$criteria' ORDER BY $sortkey";
		}
	}
	
/* ======================PHP TO HTML OUTPUT========================== */	
	
	/* Getting results from MySQL */
	$result =  mysql_query($query) or die("Query failed : " . mysql_error());
	$records = mysql_num_rows($result);
	
	/* Printing result */
	if ($records!=0)
	{	
		echo"$records records were found.</br><br>";
		echo"<table id =\"results\">\n";
		change_field_name($result); /* changes field names and prints them in first row */
		print_result($result);	
		echo"</table>\n";
	} 
	else /* Query ran with no results */
	{
		echo"\tSorry. There are no records avaiable that match your query.";
	} /* End if */
	
	/* Freeing MySQL results and closing connection */
	mysql_free_result($result);
	mysql_close($link);
	
	
/* ==================================================================== */
?>
</div>
</div>
</body>
</html>