<?php
/**
 * Single Event - Register
 *
 * @package single-event/register.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="eem-event-section eem-register-style-1 eem-spacer eem-force-full-width bg-white">
	<div class="pb-container">
		<div class="pb-row">
			<div class="pb-col-md-7">
				<div class="eem-section-heading">
					<h6 class="eem-sh-tagline">Registration form</h6>
					<h2 class="eem-sh-title">Register Now</h2>
					<h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed
						ac
						velit iaculis, condimentum neque maximus urna. </h5>
					<div class="join-as-volunteer">
						<a href="#" class="eem-btn eem-btn-large">Join As volunteer</a>
					</div>
				</div>
			</div>

			<div class="pb-col-md-5">
				<form class="eem-register-form">
					<div class="form-fields-wrap">
						<div class="form-group">
							<label for="name">Name</label>
							<input id="name" type="text" class="form-control" placeholder="James Smith">
						</div>

						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" id="email" class="form-control" placeholder="your@site.com">
						</div>

						<div class="form-group">
							<label for="tickets">Tickets</label>
							<select id="tickets" class="form-control">
								<option>Business</option>
								<option>Free</option>
								<option>Premium</option>
							</select>
						</div>

						<div class="form-group">
							<button type="submit" class="eem-btn eem-btn-round">Register</button>
						</div>
					</div>
				</form>
			</div>

		</div>

	</div>
</div>
