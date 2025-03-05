<header class="navbar">
    <nav class="navbar-content">
        <a href="/" class="navbar-logo">My first App PHP</a>
    <ul class ="navbar-links">
        <li>
            <a href="#" class ="navbar-item">Acceuil</a>
        </li>
        <li>
            <a href="#"class ="navbar-item">Profil</a>
        </li>
        <li>
            <a href="#"class ="navbar-item">Blog</a>
        </li>
    </ul>
    <ul class="navbar-buttons">
        <li class ="navbar-items">
        <?php if (!empty($_SESSION['user'])): ?>
            <a href="/logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
            <a href="/login.php" class="btn btn-danger">Login</a>
            <?php endif; ?>
        </li>
    </ul>
    </nav>
</header>