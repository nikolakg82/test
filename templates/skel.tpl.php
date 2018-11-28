<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $objView->getPageTitle(); ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link href="/design/css/css.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php
            include ($objView->getHeaderTemplates());
            include ($objView->getContentTemplates());
            include ($objView->getFooterTemplates());
        ?>
    </body>
</html>

