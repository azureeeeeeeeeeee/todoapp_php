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
    <form action="login.php" method="POST">
        <label for="">username</label>
        <input type="text" name="username"><br>

        <label for="">password</label>
        <input type="password" name="password"><br>

        <input type="submit" value="login">
    </form>
    <p>Do not have an account ? register <a href="register.php">here</a></p>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username) || empty($password)) {
        echo '<script>alert("Username or password cannot be empty")</script>';
    } else {
        $sql = "SELECT user, password from users WHERE user = '{$username}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {
            echo '<script>alert("User or Password does not exist")</script>';
        } else {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['user'];
                echo '<script>alert("Login Successful"); window.location.href = "index.php"</script>';
            } else {
                echo '<script>alert("User or Password does not exist");</script>';
            }
        }
    }

    mysqli_close($conn);
}
?>