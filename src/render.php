<?php

//function to render the template
function render(string $template, array $data=[]):string{
    if($data){
        extract($data, EXTR_OVERWRITE); //transform the associative array into a variable
    }
    ob_start(); //initialize the buffer
    require 'src/views/'.$template.'.tpl.php';
    $rendered = ob_get_clean(); //gets the buffer and renders it 
    return (string)$rendered;
}