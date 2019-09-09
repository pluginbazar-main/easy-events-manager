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

global $event;

?>
<div class="eem-event-section eem-speaker-style-1 eem-spacer bg-white eem-force-full-width">
    <div class="pb-container">
        <div class="eem-section-heading">
            <h6 class="eem-sh-tagline">Welcome to Meetup</h6>
            <h2 class="eem-sh-title">Event Speakers</h2>
            <h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed ac
                velit iaculis, condimentum neque maximus urna. </h5>
        </div>

        <div class="pb-row pb-justify-content-center">

			<?php foreach ( $event->get_speakers() as $speaker_id => $speaker ) :

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

        <div class="view-more text-center">
            <a href="#" class="eem-btn eem-btn-large">All Speakers</a>
        </div>
    </div>
</div>
