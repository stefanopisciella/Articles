<?php
require "vendor/bcosca/fatfree-core/base.php";

class MyView extends View {
    function render($file,$mime='text/html',array $hive=NULL,$ttl=0) {
        parent::render($file);
        // echo "OK";
    }

}

/*
class CustomView extends \View {

} */
