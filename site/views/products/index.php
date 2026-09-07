<?php $titre = 'Liste des produits'; ?>
<?php require __DIR__ . '/../partials/header.php'; ?>
<h1>Liste des produits</h1>

<a class="add" href="/public/produits/create">+ Ajouter un produit</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th class="colPrix">Prix</th>
            <th class="colActions">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit): ?>
            <tr>
                <td><?= htmlspecialchars($produit['id']) ?></td>
                <td><?= htmlspecialchars($produit['nom']) ?></td>
                <td><?= htmlspecialchars($produit['description']) ?></td>
                <td class="colPrix"><?= htmlspecialchars($produit['prix']) ?> €</td>
                <td class="colActions">
                    <a href="/public/produits/<?= $produit['id'] ?>/edit"><img class="button edit icon" src="/images/stylo.png" alt="Modifier"></a>
                    <!-- <a href="https://www.flaticon.com/fr/icones-gratuites/creer" title="créer icônes">Créer icônes créées par riajulislam - Flaticon</a>-->

                    <form class="inline-form" method="POST" action="/public/produits/<?= $produit['id'] ?>/delete" onsubmit="return confirm('Confirmer la suppression ?');">
                        <button type="submit"><img class="button delete icon" src="/images/supprimer.png" alt="Supprimer"></button>
						
                        <!-- <a href="https://www.flaticon.com/fr/icones-gratuites/poubelle" title="poubelle icônes">Poubelle icônes créées par IYAHICON - Flaticon</a> -->
                    </form>
   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>