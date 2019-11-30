<?php

class BaseController {
    protected $sPageTitle = 'Base';
    protected $sClassDir = '';
    protected $arActions = array();

    public function renderView($sViewName, $arParams = null){
        if (isset($arParams)){
            extract($arParams, EXTR_SKIP);
        }

        $sViewPath = $this->sClassDir . '/../views/' . $sViewName . '.php';

        require CONST_SITE_BASE_PATH . '/views/layout.php';
    }

    public function actionNotFound(){
        require CONST_SITE_BASE_PATH . '/views/404.php';
    }

    public function getActions(){
        return $this->arActions;
    }
}