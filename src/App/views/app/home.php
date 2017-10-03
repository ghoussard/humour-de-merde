<h1><?= \App\App::getInstance()->getConfig('website.name'); ?></h1>

<a href="<?= \App\App::getInstance()->getRouter()->generateUrl('jokes.add') ?>">Propose une blague !</a>