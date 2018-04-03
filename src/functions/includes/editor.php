<?php


/*
Block Color Palettes: #Block Color Palettes:
Different blocks have the possibility of customizing colors. Gutenberg provides a default palette, but a theme can overwrite it and provide its own:
*/

add_theme_support( 'editor-color-palette',
  '#a156b4',
  '#d0a5db',
  '#eee',
  '#444'
);


/*
Disabling custom colors in block Color Palettes #Disabling custom colors in block Color Palettes
By default, the color palette offered to blocks, allows the user to select a custom color different from the editor or theme default colors.
Themes can disable this feature using:
*/
add_theme_support( 'disable-custom-colors' );
