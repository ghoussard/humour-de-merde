<h1>Proposer une blague</h1>

<form action="" method="post">
    <?= $form->select('category', 'Catégorie', $categories) ?>
    <?= $form->textarea('content', 'Intitulé') ?>
    <?= $form->submit() ?>
</form>