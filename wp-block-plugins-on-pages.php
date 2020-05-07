<?php if( !is_admin() && empty( $_POST ) ){
    $uri = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $uriArr = explode( '?',$uri );
    $uri = $uriArr[0];
    $check_uris = str_replace( 'https://','',str_replace( 'http://','',array(
        home_url( '/' ),
        home_url( '/your-slug-here/' ),
        home_url( '/your-second-slug-here/'),
     )));
    if ( in_array($uri, $check_uris) )  {
        $paths = array(
            'your-plugin-folder-here/your-plugin-file-here.php',
            'your-second-plugin-folder-here/your-second-plugin-file-here.php',
        );
        global $paths;
        add_filter( 'option_active_plugins', 'my_option_active_plugins' );
    }
}

function my_option_active_plugins( $plugins ){
    global $paths;
    foreach( $paths as $path ){
        $k = array_search( $path, $plugins );
        if( false !== $k ){
            unset( $plugins[$k] );
        }
    }

    return $plugins;
}