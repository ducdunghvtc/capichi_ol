<?php

    global $tp_options;

    $lang = get_bloginfo("language");

?>

<footer class="footer">

    <div class="py-6h">

        <div class="container">

            <div class="footer-left">

                <div class="footer-logo">

                    <a href="/"><img src="<?php echo $tp_options['footer-logo']['url']; ?>" alt="logo"></a>

                </div>

                <p class="fs-9 text-sixth mt-2 mb-5">

                    <?php if($tp_options['description']):foreach($tp_options['description'] as $key=>$value):?>          

                        <?php 

                        if(str_contains(strtolower($value), explode('-',$lang)[0])) :

                            echo $tp_options['desc'][$key];

                        endif;

                        ?>

                    <?php endforeach;endif; ?>

                </p>

                <div class="language d-flex align-items-center">

                    <img class="mr-1" src="<?php echo get_template_directory_uri(); ?>/common/images/ico-lang.png" alt="ico"><?php pll_the_languages(array('dropdown'=>1)); ?>

                </div>

            </div>

            <div class="footer-right d-flex justify-content-end">

                <?php wp_nav_menu(array("theme_location" => "footer-menu"));?>

                <div class="footer-contact mt-3 mt-md-0">

                    <div class="title fw-bold fs-16 fs-md-28 text-third">

                        <?php if($tp_options['lang-title']):foreach($tp_options['lang-title'] as $key=>$value):?>          

                        <?php 

                            if(str_contains(strtolower($value), explode('-',$lang)[0])) :

                                echo $tp_options['title'][$key];

                            endif;

                            ?>

                        <?php endforeach;endif; ?>

                    </div>

                    <ul class="list-style-none justify-content-end mt-1hq">

                        <?php if($tp_options['footer-contact']):foreach($tp_options['footer-contact'] as $key=>$value):?>          

                            <li class="mb-2"><a class="d-flex align-items-center fs-12 fs-md-16 text-sixth fw-semibold" href="<?php echo $value['url']; ?>"><img class="w-21 mr-1h" src="<?php echo $value['image']; ?>" alt="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></li>

                        <?php endforeach;endif; ?>

                    </ul>

                    <ul class="mt-md-4 social-list d-flex align-items-center list-style-none">

                        <?php if($tp_options['footer-social']):foreach($tp_options['footer-social'] as $key=>$value):?>          

                            <li class="<?php if($value['sort'] != 0) : echo 'ml-1 ml-md-3'; endif; ?>"><a href="<?php echo $value['url']; ?>"><img src="<?php echo $value['image']; ?>" alt="<?php echo $value['title']; ?>"></a></li>

                        <?php endforeach;endif; ?>

                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="container">
        <p class="bd-top-third-1 py-1h pt-md-4 pb-md-3h px-2 fs-9 w-100 footer-copyright text-center text-fourth">

            <?php if($tp_options['lang-copyright']):foreach($tp_options['lang-copyright'] as $key=>$value):?>          

            <?php 

                if(str_contains(strtolower($value), explode('-',$lang)[0])) :

                    echo $tp_options['copyright'][$key];

                endif;

                ?>

            <?php endforeach;endif; ?>

        </p>

    </div>

</footer>
<div class="modal">
    <div class="modal-content">
      <span class="close d-inline-block"><img src="<?php echo get_template_directory_uri(); ?>/common/images/ico-close.png" alt="close"></span>
      <img class="ml-auto mr-auto modal-image d-block mt-2 mt-md-5 mb-2 mb-md-4" src="<?php echo get_template_directory_uri(); ?>/common/images/download.png" alt="ico download">
      <?php echo do_shortcode('[contact-form-7 id="511" title="Form Download"]'); ?>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php wp_footer();?>

</body>

</html>

