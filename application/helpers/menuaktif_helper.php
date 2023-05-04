<?php
function menuaktif($class = '')
{
    $ci = & get_instance();
    if ($ci->router->fetch_class() == $class) {
        return 'active';
    }
    return false;
}

?>