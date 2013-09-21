var theTax = 1.086;
var totalPrice = 0;
var itemsInCart = "</br>";
var priceWTax = 0;
var cupPrice = 0;

var nameCookie="";
var itemsInCartCookie="";
var totalPriceCookie="";
var priceWTaxCookie="";

// expiration for cookies
var expireDate;
var expiration;

var loginName="";
var userName;


function checkUser()
{
	
	var thisCookie = document.cookie.split("; ");
	
	for (var i=0; i<thisCookie.length; i++) 
	{
		if ( thisCookie[i].split("=")[0] == "firstNameCookie")
		{
			loginName = String( thisCookie[i].split("=")[1] );
		}
	}
	
	
	if (loginName=="")
	{
		document.getElementById('yourName').innerHTML="First time? click go! to submit info";
	}
	else
	{
		document.getElementById('yourName').innerHTML="Is your name <b>"+loginName + "</b>?\n"
			+ "If not click go! to submit info";	
	}
}


function addCupcake() 
{
	var cupStyle;
	var cupFlavor;
	var stylePrice;
	var flavorPrice;
	var errorMessage = 'Oops!\n';
	
	var selectStyle = document.getElementById('yourStyle');
	var selectFlavor = document.getElementById('yourFlavor');
	var styleIndex = selectStyle.selectedIndex;
	var flavorIndex = selectFlavor.selectedIndex;
	
	cupStyle = selectStyle.options[styleIndex].text;
	stylePrice = selectStyle.options[styleIndex].value;
	
	cupFlavor = selectFlavor.options[flavorIndex].text;
	flavorPrice = selectFlavor.options[flavorIndex].value;
	
	if(stylePrice=='') {errorMessage += '\nYou forgot to enter a style!';}	
	if(flavorPrice=='') {errorMessage += '\nYou forgot to enter a flavor!';}
	
	if(errorMessage!='Oops!\n') {alert(""+errorMessage);}
	else {
		errorMessage = 'Oops!\n';	
		cupPrice = Number(stylePrice) + Number(flavorPrice);
	
		itemsInCart += cupStyle + " at $" + stylePrice + " " + cupFlavor + "</br>";
	
	
		document.getElementById('yourCart').innerHTML=itemsInCart;
	
		calculateTotal();
	}
}

function calculateTotal()
{

	totalPrice = Number(totalPrice) + Number(cupPrice); // calculating price befor tax
	totalPrice = Math.round(totalPrice*100)/100; // rounding to two digits after decimal place
	priceWTax = Number(totalPrice)*theTax; // calculating price after tax
	priceWTax = Math.round(priceWTax*100)/100; // rounding to two digits after decimal place
	
	document.getElementById('yourTotal').innerHTML="total before tax: $" + totalPrice;
	document.getElementById('yourTotalWTax').innerHTML="total after tax: $" + priceWTax;
	
	setItemCookies();
}

	// variables cannot be local so they can be passed into printable receipt
	var form_firstName;
	var form_lastName;
	var form_MI;
	var form_street;
	var form_apt;
	var form_city;
	var form_zip;
	
	var selectState;
	var stateIndex;
	var form_state;
	
	var form_phone;
	var form_cell;
	var form_email;
	var form_cc="";
	var ccChecked;

function storeInfo(form)
{

	form_firstName = String(form.firstName.value);
	form_lastName = String(form.lastName.value);
	form_MI = String(form.middleInitial.value);
	form_street = String(form.street.value);
	form_apt = String(form.aptNum.value);
	form_city = String(form.city.value);
	form_zip = String(form.zipCode.value);
	
	selectState = document.getElementById('state');
	stateIndex = selectState.selectedIndex;
	
	// if state is not selected
	// otherwise leave as null
	if(stateIndex!=0) {
		form_state = String(selectState.options[stateIndex].text);
	}
		
	form_phone = String(form.phoneNum.value);
	form_cell = String(form.cellNum.value);
	form_email = String(form.email.value);
	
	if(form.creditCard[0].checked == true)
	{
		form_cc = "American Express";
	} 	
	if(form.creditCard[1].checked == true)
	{
		form_cc = "MasterCard";
	} 	
	if(form.creditCard[2].checked == true)
	{
		form_cc = "Visa";
	}
	if(form_cc=="")
	{
		ccChecked = new Boolean(false);
	}
	else
	{
		ccChecked = new Boolean(true);
	}
		
	handleErrors();
			
}

