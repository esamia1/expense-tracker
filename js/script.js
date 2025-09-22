// Update current day and time
const dateElement = document.getElementById("date-text");
const timeElement = document.getElementById("time-text");
const contentElement = document.getElementById("content");
const addBtn = document.getElementById("add-item");

//Constants in the App
const gregWeekDays = ["Sun", "Mon", "Tue", "Wed", "Thu","Fri", "Sat"]
const gregMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug", "Sep", "Nov","Dec"];

//get date and time date format: Tue, Jul 26, 2025
//time format: 17:28:21
const getMyDate = new Date();

//extract date
const myWeekDay = getMyDate.getDay();
const myMonthDay = getMyDate.getDate();
const myMonth = getMyDate.getMonth();
const myYear = getMyDate.getFullYear();


//display date and time
dateElement.textContent = `${gregWeekDays[myWeekDay]}, ${gregMonths[myMonth]} ${myMonthDay}, ${myYear}`;
setInterval(updateTime, 1000);

//Update time function
function updateTime() {
    //get date and time
    const getMyDate = new Date();

    //extract time
    const myHours = String(getMyDate.getHours()).padStart(2, "0");
    const myMinutes = String(getMyDate.getMinutes()).padStart(2, "0");
    const mySeconds = String(getMyDate.getSeconds()).padStart(2, "0");

    //update display
    timeElement.textContent = `${myHours}:${myMinutes}:${mySeconds}`;
}