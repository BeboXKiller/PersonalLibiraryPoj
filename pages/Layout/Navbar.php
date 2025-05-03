
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><span style="color:salmon;">My</span>Books</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="BookShelf.php">Book Shelf</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="AddBooks.php">Add Books</a>
            </li>
            <?php if ((new \App\Authenticate())->isAuth()): ?>
                <li class="nav-item ">
                    <a style="color: red" class="nav-link" href="index.php?logout=1">LogOut</a>
                </li>
            <?php else: ?>
                <li class="nav-item ">
                    <a style="color: green" class="nav-link" href="SignIn.php">Sign In</a>
                </li>
                <li class="nav-item ">
                    <a style="color: cornflowerblue" class="nav-link" href="SignUp.php">Sign Up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- Nav Bar End-->