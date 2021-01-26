<?php require_once 'card-gallery.css.php'; ?>
<ul class="card-gallery">
<?php
    foreach ($cards as $cardId => $cardInfo) {
        ui('gallery-card', $cardInfo);
    }
?>
</ul>