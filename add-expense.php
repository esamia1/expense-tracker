<?php
    // Include connection file
    require './config/connect.php';

    

    //var_dump($_POST);
    // Set parameters
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $account = $_POST['account'];
    $note = $_POST['note'];
    $trans_expense = strtolower($_POST['trans-expense']);
        
    // Prepare and bind
    $expense_stmt = $conn->prepare("INSERT INTO et_transactions (date, accounts, category, amount, trans_type, note) VALUES (?, ?, ?, ?, ?, ?)");
    $expense_stmt->bind_param("ssssss", $date, $account, $category, $amount, $trans_expense, $note);

    // execute parameter binding
    $expense_stmt->execute();

    /*// Insert data into the table
    if ($conn->query($expense_sql) === TRUE){
        echo "Record added successfully!";
    } else { 
        echo "Error: " . $expense_sql . "<br>" . $conn->error;
    }*/

    // Close connection
    $expense_stmt->close();
    $conn->close();

    //redirect according to type of transaction
    if($trans_expense === "expense"){
        header("Location: ./add-transaction.html");
        // Enter another transaction
        exit;
    } elseif($trans_expense === "income"){
        header("Location: ./add-income.html");
        exit;
    } else {
        //change this in future to tansfer on implementation
        header("Location: ./index.html");
        exit;
    }


?>