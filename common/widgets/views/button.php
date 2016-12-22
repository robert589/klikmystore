<?php

?>

<button id="<?= $id ?>" class="<?= $class ?>" >
    <?php if($iconClass !== '') { ?>
        <div class="<?= $iconClass ?>"></div>
    <?php } ?>
        <?= $text ?>
</button>