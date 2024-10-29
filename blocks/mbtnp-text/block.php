<?php
/*
 * Name: Text+
 * Section: content
 * Description: Extended text block
 *
 */

// Don't access this file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/* @var $options array */

$default_options = array(
    'html'=>'<p>Insert your text here.</p>',
    'font_family'=>'',
    'font_size'=>'',
    'font_color'=>'',
    'block_padding_left'=>15,
    'block_padding_right'=>15,
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
    'block_background'=>'#eeeeee'
);

$options = array_merge($default_options, $options);

$text_style = TNP_Composer::get_style($options, '', $composer, 'text');

?>
<style>
    .text {
        mso-line-height-rule: exactly;
        <?php echo esc_html( $text_style->echo_css() ) ?>
        line-height: 1.5;
		<?php if( $options['background-color'] ){ ?>
			background-color: <?php echo esc_attr( $options['background-color'] ); ?>;
		<?php } ?>
		<?php if( $options['padding-top'] ){ ?>
			padding-top: <?php echo esc_attr( $options['padding-top'] ); ?>px;
		<?php } ?>
		<?php if( $options['padding-bottom'] ){ ?>
			padding-bottom: <?php echo esc_attr( $options['padding-bottom'] ); ?>px;
		<?php } ?>
		<?php if( $options['padding-left'] ){ ?>
			padding-left: <?php echo esc_attr( $options['padding-left'] ); ?>px;
		<?php } ?>
		<?php if( $options['padding-right'] ){ ?>
			padding-right: <?php echo esc_attr( $options['padding-right'] ); ?>px;
		<?php } ?>
		<?php if( $options['border-color'] ){ ?>
			border-color: <?php echo esc_attr( $options['border-color'] ); ?>;
		<?php } ?>
		<?php if( $options['border-top'] ){ ?>
			border-top-width: <?php echo esc_attr( $options['border-top'] ); ?>px;
			border-top-style: solid;
		<?php } ?>
		<?php if( $options['border-right'] ){ ?>
			border-right-width: <?php echo esc_attr( $options['border-right'] ); ?>px;
			border-right-style: solid;
		<?php } ?>
		<?php if( $options['border-bottom'] ){ ?>
			border-bottom-width: <?php echo esc_attr( $options['border-bottom'] ); ?>px;
			border-bottom-style: solid;
		<?php } ?>
		<?php if( $options['border-left'] ){ ?>
			border-left-width: <?php echo esc_attr( $options['border-left'] ); ?>px;
			border-left-style: solid;
		<?php } ?>
		<?php if( $options['border-radius'] ){ ?>
			border-radius: <?php echo esc_attr( $options['border-radius'] ); ?>px;
		<?php } ?>

		<?php if( $options['box-shadow-x'] || $options['box-shadow-y'] || $options['box-shadow-blur'] || $options['box-shadow-spread'] || $options['box-shadow-color'] ){

			if( empty($options['box-shadow-x']) ){ $options['box-shadow-x'] = '0'; }
			if( empty($options['box-shadow-y']) ){ $options['box-shadow-y'] = '0'; }
			if( empty($options['box-shadow-blur']) ){ $options['box-shadow-blur'] = '0'; }
			if( empty($options['box-shadow-spread']) ){ $options['box-shadow-spread'] = '0'; }
			if( empty($options['box-shadow-color']) ){ $options['box-shadow-color'] = '#000000'; }

			echo ' box-shadow: ' . esc_attr( $options['box-shadow-x'] ) . 'px ' . esc_attr( $options['box-shadow-y'] ) . 'px ' . esc_attr( $options['box-shadow-blur'] ) . 'px ' . esc_attr( $options['box-shadow-spread'] ) . 'px ' . esc_attr( $options['box-shadow-color'] ) . ';';
		} ?>
    }
</style>

<table width="100%" style="width: 100% !important;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="100%" valign="top" align="left" class="text" inline-class="text">
            <?php echo wp_kses_post( $options['html'] ); ?>
        </td>
    </tr>
</table>