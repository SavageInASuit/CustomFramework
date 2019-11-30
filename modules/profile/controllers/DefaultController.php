<?php

require_once CONST_BASE_CONTROLLER_PATH;

class DefaultController extends BaseController {
    protected $sPageTitle = 'Default';
    protected $sClassDir = __DIR__;

    public function __construct__(){
        parent::__construct();

        $this->arActions = array('index',);
    }

    public function actionIndex(){
        echo '<h1>This is the default controller</h1>';
    }

    
}