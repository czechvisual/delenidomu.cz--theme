<?php
/**
 * Template for header
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

namespace acdfevelop;

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'no-js' ); ?>>

<div id="page" class="site">
    <header id="header" class="site-header">
        <div class="container inner">
            <?php get_template_part( 'partials/header/branding' ); ?>
            <?php get_template_part( 'partials/header/navigation' ); ?>
        </div>
    </header>


    <div class="site-content">
