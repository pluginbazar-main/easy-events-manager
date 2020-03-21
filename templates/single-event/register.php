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

global $event;

?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-register-style-1 eem-spacer bg-white' ); ?>>
    <div class="pb-container">
        <div class="pb-row">

            <div class="pb-col-md-7">
				<?php eem_print_event_section_heading(
					array(
						'heading'     => esc_html__( 'Register Now', EEM_TD ),
						'sub_heading' => esc_html__( 'Ready to reserve your seat', EEM_TD ),
						'short_desc'  => esc_html__( 'Never be late with registration, all available seats can fill quickly.', EEM_TD ),
					)
				); ?>
            </div>

            <div class="pb-col-md-5">

                <form class="eem-register-form">

                    <div class="form-fields-wrap">

                        <p class="eem-form-notices"></p>

                        <div class="form-group">
                            <label for="name"><?php esc_html_e( 'Full Name', EEM_TD ); ?></label>
                            <input required id="name" name="full_name" type="text" class="form-control"
                                   placeholder="James Smith">
                        </div>

                        <div class="form-group">
                            <label for="email"><?php esc_html_e( 'Email Address', EEM_TD ); ?></label>
                            <input required type="email" name="email_add" id="email" class="form-control"
                                   placeholder="mail@your-site.com">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="event_id" value="<?php echo esc_attr( $event->get_id() ); ?>">
                            <button type="submit"
                                    class="eem-btn eem-btn-round"><?php esc_html_e( 'Register Now', EEM_TD ); ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
