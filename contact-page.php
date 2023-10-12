<?php
session_start();

require_once('require/general-library.php');
$obj = new General();

$obj->header();
$obj->navbar();
 ?>

	<div class="container border border-2 border-warning rounded p-2" style="margin-top: 70px;">
		<div class="row mx-0 px-0 my-1">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php
				if (isset($_GET['msg'])) {
					?>
					<div class="alert <?php echo $_GET['color']; ?> text-center alert-dismissible fade show" role="alert">
  						<?php echo $_GET['msg'] ?>
  						  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<?php
				}
				 ?>
			</div>
			<div class="col-md-3"></div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 bg-warning rounded">
				<p class="display-3 text-light text-center">Contact Us</p>
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="lead">Our <b>Blog Website</b> is your gateway to a world of knowledge and inspiration. Dive into a diverse collection of articles, stories, and insights that cover a wide range of topics. From practical tips to thought-provoking discussions, we aim to inform, engage, and empower our readers on their journey of discovery and growth.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<p class="lead">Our blog website offers a treasure trove of insights and stories, enriching minds with diverse perspectives and empowering readers with valuable knowledge.</p>
			</div>
			<div class="col-md-6">
				<p class="lead">
					Explore our blog, a source of inspiration and wisdom, where thought-provoking content and engaging stories await, fostering personal growth and enlightenment.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="card text-bg-warning mb-3 text-light" style="max-width: 18rem;">
  				<div class="card-header">Phone Support</div>
  				<div class="card-body">
    			<h5 class="card-title">Instant assistance via phone call.</h5>
    			<p class="card-text">Reach our dedicated support team for immediate help with any inquiries or issues.</p>
  				</div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="card text-bg-warning mb-3 text-light" style="max-width: 18rem;">
  				<div class="card-header">Email Inquiry</div>
  				<div class="card-body">
    			<h5 class="card-title">Send questions or requests via email.</h5>
    			<p class="card-text">Drop us an email, and we'll respond promptly to address your queries or feedback.</p>
  				</div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="card text-bg-warning mb-3 text-light" style="max-width: 18rem;">
  				<div class="card-header">Social Media</div>
  				<div class="card-body">
    			<h5 class="card-title">Connect with us on social platforms.</h5>
    			<p class="card-text">Follow, message, or mention us on social media for updates, support, and interaction.</p>
  				</div>
				</div>

			</div>
			<div class="col-md-3">
				<div class="card text-bg-warning mb-3 text-light" style="max-width: 18rem;">
  				<div class="card-header">Feedback Form</div>
  				<div class="card-body">
    			<h5 class="card-title">Share your feedback and suggestions.</h5>
    			<p class="card-text">Tell us what you think through our feedback form, helping us improve our services.</p>
  				</div>
				</div>

			</div>
		</div>
		<?php $obj->feedback_form(); ?>
	</div>

<?php
$obj->footer();
 ?>