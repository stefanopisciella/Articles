<?php
class MyView extends \View {
    public function render($file, $mime='text/html', array $hive=NULL, $ttl=0) {
        parent::render($file, $mime, $hive, $ttl);
    }
}

/*
class CustomView extends \View {

} */
