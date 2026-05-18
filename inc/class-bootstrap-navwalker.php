<?php
class Bootstrap_Navwalker extends Walker_Nav_Menu {

function start_lvl(&$output, $depth = 0, $args = null) {
  $output .= '<ul class="dropdown-menu">';
}

function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {

  $classes = empty($item->classes) ? [] : (array) $item->classes;
  $has_children = in_array('menu-item-has-children', $classes);

  $classes[] = 'nav-item';
  if ($has_children) {
    $classes[] = 'dropdown';
  }

  $class_names = implode(' ', $classes);

  $output .= '<li class="' . esc_attr($class_names) . '">';

  $atts = '';
  $atts .= ' class="nav-link';

  if ($has_children && $depth === 0) {
    $atts .= ' dropdown-toggle"';
    $atts .= ' data-bs-toggle="dropdown" aria-expanded="false"';
  } else {
    $atts .= '"';
  }

  $atts .= ' href="' . esc_url($item->url) . '"';

  if ($item->target) {
    $atts .= ' target="' . esc_attr($item->target) . '" rel="noopener noreferrer"';
  }

  $title = apply_filters('the_title', $item->title, $item->ID);

  $output .= '<a' . $atts . '>' . $title . '</a>';
}
}