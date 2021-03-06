<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $this->getConfig('website.desc') ?>">

    <title><?= $this->getConfig('website.name') ?></title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/app.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="<?= $this->url('app.home') ?>"><?= $this->getConfig('website.dim') ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->url('jokes.add') ?>">Proposer</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <?php if(!$this->userLogged()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $this->url('users.login') ?>">Connexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->getUser()->login ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Paramètres</a>
                        <a class="dropdown-item" href="<?= $this->url('users.logout') ?>">Déconnexion</a>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container">

    <?= $content ?>

</div>

<script src="./js/jquery.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>
