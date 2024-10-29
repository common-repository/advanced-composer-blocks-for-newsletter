<?php
/*
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls
 * @var $fields NewsletterFields
 */

// Don't access this file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$background = empty($options['block_background']) ? $composer['block_background'] : $options['block_background'];
$background = empty($options['background-color']) ? $background : $options['background-color'];
?>
<p>
    <a href="https://www.thenewsletterplugin.com/documentation/newsletters/newsletter-tags/" target="_blank">You can use tags to inject subscriber fields</a>.
</p>

<?php $fields->wp_editor( 'html', 'Content', [
	'text_font_family'  => $composer['text_font_family'],
	'text_font_size'    => $composer['text_font_size'],
	'text_font_weight'  => $composer['text_font_weight'],
	'text_font_color'   => $composer['text_font_color'],
    'background'		=> $background
] ) ?>

<div class="tnp-field-row">
    <div class="tnp-field-col-3">
        <?php $fields->size('border-radius', __('Border radius', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-3">
        <?php $fields->color('background-color', __('Background color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-3">
		<?php $fields->color('border-color', __('Border color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
</div>

<div class="tnp-field-row" style="padding: 10px;">
    <div class="tnp-field-col">
		<p style="margin: 0; font-size: 14px; font-weight: 300; padding-bottom: 5px; color: #666;">Padding</p>
		<table width="100%">
			<tr>
				<td><?php $fields->size('padding-left', __('&larr; Left', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('padding-top', __('&uarr; Top', 'advanced-composer-blocks-for-newsletter')) ?><?php $fields->size('padding-bottom', __('&darr; Bottom', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('padding-right', __('&rarr; Right', 'advanced-composer-blocks-for-newsletter')) ?></td>
			</tr>
		</table>
	</div>
</div>

<div class="tnp-field-row" style="padding: 10px;">
    <div class="tnp-field-col">
		<p style="margin: 0; font-size: 14px; font-weight: 300; padding-bottom: 5px; color: #666;">Border</p>
		<table width="100%">
			<tr>
				<td><?php $fields->size('border-left', __('&larr; Left', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('border-top', __('&uarr; Top', 'advanced-composer-blocks-for-newsletter')) ?><?php $fields->size('border-bottom', __('&darr; Bottom', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('border-right', __('&rarr; Right', 'advanced-composer-blocks-for-newsletter')) ?></td>
			</tr>
		</table>
	</div>
</div>

<div class="tnp-field-row" style="padding: 10px;">
    <div class="tnp-field-col">
		<p style="margin: 0; font-size: 14px; font-weight: 300; padding-bottom: 5px; color: #666;">Box shadow</p>
		<table width="100%">
			<tr>
				<td><?php $fields->color('box-shadow-color', __('Color', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('box-shadow-x', __('&harr; X-offset', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('box-shadow-y', __('&varr; Y-offset', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('box-shadow-blur', __('Blur', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('box-shadow-spread', __('Spread', 'advanced-composer-blocks-for-newsletter')) ?></td>
			</tr>
		</table>
	</div>
</div>

<hr style="clear:both; margin:20px 0;" />

<?php $fields->block_commons() ?>