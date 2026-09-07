<?php
$titre = 'Ajouter un produit';
require_once __DIR__ . '/../partials/header.php';
?>

<h1>Ajouter un produit</h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form class="product-form" method="POST" action="/public/produits/create">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" required>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3"></textarea>

    <label for="prix">Prix (€)</label>
    <input type="number" id="prix" name="prix" step="0.01" required>

    <button type="submit">Enregistrer</button>
</form>

<p><a href="/public/produits">&larr; Retour à la liste</a></p>
<?php require __DIR__ . '/../partials/footer.php'; ?>