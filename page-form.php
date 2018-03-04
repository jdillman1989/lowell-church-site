<?php
// Template Name: Form
get_header();
global $post;
?>

<section id="heading" class="alt">
	<div class="text">
		<div class="container">
			<h1>Arizona</h1>
		</div>
	</div>
</section>

<main id="site-main">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2>File a Claim</h2>
				<p>Start by selecting the state where payroll is finalized</p>
				<nav id="form-nav">
					<ul>
						<li class="active link-0"><a href="#">Worker Info</a></li>
						<li class="link-1"><a href="#">Employer Info</a></li>
						<li class="link-2"><a href="#">Injury Details</a></li>
						<li class="link-3"><a href="#">Cause of Injury</a></li>
						<li class="link-4"><a href="#">Wage Data</a></li>
						<li class="link-5"><a href="#">Signature</a></li>
					</ul>
				</nav>
				<form id="form-content">
					<div class="section section-0">
						<div class="form-section">
							<h3>Personal</h3>
							<div class="row">
								<div class="col-sm-6">
									<input id="first-name" type="text">
									<label for="first-name">First Name</label>
								</div>
								<div class="col-sm-6">
									<input id="last-name" type="text">
									<label for="last-name">Last Name</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input id="dob" type="text">
									<label for="dob">Date of Birth</label>
								</div>
								<div class="col-sm-6">
									<input id="ssn" type="text">
									<label for="ssn">Social Security #</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="custom-select">
										<select id="marital-status">
											<option value=""></option>
											<option value="Single">Single</option>
											<option value="Married">Married</option>
											<option value="Separated">Separated</option>
										</select>
									</div>
									<label for="marital-status">Marital Status</label>
								</div>
								<div class="col-sm-6">
									<fieldset class="radio">
										<legend>Gender</legend>
										<label for="female"><input id="female" type="radio" name="gender" value="Female">Female</label>
										<label for="male"><input id="male" type="radio" name="gender" value="Male">Male</label>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="form-section">
							<h3>Work Related</h3>
							<div class="row">
								<div class="col-sm-6">
									<input id="occupation" type="text">
									<label for="occupation">Occupation/Job Title</label>
								</div>
								<div class="col-sm-6">
									<input id="employment-status" type="text">
									<label for="employment-status">Worker's Employment Status</label>
								</div>
							</div>
						</div>
						<div class="form-section">
							<h3>Address</h3>
							<input id="street" type="text">
							<label for="street">Street Address</label>
							<div class="row">
								<div class="col-sm-6">
									<input id="city" type="text">
									<label for="city">City</label>
								</div>
								<div class="col-sm-6">
									<div class="custom-select">
										<select id="state">
											<option value=""></option>
											<option value="AL">Alabama</option>
											<option value="AK">Alaska</option>
											<option value="AZ">Arizona</option>
											<option value="AR">Arkansas</option>
											<option value="CA">California</option>
											<option value="CO">Colorado</option>
											<option value="CT">Connecticut</option>
											<option value="DE">Delaware</option>
											<option value="DC">District Of Columbia</option>
											<option value="FL">Florida</option>
											<option value="GA">Georgia</option>
											<option value="HI">Hawaii</option>
											<option value="ID">Idaho</option>
											<option value="IL">Illinois</option>
											<option value="IN">Indiana</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
											<option value="LA">Louisiana</option>
											<option value="ME">Maine</option>
											<option value="MD">Maryland</option>
											<option value="MA">Massachusetts</option>
											<option value="MI">Michigan</option>
											<option value="MN">Minnesota</option>
											<option value="MS">Mississippi</option>
											<option value="MO">Missouri</option>
											<option value="MT">Montana</option>
											<option value="NE">Nebraska</option>
											<option value="NV">Nevada</option>
											<option value="NH">New Hampshire</option>
											<option value="NJ">New Jersey</option>
											<option value="NM">New Mexico</option>
											<option value="NY">New York</option>
											<option value="NC">North Carolina</option>
											<option value="ND">North Dakota</option>
											<option value="OH">Ohio</option>
											<option value="OK">Oklahoma</option>
											<option value="OR">Oregon</option>
											<option value="PA">Pennsylvania</option>
											<option value="RI">Rhode Island</option>
											<option value="SC">South Carolina</option>
											<option value="SD">South Dakota</option>
											<option value="TN">Tennessee</option>
											<option value="TX">Texas</option>
											<option value="UT">Utah</option>
											<option value="VT">Vermont</option>
											<option value="VA">Virginia</option>
											<option value="WA">Washington</option>
											<option value="WV">West Virginia</option>
											<option value="WI">Wisconsin</option>
											<option value="WY">Wyoming</option>
										</select>
									</div>
									<label for="state">State</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<input id="zip" type="text">
									<label for="zip">Zip</label>
								</div>
							</div>
						</div>
						<hr>
						<footer class="text-right">
							<a class="text-btn wide next" href="#">Next</a>
						</footer>
					</div>
					<div class="section section-1">
						<hr>
						<footer class="text-right">
							<a class="text-btn wide next" href="#">Next</a>
						</footer>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
