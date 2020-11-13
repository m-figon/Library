<?php
$conn = mysqli_connect('localhost', 'admin', 'test1234', 'library-data');
$bookBorrowed = false;
if (isset($_GET['submit']) && isset($_GET['id'])) {
    $bookBorrowed = true;
    $idVal = $_GET['id'];
    if (!isset($_SESSION)) {
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    $startDate = date("Y-m-d");
    $endDate = $startDate;
    $returnedVal = '0';
    $sql = "UPDATE books SET availability = '0'";
    if (mysqli_query($conn, $sql)) {
    } else {
        echo mysqli_error($conn);
    }
    //echo $startDate;
    //echo $user_id;
    $sql = "INSERT INTO borrows (user_id,book_id,start_date,end_date,returned) VALUES ('$user_id','$idVal','$startDate','$endDate','$returnedVal')";
    if (mysqli_query($conn, $sql)) {
    } else {
        echo mysqli_error($conn);
    }
}
if (isset($_SESSION['name'])) {
    $logedAc = $_SESSION['name'];
}
if ($conn && isset($_GET['id']) && !isset($_GET['submit'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE book_id = $id";
    $result = mysqli_query($conn, $sql);
    $book = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
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
    <?php if (!$bookBorrowed) { ?>
        <div class="container">
            <div class="row bg-light">
                <div class="col-sm">
                    <h2>Title:</h2>
                </div>
                <div class="col-sm">
                    <h2><?php echo htmlspecialchars($book['title']) ?></h2>
                </div>
            </div>
            <div class="row bg-light">
                <div class="col-sm">
                    <h2>Author:</h2>
                </div>
                <div class="col-sm">
                    <h2><?php echo htmlspecialchars($book['author']) ?></h2>
                </div>
            </div>
            <div class="row bg-light">
                <div class="col-sm">
                    <h2>Type:</h2>
                </div>
                <div class="col-sm">
                    <h2><?php echo htmlspecialchars($book['type']) ?></h2>
                </div>
            </div>
            <div class="row bg-light">
                <div class="col-sm">
                    <h2>Availability:</h2>
                </div>
                <div class="col-sm">
                    <h2><?php echo $book['availability'] === '1' ? 'Available' : "Not Available"  ?></h2>
                </div>
            </div>
            <?php if ($book['availability'] === '1' && $logedAc === '') { ?>
                <div class="row bg-light">
                    <h3>To borrow book from a library</h3>
                    <a id="login-link" href="/library/login.php">Sign in</a>
                </div>
            <?php  } ?>
            <?php if ($book['availability'] === '1' && $logedAc !== '') { ?>
                <div class="row bg-light">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                        <input type="hidden" name="id" value="<?php echo $book['book_id'] ?>">
                        <input class="nav-link" type="submit" name="submit" value="Borrow Book">
                    </form>
                </div>
            <?php  } ?>
        </div>
    <?php  } ?>
    <?php if ($bookBorrowed) { ?>
        <div class="container">
            <h1>Book borrowed</h1>
        </div>
    <?php } ?>

</body>

</html>