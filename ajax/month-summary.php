<?php

    include_once "../config/connect.php";

    $html_output = "";
    $trans_details = [
        "income"=> 0, 
        "expense"=> 0
    ];   
    $today_date = date("Y-m");    
        
    //sql select statement
    $sql = "SELECT * FROM `et_transactions` WHERE `date` LIKE '$today_date%' ORDER BY `date` DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        //output data of each row
        while($row = $result->fetch_assoc()){
            
            #echo $row["date"]." ".$row["accounts"]." ".$row["category"]." ".$row["amount"]." ".$row["trans_type"]." ".$row["note"]."<br>";
            switch($row["trans_type"]){
                case "expense":
                    $trans_details["expense"] += $row["amount"];
                    break;
                case "income":
                    $trans_details["income"] += $row["amount"];
                    break;
            }                                  
        }
    }
    $conn->close();

    /*echo "<pre>";
    print_r($trans_details);
    echo "</pre>";*/

    $html_output .= '<div class="income">
                <p>Income</p>
                <p>'.$trans_details["income"].'</p>
            </div>
            <div class="expense">
                <p>Expenses</p>
                <p>'.$trans_details["expense"].'</p>
            </div>
            <div class="aggregate">
                <p>Total</p>
                <p>'.$trans_details["income"] - $trans_details["expense"].'</p>
            </div>';

    echo $html_output;

?>