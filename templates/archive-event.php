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
                            <label for="keyword">Search By Keyword</label>
                            <input id="keyword" type="text" class="form-control" placeholder="Event, Meetup">
                        </div>

                        <div class="form-group">
                            <label for="category">Search By Category</label>
                            <select id="category" class="form-control">
                                <option>Business</option>
                                <option>Technology</option>
                                <option>Design</option>
                                <option>Marketing</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keyword">Search By Location</label>
                            <input id="keyword" type="text" class="form-control" placeholder="London">
                        </div>

                        <div class="form-group">
                            <label for="category">Search By Status</label>
                            <select id="category" class="form-control">
                                <option>Upcoming</option>
                                <option>Showing</option>
                                <option>Expired</option>
                            </select>

                        <div class="form-group">
                            <script>
                                $( function() {
                                    $( "#datepicker" ).datepicker();
                                } );
                            </script>
                            <label for="datepicker">Search By Date</label>
                            <input type="text" id="datepicker" class="form-control" placeholder="Select Date">
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