<?php

/**
* Plugin Name: Advanced Composer Blocks for Newsletter
* Plugin URI: https://mburnette.com/advanced-composer-blocks/
* Description: A set of enhanced composer blocks and additional settings to extend The Newsletter Plugin
* Version: 1.3.2
* Requires Plugins: newsletter
* Author: Marcus Burnette
* Author URI: https://mburnette.com
* Text Domain: advanced-composer-blocks-for-newsletter
* License: GPLv2 or later
*
*/
// Don't access this file directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( function_exists( 'cbftnp_fs' ) ) {
    cbftnp_fs()->set_basename( false, __FILE__ );
} else {
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    if ( !function_exists( 'cbftnp_fs' ) ) {
        // Create a helper function for easy SDK access.
        function cbftnp_fs() {
            global $cbftnp_fs;
            if ( !isset( $cbftnp_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $cbftnp_fs = fs_dynamic_init( array(
                    'id'             => '14751',
                    'slug'           => 'acb-for-tnp',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_8bd3aa935c8a611d18d4adbbbea60',
                    'is_premium'     => false,
                    'premium_suffix' => 'Premium',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                        'slug'    => 'advanced_composer_blocks',
                        'contact' => false,
                        'support' => false,
                        'parent'  => array(
                            'slug' => 'options-general.php',
                        ),
                    ),
                    'is_live'        => true,
                ) );
            }
            return $cbftnp_fs;
        }

        // Init Freemius.
        cbftnp_fs();
        // Signal that SDK was initiated.
        do_action( 'cbftnp_fs_loaded' );
    }
    // enqueue styles
    function mbtnp_enqueue_styles() {
        wp_enqueue_style( 'mbtnp-styles', plugin_dir_url( __FILE__ ) . 'styles.css' );
    }

    add_action( 'admin_enqueue_scripts', 'mbtnp_enqueue_styles' );
    // include menu.php from inc folder
    require_once plugin_dir_path( __FILE__ ) . 'inc/menus.php';
    // ---------------------------------------------------------------------------------
    // ----- DEFINE PLUGIN FOLDER ------------------------------------------------------
    // ---------------------------------------------------------------------------------
    define( 'MBTNP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
    // ---------------------------------------------------------------------------------
    // ----- SETTINGS ACTION LINK ------------------------------------------------------
    // ---------------------------------------------------------------------------------
    add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mbtnp_add_action_links' );
    function mbtnp_add_action_links(  $actions  ) {
        $mylinks = array('<a href="' . admin_url( 'options-general.php?page=advanced_composer_blocks' ) . '">Settings</a>');
        $actions = array_merge( $actions, $mylinks );
        return $actions;
    }

    // ---------------------------------------------------------------------------------
    // ----- REGISTER NEW BLOCKS -------------------------------------------------------
    // ---------------------------------------------------------------------------------
    function mbtnp_newsletter_register_blocks() {
        $mbtnp_blocks = ["mbtnp-image", "mbtnp-posts-list", "mbtnp-text"];
        $dir = __DIR__;
        foreach ( $mbtnp_blocks as $block ) {
            if ( file_exists( $dir . '/blocks/' . $block ) ) {
                TNP_Composer::register_block( $dir . '/blocks/' . $block );
            }
        }
    }

    add_action( 'newsletter_register_blocks', 'mbtnp_newsletter_register_blocks' );
    // ---------------------------------------------------------------------------------
    // ----- ADD LIVE PREVIEW BUTTON TO COMPOSER ---------------------------------------
    // ---------------------------------------------------------------------------------
    function mbtnp_add_live_preview_button_in_admin() {
        // Get the current site's URL
        $site_url = get_site_url();
        $acb_settings = get_option( 'acb_settings' );
        $acb_live_preview_disable = ( isset( $acb_settings['acb_disable_live_preview'] ) ? $acb_settings['acb_disable_live_preview'] : false );
        if ( $acb_live_preview_disable ) {
            return;
        }
        // enqueue live preview script
        wp_enqueue_script(
            'mbtnp-blocks-live-preview',
            plugin_dir_url( __FILE__ ) . 'js/mbtnp-blocks-live-preview.js',
            array('jquery'),
            '',
            true
        );
    }

    add_action( 'admin_footer', 'mbtnp_add_live_preview_button_in_admin' );
    // ---------------------------------------------------------------------------------
    // ----- GET SHORTENED EXCERPT ------------------------------------------------------------------------
    // ---------------------------------------------------------------------------------
    function mbtnp_get_the_excerpt(  $post_id, $count  ) {
        $excerpt = get_the_content( '', '', $post_id );
        $excerpt = wp_strip_all_tags( $excerpt );
        if ( strlen( $excerpt ) > $count ) {
            $excerpt = trim( substr( $excerpt, 0, $count ) );
            $excerpt .= '...';
        }
        return $excerpt;
    }

    // ---------------------------------------------------------------------------------
    // ----- REPLACE CUSTOM TAGS (helper) ----------------------------------------------
    // ---------------------------------------------------------------------------------
    function mbtnp_replace_tags(  $content, $post_id = null  ) {
        if ( empty( $post_id ) ) {
            return $content;
        }
        $post = get_post( $post_id );
        // replace {field_XYZ} with value from XYZ custom field
        $content = preg_replace_callback( '/\\{field_([^}]+)\\}/', function ( $matches ) use($post) {
            return get_post_meta( $post->ID, $matches[1], true );
        }, $content );
        // replace {title} with post title
        $content = preg_replace_callback( '/\\{title\\}/', function ( $matches ) use($post) {
            return get_the_title( $post->ID );
        }, $content );
        return $content;
    }

}
// end if function_exists( 'cbftnp_fs' )