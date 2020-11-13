<?php
if (!isset($_SESSION)) {
  session_start();
}
$logedAc = $_SESSION['email'] ?? '';
if (isset($_POST['submit'])) {
  $_SESSION['email'] = "";
  $logedAc = $_SESSION['email'];
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <img src="book.png" class="book">
      </li>
      <li class="nav-item active book-li">
        <a class="nav-link text-light" href="/library/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="/library/libraries.php">Our Libraries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="/library/books.php">Available Books</a>
      </li>
      <?php if ($logedAc) { ?>
        <li class="nav-item">
          <a class="nav-link text-light"><?php echo htmlspecialchars($logedAc); ?></a>
        </li>
      <?php } ?>
      <?php if (!$logedAc) { ?>
        <li class="nav-item">
          <a class="nav-link text-light" href='/library/login.php'>Login</a>
        </li>
      <?php } ?>
      <?php if ($logedAc) { ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <li class="nav-item">
            <input class="nav-link" type="submit" name="submit" value="<?php echo $logedAc ?  "Logout" : ''; ?>">
          </li>
        <?php } ?>
        </form>
        <li class="nav-item">
          <a class="nav-link text-light" href="/library/register.php">Register</a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>