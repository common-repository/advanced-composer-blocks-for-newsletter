<?php
/* @var $options array It contains all the options of the current block, but usually there is no need to access it directly */
/* @var $fields NewsletterFields */

/**
 * This is a simple options panel for a Newsletter Composer Block.
 * $fields contains many useful methods to create controls in a easy way.
 */

 // Don't access this file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php $controls->hidden('placeholder') ?>
<?php $fields->media('image', 'Choose an image', array('alt' => false)) ?>
<?php $fields->url('image-url', 'or full path to an external image') ?>
<?php $fields->text('image-alt', 'Alternative text') ?>
<?php $fields->url('url', __('Link URL (if you want to link the image)', 'advanced-composer-blocks-for-newsletter')) ?>

<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->size('width', __('Width', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->align() ?>
    </div>
</div>

<hr style="clear:both; margin: 20px 0;" />

<div class="tnp-field-row" style="padding: 10px;">
    <div class="tnp-field-col">
        <?php $fields->size('border-radius', __('Border radius', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
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

<hr style="clear:both;" />

<?php $fields->block_commons() ?>
