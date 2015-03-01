<?php

class AlbumUrlRule extends CBaseUrlRule
{
    
    public $connectionId = 'db';

    /**
     * Store already looked up usernames
     * 
     * @var Array
     */
    private static $loadedUserNamesByGuid = array();
    
    public function createUrl($manager, $route, $params, $ampersand)
    {

        $format = $manager->urlFormat;
        if (isset($params['username'],$params['id']) && substr($route, 0, 5) == "album") {
            if ($format == 'path') {
                $userName = $params['username'];
                $url = urlencode(strtolower($userName)) . "/" . $route . "/" . $params['id'];
                return $url;
            } else {
                unset($params['username']);
                return count($params) > 0 ? 
                '?' . $manager->routeVar . '=' . $route . $ampersand . $manager->createPathInfo($params, '=', $ampersand) 
                    : 
                '?' . $manager->routeVar . '=' . $route;
            }
            
        } elseif (isset($params['username']) && substr($route, 0, 5) == "album") {
            if ($format == 'path') {
                $userName = $params['username'];
                $url = urlencode(strtolower($userName)) . "/" . $route;
                return $url;
            } else {
                unset($params['username']);
                return count($params) > 0 ? 
                '?' . $manager->routeVar . '=' . $route . $ampersand . $manager->createPathInfo($params, '=', $ampersand)
                    :
                '?' . $manager->routeVar . '=' . $route;
            }
        }

        return false;
    }
    
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        
        $parts = explode('/', $pathInfo, 3);
        /**
         * $parts[0] username from $pathInfo
         * $parts[1] album from $pathInfo
         * $parts[2] rest of $pathInfo
         */
        if (isset($parts[1]) && $parts[1] == 'album') {

            $user = User::model()->findByAttributes(array('username' => $parts[0]));

            if ($user !== null) {
                $_GET['uguid'] = $user->guid;
                
                if (!isset($parts[2])) {
                    return $parts[1];
                }
                
                $parts = explode('/',$parts[2]);
                $total_parts = count($parts);
                if ($total_parts == 3) {
                    /**
                     * $part[0] controller
                     * $part[1] action
                     * $part[2] id
                     */
                    $_GET['id'] = $parts[2];
                    return 'album/'. $parts[0] . '/'. $parts[1];
                } elseif ($total_parts == 2) {
                    if (ctype_digit($parts[1])) {
                       /**
                        * $part[0] controller
                        * $part[1] id
                        */
                       $_GET['id'] = $parts[1];
                       return 'album/'. $parts[0];
                    } else {
                       /**
                        * $part[0] controller
                        * $part[1] action
                        */
                       return 'album/'. $parts[0] .'/'.$parts[1];
                    }
                    
                } elseif ($total_parts == 1) {
                    /**
                     * $part[0] action
                     */
                    return 'album/' . $parts[0];
                }
            }
        }
        return false;
    }

    /**
     * Looks up username by given user guid
     * 
     * @param String $guid of user
     * @return Username
     * @throws CException when user not found
     */
    public static function getUserNameByGuid($guid)
    {

        if (isset(self::$loadedUserNamesByGuid[$guid])) {
            return self::$loadedUserNamesByGuid[$guid];
        }

        $user = User::model()->resetScope()->findByAttributes(array('guid' => $guid));
        
        if ($user != null) {
            self::$loadedUserNamesByGuid[$guid] = $user->username;
            return self::$loadedUserNamesByGuid[$guid];
        } else {
            throw new CException("Could not find user by uguid!");
        }

        return "";
    }
}