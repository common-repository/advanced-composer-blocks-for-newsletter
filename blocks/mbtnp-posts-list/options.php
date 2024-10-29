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
?>

<?php
// get all post type options
$post_types = get_post_types( array( 'public' => true ), 'objects' );
$post_type_options = [];
foreach($post_types as $post_type){
	$post_type_options[$post_type->name] = $post_type->label;
}

// get all thumbnail size options
$image_sizes = wp_get_registered_image_subsizes();
$image_size_options = ['none' => 'None'];
foreach($image_sizes as $name => $details){
	$image_size_options[$name] = ucfirst(str_replace('_', ' ', $name)) . ' (' . $details['width'] . 'x' . $details['height'] . ')';
}
$image_size_options['full'] = 'Full';
?>

<div class="tnp-field-row">
	<div class="tnp-field-col-3">
		<?php $fields->select('post_type', __('Post type'), $post_type_options) ?>
	</div>
	<div class="tnp-field-col-3">
		<?php $fields->select('post_order', __('Post order'), ['title_asc' => 'Title ASC', 'title_desc' => 'Title DESC', 'date_asc' => 'Post date ASC', 'date_desc' => 'Post date DESC']) ?>
	</div>
	<div class="tnp-field-col-3">
		<?php $fields->number('number_posts', __('Number of posts'), ['min' => 1]) ?>
	</div>
</div>

<p class="mbtnp-section-title">Featured images</p>
<div class="tnp-field-row">
		<div class="tnp-field-col-2">
			<?php $fields->select('image_size', __('Image size'), $image_size_options) ?>
		</div>
		<div class="tnp-field-col-2" id="o-link_images">
			<?php $fields->checkbox('link_images', __('Link image to post')) ?>
		</div>
</div>

<div class="tnp-field-row">
		<div class="tnp-field-col-2" id="o-image_align">
			<?php $fields->select('image_align', __('Align'), ['left' => 'Left', 'center' => 'Center', 'right' => 'Right']) ?>
		</div>
		<div class="tnp-field-col-2" id="o-border_radius">
			<?php $fields->size('border_radius', __('Border radius', 'advanced-composer-blocks-for-newsletter')) ?>
		</div>
</div>

<p class="mbtnp-section-title">Titles</p>
<div class="tnp-field-row">
		<div class="tnp-field-col-2">
			<?php $fields->checkbox('hide_titles', __('Hide titles')) ?>
		</div>
		<div class="tnp-field-col-2" id="o-link_titles">
			<?php $fields->checkbox('link_titles', __('Link title to post')) ?>
		</div>
</div>

<div style="clear:both;" id="o-title_font">
	<?php $fields->font('title_font', '', ['family_default'=>true, 'size_default'=>true, 'weight_default'=>true, 'align'=>true]) ?>
</div>

<p class="mbtnp-section-title">Post dates</p>
<div class="tnp-field-row">
		<div class="tnp-field-col-2">
			<?php $fields->checkbox('show_post_dates', __('Show post dates')) ?>
		</div>
</div>

<div style="clear:both;" id="o-post_date_font">
	<?php $fields->font('post_date_font', '', ['family_default'=>true, 'size_default'=>true, 'weight_default'=>true, 'align'=>true]) ?>
</div>

<p class="mbtnp-section-title">Post content</p>
<div class="tnp-field-row">
	<div class="tnp-field-col-2">
		<?php $fields->select('show_content', __('Show content'), ['none' => 'None', 'excerpt' => 'Excerpt', 'full' => 'Full']) ?>
	</div>
	<div class="tnp-field-col-2" id="o-excerpt_length">
		<?php $fields->number('excerpt_length', __('Excerpt length (characters)')) ?>
	</div>
</div>

<div style="clear:both;" id="o-post_content_font">
	<?php $fields->font('post_content_font', '', ['family_default'=>true, 'size_default'=>true, 'weight_default'=>true, 'align'=>true]) ?>
</div>

<p class="mbtnp-section-title">Custom content</p>
<p style="font-size: 0.9em; margin-top: 0;">Add custom fields by using brackets. Ex: for "custom_name", use <strong>{field_custom_name}</strong></p>
<?php $fields->wp_editor( 'post_custom_html', 'Content', [
	'post_custom_html_font_family'  => $composer['post_custom_html_font_family'],
	'post_custom_html_font_size'    => $composer['post_custom_html_font_size'],
	'post_custom_html_font_weight'  => $composer['post_custom_html_font_weight'],
	'post_custom_html_font_color'   => $composer['post_custom_html_font_color'],
] ) ?>

