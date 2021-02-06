<?php
/**************************************
 * Define templates directory constant
 **************************************/
define( 'RED_TEMPLATES_DIR', get_template_directory() . '/templates' );

/**************************************
 * Require templates
 **************************************/

/**
 * Semantic Grid Header.
 */
require_once RED_TEMPLATES_DIR . '/header/header-default.php';

/**
 * Semantic Grid Footer.
 */
require_once RED_TEMPLATES_DIR . '/footer/footer-default.php';
