<h1>Register user</h1>
<?php
if(!empty($objView->getErrorMessages()) || !empty($objView->getInfoMessages()))
    include ($objView->getMessageTemplate());
?>
<form method="post" action="/?view=register&func=send">
    <div class="Form">
        <div class="FieldTitle">Email</div>
        <div class="Field">
            <input type="email" name="email" required />
        </div>
        <div class="FieldTitle">Name</div>
        <div class="Field">
            <input type="text" name="name" required />
        </div>
        <div class="FieldTitle">Password</div>
        <div class="Field">
            <input type="password" name="password" required />
        </div>
        <div class="FieldTitle">Repeat password</div>
        <div class="Field">
            <input type="password" name="repeat_password" required />
        </div>
        <div class="Button">
            <input type="submit" value="Submit" />
        </div>
    </div>
</form>