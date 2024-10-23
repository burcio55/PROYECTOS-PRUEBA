function dcms_menu_dinamico( $args ) {
    if ( $args['theme_location'] == 'top' ) {
        if ( is_user_logged_in() ) {
            $args['menu'] = 'menu-registrados';
        } else {
            $args['menu'] = 'menu-visitantes';
        }
    }
    return $args;
}
add_filter( 'wp_nav_menu_args', 'dcms_menu_dinamico' );

function dcms_menu_dinamico_autores( $args ) {
    if ( $args['theme_location'] == 'top' ) {
        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            if ( in_array( 'author', $user->roles ) ) {
                $args['menu'] = 'menu-autores';
            }
        }
    }
    return $args;
}
add_filter( 'wp_nav_menu_args', 'dcms_menu_dinamico_autores' );