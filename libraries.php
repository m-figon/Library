<?php
$libraries = [["name" => "Gdansk Great Library", "img" => "https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1453&q=80","address"=>"Gdansk Example Street 5"],
 ["name" => "Cracow Old Library", "img" => "https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80","address"=>"Cracow Example Street 3"],
  ["name" => "Warsaw National Library", "img" => "https://images.unsplash.com/photo-1495741545814-2d7f4d75ea09?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1354&q=80", "address"=>"Warsaw Example Street 7"]]
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
    <?php foreach ($libraries as $library) { ?>
        <div class="container">
            <div class="row bg-light">
                <div class="col-sm">
                <img src="<?php echo $library['img'] ?>" class="img-thumbnail">
                </div>
                <div class="col-sm">
                <h1><?php echo  $library['name'] ?></h1>
                </div>
                <div class="col-sm">
                <h1><?php echo  $library['address'] ?></h1>
                </div>
            </div>
        </div>


    <?php } ?>
</body>

</html>