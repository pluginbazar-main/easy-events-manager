<?php
/**
 * Single Event - Schedules
 *
 * @package single-event/schedules.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event;

$schedules = $event->get_schedules();

echo '<pre>';
print_r( $schedules );
echo '</pre>';

?>

<div <?php eem_print_event_section_classes( 'eem-event-section eem-schedules-style-1 eem-spacer eem-force-full-width' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading( array( 'heading' => esc_html__( 'Schedules', EEM_TD ) ) ); ?>

        <div class="eem-tab-panel">

            <div class="tab-nav">
				<?php
				$index = 0;
				foreach ( $schedules as $schedule_id => $schedule ) {
					$index ++;

					$active = $index == 1 ? 'active' : '';
					$label  = isset( $schedule['label'] ) ? $schedule['label'] : esc_html__( sprintf( 'Day %s', $index ), EEM_TD );

					printf( '<div class="tab-nav-item %s" data-target="schedule-%s">%s</div>', $active, $schedule_id, esc_html( $label ) );
				}
				?>
            </div>

            <div class="tab-content">

				<?php $index = 0;
				foreach ( $schedules as $schedule_id => $schedule ) :

					$index ++;

					$active        = $index == 1 ? 'active' : '';
					$label         = isset( $schedule['label'] ) ? $schedule['label'] : esc_html__( sprintf( 'Day %s', $index ), EEM_TD );
					$date          = isset( $schedule['date'] ) ? $schedule['date'] : '';
					$sessions      = isset( $schedule['sessions'] ) ? $schedule['sessions'] : array();
					$first_session = reset( $sessions );
					$last_session  = end( $sessions );
					$session_start = isset( $first_session['time_start'] ) ? $first_session['time_start'] : '';
					$session_end   = isset( $last_session['time_end'] ) ? $last_session['time_end'] : '';


					?>

                    <div class="tab-item-content <?php echo esc_attr( $active ); ?> schedule-<?php echo esc_attr( $schedule_id ); ?>">

                        <div class="eem-schedule-date-time">
							<?php printf( '<span class="eem-schedule-date"><i class="icofont-calendar"></i> %s</span>', date( 'j M, Y', strtotime( $date ) ) ) ?>
							<?php printf( '<span class="eem-schedule-time"><i class="icofont-wall-clock"></i> %s - %s</span>', $session_start, $session_end ); ?>
                        </div>

                        <div class="eem-sidebar-tabs">

                            <div class="tab-nav">
								<?php
								$session_index = 0;
								foreach ( $sessions as $session_id => $session ) {
									$session_index ++;

									$active = $session_index == 1 ? 'active' : '';
									printf( '<div class="tab-nav-item %s" data-target="session-%s">%s</div>', $active, $session_id, esc_html( $session_index ) );
								}
								?>
                            </div>

                            <div class="tab-content">

								<?php $session_index = 0;
								foreach ( $sessions as $session_id => $session ) :

									$session_index ++;

									$active  = $session_index == 1 ? 'active' : '';
									$s_label = isset( $session['s_label'] ) ? $session['s_label'] : '';
									$s_desc  = isset( $session['sd'] ) ? $session['sd'] : '';
									$s_start = isset( $session['time_start'] ) ? $session['time_start'] : '';
									$s_end   = isset( $session['time_end'] ) ? $session['time_end'] : '';
									$s_loc   = isset( $session['s_loc'] ) ? $session['s_loc'] : '';
									$s_meta  = array();

									if ( ! empty( $s_start ) && ! empty( $s_end ) ) {
										$s_meta[] = strtolower( sprintf( '<span>%s - %s</span>', $s_start, $s_end ) );
									}

									if ( ! empty( $s_loc ) ) {
										$s_meta[] = sprintf( '<span>%s</span>', $s_loc );
									}

									?>

                                    <div class="tab-item-content <?php echo esc_attr( $active ); ?> session-<?php echo esc_attr( $session_id ); ?>">
                                        <h3 class="eem-session-title">Introduction to WordPress</h3>

										<?php printf( '<div class="eem-session-meta">%s</div>', implode( '', $s_meta ) ); ?>

                                        <?php printf( '<div class="eem-session-desc">%s</div>', wpautop( $s_desc ) ); ?>

                                        <div class="eem-session-speakers">
                                            <div class="eem-session-speaker">
                                                <div class="speaker-img">
                                                    <a href="#"><img
                                                                src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                                                alt="Speaker 1"></a>
                                                </div>
                                                <div class="speaker-info">
                                                    <h3 class="speaker-name"><a href="#">J. Robert Hales</a></h3>
                                                    <h4 class="speaker-topics">Intro WordPress</h4>
                                                </div>
                                            </div>

                                            <div class="eem-session-speaker">
                                                <div class="speaker-img">
                                                    <a href="#"><img
                                                                src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                                                alt="Speaker 1"></a>
                                                </div>
                                                <div class="speaker-info">
                                                    <h3 class="speaker-name"><a href="#">J. Alex Furguson</a></h3>
                                                    <h4 class="speaker-topics">Intro WordPress</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

								<?php endforeach; ?>

                            </div>

                        </div>

                    </div>


				<?php endforeach; ?>

            </div>
        </div>

    </div>
</div>
