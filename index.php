<?php
define('APP_ROOT', realpath(dirname(__FILE__)));
define('APP_TEMPLATES', APP_ROOT . '/templates/');
define('APP_CLASS', APP_ROOT . '/class/');
define('APP_CONFIG', APP_ROOT . '/config/');

try{
    //Include class
    require_once (APP_CLASS . 'view.php');
    require_once (APP_CLASS . 'user.php');

    $objView = new View();
    $objUser = new User();

    //Get user from session
    $objUser->getUserFromSession();
    if(is_array($objUser->getUserData()))
        $objView->setUserData($objUser->getUserData());

    if(isset($_GET['func']) && $_GET['func'] == 'logout')
        $objUser->logoutUser();

    if(isset($_GET['view']) && !empty($_GET['view']))
    {
        // If user login can't register or login
        if(empty($objView->getUserData()))
        {
            if($_GET['view'] == 'register')
            {
                if(isset($_GET['func']) && !empty($_GET['func']) && $_GET['func'] == 'send')
                {
                    if($objUser->validateData($_POST))
                    {
                        if($objUser->isUserExist($_POST['email']))
                            $objView->setErrorMessage(array('User already exist'));
                        else
                        {
                            if ($objUser->registerUser($_POST))
                                $objView->setInfoMessage(array('Your data is saved, please login'));
                            else
                                $objView->setErrorMessage(array('Error with database'));
                        }
                    }
                    else
                        $objView->setErrorMessage($objUser->getValidateMessages());
                }

                $objView->setPageTitle("Register user");
                $objView->setActiveTemplate(APP_TEMPLATES . 'register.tpl.php');
            }
            elseif ($_GET['view'] == 'login')
            {
                if (isset($_GET['func']) && !empty($_GET['func']) && $_GET['func'] == 'send')
                {
                    if ($objUser->validateData($_POST))
                    {
                        if ($objUser->loginUser($_POST))
                        {
                            $objView->setUserData($objUser->getUserData());
                            $objView->setInfoMessage(array('Welcome ' . $objView->getUserData()['name']));
                        }
                        else
                            $objView->setErrorMessage(array('User not exist'));
                    }
                    else
                        $objView->setErrorMessage($objUser->getValidateMessages());
                }
                $objView->setPageTitle("Login user");
                $objView->setActiveTemplate(APP_TEMPLATES . 'login.tpl.php');
            }
        }

        if($_GET['view'] == 'search')
        {
            $objView->setActiveTemplate(APP_TEMPLATES . 'search.tpl.php');

            if (isset($_GET['func']) && !empty($_GET['func']) && $_GET['func'] == 'send')
            {
                if(empty($objView->getUserData()))
                {
                    $objView->setInfoMessage(array('Please login'));
                    $objView->setActiveTemplate(APP_TEMPLATES . 'login.tpl.php');
                }
                else
                {
                    $arrSearchData = $objUser->searchUser($_POST['search_word']);

                    if(isset($arrSearchData) && !empty($arrSearchData))
                        $objView->setActiveTemplate(APP_TEMPLATES . 'search_result.tpl.php');
                    else
                        $objView->setErrorMessage(array('No search result'));
                }
            }

            $objView->setPageTitle("Search form");
        }

    }
    else
    {
        $objView->setPageTitle("Index page");
        $objView->setActiveTemplate(APP_TEMPLATES . 'home.tpl.php');
    }

    //Include templates
    include ($objView->getSkelTemplates());
}catch (Exception $msg)
{
    echo $msg;
}