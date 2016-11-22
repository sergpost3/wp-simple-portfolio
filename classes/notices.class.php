<?php

namespace Simpo;

class Notices
{
    public static function error( $data, $class = '' ) {
        echo "<div class='error notice is-dismissible " . $class . "'><p>";
        echo $data;
        echo "</div></p>";
    }
}