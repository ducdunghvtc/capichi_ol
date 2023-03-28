<?php
define( 'THEME_URL', get_stylesheet_directory() );
define ( 'CORE', THEME_URL . "/core" );
require_once( CORE . "/init.php" );

if ( !isset($content_width) ) {
	$content_width = 620;
}

if ( !function_exists('wp_theme_setup') ) {
	function wp_theme_setup() {

		/* textdomain */
		$language_folder = THEME_URL . '/languages';
		load_theme_textdomain( 'wp', $language_folder );
		/* link RSS len <head> **/
		add_theme_support( 'automatic-feed-links' );

		/* Theme post thumbnail */
		add_theme_support( 'post-thumbnails' );

		/* Post Format */
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'quote',
			'link'
		) );

		/* Theme title-tag */
		add_theme_support( 'title-tag' );

		/* Theme menu */
		register_nav_menus( array(
	    	'primary-menu' => __( 'Primary Menu', 'text_domain' ),
	    	'footer-menu'  => __( 'Footer Menu', 'text_domain' ),
	    	'contact-menu'  => __( 'Contact Menu', 'text_domain' ),
		) );

		/* sidebar */
		$sidebarThumbnail = array(
			'name' => __('Image sidebar', 'wp'),
			'id' => 'thumbnail-sidebar',
			'description' => __('Default sidebar'),
			'class' => 'thumbnail-sidebar',
		);
		register_sidebar( $sidebarThumbnail );
		
		$sidebar = array(
			'name' => __('Main Sidebar', 'wp'),
			'id' => 'main-sidebar',
			'description' => __('Default sidebar'),
			'class' => 'main-sidebar',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		);
		register_sidebar( $sidebar );

	}
	add_action( 'init', 'wp_theme_setup' );
}

remove_action( 'wp_head', '_wp_render_title_tag', 1 );


/*--------
TEMPLATE FUNCTIONS */
if (!function_exists('wp_header')) {
	function wp_header() { ?>
		<div class="site-name">
			<?php
				global $tp_options;

				if( $tp_options['logo-on'] == 0 ) :
			?>
				<?php
					if ( is_home() ) {
						printf( '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );
					} else {
						printf( '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename') );
					}
				?>

			<?php
				else :
			?>
				<img src="<?php echo $tp_options['logo-image']['url']; ?>" />
		<?php endif; ?>
		</div>
		<div class="site-description"><?php bloginfo('description'); ?></div><?php
	}
}

/**
*menu
**/
if ( !function_exists('wp_menu') ) {
	function wp_menu($menu) {
		$menu = array(
			'theme_location' => $menu,
			'container' => 'nav',
			'container_class' => $menu,
			'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
		);
		wp_nav_menu( $menu );
	}
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}

/**
*pagination
**/
if ( !function_exists('wp_pagination') ) {
	function wp_pagination() {
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return '';
		} ?>
		<nav class="pagination" role="navigation">
			<?php if ( get_next_posts_link() ) : ?>
				<div class="next"><?php next_posts_link( __('Next', 'wp') ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
				<div class="prev"><?php previous_posts_link( __('Previous', 'wp') ); ?></div>
			<?php endif; ?>
		</nav>
	<?php }
}

