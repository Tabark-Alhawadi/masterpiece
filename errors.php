<?php if(count ($errors) > 0) : ?>
    <div>
        <?php foreach ($errors as $srror):?>
            <p><?php echo $error?></p>
        <?php endforeach ?>
    </div>
    <?php endif ?>