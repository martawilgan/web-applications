#!/usr/local/bin/php

<html>
<head>
	<title>DJ Database Insert</title>
	<link href="http://i5.nyu.edu/~mmw319/asg9_Marta_Wilgan_CSS.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("asg9_Marta_Wilgan_MENU.txt"); ?>

<?php

	/* Variables */
	$table=$_POST['table'];							/* table in which the record will be inserted */
	$insert_query="INSERT INTO $table VALUES(";		/* will hold update query to insert record */
	
	if(($table="cd") || ($table="perf"))
	{
		$insert_query.="\"\",";		/* Auto-increment */
	}
	
	/* Checking and getting input from dynamically created input boxes */
	if(isset($_POST['field']) && is_array($_POST['field']) && (count($_POST['field'])>0))
	{
		$field_num = 0;						/* index of field in input array field[] */
		$count = count($_POST['field']);	/* number of fields in field[] */
		
		foreach($_POST['field'] as $field)
		{			
			/* Adding to $insert_query string */
			if(!(empty($field)))	/* check if the field is not empty */
			{
				$insert_query.="\"$field\"";			
				if($field_num < ($count-1))
				{
					$insert_query.=",";
				}
				else
				{
					$insert_query.=")";
				}	
				$field_num++; /* incrementing index */
			}
		} /* end of foreach loop*/
	}
	else
	{
		/* Giving user helpful instructions if their input is incorrect */
		echo"Please make sure every field has a correclty formatted value";
	}
		
	/* Spitting out resulting query and giving user options on how to proceed */
	echo"<h3>Generated MySQL query based on your input:</h3>\n";
	
	echo"\t<form action=\"http://i5.nyu.edu/cgi-bin/cgiwrap/~mmw319/asg9_Marta_Wilgan_PAGE1.php\" method =\"post\">\n";
	echo"\t\t<textarea name=\"insert_query\" cols=\"90\" rows=\"5\">$insert_query</textarea>;</br>\n";
	echo"</br>\t\tIf this is correct click submit to insert data and go back to previous page</br>\n";
	echo"\t\tOtherwise click redo to go back to previous page and make changes</br></br>\n";
	echo"\t<input type = \"submit\" name =\"submit\" value=\"submit\">\n";
	echo"\t<input type = \"submit\" name =\"cancel\" value=\"redo\">\n";
	echo"\t</form>\n";	


?>

</div>
</div>
</body>
</html>