<?php
/**
 * User profile page
 *
 * @package user-profile.php
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

?>

<div class="eem-user-profile">
    <div class="eem-force-full-width eem-user-banner">
        <div class="pb-container">
            <div class="btn-control">
                <a href="#" class="btn-edit">Edit Profile</a>
                <a href="#" class="btn-logout">Logout</a>
            </div>
        </div>
    </div>

    <div class="eem-force-full-width eem-user-content-wrap">

        <div class="pb-container">

            <div class="pb-row">
                <div class="pb-col-lg-4 col-md-12">

                    <div class="eem-user-sidebar">
                        <div class="user-avatar">
                            <img src="http://demo.themewinter.com/wp/exhibz/wp-content/uploads/2018/12/speaker1.jpg"
                                 alt="User Avatar">
                        </div>

                        <div class="user-info">
                            <h3 class="user-name">Donald J. Smith</h3>
                            <span class="user-designation">WordPress Developer</span>
                            <span class="user-location"><i class="icofont-google-map"></i> 360 NY City, USA</span>
                            <a href="#" class="user-website">http://pluginbazar.com</a>
                        </div>

                        <ul class="user-stats">
                            <li>
                                <span class="stats-label">
                                    <i class="icofont-heart"></i>
                                    <span class="eem-btn-label">Interested</span>
                                </span>

                                <div class="stats-count">
                                    <span class="eem-btn-count">5200</span>
                                </div>
                            </li>
                            <li>
                                <span class="stats-label">
                                    <i class="icofont-check"></i>
                                    <span class="eem-btn-label">Events Attend</span>
                                </span>

                                <div class="stats-count">
                                    <span class="eem-btn-count">785</span>
                                </div>
                            </li>
                            <li>
                                <span class="stats-label">
                                   <i class="icofont-book-mark"></i>
                                    <span class="eem-btn-label">Bookmark</span>
                                </span>

                                <div class="stats-count">
                                    <span class="eem-btn-count">500</span>
                                </div>
                            </li>
                        </ul>

                        <div class="user-about">
                            <h3>About Me</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur atque dolore dolorem ex fuga molestiae provident</p>
                        </div>

                        <div class="user-experience">
                            <h3>Experience</h3>
                            <a href="#">WordPress</a>, <a href="#">Plugins</a>, <a href="#">Themes</a>, <a
                                    href="#">Development</a>
                        </div>

                        <div class="user-find">
                            <h3>Follow me on</h3>
                            <a href="#"><i class="icofont-facebook"></i></a>
                            <a href="#"><i class="icofont-twitter"></i></a>
                            <a href="#"><i class="icofont-instagram"></i></a>
                        </div>

                    </div>

                </div>

                <div class="pb-col-lg-8 col-md-12">
                    <div class="eem-user-content">

                        <div class="eem-tab-panel">

                            <div class="tab-nav">
                                <div class="tab-nav-item active">First Day</div>
                                <div class="tab-nav-item">Second Day</div>
                                <div class="tab-nav-item">Last Day</div>
                            </div>

                            <div class="tab-content">

                                <div class="tab-item-content active">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur
                                        atque dolore dolorem ex fuga molestiae provident</p>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

