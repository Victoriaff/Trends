<?php 
/* 
Template Name: Trends
*/ 

set_time_limit(0);

define( 'TRENDS_DIR', ABSPATH . 'data' );

define( 'TRENDS_DATE', '29-09-2018' );
define( 'CUR_DATE', '2018-09-29' );

$items = $wpdb->get_results("SELECT * FROM wp_trend_products WHERE created_date = '0000-00-00' or created_date is NULL");

foreach($items as $item) {
    $sql = $wpdb->prepare("SELECT * FROM wp_trend_product_sales WHERE envato_id = %d ORDER BY record_date DESC LIMIT 1", array($item->envato_id) );
    dump($sql);
    $date = $wpdb->get_row( $sql );
    
    if (isset($date['sales'])) {
        $sql = $wpdb->prepare("UPDATE wp_trend_products SET created_date = %s", array($date->record_date) );
        dump($sql);
        //$wpdb->query( $sql );
        dd(0);
        
        
    }
}
exit;




$sites = array(
/*
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
    */
    
	'themeforest.net' => array(
		'url' => 'https://themeforest.net/search?page=1&sort=sales',
		'type' => 'theme',
        'categories' => array(
            //'ecommerce',
            //'corporate',
            //'creative',
            //'blog-magazine',
            //'retail',
            //'entertainment',
            //'nonprofit',
            //'technology',
            //'education',
            //'real-estate',
            //'miscellaneous',
            //'wedding',
            //'mobile',
            //'buddypress'
        )   
	)
    
    
);

$end_page = 0;
$url      = '';

foreach ( $sites as $site => $site_data ) {
    
    foreach ( $site_data['categories'] as $category ) {
        
        @mkdir( TRENDS_DIR . '/' . $site );
        @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE );
        @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pagination' );
        @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pagination/' );
        @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pagination/'.$category );
        @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pages' );
        
        $dir = TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pagination/'.$category;
        
        $content = '';
        $pages   = 1;
        //$pages = 35;
        
        for ( $page = 1; $page <= $pages; $page ++ ) {
            
            dump('Category: '.$category.'; Page = '.$page);

            
            $fname   = $dir . '/' . $page . '.html';
            $url = preg_replace('#\{category\}#', $category, $site_data['url']);
            $url = preg_replace('#\?page=[0-9]+#', '?page='.$page, $url);
            
            $content = trends_get_pagination_page( $fname, $url );
            $content = preg_replace('#<!-- -->#', '' ,$content);
            //dd($content);
            
            if ($content) {
                // Pages
                if ( $pages == 1 ) {
                    preg_match_all( '#\?page=([0-9]+)&#', $content, $matches );
                    $pages = end( $matches[1] );
                    dump($pages);
                }
                //continue;
                
                $e       = explode( '<li role="presentation"', $content );
                $content = $e[0];
                
                $e = explode( '<article ', $content );
                
                for ( $i = 1; $i < count( $e ); $i ++ ) {
                    
                    $data = array(
                        'id'                => 0,
                        'type'              => $site_data['type'],
                        'url'               => '',
                        'name'              => '',
                        'author'            => '',
                        'price'             => 0,
                        'rating'            => 0,
                        'compatible_with'   => '',
                        'files_included'    => '',
                        'created_date'      => '',
                        'tags'              => ''
                    );
                    
                    // URL
                    unset( $p );
                    preg_match( '#<h3><a href="([^"]+)#', $e[ $i ], $p );
                    $data['url'] = $p[1];
                    
                    //dump('Category: '.$category.'; URL = '.$data['url']);
                    
                    // Envato ID
                    unset( $p );
                    preg_match( '#/([0-9]+)\?#', $data['url'], $p );
                    $data['id'] = $p[1];
                    if ( empty( $data['id'] ) ) {
                        continue;
                    }
                    //dd($data);
                    //if ($data['id'] == 242431) continue;
                    
                    // Name
                    unset( $p );
                    preg_match( '#>([^<]+)</a></h3>#', $e[ $i ], $p );
                    $data['name'] = $p[1];
                    
                     // Author
                    unset( $p );
                    preg_match( '#<i> by </i><a( class="[^"]+")? href="([^"]+)">([^<]+)#', $e[ $i ], $p );
                    if (isset($p[3]))  $data['author'] = $p[3];
                    
                    
                    $sections = explode('<section ', $e[ $i ]);
                    
                    if (isset($sections[3])) {
                        // Price
                        unset( $p );
                        preg_match( '#>\$([0-9\.]*)#', $e[ $i ], $p );
                        if (isset($p[1]))  $data['price'] = $p[1];
                        
                        // Sales
                        unset( $p );
                        preg_match( '#>([0-9\.K]+) Sales#', $e[ $i ], $p );
                        if (isset($p[1])) {
                            $data['sales'] = $p[1];
                            if (preg_match('#K#', $data['sales'])) $data['sales'] = (float)preg_replace('#K#', '', $data['sales'])*1000;
                        }
                    }
                    
                    // Rating
                    unset( $p );
                    preg_match( '#Rated ([0-9\.]+) out of 5#', $e[ $i ], $p );
                    if (isset($p[1])) $data['rating'] = $p[1];
                    
                    // Tags
                    unset( $p );
                    preg_match( '#>Tags:([^<]+)#', $e[ $i ], $p );
                    if (isset($p[1])) $data['tags'] = trim($p[1]);
                    
                    //dump($data);
                    
                    if ($data['id'] && $data['price'] && isset($data['sales'])) {
                        
                        // Insert product or update
                        $sql = $wpdb->prepare("
                                INSERT INTO wp_trend_products(`envato_id`,`type`,`name`,`category`,`sales`,`url`,`author`,`price`,`rating`,`created_date`,`compatible_with`,`files_included`,`tags`,`added_date`,`update_date`)
                                VALUES ( %d, %s, %s, %s, %d, %s, %s, %f, %f, %s, %s, %s, %s, '".CUR_DATE."', '".CUR_DATE."' ) 
                                ON DUPLICATE KEY UPDATE 
                                    category = %s,
                                    sales = %d,
                                    price = %f,
                                    rating = %f,
                                    tags = %s,
                                    update_date = '".CUR_DATE."'
                                ",
                                array(
                                    $data['id'],
                                    $data['type'],
                                    $data['name'],
                                    $category,
                                    $data['sales'],
                                    $data['url'],
                                    $data['author'],
                                    $data['price'],
                                    $data['rating'],
                                    $data['created_date'],
                                    $data['compatible_with'],
                                    $data['files_included'],
                                    $data['tags'],
                                    
                                    $category,
                                    $data['sales'],
                                    $data['price'],
                                    $data['rating'],
                                    $data['tags']
                                )
                        );
                        //dump( $sql );
                        $q = $wpdb->query( $sql );
                        //dd($q);
                        
                        // Get record
                        $sql    = $wpdb->prepare("SELECT ID FROM wp_trend_products WHERE envato_id = %d", array( $data['id'] ));
                        $result =  $q = $wpdb->get_row( $sql );
                        //dump($result);
                        
                        if ( $result && ! empty( $result->ID ) ) {
                            // Insert sale
                            $sql    = $wpdb->prepare("
                                INSERT INTO wp_trend_product_sales(`product_id`, `envato_id`,`sales`,`record_date`)
                                VALUES ( %d, %d, %d, %s )",
                                array(
                                    $result->ID,
                                    $data['id'],
                                    $data['sales'],
                                    CUR_DATE
                                )
                            );
                            //dump($sql);
                            $result = $wpdb->get_results( $sql );
                        }
                        
                         //usleep(50);
                        
                        //dd( $data );
                        //exit;
                    } else
                        dd($data);
                }
                //exit;
            }

            //if ($page == 3) exit;
            
            // end page
            //exit;
        }
    }
}

