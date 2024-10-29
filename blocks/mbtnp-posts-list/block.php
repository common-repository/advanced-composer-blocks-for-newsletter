<?php
/*
 * Name: Posts List
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
    'post_type'=>'post',
	'number_posts' => 3,
    'wrap_padding_left' => 10,
    'wrap_padding_right' => 10,
    'wrap_padding_top' => 10,
    'wrap_padding_bottom' => 10,
	'wrap_border_width' => 0,
	'wrap_border_color' => '#000000',
	'wrap_border_radius' => 0,
	'post_list_row_gap' => 0,
	'image_align' => 'left',
	'image_size' => 'none',
	'border_radius' => 0,
	'hide_titles' => '',
	'link_titles' => '',
	'title_font_size' => '24',
	'title_font_align' => 'left',
	'post_date_font_size' => '14',
	'post_date_font_align' => 'left',
	'post_content_font_size' => '16',
	'post_content_font_align' => 'left',
	'show_content' => 'none',
	'button_text' => 'Read more',
	'button_text_font_size' => '16',
	'button_color' => '#000000',
	'button_text_color' => '#ffffff',
	'button_border_radius' => '3',
	'button_align' => 'left',
    'block_padding_left'=>15,
    'block_padding_right'=>15,
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
    'block_background'=>'#eeeeee'
);

$options = array_merge($default_options, $options);

$title_style = TNP_Composer::get_title_style($options, 'title', $composer);
$post_date_style = TNP_Composer::get_title_style($options, 'post_date', $composer);
$post_content_style = TNP_Composer::get_title_style($options, 'post_content', $composer);
$button_text_style = TNP_Composer::get_title_style($options, 'button_text', $composer);
$text_style = TNP_Composer::get_style($options, '', $composer, 'text');
$post_custom_html_style = TNP_Composer::get_style($options, '', $composer, 'post_custom_html');

?>
<style>
	.block-wrap {
		padding: 10px;
		padding-top: <?php echo esc_attr( $options['wrap_padding_top'] ); ?>px;
		padding-bottom: <?php echo esc_attr( $options['wrap_padding_bottom'] ); ?>px;
		padding-left: <?php echo esc_attr( $options['wrap_padding_left'] ); ?>px;
		padding-right: <?php echo esc_attr( $options['wrap_padding_right'] ); ?>px;
		background-color: <?php echo esc_attr( $options['wrap_background_color'] ); ?>;
		border: <?php echo esc_attr( $options['wrap_border_width'] ) ?>px solid <?php echo esc_attr( $options['wrap_border_color'] ); ?>;
		border-radius: <?php echo esc_attr( $options['wrap_border_radius'] ); ?>px;
	}
	.post-row {
		padding-bottom: <?php echo esc_attr( $options['post_list_row_gap'] ); ?>px;
	}
	.featured-image-wrap {
		text-align: <?php echo esc_attr( $options['image_align'] ); ?>;
        line-height: normal;
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.featured-image {
		border-radius: <?php echo esc_attr( $options['border_radius'] ); ?>px;
	}
    .title {
		<?php esc_html( $title_style->echo_css() ) ?>
        line-height: normal;
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
    }
	.title-link {
		<?php esc_html( $title_style->echo_css() ) ?>
		line-height: normal;
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
		<?php if( $options['title_font_color'] ){ ?>
			color: <?php echo esc_attr( $options['title_font_color'] ); ?>;
		<?php } ?>
	}
	.post-date {
        <?php esc_html( $post_date_style->echo_css() ) ?>
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.post-excerpt {
        <?php esc_html( $post_content_style->echo_css() ) ?>
		line-height: normal;
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.post-full {
        <?php esc_html( $post_content_style->echo_css() ) ?>
		line-height: normal;
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.post-button-wrap {
		margin: 0 !important;
		padding-top: 10px;
		padding-bottom: 10px;
		text-align: <?php echo esc_attr( $options['button_align'] ); ?>;
	}
	.post-button {
		<?php echo esc_html( $text_style->echo_css() ) ?>
		<?php echo esc_html( $button_text_style->echo_css() ) ?>
		background: <?php echo esc_attr( $options['button_color'] ); ?>;
		color: <?php echo esc_attr( $options['button_text_color'] ); ?>;
		display: inline-block;
		<?php if( $options['button_width'] == 'full_width' ){ ?>
			display: block;
		<?php } ?>
		padding: 12px 24px;
		<?php if( $options['button_text_font_size'] ){ ?>
			padding: <?php echo esc_attr( $options['button_text_font_size'] ) * 0.5; ?>px <?php echo esc_attr( $options['button_text_font_size'] ) * 1; ?>px;
		<?php } ?>
		text-decoration: none;
		<?php if( $options['button_border_radius'] ){ ?>
			border-radius: <?php echo esc_attr( $options['button_border_radius'] ); ?>px;
		<?php } ?>
	}
</style>

<div inline-class="block-wrap">
	<table width="100%" style="width: 100% !important;" border="0" cellpadding="0" cellspacing="0">
		<?php if( $options['post_type'] ){ ?>
			<?php
				$post_list_args = array(
					'post_type' => $options['post_type'],
					'posts_per_page' => $options['number_posts']
				);
				if( $options['post_order'] == 'title_asc' ){
					$post_list_args['orderby'] = 'title';
					$post_list_args['order'] = 'ASC';
				} else if( $options['post_order'] == 'title_desc' ){
					$post_list_args['orderby'] = 'title';
					$post_list_args['order'] = 'DESC';
				} else if( $options['post_order'] == 'date_asc' ){
					$post_list_args['orderby'] = 'date';
					$post_list_args['order'] = 'ASC';
				} else if( $options['post_order'] == 'date_desc' ){
					$post_list_args['orderby'] = 'date';
					$post_list_args['order'] = 'DESC';
				}
				$posts_list = get_posts($post_list_args); ?>
			<?php foreach($posts_list as $post){
				$post_custom_html = $options['post_custom_html']; ?>
				<tr>
					<td width="100%" valign="top" align="left" class="post-row" inline-class="post-row">
						<?php if($options['image_size'] != 'none'){ ?>
							<div inline-class="featured-image-wrap">
								<?php if($options['link_images'] == 1){ echo '<a href="'.esc_url( get_the_permalink($post->ID) ).'" inline-class="featured-image-link">'; } ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, $options['image_size'] ) ); ?>" inline-class="featured-image" />
								<?php if($options['link_images'] == 1){ echo '</a>'; } ?>
							</div>
						<?php } ?>
						<?php if($options['hide_titles'] != 1){ ?>
							<p inline-class="title">
								<?php if($options['link_titles'] == 1){ echo '<a href="'. esc_url( get_the_permalink($post->ID) ).'" inline-class="title-link">'; } ?>
									<?php echo esc_html( $post->post_title ); ?>
								<?php if($options['link_titles'] == 1){ echo '</a>'; } ?>
							</p>
						<?php } ?>
						<?php if($options['show_post_dates'] == 1){ ?>
							<p inline-class="post-date">
								<?php echo esc_html( gmdate("F j, Y", strtotime($post->post_date) ) ); ?>
							</p>
						<?php } ?>
						<?php if($options['show_content'] == 'excerpt'){ ?>
							<div inline-class="post-excerpt">
								<?php if( $options['excerpt_length'] ){
									echo wp_kses_post( mbtnp_get_the_excerpt( $post->ID, $options['excerpt_length'] ) );
								} else {
									echo wp_kses_post( get_the_excerpt( $post->ID ) );
								} ?>
							</div>
						<?php } ?>
						<?php if($options['show_content'] == 'full'){ ?>
							<div inline-class="post-full">
								<?php echo wp_kses_post( get_the_content('','',$post->ID) ); ?>
							</div>
						<?php } ?>
						<?php if( !empty( trim($post_custom_html) ) ){ ?>
							<div>
								<?php echo wp_kses_post( mbtnp_replace_tags( $post_custom_html, $post->ID ) ); ?>
							</div>
						<?php } ?>
						<?php if( $options['hide_buttons'] != 1 ){ ?>
							<div inline-class="post-button-wrap">
								<a href="<?php echo esc_url( get_the_permalink($post->ID) ); ?>" inline-class="post-button"><?php echo esc_html( mbtnp_replace_tags( $options['button_text'], $post->ID ) ); ?></a>
							</div>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
		<?php } ?>
	</table>
</div>