<?php

/**
 * Archive Event
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>


    <div class="eem-force-full-width eem-event-search">
        <div class="pb-container">
            <div class="eem-event-search-wrap">
                <h2 class="eem-event-search-title">Find your Event</h2>
                <form class="eem-event-search-form">
                    <div class="form-fields-wrap">
						<?php eem()->PB()->generate_fields( array( array( 'options' => eem()->get_archive_search_fields() ) ) ); ?>
                    </div>

                    <div class="eem-search-footer">
                        <p class="eem-search-total-count">There are over 143 Events for you.</p>
                        <div class="eem-fields-expand-btn"><i class="icofont-listine-dots"></i> Advanced search</div>
                    </div>

                    <div class="form-button-wrap">
                        <button class="eem-btn">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="eem-force-full-width eem-event-style-1 eem-spacer">
        <div class="pb-container">
            <div class="pb-row">
                <div class="pb-col-md-4">
                    <div class="eem-event-single">
                        <div class="image-wrap">
                            <a href="#">
                                <img src="https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/event-5.jpg" alt="Event Image">
                            </a>

                            <span class="eem-event-status">Upcoming</span>
                        </div>

                        <div class="eem-event-content">
                            <h2><a href="#">Welcome to WordCamp Dhaka 2019</a></h2>
                            <div class="event-meta">
                                <span class="event-meta-date">
                                    <i class="icofont-calendar"></i>
                                    <span>21 Sep 2019</span>
                                </span>
                                <span class="event-meta-location">
                                    <i class="icofont-location-pin"></i>
                                    <span>Dhaka, Bangladesh</span>
                                </span>
                            </div>
                            <div class="event-desc">
                                <p>Itaque minima molestiae nesciunt nihil quia quo reprehenderit suscipit temporibus ullam ut voluptas!</p>
                            </div>
                            <a href="#" class="eem-btn read-more">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-md-4">
                    <div class="eem-event-single">
                        <div class="image-wrap">
                            <a href="#">
                                <img src="https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/event-2.jpg" alt="Event Image">
                            </a>

                            <span class="eem-event-status">Completed</span>
                        </div>

                        <div class="eem-event-content">
                            <h2><a href="#">Welcome to WordCamp Dhaka 2019</a></h2>
                            <div class="event-meta">
                                <span class="event-meta-date">
                                    <i class="icofont-calendar"></i>
                                    <span>21 Sep 2019</span>
                                </span>
                                <span class="event-meta-location">
                                    <i class="icofont-location-pin"></i>
                                    <span>Dhaka, Bangladesh</span>
                                </span>
                            </div>
                            <div class="event-desc">
                                <p>Itaque minima molestiae nesciunt nihil quia quo reprehenderit suscipit temporibus ullam ut voluptas!</p>
                            </div>
                            <a href="#" class="eem-btn read-more">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-md-4">
                    <div class="eem-event-single">
                        <div class="image-wrap">
                            <a href="#">
                                <img src="https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/event-3.jpg" alt="Event Image">
                            </a>

                            <span class="eem-event-status">Upcoming</span>
                        </div>

                        <div class="eem-event-content">
                            <h2><a href="#">Welcome to WordCamp Dhaka 2019</a></h2>
                            <div class="event-meta">
                                <span class="event-meta-date">
                                    <i class="icofont-calendar"></i>
                                    <span>21 Sep 2019</span>
                                </span>
                                <span class="event-meta-location">
                                    <i class="icofont-location-pin"></i>
                                    <span>Dhaka, Bangladesh</span>
                                </span>
                            </div>
                            <div class="event-desc">
                                <p>Itaque minima molestiae nesciunt nihil quia quo reprehenderit suscipit temporibus ullam ut voluptas!</p>
                            </div>
                            <a href="#" class="eem-btn read-more">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-md-4">
                    <div class="eem-event-single">
                        <div class="image-wrap">
                            <a href="#">
                                <img src="https://demo.gloriathemes.com/eventchamp/demo/wp-content/uploads/2018/11/event-4.jpg" alt="Event Image">
                            </a>

                            <span class="eem-event-status">Completed</span>
                        </div>

                        <div class="eem-event-content">
                            <h2><a href="#">Welcome to WordCamp Dhaka 2019</a></h2>
                            <div class="event-meta">
                                <span class="event-meta-date">
                                    <i class="icofont-calendar"></i>
                                    <span>21 Sep 2019</span>
                                </span>
                                <span class="event-meta-location">
                                    <i class="icofont-location-pin"></i>
                                    <span>Dhaka, Bangladesh</span>
                                </span>
                            </div>
                            <div class="event-desc">
                                <p>Itaque minima molestiae nesciunt nihil quia quo reprehenderit suscipit temporibus ullam ut voluptas!</p>
                            </div>
                            <a href="#" class="eem-btn read-more">View Details</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="view-more eem-event-load-more text-center">
                <a href="#" class="eem-btn eem-btn-large">Load More <i class="icofont-spinner"></i></a>
            </div>

        </div>
    </div>


<?php
get_footer();