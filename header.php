<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
    global $tp_options;
    $lang = get_bloginfo("language");

?>
<?php
$a=5;
// echo $a++; =>5 
echo $a;
echo -$a;
echo ++$a;
?>
<header class="header d-flex flex-column">
	<div class="container">
		<div class="header-left d-flex align-items-center">
			<div class="header-logo bd-right-lg-fifth-2 pr-1 pr-lg-3">
				<?php the_custom_logo();?>
			</div>
			<div class="language d-none d-lg-inline-flex">
				<?php pll_the_languages(array('dropdown'=>1, 'display_names_as'=>'slug')); ?>
			</div>
		</div>
		<div class="header-nav">
			<div class="d-lg-none header-logo mb-3q">
				<?php the_custom_logo();?>
			</div>
			<?php wp_nav_menu(array("theme_location" => "primary-menu"));?>
			<ul class="d-lg-flex align-items-center list-style-none mt-3q mt-lg-0 w-100 w-lg-unset">
				<li class="ml-lg-3 by-seventh-1 bd-lg-none pt-1h pb-1h mb-4h mb-lg-0"><a class="fs-19 fw-semibold text-secondary btn-show" href="#">
					<?php if($tp_options['lang-download']):foreach($tp_options['lang-download'] as $key=>$value):?>          
                        <?php 
                        if(str_contains(strtolower($value), explode('-',$lang)[0])) :
                            echo '<span class="text-underline-secondary">'.$tp_options['header-download'][$key],'</span>';
                        endif;
                        ?>
                    <?php endforeach;endif; ?><span class="d-block d-lg-none fs-11 text-primary text-decoration-none">To present you all you need to know </span></a>
				</li>
				<li class="ml-lg-3 text-center"><a class="ml-auto mr-auto m-lg-0 bg-secondary bd-radius-4 btn-contact fs-19 fw-semibold text-light" href="#contact">
					<?php if($tp_options['lang-contact']):foreach($tp_options['lang-contact'] as $key=>$value):?>          
                        <?php 
                        if(str_contains(strtolower($value), explode('-',$lang)[0])) :
                            echo $tp_options['header-contact'][$key];
                        endif;
                        ?>
                    <?php endforeach;endif; ?>
				</a></li>
			</ul>
			<div class="language w-100 d-inline-flex align-items-center d-lg-none mt-4q ml-auto mr-auto">
				<img src="<?php echo get_template_directory_uri(); ?>/common/images/ico-lang.png" alt="ico"><?php pll_the_languages(array('dropdown'=>1)); ?>
			</div>
		</div>
		<div class="d-flex align-items-center">
			<!-- <a class="bg-secondary bd-radius-4 btn-contact fs-14 fs-lg-16 fs-lg-19 fw-semibold text-light d-lg-none mr-3" href="#contact">
				<?php if($tp_options['lang-contact']):foreach($tp_options['lang-contact'] as $key=>$value):?>          
					<?php 
					if(str_contains(strtolower($value), explode('-',$lang)[0])) :
						echo $tp_options['header-contact'][$key];
					endif;
					?>
				<?php endforeach;endif; ?>
			</a> -->
			<button class="header-toggle-navi js-toggle-navi d-lg-none">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</div>
</header>