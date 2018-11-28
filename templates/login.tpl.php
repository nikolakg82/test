<h1>Login</h1>
<?php
if(!empty($objView->getErrorMessages()) || !empty($objView->getInfoMessages()))
    include ($objView->getMessageTemplate());
if(!is_array($objView->getUserData()))
{
    ?>
    <form method="post" action="/?view=login&func=send">
        <div class="Form">
            <div class="FieldTitle">Email</div>
            <div class="Field">
                <input type="email" name="email" required/>
            </div>
            <div class="FieldTitle">Password</div>
            <div class="Field">
                <input type="password" name="password" required/>
            </div>
            <div class="Button">
                <input type="submit" value="Submit"/>
            </div>
        </div>
    </form>
    <?php
}