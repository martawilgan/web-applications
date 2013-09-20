#!/usr/local/bin/php

<html>
	<head>
	<title></title>
	<link href="http://i5.nyu.edu/~mmw319/picture.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
	
	<?php
	
	
		$dark = array("http://i5.nyu.edu/~mmw319/black.gif",
					  "http://i5.nyu.edu/~mmw319/dblue.gif");
		
		$light = array("http://i5.nyu.edu/~mmw319/orange.gif",
					   "http://i5.nyu.edu/~mmw319/pink.gif",
		    		   "http://i5.nyu.edu/~mmw319/blue.gif",
					   "http://i5.nyu.edu/~mmw319/green.gif",
					   "http://i5.nyu.edu/~mmw319/grapefruit.gif",
					   "http://i5.nyu.edu/~mmw319/yellow.gif");
		
		$pic = array (); # empty array... arrays will be added 
		
		print"<div id=\"container\">";
		print"<h1>City Lights</h1>\n";
		print"<h4>by:Marta M.Wilgan\n</br></br>";
		print"This picture is an ineractive changing piece.  \n";
		print"It gives an impression of city buildings at night with window lights.  \n".
		     "Every time the user refreshes the page the locations \n".
			 "and the colors of the light change, \n".
			 "mimicking the ever changing life of the city.</h4>";
		print"</div></br></br>";	 
		
		$pic = createPicture($pic,$light,$dark); #call to the function to create the array
		printPicture($pic); #call to print the array creating the picture on the page
		
		print"</br></br></br>";
		
	
		
		
		function createPicture($pic,$light,$dark)
		{
		
			$r=0; # counter will tell the index of array within $pic array (or the row)
			$c=0; # counter will tell the index witin each array (or the column)
		
			#create 21 rows of empty arrays within $pic array
			for ($x = 0; $x<=20; $x++)
			{
				$pic[$x]= array();
			}
			
			# this will make the first row an entire row of black pixles
			for($j = 0; $j<30; $j++)
			{
				$pic[$r][$j]="<img src=\"$dark[0]\">";
			}
			
			$r++;	 #row must be incremented to go to the next array
								
			for($i = 0; $i<10; $i++)
			{
				
				# this loop will choose 6 pixles each time to make a total of 30
				for($j = 0;$j<5; $j++)
				{
				
					# choose a random number from 1 to 3 
					# this will determine the amount of dark spaces before the light
					$d = rand(1,3);
					# choose a random number from 0 5
					# this will determine the index of the light color
					$l = rand(0,5);
					
					# this loop will determine the random $d number of black pixles
					for($k = 1; $k<=$d; $k++)
					{
						$pic[$r][$c]="<img src=\"$dark[0]\">";
						$c++; #column must be incremented once it is filled with a pixel
					}				
					
					# then pick a random pixle of light and one of dark
					$pic[$r][$c]="<img src=\"$light[$l]\">";
					$c++;
	
					
					# this loop will add dark pixles if 6 pixles have not been chosen
					for($k = 5-$d; $k>0; $k--)
					{
						$pic[$r][$c]="<img src=\"$dark[0]\">";
						$c++;	
					}
						
				}
				
				$r++; # next array
				$c=0; #set column back to 0 since moving to next row array
				
				# this loop will make every other row an entire row of black pixles
				for($j = 0; $j<30; $j++)
				{
					$pic[$r][$j]="<img src=\"$dark[0]\">";
				}
				
				$r++; # next row
			}
			
			return $pic;
		} // end of function createPicture
		
		function printPicture($pic)
		{
		
			print"<center>";
			#printing multi-dimensional array
			for($i=0;$i<=20;$i++)
			{
				for($j = 0; $j<30; $j++)
				{
					print"".$pic[$i][$j];
				}
				print"\n</br>"; #print space and adding space to html
			} #end of for loop
			print"</center>";
		} #end of printPicture
		
	?>
	</body>

</html>