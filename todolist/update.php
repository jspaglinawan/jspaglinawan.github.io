<?php
include 'db.php';

if (isset($_POST['toggle_id'])) {

    $id = $_POST['toggle_id'];

    $check = $conn->query("SELECT status FROM tasks WHERE id = $id");

    if($check && $check->num_rows > 0){
        $row = $check->fetch_assoc();

        if($row['status'] == 'Completed'){
            $newStatus = 'Pending';
        } else {
            $newStatus = 'Completed';
        }

        $conn->query("UPDATE tasks SET status='$newStatus' WHERE id=$id");
    }
}
if (isset($_POST['id']) && isset($_POST['task'])) {
    $id = $_POST['id'];
    $task = $_POST['task'];

    $sql = "UPDATE tasks SET task_name='$task' WHERE id=$id";
    $conn->query($sql);
}
?>