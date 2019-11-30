<?php

class Router {
    private static $sIndexModule = 'dashboard';
    private static $sIndexController = 'DashboardController';

    public static function route(string $sRouteName = ''){
        // Return site file if requested and end
        $arMatches = preg_match('/\.(map|css)$/', $sRouteName);
        if ($arMatches)
            return;
        
        // Get the default controller
        $sIndexClassPath = CONST_SITE_BASE_PATH . '/modules/' . self::$sIndexModule . '/controllers/' . self::$sIndexController;
        require_once $sIndexClassPath . '.php';

        // Render base controller index
        if (empty($sRouteName) || $sRouteName == '/'){
            $oIndexController = new self::$sIndexController();
            $oIndexController->actionIndex();
            return;
        }else{  // find the correct controller and action
            $arParts = explode('/', $sRouteName);
            // [0] => '', [1] => module, [2] controller, [3] action

            $iPartsCount = count($arParts);

            if ($iPartsCount < 2 || empty($arParts[1])){
                $oIndexController = new self::$sIndexController();
                $oIndexController->actionNotFound();
                return;
            }

            // Parse the module from the route path
            $sModule = '';
            if ($iPartsCount > 1 && array_key_exists($arParts[1], CONST_MODULES)){
                $sModule = $arParts[1];
            }

            // Parse the controller from the route path - May be empty -> use DefaultController
            $sController = '';
            if ($iPartsCount > 2 && $sModule){
                $sController = ucfirst($arParts[2]) . 'Controller';
                if (!in_array($sController, CONST_MODULES[$sModule])){
                    $sController = '';
                }
            }

            $oController = self::_getController($sModule, $sController);

            // Check if valid Controller found
            if (empty($oController)){
                Logger::log("Controller was not found...");
                $oIndexController = new self::$sIndexController();
                $oIndexController->actionNotFound();
                return;
            }

            // Parse action
            $sAction = '';
            if ($iPartsCount > 3 && in_array($arParts[3], $oController->getActions())){
                $sAction = 'action' . ucfirst($arParts[3]);
            }

            // If no valid action found, use index
            if (empty($sAction)){
                $sAction = 'actionIndex';
            }

            $oController->$sAction();
        }
    }

    private static function _getController($sModule, $sController){
        if (empty($sModule)){
            return null;
        }

        if (empty($sController)){
            $sController = 'DefaultController';
        }

        // Try to find class
        $sClassPath = CONST_SITE_BASE_PATH . '/modules/' . $sModule . '/controllers/' . $sController . '.php';
        
        if (include_once $sClassPath){
            return new $sController();
        }

        return null;
    }
}