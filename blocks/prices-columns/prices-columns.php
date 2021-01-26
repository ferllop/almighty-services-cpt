<?php
add_action( 'init', 'register_block_prices_columns');
function register_block_prices_columns() {
    if ( ! function_exists('register_block_type') ) {
        return;
    }

    $block_name = 'prices-columns';

    wp_register_script( 
        $block_name, 
        plugin_dir_url( __FILE__ ) . $block_name .'.js', 
        [
            'wp-blocks',
            'wp-i18n',
            'wp-element',
            'wp-components',
            'wp-editor'
        ]
    );

    wp_register_style( 
        $block_name,
        plugin_dir_url( __FILE__ ) . $block_name . '.css', 
        [ 
            'wp-edit-blocks' 
        ]
    );

    register_block_type( 'almighty-services-cpt/prices-columns', [
        'editor_script' => $block_name,
        'editor_style' => $block_name,
        'style' => $block_name
    ]);

}

