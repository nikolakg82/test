<div class="Message">
    <?php
    if(!empty($objView->getErrorMessages()))
    {
        foreach ($objView->getErrorMessages() as $key => $val)
            echo "$val <br />";
    }

    if(!empty($objView->getInfoMessages()))
    {
        foreach ($objView->getInfoMessages() as $key => $val)
            echo "$val <br />";
    }
    ?>
</div>