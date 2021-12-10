<?php

?>
<div class="errordiv" id="errordiv">
    <?php if (isset($erros)) : ?>
        <?php foreach ($erros as $error) : ?>
            <p> <?php echo $error ?> </p>
        <?php endforeach ?>
    <?php endif ?>
</div>
