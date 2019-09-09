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

$unique_id = uniqid();

?>
<div class="eem-event-section eem-force-full-width eem-banner-style-1"
     style="background-image: url(http://smart.commonsupport.com/miexpo/wp-content/uploads/2019/07/1-1.jpg)">
    <div class="pb-container">
        <div class="eem-banner-wrap">
            <h3 class="eem-banner-sub-title">International Convention City Bashundhara, Dhaka</h3>
            <h1 class="eem-banner-title">Welcome to WordCamp Dhaka 2019</h1>

            <div id="eem-countdown-timer-<?php echo esc_attr( $unique_id ); ?>" class="eem-countdown-timer"></div>

            <script>


                (function ($, window, document) {
                    "use strict";

                    (function updateTime() {

                        var countDownDate = new Date(new Date('Sep 20, 2020').toString()).getTime(),
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

            <a href="#" class="eem-btn eem-btn-large">Buy Ticket</a>
        </div>
    </div>
</div>
