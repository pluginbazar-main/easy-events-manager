<?php
/**
 * Single Event - Blog
 *
 * @package single-event/blog.php
 * @copyright Pluginbazar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div <?php eem_print_event_section_classes( 'eem-event-section eem-nearby-style-1 eem-blog-style-1 bg-white eem-force-full-width eem-spacer' ); ?>>
    <div class="pb-container">

		<?php eem_print_event_section_heading(
			array(
				'heading'     => esc_html__( 'Exploring Nearby', EEM_TD ),
				'sub_heading' => esc_html__( 'Would like to know more', EEM_TD ),
				'short_desc'  => esc_html__( 'Have some great time at the event location. Here are some detailed information about nearby facts.', EEM_TD ),
			)
		); ?>

        <div class="pb-row">
            <div class="pb-col-md-6">
                <div class="tab-nav">
                    <div class="tab-nav-item active" data-target="day-1">
                        <i class="icofont-hotel"></i>
                        <span>Nearby Hotel</span>
                    </div>
                    <div class="tab-nav-item" data-target="day-2">
                        <i class="icofont-airplane-alt"></i>
                        <span>Transport Services</span>
                    </div>
                    <div class="tab-nav-item" data-target="day-3">
                        <i class="icofont-location-pin"></i>
                        <span>Historical Places</span>
                    </div>
                </div>
            </div>

            <div class="pb-col-md-6">
                <div class="post-item">
                    <div class="post-image">
                        <a href="#">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2019/01/Blog-3.jpg"
                                 alt="Blog Image">
                        </a>
                    </div>
                    <div class="post-body">
                        <div class="post-meta">
                                <span class="post-author">
                                    <i class="icofont-user"></i>
                                    <a href="#">Pluginbazar</a>
                                </span>
                            <span class="post-meta-date">
                                    <i class="icofont-calendar"></i> January 01,2019
                                </span>
                        </div>
                        <h2 class="post-title">
                            <a href="#">Budgets for Business Events</a>
                        </h2>
                        <div class="post-content">
                            <p>There’s such a thing as “too much information”, especially for</p>
                        </div>
                        <div class="post-footer">
                            <a href="#" class="eem-btn"> Read More <i class="icofont-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>