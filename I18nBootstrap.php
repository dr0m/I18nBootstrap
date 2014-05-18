<?php

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
    $thisfile,
    'I18nBootstrap',
    '0.1.0',
    'Luis Antonio',
    'https://github.com/luis-agn',
    'Use I18N with Bootstrap',
    '',
    ''
);

# ===== FRONTEND FUNCTIONS =====

function get_i18n_navigation_bootstrap($slug, $minlevel = 0, $maxlevel = 0, $show = I18N_SHOW_NORMAL, $component = null)
{
  require_once(GSPLUGINPATH.'i18n_navigation/frontend.class.php');
  require_once(GSPLUGINPATH.'I18nBootstrap/I18nNavigationFrontendBootstrap.php');
  I18nNavigationFrontendBootstrap::outputMenu($slug, $minlevel, $maxlevel, $show, $component);
}

