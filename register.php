<?php
$classes = ['email' => '', "name" => '','surname'=>'','phone'=>'', 'password' => '', 'confirm-password' => ''];
$email = '';
$name = '';
$surname = '';
$phone = '';
$password = '';
$confirmPassword = '';
$tooltips = ['email' => '', "name" => '','surname'=>'','phone'=>'', 'password' => '', 'confirm-password' => ''];



if (isset($_GET['submit'])) {
    $correctData = true;
    if (preg_match('/^[a-z0-9\._\-]+@[a-z0-9\.\-]+\.[a-z]{2,4}$/', $_GET['email'])) {
        $email = $_GET['email'];
        $classes['email'] = "correct";
        $tooltips['email'] = false;
    } else {
        $classes['email'] = "incorrect";
        $tooltips['email'] = true;
        $correctData = false;
    }
    if (preg_match('/^[a-zA-Z]{3,15}$/', $_GET['name'])) {
        $name = $_GET['name'];
        $classes['name'] = "correct";
        $tooltips['name'] = false;
    } else {
        $classes['name'] = "incorrect";
        $tooltips['name'] = true;
        $correctData = false;
    }
    if (preg_match('/^[0-9]{9}$/', $_GET['phone'])) {
        $phone = $_GET['phone'];
        $classes['phone'] = "correct";
        $tooltips['phone'] = false;
    } else {
        $classes['phone'] = "incorrect";
        $tooltips['phone'] = true;
        $correctData = false;
    }
    if (preg_match('/^[a-zA-Z]{3,15}$/', $_GET['surname'])) {
        $surname = $_GET['surname'];
        $classes['surname'] = "correct";
        $tooltips['surname'] = false;
    } else {
        $classes['surname'] = "incorrect";
        $tooltips['surname'] = true;
        $correctData = false;
    }
    if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.\-_@$!%*#?&])[A-Za-z\d\.\-_@$!%*#?&]{8,13}$/', $_GET['password'])) {
        $password = $_GET['password'];
        $classes['password'] = "correct";
        $tooltips['password'] = false;
    } else {
        $classes['password'] = "incorrect";
        $tooltips['password'] = true;
        $correctData = false;
    }
    if ($_GET['confirm-password']===$_GET['password'] && preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.\-_@$!%*#?&])[A-Za-z\d\.\-_@$!%*#?&]{8,13}$/', $_GET['password'])) {
        $confirmPassword = $_GET['confirm-password'];
        $classes['confirm-password'] = "correct";
        $tooltips['confirm-password'] = false;
    } else {
        $classes['confirm-password'] = "incorrect";
        $tooltips['confirm-password'] = true;
        $correctData = false;
    }
    if ($correctData) {
        $conn = mysqli_connect('localhost', 'admin', 'test1234', 'library');
        if ($conn) {
            $idVal='1';
            $nameVal = mysqli_real_escape_string($conn, $_GET['name']);
            $surnameVal = mysqli_real_escape_string($conn, $_GET['surname']);
            $passwordVal = mysqli_real_escape_string($conn, $_GET['password']);
            $confirmPasswordVal = mysqli_real_escape_string($conn, $_GET['confirm-password']);
            $emailVal = mysqli_real_escape_string($conn, $_GET['email']);
            $phoneVal = mysqli_real_escape_string($conn, $_GET['phone']);
            $sql = "INSERT INTO users(name,surname,password, confirm_password, email, phone) VALUES ('$nameVal','$surnameVal','$passwordVal','$confirmPasswordVal','$emailVal','$phoneVal')";

            if (mysqli_query($conn, $sql)) {
                header("Location: http://localhost/library/");
            } else {
                echo 'query error: ' . mysqli_error($conn);
            }
        } else {
            echo 'connection error' . mysqli_connect_error();
        }
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
    <form class="container" action="register.php" method="GET">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>"  id="<?php echo $classes['email']?>" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['email']) echo 'Please enter email' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name ?>" id="<?php echo $classes['name']?>" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['name']) echo 'Name must consist of 3-15 letters' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Surname</label>
            <input type="text" name="surname" class="form-control" value="<?php echo $surname ?>" id="<?php echo $classes['surname']?>" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['surname']) echo 'Surname must consist of 3-15 letters' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>" id="<?php echo $classes['phone']?>" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['phone']) echo 'Phone number must be 9 digits' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password ?>" id="<?php echo $classes['password']?>">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['password']) echo 'Password must be 8-13 signs long, have at least one lower and uper case letter, digit, special sign' ?></small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="confirm-password" class="form-control" value="<?php echo $confirmPassword ?>" id="<?php echo $classes['confirm-password']?>">
            <small id="emailHelp" class="form-text text-muted"><?php if ($tooltips['confirm-password']) echo 'Password confirmation must be same as password' ?></small>
        </div>
        <button type="submit" name="submit" class="btn bg-secondary text-light">Register</button>
    </form>
</body>

</html>