<?php

?>

<button id="<?= $id ?>" class="<?= $class ?>" <?= $optionText ?> >
    <?php if($iconClass !== '') { ?>
        <div class="<?= $iconClass ?>"></div>
    <?php } ?>
        <?= $text ?>
</button>