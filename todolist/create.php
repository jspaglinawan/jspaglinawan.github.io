<?php
include 'db.php';

if (isset($_POST['task']) && isset($_POST['due_date'])) {
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO tasks (task_name, due_date, status) 
            VALUES ('$task', '$due_date', 'Pending')";
    
    $conn->query($sql);
}
?>