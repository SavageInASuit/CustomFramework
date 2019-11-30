<?php

require_once CONST_BASE_CONTROLLER_PATH;

class DashboardController extends BaseController {
    protected $sPageTitle = 'Dashboard';
    protected $sClassDir = __DIR__;

    public function __construct__(){
        parent::__construct();

        $this->arActions = array('index');
    }

    public function actionIndex(){
        $this->renderView('index', array('name' => 'Savage'));
    }
}