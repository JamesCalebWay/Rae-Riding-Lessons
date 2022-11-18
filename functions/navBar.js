// Student Name: James Caleb Way
// Program Name: Rae Riding Lessons
// Creation Date: 9/17/2022
// Last Modified Date: 11/9/2022
// CSCI Course: CSCI 495
// Grade Received: TBA
// Design Comments: 

// Navigation menu addapted from https://www.w3schools.com/howto/howto_js_topnav_responsive.asp

// Highlights the current page
function myFunction()
{
    var x = document.getElementById("myTopnav");

    if (x.className === "topnav")
    {
        x.className += " responsive";
    }
    else
    {
        x.className = "topnav";
    }
}
