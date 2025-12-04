const transDetails = document.getElementById("trans-load");


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
window.onload = (event) => showTransactions();


//clear the data after 10s
/* setTimeout(() => {
    transDetails.innerHTML = "";
}, 10000); */



