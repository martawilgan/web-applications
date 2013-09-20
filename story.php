#!/usr/local/bin/php

<html>

	<head>
	<title>Read your own creation :)</title>
	<link href="http://i5.nyu.edu/~mmw319/story.css" type="text/css" rel="stylesheet" />
	</head>
	
	
	<body>
	
		<?php
	
			# taking variables from form
			$mood = $_POST['mood'];
			$time = $_POST['time'];
			$temp = $_POST['temp'];
			$firstLoc = $_POST['firstLoc'];
			$secondLoc = $_POST['secondLoc'];
			$animal = $_POST['animal'];
			$sex = $_POST['sex'];
			$name = ucwords(strtolower($_POST['name'])); #making sure name is in correct format
			$power = $_POST['power'];
			$adj = $_POST['adj'];
			$noun  = $_POST['noun'];
			$color  = $_POST['color'];
			$italicize = $_POST['italicize'];
			$msg="Since you have not chosen the : \n";
			
			$defaults = array("1","sunrise","cold and snowing","hotel","forest","big fat rat","he","Barry","flight","sparkling","bus","1");
			
			if ($mood == "") 		{$mood = $defaults[0]; $msg = $msg."-mood-\n";}
			if ($time == "") 		{$time = $defaults[1]; $msg = $msg."-time-\n";}
			if ($temp == "") 		{$temp = $defaults[2]; $msg = $msg."-weather-\n";}
			if ($firstLoc == "") 	{$firstLoc = $defaults[3]; $msg = $msg."-first location-\n";}
			if ($secondLoc == "") 	{$secondLoc = $defaults[4]; $msg = $msg."-second location-\n";}
			if ($animal == "") 		{$animal = $defaults[5]; $msg = $msg."-type of animal-\n";}
			if ($sex == "") 		{$sex = $defaults[6]; $msg = $msg."-sex of character-\n";}
			if ($name == "") 		{$name = $defaults[7]; $msg = $msg."-name-\n";}
			if ($power == "")		{$power = $defaults[8]; $msg = $msg."-special power-\n";}
			if ($adj == "") 		{$adj = $defaults[9]; $msg = $msg."-adjective-\n";}
			if ($noun == "") 		{$noun = $defaults[10]; $msg = $msg."-noun-\n";}
			if ($color == "") 		{$color = $defaults[11]; $msg = $msg."-color style of next page-\n";}
			
			# sending message to user
			if ($msg != "Since you have not chosen the : \n")
			{ 
				echo "<script language=javascript> alert(\"Note: For every field not chosen, a default value has been selected!\");</script>"; 
			}
			
			# possessive noun depending on sex of main character
			if ($sex == "he")
			{
				$pos = "his"; 
			}
			if ($sex == "she")
			{
				$pos = "her";
			}
						
			$season = array('cold and snowing' => 'winter',
				'dark and raining' => 'fall', 
				'warm and sunny' => 'summer',
				'hot and humid' => 'summer',
				'cool and breezy' => 'spring'
				);
							
			# adjective fillers based on mood of the story				
			switch($mood)
			{
				case 1:
					$filler = array ('spooky','haunted');
					break;
				case 2:
					$filler = array ('splendid','beautiful brand new');
					break;
				case 3:
					$filler = array ('dreary','desolate');
					break;
			}

			
			
			
			$part1 = "<p>It was $temp on a $filler[0] $season[$temp] day. \n".
				"$name the $animal woke up in a $filler[1] ".
				"$firstLoc. \n".ucwords(strtolower($sex)).
				" looked around and saw there was nothing to do.  \n".
				"</p><p>Then a ";
				
			$part2 = "";	
				
			switch($mood)
			{
				case 1:
					$part2 = "skeleton jumped out of the closet and ".
					"frightened $name. \n".ucwords(strtolower($sex)).
					" ran away but got stuck ".
					"in some cobwebs.  \nThen $name heard an unearthly ".
					"scream and saw a terrifying blood thirsty vampire ".
					"jump in through the window.  \nHer teeth came close ".
					"to biting and sucking $name's blood dry, however, ".
					"they also tore the web just enough so $sex could ".
					"escape before untimely death.  \n</p><p>";
					break;
				case 2:
					$part2 = "bunny rabbit named Prince hopped into view and ".
					"invited $name to a party.  \nIt was a tea party with ".
					"teas from all over the world and many delicious cakes. \n".
					"$name had lots of fun with Prince and took down his ".
					"email and promised to write next time $sex ".
					"was bored.  \n</p><p>";
					break;
				case 3:
					$part2 = "serial killer ran into the room and saw $name.  \n".  
					"The killer thought to himself \"yumm! dinner!\" and ".
					"chased $name down the stairs where $sex heard a crack ".
					"like a bone breaking and felt a sharp pain in $pos leg. \n".
					"The serial killer tripped over $name and dropped ".
					"his knife. \n$name grabbed the knife and stabbed the ".
					"killer's foot so that it would be nailed to the floor. \n".
					"Then $name limped away.  \n</p><p>";
					break;
			}
							
			
				
			$part3 = "$name headed off into the $secondLoc to find a way ".
				"back home.  \nIt did not take long before $sex realized $sex ".
				"was lost.  \n$name saw eyes hiding in the darkness ".
				"under a  half open book that was thrown on the ground in ".
				"a shape of an upside-down letter 'V'. \n$name asked for directions ".
				"to the beloved garden meadow $sex called home.  \nA very big ".
				"hairy spider craweled from underneath the $adj book ".
				"and $name could immidiately tell this spider ".
				"was not about to give $pos directions.  \nIt moved closer, ".
				"its fangs dripping wet with venom. \n</p><p>";
					
				if ($power == "flight")
				{
					$part4 = "$name opened $pos wings and " .
					"flew away leaving the spider shocked that this $animal " .
					"could fly.  \nThen $name hit $pos head on ".
					"a tree branch and landed in a pond. \n";
				}					
				if ($power == "super strength")
				{
					$part4 = "$name put all $pos energy into $pos ".
					"fist and punched the spider in its face sending it back " .
					"underneath the book and then closed it squishing the ".
					"spider inside.  \nThen $name ran away and stopped ".
					"at a pond once $sex was a fair amount of distance ".
					"away and saw that the spider was not following. \n";
				}
				if ($power == "invisibility")
				{
					$part4 = "$name concentrated until $sex was ".
					"completely invisible and tried hard not to laugh ".
					"at the spider's confused face.  \nThen $name tip-toed ".
					"quietly away until $sex reached a pond.  \n";
				}
				
				$part4 = $part4."$name immediately recognized the pond ".
				"because $sex could see the one of a kind painting of a ".
				"$noun at the bottom of the shallow end.  \n</p><p>";
				
				$part5 = "Finally!  $name was almost home!  \n";
				
				switch($mood)
				{
					case 1:
						$part5 = $part5."... but $sex did not realize that ".
						"the vampire had been following the $animal.  \n".
						"She had quite liked $name and ".
						"decided to keep $name around.  \nSo when $name ".
						"was gazing at the pond she bit into $pos ".
						"neck and whispered \"Now you are mine forever!... ".
						"Mwah haha! \"\n</p>";
						
						print"<embed src=\"http://i5.nyu.edu/~mmw319/scary01.wav\" hidden=\"true\" autostart=\"true\">";
						print"<embed src=\"http://i5.nyu.edu/~mmw319/scary02.wav\" hidden=\"true\" autostart=\"true\">";
						break;
					case 2:
						$part5 = $part5."So $sex skipped down the beautiful ".
						"stone path to $pos house in the gorgeous old oak ".
						"tree.  \n ".ucwords(strtolower($sex)).
						" opened the door and took a box of ". 
						"chocolates into $pos room and got snug into bed ".
						"ready to watch $pos favorite soap ".
						"opera before going to sleep.  \n </p>";
						
						print"<embed src=\"http://i5.nyu.edu/~mmw319/happy01.wav\" hidden=\"true\" autostart=\"true\">";
						print"<embed src=\"http://i5.nyu.edu/~mmw319/happy02.wav\" hidden=\"true\" autostart=\"true\">";
						break;
					case 3:
						$part5 = $part5.".... but the $name didn't realize that ".
						"the serial killer had slowly followed the $animal ".
						"all the way. \nSo as $name was gazing into the pond ".
						"the killer stabbed the poor animal in the back ".
						"and dragged $pos limp body ".
						"to a spot where he could prepare a proper stew for ".
						"dinner.  \n</p>";
						
						print"<embed src=\"http://i5.nyu.edu/~mmw319/tragic01.wav\" hidden=\"true\" autostart=\"true\">";
						print"<embed src=\"http://i5.nyu.edu/~mmw319/tragic02.wav\" hidden=\"true\" autostart=\"true\">";
						break;
					
				}	
				
				print"<div id =\"container\"><div id =\"secondHeader\">";
				print"<u>Read</u> <i>your </i>c r e a t i o n!";
				
				switch($color)
				{
					case 1:
						print "</div><div id =\"green\">";	
						break;
					case 2:
						print "</div><div id =\"blue\">";
						break;
					case 3:
						print "</div><div id =\"pink\">";	
						break;
				}
			
				if (isset($_POST['italicize']))
				{
					print"<i>";	
				}
				
				if ($msg != "Since you have not chosen the : \n")
				{
					$msg = "<hr>".$msg."</br>default values have been provided to create the story...".
						   "\nIf you wish to change this go back to the previous page!<hr>";
					print"<h4>".$msg."</h4>";
				}
				
				print"".$part1.$part2.$part3.$part4.$part5;
				
				if (isset($_POST['italicize']))
				{
					print"</i>";	
				}
				
				print"</div></div>";

			
		?>
	
	</body>
	
</html>