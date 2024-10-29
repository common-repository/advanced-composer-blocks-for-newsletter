<?php
/*
 * Name: Image+
 * Section: content
 * Description: Extended image block
 */

/* @var $options array */

// Don't access this file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// On future releases of Newsletter, default options will be part of the options.php
// file, it is the best place to have them. By now, be patience.

// The "block_*" options are reserved and could be processed dutrectly by Newsletter. For example the
// "block_background" and "block_padding_*" are used to generated the wrapper of the block content.

$defaults = array(
    'image' => '',
    'image-alt' => '',
    'url' => '',
    'width' => 0,
	'border-radius' => '7',
	'box-shadow-x' => '0',
	'box-shadow-y' => '0',
	'box-shadow-blur' => '0',
	'box-shadow-spread' => '0',
	'box-shadow-color' => '#ffffff',
    'align' => 'center',
    'block_background' => '',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);

$options = array_merge($defaults, $options);

if (empty($options['image']['id'])) {
    if ( !empty($options['image-url']) ) {
        $media = new TNP_Media();
        $media->url = $options['image-url'];
        $media->width = $composer['width'];
    } else {
        $media = new TNP_Media();
        // A placeholder can be set by a preset and it is kept indefinitely
        if ( !empty($options['placeholder']) ) {
            $media->url = $options['placeholder'];
            $media->width = $composer['width'];
            $media->height = 250;
        } else {
            $media->url = esc_url( MBTNP_PLUGIN_URL . '/images/placeholder-image.jpg' );
            $media->width = $composer['width'];
            $media->height = 250;
        }
    }
} else {
    $media = tnp_resize_2x($options['image']['id'], [$composer['width'], 0]);
    // Should never happen but... it happens
    if (!$media) {
        echo 'The selected media file cannot be processed';
        return;
    }
}

if (!empty($options['width'])) {
    $media->set_width( $options['width'] );
}
$media->link = $options['url'];
$media->alt = $options['image-alt'];
$media->border_radius = $options['border-radius'];

echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="', esc_attr( $options['align'] ), '">';

if ( $media->link ) {
     echo '<a href="', esc_url( $media->link ), '" target="_blank" rel="noopener nofollow" style="display: block; font-size: 0; text-decoration: none; line-height: normal !important;">';
} else {
}

echo '<img src="', esc_url( $media->url ), '" width="', esc_attr( $media->width ), '"';
if ( $media->height ) {
    echo ' height="', esc_attr( $media->height ), '"';
}
echo ' alt="', esc_attr( $media->alt ), '"';
// The font size is important for the alt text
echo ' border="0" style="display: block; height: auto; max-width: ', esc_attr( $media->width ), 'px !important; width: 100%; padding: 0; border: 0; font-size: 12px;';
if( $media->border_radius ){
	echo ' border-radius: ' . esc_attr( $media->border_radius ) . 'px;';
}
if( $options['box-shadow-x'] || $options['box-shadow-y'] || $options['box-shadow-blur'] || $options['box-shadow-spread'] || $options['box-shadow-color'] ){

	if( empty($options['box-shadow-x']) ){ $options['box-shadow-x'] = '0'; }
	if( empty($options['box-shadow-y']) ){ $options['box-shadow-y'] = '0'; }
	if( empty($options['box-shadow-blur']) ){ $options['box-shadow-blur'] = '0'; }
	if( empty($options['box-shadow-spread']) ){ $options['box-shadow-spread'] = '0'; }
	if( empty($options['box-shadow-color']) ){ $options['box-shadow-color'] = '#000000'; }

	echo ' box-shadow: ' . esc_attr( $options['box-shadow-x'] ) . 'px ' . esc_attr( $options['box-shadow-y'] ) . 'px ' . esc_attr( $options['box-shadow-blur'] ) . 'px ' . esc_attr( $options['box-shadow-spread'] ) . 'px ' . esc_attr( $options['box-shadow-color'] ) . ';';
}
echo '">';

if ( $media->link ) {
    echo '</a>';
} else {
}

echo '</td></tr></table>';