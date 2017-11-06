<?php
/**
* Add an automatic default custom taxonomy for calendar.
* If no event (taxonomy) is set, the event will be sorted as “draft” and won’t return an offset error.
*
*/

// Fix ACF Support
add_filter('_includes/acf-pro/settings/show_admin', '__return_true');

register_sidebar( array(
'name' => 'Footer Flex Widget',
'id' => 'footer-flex-widget',
'description' => 'Appears in the footer area',
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h2 class="widget-title">',
'after_title' => '</h3>',
) );

add_filter('body_class','uams_field_body_class');
function uams_field_body_class( $classes ) {
    $classes[] = 'uams-primary';

    $site_url = get_bloginfo( 'name' ); // Originally URL
    $site_url = strtolower($site_url); // Make it lowercase

    if(strpos($site_url, 'cancer') !== false) {
        $classes[] = 'cancer';
    } elseif (strpos($site_url, 'myeloma') !== false) {
        $classes[] = 'myeloma';
    } elseif (strpos($site_url, 'aging') !== false) {
        $classes[] = 'aging';
    } elseif (strpos($site_url, 'pri') !== false) {
        $classes[] = 'pri';
    } elseif (strpos($site_url, 'tri') !== false) {
        $classes[] = 'tri';
    } elseif (strpos($site_url, 'eye') !== false) {
        $classes[] = 'eye';
    } elseif (strpos($site_url, 'spine') !== false) {
        $classes[] = 'spine';
    }

    // return the $classes array
    return $classes;
}


//* Setup widget counts
function footer_count_widgets( $id ) {
    global $sidebars_widgets;

    if ( isset( $sidebars_widgets[ $id ] ) ) {
        return count( $sidebars_widgets[ $id ] );
    }

}

function footer_widget_area_class( $id ) {

    $count = footer_count_widgets( $id );

    $class = '';
    
    if ( $count == 1 ) {
        $class .= ' widget-full';
    } elseif ( $count % 3 == 0 ) {
        $class .= ' widget-thirds';
    } elseif ( $count % 4 == 0 ) {
        $class .= ' widget-fourths';
    } elseif ( $count % 2 == 1 ) {
        $class .= ' widget-halves uneven';
    } else {    
        $class .= ' widget-halves';
    }

    return $class;
    
}

require( 'setup/class.uams-quicklinks.php' );
