<?php get_header(); ?>

<main id="main">
  <div class="alt-background">
    <div class="container">
    	<div class="row">
	      <div class="col-lg-10 col-lg-offset-1">
          <!--begin content-->
          <?php
            if(have_posts()){
              while(have_posts()) { the_post();
                echo the_content();
              }
            }
          ?>
	      </div>
	    </div>
    </div>
  </div><!-- END .alt-background -->

  <div class="container">
  	<div class="row">
	    <div class="col-lg-10 col-lg-offset-1">
	    	<div class="row">
	    		<div class="col-sm-3">
            <?php
              $requiredState = get_post_meta(get_the_ID(),'required_state',true);
              if(strlen($requiredState)) {
                  echo $requiredState
            ?>
              <!--
  			      <h3 class="h3">Required State Forms</h3>
  			      <ul class="link-list">
  			        <li>
  			          <a href="#">First Report of Injury</a>
  			        </li>
  			      </ul>
            -->
            <?php } ?>
            <?php
              $employeeForms = get_post_meta(get_the_ID(),'additional_employee',true);
              if(strlen($employeeForms)) {
                echo $employeeForms;
            ?>
  			      <!--<label for="employee-forms" class="h3">Additional Employee Forms</label>
  			      <small>*Form is also in Spanish (El formulario es en Español también)</small>
  			      <div class="custom-select">
  				      <select id="employee-forms">
  				      	<option value="Select Form">Select Form</option>
  				      	<option value="Form A*">Form A*</option>
  				      	<option value="Form B*">Form B*</option>
  				      	<option value="Form C*">Form C*</option>
  				      	<option value="Form D*">Form D*</option>
  				      	<option value="Form E*">Form E*</option>
  				      </select>
  				    </div>
  			      <small><em>Forms A&mdash;E must be signed by the injured worker, and the employer must send them to Benchmark Administrators.</em></small>
            -->
            <?php } ?>
            <?php
              $employerForms = get_post_meta(get_the_ID(),'additional_employer',true);
              if(strlen($employerForms)) {
                echo $employerForms;
            ?>
  			      <!--<label for="employer-forms" class="h3">Additional Employer Forms</label>
  			      <div class="custom-select">
  				      <select id="employer-forms">
  				      	<option value="Select Form">Select Form</option>
  				      	<option value="OSHA 300 Log Information">OSHA 300 Log Information</option>
  				      </select>
  				    </div>-->
            <?php } ?>
			    </div>

			    <div class="col-sm-8 col-sm-offset-1">
			    	<h3 class="h3">Medical Provider Network</h3>
			    	<div class="map" id="googleMap" style="width:100%; height:500px;">
			    		<!--<img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="">-->
			    	</div>
            <?php
              //stateid is the relationship field on the medical_provider child pod
              //post_title is the state name, which is the same as get_the_title()
              $params = array('where' => "stateid.post_title = '" . get_the_title() . "'");
              $providers = pods('medical_provider')->find($params);
            ?>
            <div class="map-results">
			    		<div class="row">
                  <?php
                    while($providers->fetch()) {  //loop the providers found
                      echo '<div class="col-sm-6">';
                      echo '  <div class="map-result">';
                      echo '<p>' . $providers->display('post_title') . "<br/>\r\n";
                      echo $providers->field('post_content') . "<br/>\r\n";
                      echo $providers->display('provider_phone') . "<br/>\r\n";
  			    				  echo '  </p></div>';
  			    			    echo '</div>';
                    }
                  ?>
			    	</div>
			    </div>
			  </div>
        <div class="col-sm-12">
  	      <h3 class="h3">Please send the Form IA &ndash; 1 and the medical slip to:</h3>
  	      <p>
  	        Benchmark Administrators<br>
  					3791 Southern Boulevard SE #240<br>
  					Rio Rancho, NM 87124<br>
  					Telephone: (505) 219-2924	Toll free (800) 362-5198<br>
  					Fax (505) 892-1350
  	      </p>
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
<?php
  //stateid is the relationship field on the medical_provider child pod
  //post_title is the state name, which is the same as get_the_title()
  $params = array('where' => "stateid.post_title = '" . get_the_title() . "'");
  $providers = pods('medical_provider')->find($params);
?>
<script>
  var providers = [<?php while($providers->fetch()){
      echo "{title: '" . $providers->display('post_title') . "', lat:" . $providers->display('latitude') . ", lng:" . $providers->display('longitude') . "},";
    }?>];//reference the data set we have on the state page;
</script>

<?php get_footer(); ?>
