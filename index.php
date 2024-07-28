<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_SPECIAL_CHARS);
    $user = $_SESSION['username'];
    $sql = "INSERT INTO tasks(user, task) VALUES ('{$user}', '{$task}')";

    if (empty($task)) {
        echo '<script>alert("Input a valid task")</script>';
    } else {
        mysqli_query($conn, $sql);

        echo "<script>alert('Task added')</script>";
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo | Home</title>
</head>

<body>
    <h2>To Do App</h2>
    <form action="index.php" method="POST">
        <label for="">add todo</label>
        <input type="text" name="task"><br>

        <input type="submit" value="submit">
    </form>

    <main>
        <h3>Your task</h3>
        <ul>

            <?php
            $user = $_SESSION['username'];
            $sql = "SELECT * FROM tasks WHERE user = '{$user}'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . htmlspecialchars($row['task']) . "</li>";
                }
            } else {
                echo "<li>No task found</li>";
            }
            ?>
        </ul>
    </main>
</body>

</html>

<?php
mysqli_close($conn);
?>