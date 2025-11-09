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
    $trans_expense = $_POST['trans-expense'];
        
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

    // Enter another transaction
    header("Location: ./add-transaction.html");
    exit;

?>