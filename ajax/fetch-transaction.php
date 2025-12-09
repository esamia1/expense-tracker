<?php

    include_once '../config/connect.php';

    $html_output = "";
    $trans_details = [];   
    $today_date = date("Y-m");    
        
    //sql select statement
    $sql = "SELECT * FROM `et_transactions` WHERE `date` LIKE '$today_date%' ORDER BY `date` DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        //output data of each row
        while($row = $result->fetch_assoc()){
            
            #echo $row["date"]." ".$row["accounts"]." ".$row["category"]." ".$row["amount"]." ".$row["trans_type"]." ".$row["note"]."<br>";
            array_push($trans_details, $row);                       
        }
    }
    $conn->close();

    //array to hold fetched values
    $formatDetails = [];

    //hold daily subtotal transactions    
    $totals = [];

    foreach($trans_details as $item){
        //extract full date
        $fullDate = date("Y-m-d", strtotime($item["date"]));
        /* $fullDate ."<br>";
        echo "<pre>";
        print_r($item);
        echo "</pre>";*/

        //create new array populating the figures
        if(array_key_exists($fullDate, $formatDetails)){
            array_push($formatDetails[$fullDate], [
                "day"=> date("d", strtotime($item["date"])), "week_day"=> date("D", strtotime($item["date"])), "month"=> date("m", strtotime($item["date"])), "year"=> date("Y", strtotime($item["date"])), "accounts"=> $item["accounts"], 
                "category"=> $item["category"], 
                "amount"=> $item["amount"], 
                "trans"=> $item["trans_type"], 
                "note"=> $item["note"]
            ]);
            //update income&expense total
            switch($item["trans_type"]){
                case "expense":
                    $totals[$fullDate][1] += $item["amount"];
                    break;
                case "income":
                    $totals[$fullDate][0] += $item["amount"];
                    break;
            }
        } else {
            $formatDetails[$fullDate] = [];
            array_push($formatDetails[$fullDate], [
                "day"=> date("d", strtotime($item["date"])), "week_day"=> date("D", strtotime($item["date"])), "month"=> date("m", strtotime($item["date"])), "year"=> date("Y", strtotime($item["date"])), "accounts"=> $item["accounts"], 
                "category"=> $item["category"], 
                "amount"=> $item["amount"], 
                "trans"=> $item["trans_type"], 
                "note"=> $item["note"]
            ]);
            //update income&expense total
            $totals[$fullDate] = [0, 0];
            switch($item["trans_type"]){
                case "expense":
                    $totals[$fullDate][1] += $item["amount"];
                    break;
                case "income":
                    $totals[$fullDate][0] += $item["amount"];
                    break;
            }
        }
    }
    /*
    echo "<pre>";
    print_r($totals);
    echo "</pre>";
    */
    //extract daily summary
    

    //generate html output
    $dayList = array_keys($formatDetails);    
    for($day = 0; $day < count($formatDetails); $day++){
        $html_output .= '<div class="card">
                            <div class="trans-head">
                                <div class="card-date">
                                    <div class="day">'.$formatDetails[$dayList[$day]][0]["day"].'</div>
                                    <div class="week-day">'.$formatDetails[$dayList[$day]][0]["week_day"].'</div>
                                    <div class="d-period">'.$formatDetails[$dayList[$day]][0]["month"].'.'.$formatDetails[$dayList[$day]][0]["year"].'</div>
                                </div>
                                <div class="income-color">Kshs '.$totals[$dayList[$day]][0].'</div>
                                <div class="expense-color">Kshs '.$totals[$dayList[$day]][1].'</div>
                            </div>';
        for($trans = 0; $trans < count($formatDetails[$dayList[$day]]); $trans++){
            // check transaction if expense or income
            if($formatDetails[$dayList[$day]][$trans]["trans"] === "income"){
                $html_output .= '<div class="trans-entry expense some-space">
                                    <div>'.$formatDetails[$dayList[$day]][$trans]["category"].'</div>
                                    <div class="description">
                                        <div class="note">'.$formatDetails[$dayList[$day]][$trans]["note"].'</div>
                                        <div>'.$formatDetails[$dayList[$day]][$trans]["accounts"].'</div>
                                    </div>
                                    <div class="income-color">Kshs '.$formatDetails[$dayList[$day]][$trans]["amount"].'</div>
                                </div>';                            
            } else {
                $html_output .= '<div class="trans-entry expense some-space">
                                    <div>'.$formatDetails[$dayList[$day]][$trans]["category"].'</div>
                                    <div class="description">
                                        <div class="note">'.$formatDetails[$dayList[$day]][$trans]["note"].'</div>
                                        <div>'.$formatDetails[$dayList[$day]][$trans]["accounts"].'</div>
                                    </div>
                                    <div class="expense-color">Kshs '.$formatDetails[$dayList[$day]][$trans]["amount"].'</div>
                                </div>';
            }
        }
        $html_output .= '</div>';
    }
    //send response back to client
    echo $html_output;
?>