<?php 
/* 
Template Name: Trends 
*/ 

set_time_limit(0);

define( 'TRENDS_DIR', ABSPATH . 'data' );

//define( 'TRENDS_DATE', date( 'd-m-Y' ) );
//define( 'CUR_DATE', 'curdate()' );
define( 'NOW', 'now()' );

define( 'TRENDS_DATE', '18-09-2018' );
define( 'CUR_DATE', '2018-09-18' );


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
        
        for ( $page = 1; $page <= $pages; $page ++ ) {
            
            
            dump('Category: '.$category.'; Page = '.$page);

            
            $fname   = $dir . '/' . $page . '.html';
            $url = preg_replace('#\{category\}#', $category, $site_data['url']);
            $url = preg_replace('#\?page=[0-9]+#', '?page='.$page, $url);
            
            $content = trends_get_pagination_page( $fname, $url );
            //dd($content);
            
            if ($content) {
                // Pages
                if ( $pages == 1 ) {
                    preg_match_all( '#\?page=([0-9]+)&#', $content, $matches );
                    $pages = end( $matches[1] );
                }
                //continue;
                
                $e       = explode( '<li role="presentation"', $content );
                $content = $e[0];
                
                $e = explode( '<article ', $content );
                
                for ( $i = 1; $i < count( $e ); $i ++ ) {
                    
                    $data = array(
                        'type'            => $site_data['type'],
                        'rating'          => 0,
                        'compatible_with' => '',
                        'files_included'  => ''
                    );
                    
                    // Get url
                    unset( $p );
                    preg_match( '#<h3><a href="([^"]+)#', $e[ $i ], $p );
                    $data['url'] = $p[1];
                    
                    dump('Category: '.$category.'; URL = '.$data['url']);
                    
                    // Get Envato ID
                    unset( $p );
                    preg_match( '#/([0-9]+)\?#', $data['url'], $p );
                    $data['id'] = $p[1];
                    if ( empty( $data['id'] ) ) {
                        continue;
                    }
                    //dd($data);
                    //if ($data['id'] == 242431) continue;
                    
                    // Get name
                    unset( $p );
                    preg_match( '#>([^<]+)</a></h3>#', $e[ $i ], $p );
                    $data['name'] = $p[1];
                    
                    // Read product page
                    $fname           = TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pages/' . floor($data['id']/1000) . '/'. $data['id'] . '.html';
                    @mkdir( TRENDS_DIR . '/' . $site . '/' . TRENDS_DATE . '/pages/' . floor($data['id']/1000) );
                    
                    dump($fname);
                    dump($data['url']);
                    $product_content = trends_get_product_page( $fname, $data['url'] );
                    dump($product_content);
                    
                    if ($product_content) {
                        $data['sales']   = preg_replace( '#,#', '', trim( expl( '<i class="e-icon -icon-cart"></i></span>', '</strong>', $product_content ) ) );
                        
                        // Get author and author URL
                        unset( $p );
                        preg_match( '#<a rel="author" class="t-link -color-dark -decoration-none" href="([^"]+)">([^<]+)</a>#', $product_content, $p );
                        $data['author_url'] = $p[1];
                        $data['author']     = $p[2];
                        
                        // Get price
                        unset( $p );
                        preg_match( '#class="js\-purchase\-price">\$([0-9]+)#', $product_content, $p );
                        $data['price'] = $p[1];
                        
                        // Get rating
                        unset( $p );
                        preg_match( '#([0-9\.]+) average based on#', $product_content, $p );
                        if (isset($p[1])) $data['rating'] = $p[1];
                        
                        // Compatible With
                        if ( preg_match( '#>Compatible With</td>#', $product_content ) ) {
                            $c = expl( '>Compatible With</td>', '</tr>', $product_content );
                            preg_match_all( '#>([^<]+)</a>#', $c, $p );
                            $data['compatible_with'] = implode( ',', $p[1] );
                        }
                        
                        // Files Included
                        if ( preg_match( '#Files Included</td>#', $product_content ) ) {
                            $c = expl( 'Files Included</td>', '</tr>', $product_content );
                            preg_match_all( '#>([^<]+)</a>#', $c, $p );
                            $data['files_included'] = implode( ',', $p[1] );
                        }
                        
                        // Created
                        $c = expl( '<td class="meta-attributes__attr-name">Created</td>', '</tr>', $product_content );
                        preg_match( '#<span>([^<]+)</span>#', $c, $p );
                        $data['product_created'] = trim( $p[1] );
                        
                        $data['created_date'] = _getDate($data['product_created']);
                        
                        dump($data);
                        
                        // Insert product or update
                        $sql = "INSERT INTO wp_trend_products(`envato_id`,`type`,`name`,`category`,`sales`,`url`,`author`,`author_url`,`price`,`rating`,`product_created`,`created_date`,`compatible_with`,`files_included`,`added_date`,`update_date`)
                                VALUES (
                                    '" . esc_attr( $data['id'] ) . "',
                                    '" . esc_attr( $data['type'] ) . "',
                                    '" . esc_attr( $data['name'] ) . "',
                                    '" . esc_attr( $category ) . "',
                                    '" . esc_attr( $data['sales'] ) . "',
                                    '" . esc_attr( $data['url'] ) . "',
                                    '" . esc_attr( $data['author'] ) . "',
                                    '" . esc_attr( $data['author_url'] ) . "',
                                    '" . esc_attr( $data['price'] ) . "',
                                    '" . esc_attr( $data['rating'] ) . "',
                                    '" . esc_attr( $data['product_created'] ) . "',
                                    '" . esc_attr( $data['created_date'] ) . "',
                                    '" . esc_attr( $data['compatible_with'] ) . "',
                                    '" . esc_attr( $data['files_included'] ) . "',
                                    ".NOW.",
                                    ".NOW."
                                ) ON DUPLICATE KEY UPDATE
                                    category = '" . esc_attr( $category ) . "',
                                    sales = '" . esc_attr( $data['sales'] ) . "',
                                    price = '" . esc_attr( $data['price'] ) . "',
                                    rating = '" . esc_attr( $data['rating'] ) . "',
                                    compatible_with = '" . esc_attr( $data['compatible_with'] ) . "',
                                    files_included = '" . esc_attr( $data['files_included'] ) . "',
                                    update_date = ".NOW;
                        //dump( $sql );
                        $q = $wpdb->query( $sql );
                        //dump($q);
                        
                        
                        // Get record
                        $sql    = "SELECT ID FROM wp_trend_products WHERE envato_id = " . $data['id'];
                        $result =  $q = $wpdb->get_results( $sql );
                        //dump($result);
                        
                        if ( $result && ! empty( $result->id ) ) {
                            // Insert sale
                            $sql    = "INSERT INTO wp_trend_product_sales(`product_id`, `envato_id`,`sales`,`record_date`)
                                VALUES (
                                '" . esc_attr( $result->id ) . "',
                                '" . esc_attr( $data['id'] ) . "',
                                '" . esc_attr( $data['sales'] ) . "',
                                ".CUR_DATE."
                                )";
                                //dump($sql);
                            $result = $wpdb->get_results( $sql );
                        }
                        
                        dd( $data );
                        exit;
                    }
                    //exit;
                    
                }
            }

            //if ($page == 3) exit;
            
            // end page
            //exit;
        }
    }
}

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