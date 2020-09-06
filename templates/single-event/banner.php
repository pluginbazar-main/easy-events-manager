<?php
/**
 * Single Event - Banner
 *
 * @package single-event/banner.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$style = 2; // Delete this line when it will work dynamically

global $event, $template_section;

$alignment = $template_section && isset( $template_section['alignment'] ) ? $template_section['alignment'] : 'center';
$button    = $template_section && isset( $template_section['button'] ) && is_array( $template_section['button'] ) ? reset( $template_section['button'] ) : '';
$bg_image  = $style == 1 ? $event->get_thumbnail() : '';
$bg_image  = empty( $bg_image ) ? '' : sprintf( 'style="background-image: url(\'%s\')"', $bg_image );
$unique_id = uniqid();
$alignment = sprintf( 'eem-banner-align-%s', $alignment );



?>

<div <?php eem_print_event_section_classes( "eem-event-section eem-banner-style-1 $alignment" ); ?> <?php echo $bg_image; ?>>
    <div class="pb-container">
        <div class="eem-banner-wrap">
            <h3 class="eem-banner-sub-title"><?php echo esc_html( $event->get_location() ); ?></h3>
            <h1 class="eem-banner-title"><?php echo esc_html( $event->get_name() ); ?></h1>

            <div id="eem-countdown-timer-<?php echo esc_attr( $unique_id ); ?>" class="eem-countdown-timer"></div>

            <script>
                (function ($, window, document) {
                    "use strict";

                    (function updateTime() {

                        var countDownDate = new Date(new Date('<?php echo $event->get_event_datetime( 'start', 'M d, Y H:i' ); ?>').toString()).getTime(),
                            now = new Date().getTime(),
                            distance = countDownDate - now,
                            days = 0, hours = 0, minutes = 0, seconds = 0;

                        if (distance > 0) {
                            days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            // hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) + days * 24);
                            minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        }

                        days = days < 10 ? '0' + days : days;
                        hours = hours < 10 ? '0' + hours : hours;
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        seconds = seconds < 10 ? '0' + seconds : seconds;

                        $("#eem-countdown-timer-<?php echo esc_attr( $unique_id ); ?>").html(
                            '<span class="days"><span class="count-number">' + days + '</span><span class="count-text">Days</span></span>' +
                            '<span class="hours"><span class="count-number">' + hours + '</span><span class="count-text">Hours</span></span>' +
                            '<span class="minutes"><span class="count-number">' + minutes + '</span><span class="count-text">Minutes</span></span>' +
                            '<span class="seconds"><span class="count-number">' + seconds + '</span><span class="count-text">Seconds</span></span>');

                        setTimeout(updateTime, 1000);
                    })();

                })(jQuery, window, document);

            </script>

			<?php do_action( 'eem_section_banner_button', $button, $template_section ); ?>

        </div>
    </div>
</div>
