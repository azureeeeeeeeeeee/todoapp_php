<?php
include('db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="register.php" method="POST">
        <label for="">username</label>
        <input type="text" name="username"><br>

        <label for="">password</label>
        <input type="password" name="password"><br>

        <label for="">confirm password</label>
        <input type="password" name="password_confirm"><br>

        <input type="submit" value="register">
    </form>
    <p>Already have an account ? login <a href="login.php">here</a></p>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {
        echo '<script>alert("Username or password cannot be empty")</script>';
    } elseif (empty($password_confirm)) {
        echo "<script>alert('confirm your password')</script>";
    } elseif ($password != $password_confirm) {
        echo '<script>alert("Password do not match")</script>';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user, password) VALUES ('{$username}', '{$hash}')";

        mysqli_query($conn, $sql);

        $_SESSION['username'] = $username;

        echo "<script>alert('You are now registered'); window.location.href = 'index.php'</script>";
    }
}



mysqli_close($conn);
?>