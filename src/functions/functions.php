<?php

$includes = [
  'setup',
  'scripts',
  'output',
  'menus',
  'widgets',
  'widget-areas',
  'features',
  'helper',
  'template-tags',
  'shortcodes',
  'editor',
  'misc',
  // 'metabox',
  'custom-fields',
  'customization',
  'admin'
];

foreach ($includes as $file) {
  if (!$filepath = locate_template('includes/' . $file . '.php')) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'imagegrid'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);
