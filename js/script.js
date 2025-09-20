// Update current day and time
const dateElement = document.getElementById("date-text");
const timeElement = document.getElementById("time-text");
const contentElement = document.getElementById("content");
const addBtn = document.getElementById("add-item");

//Constants in the App
const gregWeekDays = ["Sun", "Mon", "Tue", "Wed", "Thu","Fri", "Sat"]
const gregMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug", "Sep", "Nov","Dec"];

const addEntryForm = `
    <div class="add-entry some-space">
        <div>
            <button><i class="fa-solid fa-arrow-left"></i></button>
            <div>Expense</div>
        </div>
        <div>
            <span>Income</span>
            <span>Expense</span>
            <span>Transfer</span>
        </div>
        <div>
            <form action="">
                <div>
                    <label for="">Date</label>
                    <input type="date" name="" id="">
                    <input type="time" name="" id="">
                </div>
                <div>
                    <label for="">Amount</label>
                    <input type="number" name="" id="">
                </div>
                <div>
                    <label for="">Category</label>
                    <input type="text">
                </div>
                <div>
                    <label for="">Account</label>
                    <input type="text" name="" id="">
                </div>
                <div>
                    <button>Done</button>
                </div>
            </form>
        </div>
    </div>`;

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

//function to populate html for transaction view
const addTransactionView = () => {
   //create top navigation
   const backNavDiv = document.createElement("div");
   
   //create some content to add
   const greeTing = document.createTextNode("Hi there and greetings!");

   //add content to the created element
   backNavDiv.appendChild(greeTing);

   wrapperElement.appendChild(backNavDiv);
};


//Adding New Items Transcations Event listener
addBtn.addEventListener("click", () => {
    //clear the main container element
    contentElement.innerHTML = addEntryForm;

    //call the new function
    addTransactionView();
});