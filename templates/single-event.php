<?php
/**
 * Single Event
 */

get_header();

$unique_id = uniqid();

?>

    <div class="eem-force-full-width eem-banner-style-1"
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

                            var countDownDate = new Date(new Date('Dec 8, 2020').toString()).getTime(),
                                now = new Date().getTime(),
                                distance = countDownDate - now,
                                days = 0, hours = 0, minutes = 0, seconds = 0;

                            if (distance > 0) {
                                days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) );
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


    <div class="eem-speaker-style-1 eem-spacer bg-white eem-force-full-width">
        <div class="pb-container">
            <div class="eem-section-heading">
                <h6 class="eem-sh-tagline">Welcome to Meetup</h6>
                <h2 class="eem-sh-title">Event Speakers</h2>
                <h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed ac
                    velit iaculis, condimentum neque maximus urna. </h5>
            </div>
            <div class="pb-row">
                <div class="pb-col-lg-3 pb-col-md-6">
                    <div class="eem-speaker-single">
                        <div class="speaker-img">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                 alt="Speaker 1">
                        </div>
                        <div class="speaker-info">
                            <h4 class="speaker-name">Reuben P. Dunn</h4>
                            <p class="speaker-designation">Lead Speaker</p>
                        </div>
                        <div class="speaker-social">
                            <a href="#"><i class="icofont-linkedin"></i></a>
                            <a href="#"><i class="icofont-facebook"></i></a>
                            <a href="#"><i class="icofont-twitter"></i></a>
                            <a href="#"><i class="icofont-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-lg-3 pb-col-md-6">
                    <div class="eem-speaker-single">
                        <div class="speaker-img">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                 alt="Speaker 1">
                        </div>
                        <div class="speaker-info">
                            <h4 class="speaker-name">Reuben P. Dunn</h4>
                            <p class="speaker-designation">Lead Speaker</p>
                        </div>
                        <div class="speaker-social">
                            <a href="#"><i class="icofont-linkedin"></i></a>
                            <a href="#"><i class="icofont-facebook"></i></a>
                            <a href="#"><i class="icofont-twitter"></i></a>
                            <a href="#"><i class="icofont-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-lg-3 pb-col-md-6">
                    <div class="eem-speaker-single">
                        <div class="speaker-img">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                 alt="Speaker 1">
                        </div>
                        <div class="speaker-info">
                            <h4 class="speaker-name">Reuben P. Dunn</h4>
                            <p class="speaker-designation">Lead Speaker</p>
                        </div>
                        <div class="speaker-social">
                            <a href="#"><i class="icofont-linkedin"></i></a>
                            <a href="#"><i class="icofont-facebook"></i></a>
                            <a href="#"><i class="icofont-twitter"></i></a>
                            <a href="#"><i class="icofont-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-lg-3 pb-col-md-6">
                    <div class="eem-speaker-single">
                        <div class="speaker-img">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                 alt="Speaker 1">
                        </div>
                        <div class="speaker-info">
                            <h4 class="speaker-name">Reuben P. Dunn</h4>
                            <p class="speaker-designation">Lead Speaker</p>
                        </div>
                        <div class="speaker-social">
                            <a href="#"><i class="icofont-linkedin"></i></a>
                            <a href="#"><i class="icofont-facebook"></i></a>
                            <a href="#"><i class="icofont-twitter"></i></a>
                            <a href="#"><i class="icofont-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-more text-center">
                <a href="#" class="eem-btn eem-btn-large">All Speakers</a>
            </div>
        </div>
    </div>


    <div class="eem-pricing-style-1 eem-spacer eem-force-full-width">
        <div class="pb-container">
            <div class="eem-section-heading">
                <h6 class="eem-sh-tagline">Our Pricing Plans</h6>
                <h2 class="eem-sh-title">Get your Tickets</h2>
                <h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed ac
                    velit iaculis, condimentum neque maximus urna. </h5>
            </div>
            <div class="pb-row">
                <div class="pb-col-md-6 pb-col-lg-4">
                    <div class="eem-pricing-plan">
                        <div class="pricing-head">
                            <div class="price"><span class="currency">$</span>199.99</div>
                            <h3 class="pricing-title">Main Conference</h3>
                            <h4 class="pricing-duration">1 day</h4>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-icon"><i class="icofont-aim"></i></div>
                            <ul>
                                <li>Access to mobile app</li>
                                <li>Access to 1000+ talk</li>
                                <li class="not-in">Access to exhibition floor</li>
                                <li>Access attendee database</li>
                                <li class="not-in">Email support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#">Get Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-4">
                    <div class="eem-pricing-plan is-featured">
                        <div class="pricing-head">
                            <div class="price"><span class="currency">$</span>299.99</div>
                            <h3 class="pricing-title">Conference + Workshops</h3>
                            <h4 class="pricing-duration">1 + 1 (2) days</h4>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-icon"><i class="icofont-space-shuttle"></i></div>
                            <ul>
                                <li>Access to mobile app</li>
                                <li>Access to 1000+ talk</li>
                                <li class="not-in">Access to exhibition floor</li>
                                <li>Access attendee database</li>
                                <li>Email support</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#">Get Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-4">
                    <div class="eem-pricing-plan">
                        <div class="pricing-head">
                            <div class="price"><span class="currency">$</span>399.99</div>
                            <h3 class="pricing-title">Conference + Workshops</h3>
                            <h4 class="pricing-duration">1 + 2 (3) days</h4>
                        </div>
                        <div class="pricing-content">
                            <div class="pricing-icon"><i class="icofont-microphone-alt"></i></div>
                            <ul>
                                <li>Access to mobile app</li>
                                <li>Access to 1000+ talk</li>
                                <li>Email support</li>
                                <li>Access to exhibition floor</li>
                                <li>Access attendee database</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#">Get Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-more text-center">
                <a href="#" class="eem-btn eem-btn-large">More Tickets!</a>
            </div>
        </div>
    </div>

    <div class="eem-register-style-1 eem-spacer eem-force-full-width bg-white">
        <div class="pb-container">
            <div class="pb-row">
                <div class="pb-col-md-7">
                    <div class="eem-section-heading">
                        <h6 class="eem-sh-tagline">Registration form</h6>
                        <h2 class="eem-sh-title">Register Now</h2>
                        <h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed ac
                            velit iaculis, condimentum neque maximus urna. </h5>
                        <div class="join-as-volunteer">
                            <a href="#" class="eem-btn eem-btn-large">Join As volunteer</a>
                        </div>
                    </div>
                </div>

                <div class="pb-col-md-5">
                    <form class="eem-register-form">
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
    </div>

    <div class="eem-attendees-style-1 eem-spacer eem-force-full-width bg-white">
        <div class="pb-container">
            <div class="eem-section-heading">
                <h6 class="eem-sh-tagline">Who Attend our Meetup?</h6>
                <h2 class="eem-sh-title">Full Attendees List</h2>
                <h5 class="eem-sh-subtitle">Suspendisse hendrerit turpis dui, eget ultricies erat consequat. Sed ac
                    velit iaculis, condimentum neque maximus urna. </h5>
            </div>
            <div class="pb-row">
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
                <div class="pb-col-md-6 pb-col-lg-3">
                    <div class="eem-attendees-single">
                        <div class="eem-attendees-img">
                            <a href="#"><img
                                        src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                        alt="Speaker 1"></a>
                        </div>
                        <h3 class="eem-attendees-name"><a href="#">J. Robert Hales</a></h3>
                    </div>
                </div>
            </div>

            <div class="view-more text-center">
                <a href="#" class="eem-btn eem-btn-large">Full Attendees</a>
            </div>
        </div>
    </div>

    <div class="eem-cta-style-1 eem-force-full-width">
        <div class="pb-container">
            <div class="eem-cta-wrap">
                <div class="eem-cta-content">
                    <h2 class="eem-cta-title">You'll Fall in Love Barcelona</h2>
                    <p class="eem-cta-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.
                        ipsum dolor Tur adipiscing elit, sed do eiusmod sed do eiusmod.</p>
                </div>
                <div class="eem-cta-button">
                    <a href="#">Get Ticket Now!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="eem-sponsors-style-1 eem-spacer eem-force-full-width">
        <div class="pb-container">
            <div class="eem-section-heading">
                <h6 class="eem-sh-tagline">Who Help Us</h6>
                <h2 class="eem-sh-title">Big Thanks our Sponsors</h2>
                <h5 class="eem-sh-subtitle">Donec hendrerit turpis dui, eget ultricies erat consequat. Sed ac velit
                    iaculis, condimentum neque maximus urna. </h5>
            </div>

            <div class="pb-grid pb-grid-4">
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-12.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-8.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-6.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-1.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-3.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>

                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-2.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-11.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-10.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-9.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-7.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>

                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-5.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
                <div class="pb-grid-col">
                    <div class="sponsors-single">
                        <a href="#"><img
                                    src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-client-4.png"
                                    alt="Sponsors Image"></a>
                    </div>
                </div>
            </div>

            <div class="view-more text-center">
                <a href="#" class="eem-btn eem-btn-large">View All Sponsors</a>
            </div>
        </div>
    </div>


    <div class="eem-gallery-style-1 bg-white eem-force-full-width">
        <div class="eem-gallery-wrap pb-grid pb-grid-4 pb-no-gutters">
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-2.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-2.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-5.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-5.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-3.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-3.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-4.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-4.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-2.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-2.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-5.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-5.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-3.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-3.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
            <div class="pb-grid-col">
                <div class="gallery-single">
                    <img src="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-4.jpg"
                         alt="Gallery Image">
                    <a href="https://evently.mikado-themes.com/wp-content/uploads/2017/06/h1-gallery-img-4.jpg"
                       class="gallery-zoon-icon" data-effect="mfp-3d-unfold">
                        <i class="icofont-search"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="eem-post-style-1 eem-force-full-width eem-spacer">
        <div class="pb-container">
            <div class="eem-section-heading">
                <h6 class="eem-sh-tagline">Donec hendrerit turpis</h6>
                <h2 class="eem-sh-title">Latest News</h2>
                <h5 class="eem-sh-subtitle">Nuonec hendrerit turpis dui, eget ultricies erat consequat. Sed ac velit
                    iaculis, condimentum neque maximus urna. </h5>
            </div>

            <div class="pb-row">
                <div class="pb-col-lg-4 pb-col-md-6">
                    <div class="post-item">
                        <div class="post-image">
                            <a href="#">
                                <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2019/01/Blog-1.jpg" alt="Blog Image">
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

                <div class="pb-col-lg-4 pb-col-md-6">
                    <div class="post-item">
                        <div class="post-image">
                            <a href="#">
                                <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2019/01/Blog-2.jpg" alt="Blog Image">
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

                <div class="pb-col-lg-4 pb-col-md-6">
                    <div class="post-item">
                        <div class="post-image">
                            <a href="#">
                                <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2019/01/Blog-3.jpg" alt="Blog Image">
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

            <div class="view-more text-center">
                <a href="#" class="eem-btn eem-btn-large">View More Posts</a>
            </div>
        </div>
    </div>

<?php

get_footer();