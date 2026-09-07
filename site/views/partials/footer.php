</main>

<footer class="site-footer">
    <p>&copy; <?= date('Y') ?> Exemple d'application MVC</p>
</footer>

<script>
    const description = document.getElementById('description');
    const formulaireProduit = document.querySelector('.product-form');

    if (description && formulaireProduit) {
        const verifierDescriptionRenseignee = () => {
            description.setCustomValidity('');

            if (description.value) {
                return;
            }

            description.setCustomValidity(
                'Il est conseillé de renseigner une description.'
            );
        };

        [description].forEach((champ) => {
            champ.addEventListener('input', verifierDescriptionRenseignee);
            champ.addEventListener('change', verifierDescriptionRenseignee);
        });
        formulaireProduit.addEventListener('submit', verifierDescriptionRenseignee);
    }
</script>
</body>

</html>