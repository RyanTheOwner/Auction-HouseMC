<?php
/**
*   ____                  ________         ____                          
   / __ \__  ______ _____/_  __/ /_  ___  / __ \_      ______  ___  _____
  / /_/ / / / / __ `/ __ \/ / / __ \/ _ \/ / / / | /| / / __ \/ _ \/ ___/
 / _, _/ /_/ / /_/ / / / / / / / / /  __/ /_/ /| |/ |/ / / / /  __/ /    
/_/ |_|\__, /\__,_/_/ /_/_/ /_/ /_/\___/\____/ |__/|__/_/ /_/\___/_/     
      /____/                                                             
*/

namespace RyanTheOwner;

class Utils {

    /**
    * Returns the first free key of an array.
    * @return int.
    */
    public static function getFreeKey($array) : int {
        $i = 0;
        while (isset($array[$i])) $i++;
        return $i;
    }
}
