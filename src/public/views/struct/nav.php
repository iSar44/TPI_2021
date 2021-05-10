<nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
    <div class="container-fluid">
        <a class="navbar-brand" href="./" style="font-size: 40px;">tournamentManager</a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
            <span class="visually-hidden">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navcol-1" style="margin-top:10px;font-size:20px;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./">Accueil</a>
                </li>
                <?php if (isset($_SESSION['isLoggedIn'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Plus</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./?action=create">Créer un tournoi</a>
                            <a class="dropdown-item" href="#">Second Item</a>
                            <a class="dropdown-item" href="#">Third Item</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex me-auto navbar-form" target="_self">
            </form>
            <?php if (!isset($_SESSION['isLoggedIn'])) : ?>
                <a class="btn btn-light action-button" style="font-size:inherit;" role="button" href="./?action=login">Log In</a>
            <?php else : ?>
                <a class="navbar-brand" style="font-size: 20px;" disabled><?= $_SESSION['username']; ?></a>
                <a class="btn btn-light action-button" style="font-size:inherit;" role="button" href="./?action=logout">Log Out</a>
            <?php endif; ?>
        </div>
    </div>
</nav>