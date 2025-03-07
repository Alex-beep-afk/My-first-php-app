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
        
        <?php if (!empty($_SESSION['user'])): ?>
            <?php if (in_array('ROLE_ADMIN', $_SESSION['user']['roles'])): ?>
                <li class="navbar-items">
                    <a href="/admin/users" class="btn btn-light">Admin User</a>
                </li>
            <?php endif; ?>
            <li class ="navbar-items">
            <a href="/logout.php" class="btn btn-danger">Logout</a></li>
            <li class ="navbar-items">
            <a href ="/sup.php"class="btn btn-danger">Supprimer mon compte</a>
            </li>
            <?php else: ?>
            <li class ="navbar-items">
            <a href="/login.php" class="btn btn-secondary">Login</a>
            <a href="/register.php" class="btn btn-primary">Register</a>
            </li>
            <?php endif; ?>
    </ul>
    </nav>
</header>