<p class="mbtnp-section-title">Buttons</p>
<?php $fields->checkbox('hide_buttons', __('Hide buttons')) ?>
<div id="o-button_text">
	<?php $fields->text('button_text', __('Button text', 'advanced-composer-blocks-for-newsletter')) ?>
	<?php $fields->font('button_text_font', '', [ 'family_default' => true, 'size_default' => true, 'weight_default' => true, 'align'=>false, 'color'=>false ] ) ?>
</div>

<div class="tnp-field-row">
    <div class="tnp-field-col-3" id="o-button_text_color">
        <?php $fields->color('button_text_color', __('Text color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-3" id="o-button_color">
        <?php $fields->color('button_color', __('Button color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-3" id="o-button_border_color">
        <?php $fields->size('button_border_radius', __('Border radius', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
</div>

<div class="tnp-field-row">
    <div class="tnp-field-col-2" id="o-button_width">
        <?php $fields->select('button_width', 'Width', ['inline' => __('Inline'), 'full_width' => __('Full width')]) ?>
    </div>
    <div class="tnp-field-col-2"id="o-button_align">
        <?php $fields->select('button_align', 'Alignment', ['center' => __('Center'), 'left' => __('Left'), 'right' => __('Right')]) ?>
    </div>
</div>

<p class="mbtnp-section-title">Layout</p>
<?php $fields->size('post_list_row_gap', __('Row gap', 'advanced-composer-blocks-for-newsletter')) ?>
<div class="tnp-field-row">
    <div class="tnp-field-col-4">
        <?php $fields->size('wrap_border_radius', __('Border radius', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-4">
        <?php $fields->color('wrap_background_color', __('Background color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-4">
        <?php $fields->size('wrap_border_width', __('Border width', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
    <div class="tnp-field-col-4">
		<?php $fields->color('wrap_border_color', __('Border color', 'advanced-composer-blocks-for-newsletter')) ?>
    </div>
</div>

<div class="tnp-field-row" style="padding: 10px;">
    <div class="tnp-field-col">
		<table width="100%">
			<tr>
				<td><?php $fields->size('wrap_padding_left', __('&larr; Left', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('wrap_padding_top', __('&uarr; Top', 'advanced-composer-blocks-for-newsletter')) ?><?php $fields->size('wrap_padding_bottom', __('&darr; Bottom', 'advanced-composer-blocks-for-newsletter')) ?></td>
				<td><?php $fields->size('wrap_padding_right', __('&rarr; Right', 'advanced-composer-blocks-for-newsletter')) ?></td>
			</tr>
		</table>
	</div>
</div>


<hr style="clear:both; margin:20px 0;" />

<script>
jQuery(document).ready(function($){

	function mbtnp_post_list_visibility(){

		// thumbnail rules
		var image_size = $('#options-image_size').val();
		if(image_size == 'none'){
			$('#o-link_images').hide();
			$('#o-image_align').hide();
			$('#o-border_radius').hide();
		} else {
			$('#o-link_images').show();
			$('#o-image_align').show();
			$('#o-border_radius').show();
		}

		// title rules
		var hide_titles = $('#options-hide_titles').is(':checked');
		if(hide_titles){
			$('#o-link_titles').hide();
			$('#o-title_font').hide();
		} else {
			$('#o-link_titles').show();
			$('#o-title_font').show();
		}

		// post date rules
		var show_post_dates = $('#options-show_post_dates').is(':checked');
		if(show_post_dates){
			$('#o-post_date_font').show();
		} else {
			$('#o-post_date_font').hide();
		}

		// content rules
		var show_content = $('#options-show_content').val();
		if(show_content == 'none'){
			$('#o-excerpt_length').hide();
			$('#o-post_content_font').hide();
		} else {
			$('#o-excerpt_length').show();
			$('#o-post_content_font').show();
		}

		// button rules
		var hide_buttons = $('#options-hide_buttons').is(':checked');
		if(hide_buttons){
			$('#o-button_text').hide();
			$('#o-button_text_color').hide();
			$('#o-button_color').hide();
			$('#o-button_border_color').hide();
			$('#o-button_width').hide();
			$('#o-button_align').hide();
		} else {
			$('#o-button_text').show();
			$('#o-button_text_color').show();
			$('#o-button_color').show();
			$('#o-button_border_color').show();
			$('#o-button_width').show();
			$('#o-button_align').show();
		}
	}

	$(document).delegate('input, select', 'change', function(e){
		e.preventDefault();
		mbtnp_post_list_visibility();
	});

	// if mouse hovers #tnpc-block-options
	$('#tnpc-block-options').hover(function(){
		mbtnp_post_list_visibility();
	});
});
</script>

<?php $fields->block_commons() ?>