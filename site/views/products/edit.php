<?php $titre = 'Modifier le produit'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<h1>Modifier le produit</h1>

<form class="product-form edit-form" method="POST" action="/public/produits/<?= $produit['id'] ?>/edit">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3"><?= htmlspecialchars($produit['description']) ?></textarea>

    <label for="prix">Prix (€)</label>
    <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>" required>

    <button type="submit">Mettre à jour</button>
</form>

<p><a href="/public/produits">&larr; Retour à la liste</a></p>
<?php require __DIR__ . '/../partials/footer.php'; ?>