/*---------------- Update created_date ---------------*/
/*
$items = $wpdb->get_results("SELECT * FROM wp_trend_products WHERE created_date = '0000-00-00' or created_date is NULL");

foreach($items as $item) {
    $sql = $wpdb->prepare("SELECT * FROM wp_trend_product_sales WHERE envato_id = %d ORDER BY record_date DESC LIMIT 1", array($item->envato_id) );
    dump($sql);
    $date = $wpdb->get_row( $sql );
    
    if (isset($date['sales'])) {
        $sql = $wpdb->prepare("UPDATE wp_trend_products SET created_date = %s", array($date->record_date) );
        dump($sql);
        //$wpdb->query( $sql );
        dd(0);
        
        
    }
}
*/
dd('Complete');





function trends_get_pagination_page( $fname, $url ) {
    
    $content = '';
	if ( file_exists( $fname ) ) {
		$content = file_get_contents( $fname );
	} else {
        
        usleep(300);
        
		$c = wp_remote_post( $url );
		if ( isset( $c['body'] ) && preg_match('#<nav class="[^"]+" role="navigation">#', $c['body']) ) {
			$content = $c['body'];
			$content = expl( 'data-test-selector="search-results"', 'data-test-selector="paginationNext"', $content );
			file_put_contents( $fname, $content );
		}
	}
    
	//dd($content);
	return $content;
}

function trends_get_product_page( $fname, $url ) {
    
    $old_fname           = preg_replace('#pages/[0-9]+#', 'pages', $fname);
    if ( file_exists( $old_fname ) ) @copy($old_fname, $fname);
    
    $content = '';
	if ( file_exists( $fname ) ) {
		$content = file_get_contents( $fname );
	} else {
		//$c = file_get_contents( $url );
        
        usleep(300);
        
        //$url = 'http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?s_rank=1';
        //$f = fopen($url, 'r');
        //dd($f);
        //$c = fread($f, 100000);
        $c = wp_remote_post( $url );
        //$c = file_get_contents( $url );
        //dd($c);
        if ( isset( $c['body'] ) && preg_match('#<h1 class="t\-heading \-color\-inherit#', $c['body']) ) {
			$content = $c['body'];
			file_put_contents( $fname, $content );
		}
	}
	
    //dd($content);
	return $content;
}

function _getDate( $string ) {
	$mon = array(
		'January' => '01',
		'February' => '02',
		'March' => '03',
		'April' => '04',
		'May' => '05',
		'June' => '06',
		'July' => '07',
		'August' => '08',
		'September' => '09',
		'October' => '10',
		'November' => '11',
		'December' => '12'
	);
	
	preg_match( '/([0-9]+) ([a-z]+) ([0-9]+)/i', $string, $m);
	
	return '20'.$m[3].'-'.$mon[$m[2]].'-'.$m[1];
}

function expl( $exp1, $exp2, $text ) {
	$c = explode( $exp1, $text );
	if ( isset( $c[1] ) ) {
		$c = explode( $exp2, $c[1] );
	}
	return $c[0];
}




?>