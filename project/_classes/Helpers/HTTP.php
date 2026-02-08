<?php

namespace Helpers;

class HTTP
{
    static $base = "http://localhost/project";

    static function redirect($page, $q = "")
    {
        $url = static::$base . $page;
        if($q) $url .= "?$q";

        header("location: $url");
        exit();
    }
}