/**
*thumbnail
**/
if ( !function_exists('wp_thumbnail') ) {
	function wp_thumbnail($size) {
		if( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image') ) : ?>
		<figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure>
	<?php endif; ?>
	<?php }
}

/**
*wp_entry_header = title post
**/
if ( !function_exists('wp_entry_header') ) {
	function wp_entry_header() { ?>
		<?php if ( is_single() ) : ?>
			<!-- <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1> -->
			<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php else : ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php endif; ?>
	<?php }
}

/**
*wp_entry_meta = get posts
**/
if ( !function_exists('wp_entry_meta') ) {
	function wp_entry_meta() { ?>
		<?php if ( !is_page() ) : ?>
			<div class="entry-meta">
			<?php
				printf( __('<span class="author">Posted by %1$s', 'wp'),
				get_the_author() );

				printf( __('<span class="date-published"> at %1$s', 'wp'),
				get_the_date() );

				printf( __('<span class="category"> in %1$s ', 'wp'),
				get_the_category_list( ',' ) );

				if ( comments_open() ) :
					echo '<span class="meta-reply">';
						comments_popup_link(
							__('Leave a comment', 'wp'),
							__('One comment', 'wp'),
							__('% comments', 'wp'),
							__('Read all comments', 'wp')
							);
					echo '</span>';
				endif;
			?>
			</div>
		<?php endif; ?>
	<?php }
}

/**
*wp_entry_content = post/page
**/
if ( !function_exists('wp_entry_content') ) {
	function wp_entry_content() {
		if( !is_single() && !is_page() ) {
			the_excerpt();
		} else {
			the_content();

			/* Phan trang trong single */
			$link_pages = array(
				'before' => __('<p>Page: ', 'wp'),
				'after' => '</p>',
				'nextpagelink' => __('Next Page', 'wp'),
				'previouspagelink' => __('Previous Page', 'wp')
			);
			wp_link_pages( $link_pages );
		}
	}
}

// function wp_readmore() {
// 	return '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'.__('...[Read More]', 'wp').'</a>';
// }
// add_filter('excerpt_more', 'wp_readmore');


/**
*wp_entry_tag = show tag
**/
if ( !function_exists('wp_entry_tag') ) {
	function wp_entry_tag() {
		if ( has_tag() ) :
			echo '<div class="entry-tag">';
			printf( __('Tagged in %1$s', 'wp'), get_the_tag_list( '', ',' ) );
			echo '</div>';
		endif;
	}
}
/*=====import style.css=====*/
function wp_style() {
	wp_register_style( 'style', get_template_directory_uri() . "/style.css", 'all' );
	wp_enqueue_style('style');

	wp_register_style( 'common-style', get_template_directory_uri() . "/common/css/common.css", 'all' );
	wp_enqueue_style('common-style');

	wp_register_style( 'main-style', get_template_directory_uri() . "/common/css/style.css", 'all' );
	wp_enqueue_style('main-style');

	wp_register_style( 'slick-style', get_template_directory_uri() . "/common/css/slick.css", 'all' );
	wp_enqueue_style('slick-style');

	wp_register_script( 'jquery-3-script', "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js", array('jquery') );
	wp_enqueue_script('jquery-3-script');
	wp_register_script( 'slick-script', get_template_directory_uri() . "/common/js/slick.min.js", array('jquery') );
	wp_enqueue_script('slick-script');
	wp_register_script( 'main-script', get_template_directory_uri() . "/common/js/common.js", array('jquery') );
	wp_enqueue_script('main-script');
	
}
add_action('wp_enqueue_scripts', 'wp_style');

function nd_dosth_theme_setup() {
    add_theme_support( 'title-tag' );  
    add_theme_support( 'custom-logo' );
}
add_action( 'after_setup_theme', 'nd_dosth_theme_setup');

function remove_core_updates (){ 
	global $wp_version ; return ( object ) array ( 'last_checked' => time (), 'version_checked' => $wp_version ,); 
} 
add_filter ( 'pre_site_transient_update_core' , 'remove_core_updates' ); 
add_filter ( 'pre_site_transient_update_plugins' , 'remove_core_updates' ); 
add_filter ( 'pre_site_transient_update_themes' , 'remove_core_updates' );


// Custom Post Type

add_action('init', 'create_post_type');
function create_post_type()
{
	//------------------------------------------
	// Clients
	//------------------------------------------
	$clients = 'clients';
	register_post_type($clients,
		array(
			'labels' => array(
				'name'          => __('Our Clients'),
				'singular_name' => __('clients'), 
			),
			'public'        => true,
			'menu_position' => 5,
			'rewrite'       => array('with_front' => true),
			'supports'      => array('title', 'editor', 'thumbnail')
		)
	);

}


//shortcode
function create_shortcode_getpost($args) {
	$random_query = new WP_Query(array(
		'post_type' => $args['type'],
	));

	$randomID = rand(10,100);
	ob_start();
	if ( $random_query->have_posts() ) :
		echo '<div id="slide_'.$randomID.'" class="js-slide clients-slide">';
		while ( $random_query->have_posts() ) : $random_query->the_post();
			$position = get_field('position', $random_query->ID);
            $location = get_field('location', $random_query->ID);
            $ico = get_field('ico', $random_query->ID);
		?>

				<div class="clients-content bd-radius-12 bg-light px-1h py-3 p-md-1 p-md-3 m-1 mb-3 m-md-1q box-shadow">
					<div class="clients-top d-flex align-items-center mb-1h mb-md-3">
						<div class="clients-top-left bd-radius-20 w-50 h-50 w-md-124 h-md-124 mr-1 mr-md-2h">
							<img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php the_title();?>">
						</div>
						<div class="clients-top-right">
							<h3 class="fs-19 fs-md-28 fw-medium"><?php the_title();?></h3>
							<span class="fs-13 fs-md-19"><?php echo $position; ?></span>
						</div>
					</div>
					<div class="content"><?php the_content();?></div>
					<div class="location mt-1hq mt-md-3h d-flex justify-content-between align-items-center">
						<span class="d-inline-block pr-2 fs-11 fw-semibold"><?php echo $location; ?></span>
						<img class="w-40 w-md-68" src="<?php echo $ico; ?>" alt="">
					</div>
				</div>

		<?php endwhile;
		echo '</div>';
	endif;
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#slide_<?php echo $randomID;?>').slick({
					dots: true,
					arrows: true,
					infinite: true,
					autoplay: false,
					speed: 500,
					slidesToShow: 3,
					slidesToScroll: 1,
					prevArrow:"<button class='slick-btn prev slick-prev'><img src='/wp-content/themes/capichi_oi/common/images/arrow_left.png'></button>",
    				nextArrow:"<button class='slick-btn next slick-next'><img src='/wp-content/themes/capichi_oi/common/images/arrow_right.png'></button>",
					responsive: [
						{
							breakpoint: 1300,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
							},
						},
						{
							breakpoint: 993,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							},
						},
					],

				});
			});
		</script>
	<?php
	$list_post = ob_get_contents();

	ob_end_clean();


	return $list_post;
}
add_shortcode('get_post', 'create_shortcode_getpost');

// [get_post type="post" number="4" category="major-equipment"]

