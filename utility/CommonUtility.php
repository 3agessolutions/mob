<?php
    namespace app\utility;
    
    class CommonUtility
    {
        public static function getCategoryActionUrl($action) 
        {
            $categoryAction = '';
            $action = strtolower($action);
            
            switch($action)
            {
                case 'venues':
                    $categoryAction = 'venues';
                    break;
                default:
                    $categoryAction = $action;
            }
                          
            return $categoryAction;
        }
    }