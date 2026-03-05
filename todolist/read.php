<?php
include 'db.php';

$result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");

$tasks = [];
$pendingCount = 0;
$completedCount = 0;

while($row = $result->fetch_assoc()){
    if($row['status'] == 'Pending') $pendingCount++;
    if($row['status'] == 'Completed') $completedCount++;

    $tasks[] = [
        'id' => $row['id'],
        'task_name' => $row['task_name'],
        'due_date' => $row['due_date'],
        'status' => $row['status']
    ];
}

echo json_encode([
    'tasks' => $tasks,
    'pending' => $pendingCount,
    'completed' => $completedCount
]);
?>