<?php 
/* 
Template Name: Trends Category
*/ 

set_time_limit(0);

define( 'TRENDS_DIR', ABSPATH . 'data' );

$sites = array(

	'codecanyon.net' => array(
		'url' => 'https://codecanyon.net/category/wordpress/{category}?page=1&sort=sales',
		'type'      => 'plugin',
        'categories' => array(
            'utilities',
            'miscellaneous',
            'ecommerce',
            'add-ons',
            'interface-elements',
            'miscellaneous',
            'forms',
            'social-networking',
            'media',
            'galleries',
            'widgets',
            'advertising',
            'calendars',
            'seo',
            'newsletters',
            'membership',
            'forums',
        )   
	),
    
	'themeforest.net' => array(
		'url' => 'https://themeforest.net/search?page=1&sort=sales',
		'type' => 'theme',
        'categories' => array(
            'ecommerce',
            'corporate',
            'creative',
            'blog-magazine',
            'retail',
            'entertainment',
            'nonprofit',
            'technology',
            'education',
            'real-estate',
            'miscellaneous',
            'wedding',
            'mobile',
            'buddypress'
        )   
	)
    
    
);

$items = $wpdb->get_results("SELECT * FROM wp_trend_products WHERE category = '' or category is NULL");

foreach($items as $item) {
    $dir = TRENDS_DIR . '/' . ($item->type == 'plugin' ? 'codecanyon.net':'themeforest.net') . '/';
    
    foreach(glob($dir.'*', GLOB_ONLYDIR) as $date_dir) {
        $fname = $date_dir . '/pages/'.floor($item->envato_id/1000) . '/'. $item->envato_id . '.html';
        if (file_exists($fname)) {
            $c = file_get_contents($fname);
            preg_match('#/category/wordpress/([^"]+)#u', $c, $match); 
            if ( !empty($match[1]) ) {
                $sql = $wpdb->prepare("UPDATE wp_trend_products SET category = %s WHERE envato_id = %d", array($match[1], $item->envato_id));
                dump($sql);
                $q = $wpdb->query( $sql );
                break;
            }
        }
    }
    
}
                    

?>