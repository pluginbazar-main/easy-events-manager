<?php
/**
 * Single Event - Speaker
 *
 * @package single-event/speaker.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $event, $template_section;

$count          = $template_section && isset( $template_section['count'] ) ? $template_section['count'] : 4;
$button         = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';
$event_speakers = $event->get_speakers();


?>
<div <?php eem_print_event_section_classes( 'eem-event-section eem-speaker-style-1 eem-spacer bg-white eem-force-full-width' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Speakers', EEM_TD ),
				'sub_heading' => esc_html__( 'Who will deliver speeches', EEM_TD ),
				'short_desc'  => esc_html__( 'Meet our speakers who will continue with their discussion', EEM_TD ),
			)
		); ?>

		<?php
		if ( empty( $event_speakers ) ) {
			eem_print_event_notice( apply_filters( 'eem_filters_speakers_not_found_text',
				esc_html__( 'No speaker assigned yet. We will announce latter. Stay close !', EEM_TD ) ), 'warning'
			);
		}
		?>

        <div class="pb-row pb-justify-content-center">

			<?php foreach ( $event->get_speakers( $count ) as $speaker_id => $speaker ) :

				$user_id = isset( $speaker['user_id'] ) ? $speaker['user_id'] : '';
				$topics = isset( $speaker['topics'] ) ? $speaker['topics'] : '';
				$user = get_user_by( 'ID', $user_id );

				?>

                <div class="pb-col-lg-3 pb-col-md-6">
                    <div class="eem-speaker-single">
                        <div class="speaker-img">
							<?php echo get_avatar( $user_id, 150 ); ?>
                        </div>
                        <div class="speaker-info">
                            <h4 class="speaker-name"><?php echo esc_html( $user->display_name ); ?></h4>
							<?php if ( ! empty( $topics ) ) : ?>
                                <p class="speaker-designation"><?php echo esc_html( $topics ); ?></p>
							<?php endif; ?>
                        </div>

						<?php eem_render_social_profiles(
							array(
								'user_id'       => $user_id,
								'wrapper'       => 'div',
								'wrapper_class' => 'speaker-social',
							)
						); ?>
                    </div>
                </div>

			<?php endforeach; ?>

        </div>

		<?php if ( ! empty( $event_speakers ) && $button !== 'yes' ) {
			eem_print_button( esc_html__( 'All Speakers', EEM_TD ), 'a', 'eem-btn eem-btn-large',
				$event->get_endpoint_url( 'speakers' ), '<div class="view-more text-center">%</div>' );
		} ?>

    </div>
</div>
