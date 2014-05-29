<footer class="content-info" role="contentinfo">
  <div class="container">

	<div class="alertbar row">
		<div class="col-sm-9">
			<h1>Want to Help Out?</h1>
			<p>Are you looking for ways to get involved in improving the quality of life in your community? There are many opportunities to help in the ongoing effort to build a bicycle and pedestrian friendly community!</p>
		</div>
		<div class="col-sm-3 right">
			<a href="<?php echo get_permalink(100); ?>" role="button" class="btn btn-lg btn-primary">Get Involved!</a>
		</div>
	</div>

    <div class="row">
    	<div class="col-md-12 footer-sitemap">
	    	
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
                  'items_wrap'      => '<p>'.$segment.'</p><ul id="%1$s" class="%2$s">%3$s<li><a href="'.get_permalink(61).'">Advisory Committee</a></li></ul>',
                )
              );
              ?>
	    	</div>
        <div class="col-five">
	    		<p>Social</p>
    			<ul>
    				<li>
    					<a href="https://www.facebook.com/RWWWL">Facebook</a>
    				</li>
            <li>
    					<a href="https://twitter.com/RideWalkWrswWL">Twitter</a>
    				</li>           
				</ul>
	    	</div>
	    </div>
    </div>

    <p class="small">Design work for ridewalk.com was generously funded by the Kosciusko County Convention, Recreation, and Visitor Commission</p>
    <p class="small">Copyright <?php echo date('Y'); ?>. City of Warsaw, Indiana</p>

  </div>
</footer>

<?php wp_footer(); ?>
