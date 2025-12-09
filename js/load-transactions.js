const monthSummary = document.getElementById("daily-summary")
const transDetails = document.getElementById("trans-load");



//declare summary function
const showSummary = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            monthSummary.innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "./ajax/month-summary.php", true);
    xmlhttp.send(); 
};

//declare display function
const showTransactions = () => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            transDetails.innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "./ajax/fetch-transaction.php", true);
    xmlhttp.send();
};
//execute reques after page load
showSummary();
showTransactions();