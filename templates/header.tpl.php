<div class="Header">
    <div class="SiteWidth">
        <div class="Left">
            <a href="/"><img src="/design/images/logo.gif" /></a>
        </div>
        <div class="Right">
            <a href="/">Home</a> |
            <?php
            if(!is_array($objView->getUserData()))
                {
            ?>
                <a href="/?view=register">Register</a> | <a href="/?view=login">Login</a>
            <?php
                }
                else
                {
            ?>
                    <a href="/?func=logout">Logout</a>
            <?php
                }
            ?>
            | <a href="/?view=search">Search</a>
            <?php
            if(is_array($objView->getUserData()))
                echo '<div class="Welcome">Welcome ' . $objView->getUserData()['name'] . '</div>';
            ?>
        </div>
        <div class="Clear"></div>
    </div>
</div>