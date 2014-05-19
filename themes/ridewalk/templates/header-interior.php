<header class="banner" role="banner">
  <div class="overlay">
    <div class="container">
      <div class="row navwrap">
        <div class="col-lg-12">
          <a class="brand" href="<?php echo home_url('/') ?>"><img src="<?php echo get_bloginfo('template_directory');?>/assets/img/ride_walk_logo.png" alt="<?php bloginfo('name'); ?>" /></a>
          <nav class="nav-main" role="navigation">
            <?php
              if ( has_nav_menu('primary_navigation') ) :
                $twitter_url = '#';
                $facebook_url = '#';
                $socials_html = '<li class="social menu-social">
                                  <div class="icons">
                                    <a href="'.$twitter_url.'">
                                      <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="'.$facebook_url.'">
                                      <i class="fa fa-facebook"></i>
                                    </a>
                                  </div>
                                  <span>Social</span>
                                </li>';
                wp_nav_menu(
                  array(
                    'theme_location'  => 'primary_navigation',
                    'menu_class'      => 'primary-nav',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s' . $socials_html . '</ul>'
                  )
                );
              endif;
            ?>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumbs">
              <?php if(function_exists('bcn_display'))
              {
                  bcn_display();
              }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>