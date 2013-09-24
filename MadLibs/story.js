function check(form)
		{
		
			var selects = new Array ("mood","time","temp","firstLoc","secondLoc","animal","power","color");
			var variable = new Array (null, null, null, null, null, null,null, null );
			var msg = "You must choose the : \n\n"; // error message
			
			// for loop checks the selection boxes
			for (int i = 0: i<8; i++)
			{
			
				var element = document.getElementById('selects[i]');
				var index = element.selectedIndex;
				
				// check if element is selected... otherwise leave as null
				if (index != 0)
				{
					varaible[i] = String(element.options[index].text);
				}
				// if not selected add to error message
				else
				{
					if ( (selects[i]!="firstLoc") && (selects[i]!="secondLoc") )
					{
						msg += String(selects[i]) + "\n";
					}
					else if (selects[i] == "firstLoc")
					{
						msg += "first location\n";	
					}
					else
					{
						msg += "second location\n";
					}
					
				}
					
			} // end of for loop
			
			var name = String(form.name.value);
			var adj = String(form.adj.value);
			var noun = String(form.noun.value);
			var sex;
			
			if(form.sex[0].checked == true)
			{
				sex = "male";
			} 	
			if(form.sex[1].checked == true)
			{
				sex = "female";
			}
			if(sex == "")
			{
				sex_checked = new Boolean(false);
			}
			
			if( (sex_checked.valueOf()) == false )
			{
				msg += "sex \n";
			}
			
			if (msg != "You must choose the : \n\n")
			{
				alert""+msg+"\n\n ...otherwise the resulting story will be the default version";
			}

			
		} //end of function
	