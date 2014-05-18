<?php

class I18nNavigationFrontendBootstrap extends I18nNavigationFrontend
{
	public static function getMenuHTMLImpl(&$menu, $showTitles = false, $component = null)
	{
	    $html = '';
	    foreach ($menu as &$item) {
	      if (!isset($component)) {
	        $href = @$item['link'] ? $item['link'] : (function_exists('find_i18n_url') ? find_i18n_url($item['url'],$item['parent']) : find_url($item['url'],$item['parent']));
	      }
	      $urlclass = (preg_match('/^[a-z]/i',$item['url']) ? '' : 'x') . $item['url'];
	      $parentclass = !$item['parent'] ? '' : (preg_match('/^[a-z]/i',$item['parent']) ? ' ' : ' x') . $item['parent'];
	      $classes = $urlclass . $parentclass.
	                  ($item['current'] ? ' current' : ($item['currentpath'] ? ' currentpath' : '')).
	                  (isset($item['children']) && count($item['children']) > 0 ? ' dropdown' : ($item['haschildren'] ? ' closed' : ''));
	      $text = $item['menu'] ? $item['menu'] : $item['title'];
	      $title = $item['title'] ? $item['title'] : $item['menu'];

	      if (isset($item['children']) && count($item['children']) > 0)
	        // $dropdown = 'class="dropdown-toggle" data-toggle="dropdown"';
	        $dropdown = 'class="dropdown-toggle"';
	      else
	        $dropdown = '';

	      if (isset($component)) {
	        $navitem = new I18nNavigationItem($item, $classes, $text, $title, $showTitles, $component);
	        $html .= self::getMenuItem($component, $navitem);
	      } else {
	        if ($showTitles) {
	          $html .= '<li class="' . $classes . '" ><a href="' . $href . '" '.$dropdown.'>' . $title . '</a>';
	        } else {
	          $html .= '<li class="' . $classes . '"><a href="' . $href . '" '.$dropdown.' title="' . htmlspecialchars(html_entity_decode($title, ENT_QUOTES, 'UTF-8')) . '">' . $text . '</a>';
	        }
	        if (isset($item['children']) && count($item['children']) > 0) {
	          $html .= '<ul class="dropdown-menu">' . self::getMenuHTMLImpl($item['children'], $showTitles, $component) . '</ul>';
	        }
	        $html .= '</li>' . "\n";
	      }
	    }
	    return $html;
	}
}
