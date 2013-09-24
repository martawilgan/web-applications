#!/usr/local/bin/php


<html>
<head>
	<title>DJ Database Insert</title>
	<link href="http://i5.nyu.edu/~mmw319/asg9_Marta_Wilgan_CSS.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("asg9_Marta_Wilgan_MENU.txt"); ?>
<form action="http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE1.php" method ="post">
	<p><h4>Choose a table to view its current records and insert a new record:</h4>
	
	<select name = table>
	<option value="dj">DJ</option>
	<option value="cd">CD</option>
	<option value="perf">Performance</option>
	</select>
	<input type = "submit" value="choose table">
	</form>
		
<?php

/* ===========================PHP VARIABLES=========================== */

	/* Connecting and selecting database */	
	$link = mysql_connect("", 'mmw319', 'mmw319') or die("Could not connect : " . mysql_error());
	mysql_select_db("mmw319") or die("Could not select database");
	
	/* Variables */
	$table= $_POST['table']; 			/* grabbing table selected by user from form */
	$select_query; 						/* select query based on chosen table */
	$select_result; 					/* result based on select query */	
	$insert_query;						/* update query for the insert */
	$insert_result;						/* result based on insert query */

/* ====================PHP USER DEFINED FUNCTIONS====================== */

/* 
 * print_table - Prints the results of a query in a table
 * results are printed unmodified and appear as text like they would in mysql
 */	
	function print_table($result)
	{
		
		echo"<table id =\"results\">\n";
		
		/* Printing field names */	
		$num_of_fields = mysql_num_fields($result);
		echo"\t<tr>\n";
		for ($i = 0; $i< $num_of_fields; $i++)
		{
			$field = mysql_field_name($result, $i);
			echo"\t\t<th>$field</th>\n";
		}
		
		echo"\t</tr>\n";
		
		/* Printing records in $result */
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{		
			echo"\t<tr>\n";
			foreach($line as $col_value)
			{
				echo"\t\t<td>$col_value</td>\n";
			}
			echo"\t</tr>\n";
		}
		echo"</table>\n";
	} /* End of function print_query */
	
/*
 * print_input_boxes - Prints the input boxes
 * depending on which table the user chooses
 */
	
	function print_input_boxes($result)
	{
		$num_of_fields = mysql_num_fields($result);
	
		/* Printing the appropriate input boxes */
		for ($i = 0; $i< $num_of_fields; $i++)
		{
			$field = mysql_field_name($result, $i);
			
			if (($field != "cd_id") && ($field != "perf_id")) /* Auto-incrememnt */
			{
				echo"\t\t$field: <input type=\"text\" name=\"field[]\" value=\"\"/></br>\n";
			}
			
		}
		echo"\t</br><input type = \"submit\" value=\"add record\">\n";
		echo"\t</form>\n";	
	} /* end of function print_input_boxes */
	

/* ========================PHP TO HTML OUTPUT========================== */	
	
	/* Check to see if user is already submitting a record from PAGE2 */	
	if(empty($insert_query) && !(isset($_POST['cancel'])))
	{
		$insert_query=$_POST['insert_query'];	
		$insert_query=stripslashes($insert_query);
		
	}
	/* Inserting the record ONCE! if no update query exsists continue */
	if(!empty($insert_query))
	{
		/* Inserting record */
		mysql_query($insert_query) or die("Query failed : " . mysql_error());
		$insert_query=null;			/* clearing the query so it is not reinserted */
	}
	
	/* Populating query based on user input */ 	 
	switch($table) 
	{
		case "dj":
			$select_query="SELECT * FROM dj ORDER BY dj_name";
			echo"<h3>Records avaiable from DJ table</h3>\n";
			break;
		case "cd":
			$select_query="SELECT * FROM cd ORDER BY cd_name";
			echo"<h3>Records avaiable from CD table</h3>\n";
			break;
		case "perf":
			$select_query="SELECT * FROM perf ORDER BY perf_date";
			echo"<h3>Records avaiable from Performance table</h3>\n";
			break;
		default:
			break;
	}
	
	/* Grabbing results from MySQL based on query */
	$select_result=mysql_query($select_query) or die ("Please select a table to continue");
	
	/* Printing results in an html table and the appropriate input boxes based on the table */
	print_table($select_result);
	echo"\t<form action=\"http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE2.php\" method =\"post\">\n";
	echo"</br></br>You chose to insert a new record into the table <b>$table</b>.";	
	echo"<input type=\"hidden\" name=\"table\" value=\"$table\"/>\n"; /* hidden from user */
	echo"<i>Note: if you wish to insert into a different table choose a different 
		table at the top of the page.</i></br>\n";
	echo"Please enter each field in the appropriate format as seen in table above 
		and then click add record to insert into the table.</br></br>\n";
	print_input_boxes($select_result);
	
	
	/* Freeing MySQL results and closing connection */
	mysql_free_result($select_result);
	mysql_close($link);
	
/* ==================================================================== */

?>
</div>
</div>
</body>
</html>