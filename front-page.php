<?php get_header(); ?>

<main id="main" class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
		  <div class="centered no-padding">
		    <h1 class="h1">Select a State</h1>
		    <p>Select the state where payroll is finalized.</p>
		  </div>

      <div class="state-grid">
				<div class="row">
          <?php
            $params = array(
              'orderby' => 'post_title'
                //'where'=>"category.name = 'My Category'"
            );
            $states = pods( 'state' )->find($params);
            while( $states->fetch()) {
              echo "<div class='col-sm-4'>";
              echo "  <a class='state-single' href='" . $states->display('the_permalink') . "' style='background-image: url(" . get_the_post_thumbnail_url($states->display('id')) . ");'>"; //background-image: url(assets/images/arizona.jpg);
              echo "    <span>" . $states->display('post_title') . "</span>";
              echo "  </a>";
              echo "</div>";
            }
          ?>
        </div>
      </div>
		</div>
	</div>
</main><!-- END #main.container -->
<div class="container-fluid contact-footer">
	<div class="row">
	  <div class="col-sm-8 col-sm-offset-2 centered">
      <?php
        if(is_active_sidebar('footer-hotline')) {
          dynamic_sidebar('footer-hotline');
        } else {  //default content
      ?>
        <h2 class="h2 contact-title">Injured Workers Hotline</h2>
        <p class="contact-number">1-800-289-4502</p>
        <p class="contact-footnote">Available <abbr title="24 hours a day, 7 days a week">24/7</abbr></p>
      <?php }
      ?>

	  </div>
	</div>
</div>
<?php get_footer(); ?>
