
	// storing the signs as strings
	var theSigns = new Array ("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", 
		"Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces");
		
	// storing the images of the signs
	var theImages = new Array ("image_Aries.jpg", "image_Taurus.jpg", "image_Gemini.jpg", 
		"image_Cancer.jpg", "image_Leo.jpg", "image_Virgo.jpg", "image_Libra.jpg",
		"image_Scorpio.jpg", "image_Sagitarius.jpg","image_Capricorn.jpg", 
		"image_Aquarius.jpg", "image_Pisces.jpg");		

	// storing the fortunes
	var theFortunes = new Array ();
	theFortunes [0] = "Better manage your time.. the day will go by faster than expected.";
	theFortunes [1] = "Life is too short to be constantly worried.. Relax!";
	theFortunes [2] = "Keep an eye out.. a great opportunity awaits you!";
	theFortunes [3] = "Keeping an open mind might just resolve a long lasting conflict.";
	theFortunes [4] = "If you play your cards right, things will go exactly as you planned out.";
	theFortunes [5] = "Keep a positive outlook and everything will be just fine.";
	theFortunes [6] = "Break out of your shell and try something new.. you may just like it!";
	theFortunes [7] = "Don't give up! Your kindness will not go unnoticed today.";
	theFortunes [8] = "Be careful with your money.. you may just spend more than you intended.";
	theFortunes [9] = "Get Ready! Your love life is about to get a little spicy.";
	theFortunes [10] = "It's going to be a rocky road, but you'll make it through.";
	theFortunes [11] = "Get excited! Today is a day for a new beginnings!";

	// storing how many days a particular month has 
	// (using first value as dummy to match index with number of the month)
	var theDaysInMonth = new Array (0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	
	// storing what day of the year the last day of the month is
	var lastDay = new Array (0, 31, 60, 91, 121, 152, 182, 213, 244, 274, 305, 335, 366);
	
	var rareDay = false; // to find the rare case if birthday is Feb. 29 during leap year
	var theMonth;
	var theDay;
	var dayOfYear;
	var monthIndex;
	var dayIndex;
	var signIndex; // index to find sign within arrays
	var theMonthElement;
	var theDayElement;
	var imageElement;
	var theMonthAsString;
	var theDayAsString;
	var yourSignAsString = "this is your sign"; // will hold sign as a string 
	var yourBirthDateAsString = "this is your birthday";
	var yourFortuneAsString = "this is your fortune";
	
function getDays () {

	setMonthIndex();
	var selectionDays = document.getElementById('selectDay');
	selectionDays.options.length=0;
	var days = 0;
	
	// days must match to amount in selected month
	switch(monthIndex) {
		case 4: case 6: case 9: case 11:
			days = 30;
			break;
		case 2:
			days = 29;
			break;
		default:
			days = 31;
			break;
	}
	
	// populating drop down box with days
	for (var i=1; i<=days; i++){
		selectionDays.options[i] = new Option (i,i);
	}
	
	selectionDays.selectedIndex = 0;	
} // end of getDays


function makeFortune(){

	getStrings();
	getInts();
	
	dayOfYear = (lastDay[theMonth-1] + theDay); // day of the year the birthday falls on
	
	// finding out if the birthday falls on February 29
	if (dayOfYear == lastDay[2]) {
		rareDay = true;
	}
	else
		rareDay = false;

	getSignIndex();

	// string to return birth date based on selection
	yourBirthDateAsString = "Your Birthday is: " + theMonthAsString + ", " + theDayAsString + "!";
	
	// if the birthday is on 2/29 we let the user know it is rare!
	if (rareDay) {
		yourBirthDateAsString += " This is a very rare Birthday!";
	}
	
	// calculating string that will return the sign
	// we must account for the cases when the sign starts with a vowel
	if (signIndex !=0 && signIndex !=10) {
		yourSignAsString = "You are a " + theSigns[signIndex] + ".";
	}
	else {
		yourSignAsString = "You are an " + theSigns[signIndex] + ".";
	}
	
	imageElement = "" + theImages[signIndex];
	yourFortuneAsString = theFortunes[signIndex]; // assigning the appropriate fortune
	
}

function getStrings () {
	var str = new Array( "", "January", "Febrauary", "March", "April", "May", "June", 
		"July", "August", "September", "October", "November", "December")
	theMonthAsString = str[monthIndex]; // creating string for birth month
	theDayAsString = "" + dayIndex; // creating string for birth day
}

function getInts() {
	theMonth = parseInt(monthIndex);
	theDay = theDayAsString*1;
}


function setMonthIndex() {
		
	// getting month input from drop down box
	theMonthElement = document.getElementById('selectMonth');
	monthIndex = theMonthElement.selectedIndex; // as object
}

function setDayIndex() {
	
	// getting day input from dropdown box
	theDayElement = document.getElementById('selectDay');
	dayIndex = theDayElement.selectedIndex; // as object
}

function getSignIndex() {

	if ( ( dayOfYear >= 357 ) || ( dayOfYear <= 20 ) ) {
		signIndex = 9;
	}	
	if ( ( dayOfYear >= 21 ) && ( dayOfYear <= 50 ) ) {
		signIndex = 10;
	}
	if ( ( dayOfYear >= 51 ) && ( dayOfYear <= 80 ) ) {
		signIndex = 11;
	}
	if ( ( dayOfYear >= 81 ) && ( dayOfYear <= 111) ) {
		signIndex = 0;
	}
    if ( ( dayOfYear >= 112) && ( dayOfYear <= 142 ) ) {
		signIndex = 1;
	}
	if ( ( dayOfYear >= 143) && ( dayOfYear <= 173 ) ) {
		signIndex = 2;
	}
	if ( ( dayOfYear >= 174 ) && ( dayOfYear <= 204 ) ) {
		signIndex = 3;
	}
	if ( ( dayOfYear >= 205 ) && ( dayOfYear <= 235 ) ) {
		signIndex = 4;
	}
	if ( ( dayOfYear >= 236 ) && ( dayOfYear <= 265 ) ) {
		signIndex = 5;
	}
	if ( ( dayOfYear >= 266 ) && ( dayOfYear <= 296 ) ) {
		signIndex = 6;
	}
	if ( ( dayOfYear >= 297 ) && ( dayOfYear <= 326 ) ) {
		signIndex = 7;
	}
	if ( ( dayOfYear >= 327 ) && ( dayOfYear <= 356 ) ) {
		signIndex = 8;
	}

} // end of getSignIndex

function getFortune(){

	makeFortune();
	
	// outputting everything back to the page
	document.getElementById('yourBirthday').innerHTML=yourBirthDateAsString;
	document.getElementById('yourSign').innerHTML=yourSignAsString;
	document.getElementById('pictureOfSign').innerHTML="<img src='" + theImages[signIndex] + "'>";
	document.getElementById('yourFortune').innerHTML=yourFortuneAsString;

}
