<?php

/*
 * Template Name: Strona tekstowa
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$context = Timber::get_context();
$post = new TimberPost();

$templates = array( 'page-text.twig' );

Timber::render( $templates, $context );