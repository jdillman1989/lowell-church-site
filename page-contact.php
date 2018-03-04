<?php
// Template Name: Contact
get_header();
global $post;
?>

<section id="heading">
	<div class="text">
		<div class="container">
			<h1>Contact</h1>
		</div>
	</div>
</section>

<main id="site-main">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-sm-7 col-sm-offset-1 pull-right">
						<h2>Send a Message</h2>
						<form>
							<input id="full-name" type="text">
							<label for="full-name">Full Name</label>
							<div class="row">
								<div class="col-sm-6">
									<input id="phone" type="tel">
									<label for="phone">Phone</label>
								</div>
								<div class="col-sm-6">
									<input id="email" type="email">
									<label for="email">Email</label>
								</div>
							</div>
							<textarea id="comments"></textarea>
							<label for="comments">Comments</label>
							<fieldset class="radio break">
								<legend>Are you a current American Liberty Client?</legend>
								<label for="yes"><input id="yes" type="radio" name="current" value="Yes">Yes</label>
								<label for="no"><input id="no" type="radio" name="current" value="No">No</label>
							</fieldset>
							<hr>
							<div class="text-right">
								<input type="submit" value="Send">
							</div>
						</form>
					</div>
					<aside class="col-sm-4">
						<h2>Our Office</h2>
						<address>
							3601 North University Avenue<br>
							Suite 100<br>
							Provo, UT 84604
						</address>
						<a href="images/american-liberty-map.pdf">
							<img src="images/contact-map.jpg" alt="Map/directions">
						</a>
						<br>
						<a href="images/american-liberty-map.pdf">Download a PDF version here</a>
						<h2>Call Us</h2>
						<p>Phone: (801) 226-8008</p>
					</aside>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
