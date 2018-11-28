<div class="MainContent">
    <div class="SiteWidth">
        <?php
            if(!empty($objView->getActiveTemplate()))
            {
                foreach ($objView->getActiveTemplate() as $val)
                    include ($val);
            }

        ?>
    </div>
</div>