function printReceipt() 
{
		var printable = window.open('printReceipt.html'); // opening new window
		
		var thisCookie = document.cookie.split("; ");
		
		for (var i=0; i<thisCookie.length; i++) 
		{
			
			if ( (thisCookie[i].split("=")[0]) == "itemsInCartCookie")
			{
				itemsInCart = thisCookie[i].split("=")[1];
			}
			
			if ( (thisCookie[i].split("=")[0]) == "totalPriceCookie")
			{
				totalPrice = thisCookie[i].split("=")[1];
			}
			
			if ( (thisCookie[i].split("=")[0]) == "priceWTaxCookie")
			{
				priceWTax = thisCookie[i].split("=")[1];
			}
			
			if ( (thisCookie[i].split("=")[0]) == "firstNameCookie")
			{
				form_firstName = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "lastNameCookie")
			{
				form_lastName = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "MICookie")
			{
				form_MI = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "streetCookie")
			{
				form_street = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "aptCookie")
			{
				form_apt = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "cityCookie")
			{
				form_city = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "zipCookie")
			{
				form_zip = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "stateCookie")
			{
				form_state = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "phoneCookie")
			{
				form_phone = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "cellCookie")
			{
				form_cell = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "emailCookie")
			{
				form_email = thisCookie[i].split("=")[1];
			}
			if ( (thisCookie[i].split("=")[0]) == "ccCookie")
			{
				form_cc = thisCookie[i].split("=")[1];
			}			
	 } // end of for loop
		
		printable.document.write("<h2>You purchased: </h2>" + itemsInCart + "</br></br>");
		printable.document.write("<b>Subtotal: </b>$" + totalPrice + "</br>");
		printable.document.write("<b>Total with Tax: </b>$" + priceWTax + "</br>");
		printable.document.write("<h2>Contact Information: </h2>");
		printable.document.write("<b>Name: </b>" + form_firstName + " " + form_MI + " ");
		printable.document.write(form_lastName + "</br>");
		printable.document.write("<b>Address: </b>" + form_street + " <b>Apt: </b>" + form_apt + " </br>" );
		printable.document.write(form_city + ", " + form_state + " " + form_zip + "</br>");
		printable.document.write("</br><b>Phone: </b>" + form_phone + "</br>");
		printable.document.write("<b>Cell Number: </b>" + form_cell + "</br>");
		printable.document.write("<b>Email: </b>" + form_email + "</br></br>");
		printable.document.write("<b>Credit Card Type: </b>" + form_cc + "</br>");	
		printable.document.write("Thanks and come again!");
}

function handleErrors() 
{

	var stringError="";	
	var er1 = "You must enter your : \n\n";
	var er2 = "Incorrect : \n\n";
	

	
	// error handling for empty and incorrect input
	
	if(form_firstName == "")
	{
		er1 += "first name\n";
	}
	
	if(form_lastName == "")
	{
		er1 += "last name\n";
	} 

	if(form_MI == "")
	{
		er1 += "midde initial\n";
	}
	
	if(form_street == "")
	{
		er1 += "street address\n";
	}
	
	if(form_city == "")
	{
		er1 += "city\n";
	}
	
	if(form_zip == "")
	{
		er1 += "zip code\n";
	}
	
	if(form_state == null) 
	{
		er1 += "state\n"; 
	}

	if((form_phone == "") && (form_cell == "")) 
	{
		er1 += "phone number\n";
	} 

	if(form_email == "") 
	{
		er1 += "email\n";
	} 
	
	if( (ccChecked.valueOf()) == false )
	{
		er1 += "credit card \n";
	}
	
	// putting errors together
	if(er1!="You must enter your : \n\n") 
	{
		stringError += er1;
	}
	
	if(er2!="Incorrect : \n\n") 
	{
		stringError += e2;
	}
	
	if(stringError!="") 
	{
		alert("\nALERT!\n\n"+stringError); 
	}
	else 
	{	
		setInfoCookies();
		window.open('cupMain.html'); 
	}	
}

	function setExpireDate() 
	{
		
		expireDate = new Date();
		expireDate.setMonth(expireDate.getMonth()+6);
		expiration = ";expires = " + expireDate.toGMTString() + "; path=/" ;
		
	}
		
		
	function setItemCookies() 
	{
			
		// cookie will expire once user leaves the page
		document.cookie = "itemsInCartCookie=" + itemsInCart + "; path=/" ;			
		document.cookie = "totalPriceCookie=" + totalPrice + "; path=/" ;
		document.cookie = "priceWTaxCookie= " + priceWTax + "; path=/" ;

	}
		
		
	function setInfoCookies() 
	{
	
		setExpireDate();				
			
		document.cookie = "firstNameCookie= " + form_firstName + expiration;
		document.cookie = "lastNameCookie= " + form_lastName + expiration;
		document.cookie = "MICookie= " + form_MI + expiration;
		document.cookie = "streetCookie= " + form_street + expiration;
		document.cookie = "aptCookie= " + form_apt + expiration;
		document.cookie = "cityCookie= " + form_city + expiration;
		document.cookie = "zipCookie= " + form_zip + expiration;
		document.cookie = "stateCookie= " + form_state + expiration;		
		document.cookie = "phoneCookie= " + form_phone + expiration;
		document.cookie = "cellCookie= " + form_cell + expiration;
		document.cookie = "emailCookie= " + form_email + expiration;	
		document.cookie = "ccCookie= " + form_cc + expiration;

			
	}