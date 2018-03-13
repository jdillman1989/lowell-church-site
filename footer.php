    <footer class="site-footer">
      <div class="container">
      	<div class="row">
	        <div class="col-md-4">
	          <img class="footer-logo" src="<?php echo get_template_directory_uri(); ?>/images/footer_logo.png" alt="" />
	        </div>

	        <div class="col-md-2">
            <?php
              $args = array(
                'theme_location' => 'nav-footer',
                'container' => '',
                'items_wrap' => '<ul class="link-list list-unstyled" id="%1$s" role="navigation">%3$s</ul>'
              );
              wp_nav_menu($args);
            ?>
	          <!--<ul class="link-list list-unstyled">
	            <li class="link-list-item">
	              <a href="#">About Us</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#">Contact</a>
	            </li>
	          </ul>-->
	        </div>

	        <div class="col-md-2 col-md-offset-1">
	          <h2 class="h2">File a claim:</h2>
            <ul class="link-list list-unstyled">
            <?php
              $params = array(
                'orderby' => 'post_title'
                  //'where'=>"category.name = 'My Category'"
              );
              $states = pods( 'state' )->find($params);
              while($states->fetch()) {
                echo '<li class="link-list-item"><a href="' . $states->display('the_permalink') . '" title="File a claim, ' . $states->display('post_title') . '">' . $states->display('post_title') . '</a></li>';
              }
            ?>

	          <!--<ul class="link-list list-unstyled">
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Arizona">Arizona</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Arkansas">Arkansas</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, California">California</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Idaho">Idaho</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Kansas">Kansas</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Missouri">Missouri</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Nevada">Nevada</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, New Mexico">New Mexico</a>
	            </li>
	            <li class="link-list-item">
	              <a href="#" title="File a claim, Utah">Utah</a>
	            </li>
	          </ul>-->
	        </div>

	        <div class="col-md-2 footer-address">
	          <p class="strong">
              <?php
                if(is_active_sidebar('footer-address')) {
                  dynamic_sidebar('footer-address');
                } else {  //default content
              ?>
                Benchmark Administrators<br>
                430 North Vineyard Avenue Suite 200<br>
                Ontario, CA 94764<br>
                <span title="Benchmark Administrators, Contact Telephone number">(800) 362-5198</span>
              <?php }
              ?>
	          </p>
	        </div>
	      </div>
      </div>
      <?php
      echo get_page_template();
      ?>
    </footer>

    <?php wp_footer(); ?>
	
	<!-- Prod -->
    <!-- <script src="//maps.google.com/maps/api/js?key=AIzaSyCKTr_fy7ybCeso2cVq8RqnwdqimWevQBM&callback=initMap" /> -->

    <!-- Local -->
    <script src="//maps.google.com/maps/api/js?key=AIzaSyCoiA67LCu-560-AYtWNVgv-n4TMalTemc&callback=initMap" />
  </body>
</html>
