<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="header">
    <div class="header-top">
        <div class="date">
          <span><?php echo do_shortcode('[bangla_date]'); ?></span>
          <span><?php echo do_shortcode('[hijri_date]'); ?></span>
          <span><?php echo do_shortcode('[english_date]'); ?></span>
          <span><?php echo do_shortcode('[bangla_day]'); ?></span>
        </div>
        <div class="social-profiles">
          <ul>
            <li><a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a></li>
            <li><a href="https://twitter.com" target="_blank"><i class="bi bi-twitter-x"></i></a></li>
            <li><a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i></a></li>
            <li><a href="https://youtube.com" target="_blank"><i class="bi bi-youtube"></i></a></li>
          </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg  navbar-light">
      <a class="navbar-brand" href="<?php bloginfo('home') ?>">CBC NEWS BD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php
            wp_nav_menu( array(
                'theme_location' => 'primary_menu',
                'depth'          => 2,
                'menu_class'     => 'navbar-nav mr-auto mb-2 mb-lg-0',
                'walker'         => new Bootstrap_Navwalker(), // Use the custom walker
            ) );
          ?>
        <!-- <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
  </header>