<?php
class View
{
    //Structure templates
    protected $_skelTemplate = APP_TEMPLATES . 'skel.tpl.php';
    protected $_headerTemplate = APP_TEMPLATES . 'header.tpl.php';
    protected $_contentTemplate = APP_TEMPLATES . 'content.tpl.php';
    protected $_footerTemplate = APP_TEMPLATES . 'footer.tpl.php';
    protected $_messageTemplate = APP_TEMPLATES . 'message.tpl.php';

    //Active templates with content
    protected $_activeTemplate = array();
    //Messages
    protected $_errorMessages = array();
    protected $_infoMessages = array();

    //User data if logged
    protected $_userData;

    //Title of the site
    protected $_pageTitle;

    //Setters
    public function setActiveTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_activeTemplate[$strPath] = $strPath;

        return $this;
    }

    public function setSkelTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_skelTemplate = $strPath;

        return $this;
    }

    public function setHeaderTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_headerTemplate = $strPath;

        return $this;
    }

    public function setContentTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_contentTemplate = $strPath;

        return $this;
    }

    public function setFooterTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_footerTemplate = $strPath;

        return $this;
    }

    public function setMessageTemplate($strPath)
    {
        if(!isset($strPath) || empty($strPath))
            throw new Exception('There is no path to the template');

        if(!file_exists($strPath))
            throw new Exception('Template does not exist on the path ' . $strPath);

        $this->_messageTemplate = $strPath;

        return $this;
    }

    public function setPageTitle($strTitle)
    {
        if(!is_string($strTitle))
            throw new Exception('Invalid format to page title');

        $this->_pageTitle = $strTitle;

        return $this;
    }

    public function setErrorMessage($arrMessages)
    {
        $this->_errorMessages = $arrMessages;

        return $this;
    }

    public function setInfoMessage($arrMessages)
    {
        $this->_infoMessages = $arrMessages;

        return $this;
    }

    public function setUserData($arrData)
    {
        if(!is_array($arrData))
            throw new Exception('Not valid format for user data');

        $this->_userData = $arrData;

        return $this;
    }


    //Gets
    public function getActiveTemplate()
    {
        return $this->_activeTemplate;
    }

    public function getSkelTemplates()
    {
        return $this->_skelTemplate;
    }

    public function getHeaderTemplates()
    {
        return $this->_headerTemplate;
    }

    public function getContentTemplates()
    {
        return $this->_contentTemplate;
    }

    public function getFooterTemplates()
    {
        return $this->_footerTemplate;
    }

    public function getMessageTemplate()
    {
        return $this->_messageTemplate;
    }

    public function getPageTitle()
    {
        return $this->_pageTitle;
    }

    public function getErrorMessages()
    {
        return $this->_errorMessages;
    }

    public function getInfoMessages()
    {
        return $this->_infoMessages;
    }

    public function getUserData()
    {
        return $this->_userData;
    }
}