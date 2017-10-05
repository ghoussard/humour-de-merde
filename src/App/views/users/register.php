<h1>Inscription</h1>

<form action="" method="post">
    <?= $form->input('login', 'Peudo*'); ?>
    <?= $form->input('mail', 'Adresse mail*', ['type' => 'email']); ?>
    <?= $form->input('confirm_mail', 'Confirmation adresse mail*', ['type' => 'email']); ?>
    <?= $form->input('password', 'Mot de passe*', ['type' => 'password']); ?>
    <?= $form->input('confirm_password', 'Confirmation mot de passe*', ['type' => 'password']); ?>
    <?= $form->input('firstname', 'Nom'); ?>
    <?= $form->input('lastname', 'Prénom'); ?>
    <?= $form->input('bithdate', 'Date de naissance', ['type' => 'date']); ?>
    <?= $form->submit("S'inscrire"); ?>
</form>

<p>Déjà inscris ? Connecte-toi <a href="<?= $this->url('users.login') ?>">ici</a>.</p>