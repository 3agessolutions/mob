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

        public static function getVenueTypeName($venueType)
        {
          switch($venueType)
          {
              case 'A':
                  $venueTypeName = 'AC';
                  break;
              case 'N':
                  $venueTypeName = 'Non-AC';
                  break;
              case 'B':
                  $venueTypeName = 'Both';
                  break;
              default:
                  $venueTypeName = '';
          }

          return $venueTypeName;
        }

        public static function getVenueSpaceName($venueSpace)
        {
            switch($venueSpace)
            {
                case 'L':
                    $venueSpaceName = 'Lawn';
                    break;
                case 'B':
                    $venueSpaceName = 'Banquet';
                    break;
                default:
                    $venueSpaceName = '';
            }

            return $venueSpaceName;
        }
    }
