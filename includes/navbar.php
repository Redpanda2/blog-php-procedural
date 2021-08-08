<nav>
    <ul>
        <li><a href="../index.php">Acceuil</a></li>
        <li>Contact</li>
        <?php if (!isset($_SESSION['user'])) : ?>
            <li><a href="../pages/connexion.php">Connexion</a></li>
            <li><a href="../pages/inscription.php">Inscription</a></li>
        <?php else : ?>
            <li><a href="../pages/deconnexion.php">Deconnexion</a></li>
        <?php endif; ?>
    </ul>

</nav>