<?php

/*
 * Template Name: Kontakt
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$context = Timber::get_context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$templates = array( 'page-contact.twig' );

Timber::render( $templates, $context );