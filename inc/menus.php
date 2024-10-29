<?php

// Don't access this file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// add menu subpage
add_action('admin_menu', 'mbtnp_add_admin_menu');
function mbtnp_add_admin_menu() {
    add_submenu_page(
        'options-general.php',              // Parent menu slug
        'Advanced Composer Blocks',         // Page title
        'Advanced Composer Blocks',         // Menu title
        'manage_options',                   // Capability
        'advanced_composer_blocks',         // Menu slug
        'mbtnp_settings_page'                 // Function that outputs the page
    );
}

// add settings page
function mbtnp_settings_page() {
    ?>
    <div class="wrap">
        <h2>Advanced Composer Blocks Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('acb_settings_group');
            do_settings_sections('advanced_composer_blocks');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


// register settings
add_action('admin_init', 'mbtnp_register_settings');
function mbtnp_register_settings() {
    register_setting(
        'acb_settings_group', // Option group
        'acb_settings'        // Option name
    );
}

// add settings section
add_action('admin_init', 'mbtnp_settings_init');

function mbtnp_settings_init() {
    add_settings_section(
        'acb_settings_section',        // Section ID
        'Settings',                    // Title
        'mbtnp_settings_section_cb',     // Callback
        'advanced_composer_blocks'     // Page
    );

    add_settings_field(
        'acb_disable_live_preview',              // Field ID
        'Disable Live Preview Button',           // Title
        'mbtnp_disable_live_preview_cb',           // Callback
        'advanced_composer_blocks',              // Page
        'acb_settings_section'                   // Section
    );
}

function mbtnp_settings_section_cb() {
    echo '<p>Customize the behavior of Advanced Composer Blocks.</p>';
}

function mbtnp_disable_live_preview_cb() {
    $options = get_option('acb_settings');
    ?>
    <input type="checkbox" name="acb_settings[acb_disable_live_preview]" value="1" <?php echo ( !empty($options['acb_disable_live_preview']) ) ? 'checked' : ''; ?>/>
    <?php
}
