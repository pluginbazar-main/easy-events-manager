<?php
/**
 * EEM - Admin Templates - Event Meta Box
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


$schedules_fields = array(
	array(
		'options' => array(
			array(
				'id'            => '_event_date_',
				'title'         => esc_html__( 'Event Date', EEM_TD ),
				'details'       => esc_html__( 'Select a date for your event', EEM_TD ),
				'type'          => 'datepicker',
				'value'          => '2019-06-29',
				'placeholder'   => date( 'Y-m-d' ),
				'field_options' => array(
					'dateFormat' => 'yy-mm-dd',
				),
			),

			array(
				'id'            => '_event_time_start_',
				'title'         => esc_html__( 'Event Time', EEM_TD ),
				'details'       => esc_html__( 'Select a date for your event. This will set as Event Start time', EEM_TD ),
				'type'          => 'timepicker',
				'placeholder'   => date( 'H:s A' ),
				'field_options' => array(
					'interval' => 15,
					'dynamic'  => true,
				),
			),
		),
	)
);


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


            <div class="eem-side-nav-container">


                <?php
                $_event_schedules = eem_get_meta('_event_schedules', false, array() );

                echo "<pre>"; print_r( $_event_schedules  ); echo "</pre>";


                foreach( $_event_schedules as $schedule ) {


                }

                ?>


                <?php foreach( $_event_schedules as $schedule ) : ?>
                <div class="eem-side-nav">
                    <?php eem_print_event_schedule_day_nav(); ?>
                    <div class="eem-side-nav-item active" target="day-1">Day 1</div>
                    <div class="eem-side-nav-item" target="day-2">Day 2</div>
                    <div class="eem-side-nav-item" target="day-3">Day 3</div>
                </div>
                <?php endforeach; ?>

                <div class="eem-side-nav-content">

                    <div class="eem-side-nav-item-content active day-1">

	                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>

                        <div class="button eem-add-schedule"><?php esc_html_e( 'Add Schedule', EEM_TD ); ?></div>
                        <div class="eem-repeat-container">

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="eem-side-nav-item-content day-2">
                        <div class="button eem-add-schedule"><?php esc_html_e( 'Add Schedule', EEM_TD ); ?></div>
                        <div class="eem-repeat-container">

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="eem-side-nav-item-content day-3">
                        <div class="button eem-add-schedule"><?php esc_html_e( 'Add Schedule', EEM_TD ); ?></div>
                        <div class="eem-repeat-container">

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                            <div class="eem-repeat-single">
                                <div class="eem-repeat-head">
                                    <input type="text" name="" placeholder="<?php esc_html_e( 'Schedule name here', EEM_TD ); ?>">
                                    <div class="eem-head-button eem-repeat-close"><i class="icofont-close"></i></div>
                                    <div class="eem-head-button eem-repeat-sort"><i class="icofont-drag1"></i></div>
                                    <div class="eem-head-button eem-repeat-toggle"><i class="icofont-curved-down"></i></div>
                                </div>
                                <div class="eem-repeat-content">
				                    <?php eem()->PB()->generate_fields( $schedules_fields ); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>



        </div>

        <div class="tab-item-content guests">
            Guests
        </div>

    </div>

</div>
