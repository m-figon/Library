<?php
$conn = mysqli_connect('localhost', 'admin', 'test1234', 'library');

if ($conn) {
    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
} else {
    echo "error";
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

    <div class="container">
        <div class="row bg-light">
            <div class="col-sm title-col">
                <h5 class="text-info">Title</h5>
            </div>
            <div class="col-sm title-col">
                <h5 class="text-info">Author</h5>
            </div>
            <div class="col-sm title-col">
                <h5 class="text-info">Type</h5>
            </div>
            <div class="col-sm title-col">
                <h5 class="text-info">Library</h5>
            </div>
            <div class="col-sm title-col">
                <h5 class="text-info">Availability</h5>
            </div>
        </div>
    </div>
    <?php foreach ($books as $book) { ?>
        <div class="container">
            <div class="row bg-light">

                <div class="col-sm">
                    <h6><?php echo  $book['name'] ?></h6>
                </div>
                <div class="col-sm">
                    <h6><?php echo  $book['author'] ?></h6>
                </div>
                <div class="col-sm">
                    <h6><?php echo  $book['type'] ?></h6>
                </div>
                <div class="col-sm">
                    <h6><?php echo  $book['library'] ?></h6>
                </div>
                <div class="col-sm">
                    <?php if ($book['available'] === '1') { ?>
                        <h6><?php echo  'available' ?></h6>
                    <?php } ?>
                    <?php if ($book['available'] === '0') { ?>
                        <h6><?php echo  'not available' ?></h6>
                    <?php } ?>
                </div>
            </div>
        </div>


    <?php } ?>
</body>

</html>