<?php

/**
 * Archive Event
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$unique_id = uniqid();

get_header();

?>


    <div class="eem-force-full-width eem-event-search">
        <div class="pb-container">
            <div class="eem-event-search-wrap">
                <h2 class="eem-event-search-title">Find your Event</h2>
                <form class="eem-event-search-form">
                    <div class="form-fields-wrap">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control" placeholder="James Smith">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="your@site.com">
                        </div>

                        <div class="form-group">
                            <label for="tickets">Tickets</label>
                            <select id="tickets" class="form-control">
                                <option>Business</option>
                                <option>Free</option>
                                <option>Premium</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="eem-btn eem-btn-round">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
get_footer();