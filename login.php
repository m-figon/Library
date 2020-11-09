<?php
$visible = false;
$email = '';
$password = '';


$conn = mysqli_connect('localhost', 'admin', 'test1234', 'library');
$sql = "SELECT * FROM users ORDER BY id";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

if (isset($_GET['submit'])) {
    $correctData = false;
    foreach($users as $user){
        if($user['email']===$_GET['email'] && $user['password']===$_GET['password']){
            $correctData=true;
        }
    }
    if ($correctData) {
        $visible=false;
        session_start();
        $_SESSION['email']=$user['email'];
        header("Location: http://localhost/library/");
    }else{
        $visible=true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Library</title>
</head>

<body>
    <?php include('./nav-bar.php') ?>
    <form class="container" action="login.php" method="GET">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><?php if ($visible) echo 'Please enter correct login and password' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="submit" class="btn bg-secondary text-light">Login</button>
    </form>
</body>

</html>