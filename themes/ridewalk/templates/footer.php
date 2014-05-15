<footer class="content-info" role="contentinfo">
  <div class="container">

	<div class="alertbar row">
		<div class="col-sm-9">
			<h1>Questions?</h1>
			<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam er?</p>
		</div>
		<div class="col-sm-3 right">
			<a href="#" role="button" class="btn btn-lg btn-primary">Contact Us</a>
		</div>
	</div>

    <div class="row">
    	<div class="col-md-12 footer-sitemap">
	    	<div class="col-five">
	    		<p>About</p>
    			<ul>
    				<li>
    					<a href="/test-subpage/">Test Subpage</a>
    				</li>
				</ul>
	    	</div>
	    	<div class="col-five">
              <?php
              $segment = "Ride";
              wp_nav_menu(
                array(
                  'theme_location'  => 'primary_navigation',
                  'segment'			=> $segment,
                  'items_wrap'      => '<p>'.$segment.'</p><ul id="%1$s" class="%2$s">%3$s</ul>',
                )
              );
              ?>
	    	</div>
	    	<div class="col-five">
              <?php
              $segment = "Walk";
              wp_nav_menu(
                array(
                  'theme_location'  => 'primary_navigation',
                  'segment'			=> $segment,
                  'items_wrap'      => '<p>'.$segment.'</p><ul id="%1$s" class="%2$s">%3$s</ul>',
                )
              );
              ?>
	    	</div>
	    	<div class="col-five">
              <?php
              $segment = "Maps";
              wp_nav_menu(
                array(
                  'theme_location'  => 'primary_navigation',
                  'segment'			=> $segment,
                  'items_wrap'      => '<p>'.$segment.'</p><ul id="%1$s" class="%2$s">%3$s</ul>',
                )
              );
              ?>
	    	</div>
	    	<div class="col-five">
              <?php
              $segment = "Connect";
              wp_nav_menu(
                array(
                  'theme_location'  => 'primary_navigation',
                  'segment'			=> $segment,
                  'items_wrap'      => '<p>'.$segment.'</p><ul id="%1$s" class="%2$s">%3$s</ul>',
                )
              );
              ?>
	    	</div>
	    </div>
    </div>

    <p class="small">Design work for ridewalk.com was generously funded by the Kosciusko County Convention, Recreation, and Visitor Commission</p>
    <p class="small">Copyright <?php echo date('Y'); ?>. City of Warsaw, Indiana</p>

  </div>
</footer>

<?php wp_footer(); ?>
