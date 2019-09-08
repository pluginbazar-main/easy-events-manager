<?php
/**
 * EEM - Admin Templates - Event Meta Box
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

?>
<div class="eem-tab-panel">

    <div class="tab-nav">
        <div class="tab-nav-item" target="general-info"><?php esc_html_e( 'General Info', EEM_TD ); ?></div>
        <div class="tab-nav-item" target="speakers"><?php esc_html_e( 'Speakers', EEM_TD ); ?></div>
        <div class="tab-nav-item active" target="schedules"><?php esc_html_e( 'Schedules', EEM_TD ); ?></div>
        <div class="tab-nav-item" target="guests"><?php esc_html_e( 'Guests', EEM_TD ); ?></div>
    </div>

    <div class="tab-content">

        <div class="tab-item-content general-info">
			<?php eem()->PB()->generate_fields( $this->get_meta_fields( 'general-info' ), $post->ID ); ?>
        </div>

        <div class="tab-item-content speakers">
            Speakers
        </div>

        <div class="tab-item-content schedules active">

            <div class="button eem-add-day"><?php esc_html_e( 'Add Day', EEM_TD ); ?></div>

            <div class="eem-side-nav-container">


				<?php
				$_event_schedules = eem_get_meta( '_event_schedules', false, array() );

				echo '<pre>'; print_r( $_event_schedules ); echo '</pre>';

				?>

                <div class="eem-side-nav">

				<?php
                eem_print_event_schedule_day_nav( array( 'index' => 0 ) );
                eem_print_event_schedule_day_nav( array( 'index' => 1 ) );
                foreach ( $_event_schedules as $schedule ) : ?>

                    <?php eem_print_event_schedule_day_nav(); ?>

				<?php endforeach; ?>
                </div>

                <div class="eem-side-nav-content">

					<?php
                    eem_print_event_schedule_day_content( array( 'index' => 0 ) );
                    eem_print_event_schedule_day_content( array( 'index' => 1 ) );

					foreach ( $_event_schedules as $schedule ) :
						eem_print_event_schedule_day_content( $schedule );
					endforeach; ?>

                </div>

            </div>


        </div>

        <div class="tab-item-content guests">
            Guests
        </div>

    </div>

</div>
