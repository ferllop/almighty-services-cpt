<?php
add_action( 'init', 'register_block_list_services_as_vinyls');
function register_block_list_services_as_vinyls() {
    if ( ! function_exists('register_block_type') ) {
        return;
    }

    $block_name = 'list-services-as-vinyls';

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

    register_block_type( 'almighty-services-cpt/list-services-as-vinyls', [
        'render_callback' => 'render_vinyls',
        'editor_script' => $block_name,
        'editor_style' => $block_name,
        'style' => $block_name,
        'attributes' => [
            'pickedColor' => [
                'default' => '#f00',
                'type' => 'string'
            ]
        ]
    ]);
}

function render_vinyls($attrs){
    $result = '';

    $result .= "
        <style> 
            .like-albums-grid { 
                --vinyl-cover-color: {$attrs['pickedColor']}; 
            } 
        </style>
    ";    

    $result .= '<div class="like-albums-grid">';    
    
    $args = array(
        'post_type'      => 'services',
        'posts_per_page' => 10,
        'order' => 'asc'
    );
    $loop = new WP_Query($args);
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) {
            $loop->the_post();
            $result .= render_vinyl( get_the_title(), get_the_permalink() );  
        }
    } else {
        $result += render_vinyl( __('Create your first service', 'almighty-services-cpt') );
    }
    wp_reset_postdata();
    $result .= '</div>';
    return $result;
}

function render_vinyl($title, $link_url){
    return "
    <div class='album-wrapper'>
        <div class='album'>
            <a href='$link_url'>
                <div class='vinyl'>
                    <div class='label'></div>
                </div>
                <div class='cover'><span>$title</span></div>
            </a>
        </div>
    </div>
    ";
}