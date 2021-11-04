<?php
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
function elsey_enqueue_child_theme_styles()
{
    // wp_enqueue_style( 'elsey-child-style', get_stylesheet_uri(), array(), null );
}

add_role('Doctors', 'Doctors');
add_role('Customers', 'Customers');


add_action('wp_enqueue_scripts', 'elsey_enqueue_child_theme_styles', 11);


add_shortcode('most_viewed_doctors', 'most_viewed_doctors_func');
function most_viewed_doctors_func()
{
    ?>
    <div class="row">
        <?php
        foreach (recentVerifiedDoctors() as $user) {
            // get_userdata( $user->ID )
            $userCustomField = get_user_meta($user->ID);

            //  print_r($userCustomField);

            ?>
            <!-- /box_list -->
            <div data-virtual="<?php echo get_the_author_meta('user_registration_virtual_appointments', $user->ID); ?>"
                 class="col-lg-4 col-md-6">
                <div class="box_list home">
                    <div class="virtual">
                        <div class="appointment">
                            <svg id="Layer_1" enable-background="new 0 0 511.726 511.726" height="30"
                                 viewBox="0 0 511.726 511.726" width="30" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m83.168 98.34c3.233 2.939 7.546 1.884 10.6-.48 2.79-3.05 2.58-7.8-.479-10.59-3.061-2.8-7.8-2.58-10.59.471-2.801 3.059-2.591 7.799.469 10.599z"/>
                                    <path d="m58.927 132.59c3.375 2.094 8.234.966 10.33-2.4 2.19-3.52 1.11-8.149-2.399-10.33-3.521-2.189-8.15-1.119-10.33 2.4-2.19 3.52-1.12 8.139 2.399 10.33z"/>
                                    <path d="m119.257 72.08c5.723 0 9.499-7.341 5.98-12.021-2.49-3.3-7.2-3.96-10.5-1.47-3.311 2.5-3.971 7.2-1.471 10.51 1.472 1.951 3.722 2.981 5.991 2.981z"/>
                                    <path d="m41.418 170.729c3.605 1.377 8.286-.633 9.71-4.279 1.5-3.86-.42-8.21-4.28-9.71-3.859-1.5-8.199.409-9.699 4.279-1.512 3.861.408 8.201 4.269 9.71z"/>
                                    <path d="m31.257 211.439c3.711.717 8.063-2.297 8.75-6 .76-4.069-1.92-7.989-5.99-8.739-4.08-.771-7.989 1.92-8.75 5.989-.76 4.071 1.92 7.991 5.99 8.75z"/>
                                    <path d="m41.298 320.95c-3.86 1.5-5.78 5.84-4.28 9.699 1.15 2.98 3.98 4.801 6.99 4.801 4.761 0 8.769-5.628 7-10.21-1.501-3.87-5.84-5.79-9.71-4.29z"/>
                                    <path d="m33.937 294.97c4.08-.75 6.771-4.67 6.011-8.74-.75-4.069-4.67-6.76-8.74-6.01-4.07.76-6.76 4.67-6.01 8.74.735 4.089 4.763 6.787 8.739 6.01z"/>
                                    <path d="m28.778 253.33c9.926-.345 9.928-14.66 0-15-4.141-.011-7.5 3.35-7.5 7.489-.011 4.15 3.35 7.5 7.489 7.511z"/>
                                    <path d="m451.717 361.26c-3.49-2.22-8.13-1.18-10.35 2.31-2.22 3.5-1.19 8.131 2.31 10.36 3.767 2.125 7.217 1.355 10.351-2.31 2.22-3.5 1.189-8.13-2.311-10.36z"/>
                                    <path d="m446.278 121.979c-3.54 2.141-4.67 6.761-2.521 10.301 2.049 3.384 6.927 4.572 10.311 2.52 3.54-2.15 4.659-6.76 2.52-10.3-2.151-3.54-6.76-4.67-10.31-2.521z"/>
                                    <path d="m420.217 89.1c-3.09 2.76-3.35 7.5-.59 10.59 3.448 3.123 6.978 3.32 10.59.591 3.08-2.761 3.351-7.5.59-10.591-2.759-3.081-7.5-3.35-10.59-.59z"/>
                                    <path d="m469.597 323.31c-3.85-1.54-8.21.33-9.75 4.17-1.838 4.595 2.163 10.29 6.96 10.29 2.98 0 5.79-1.779 6.971-4.72 1.529-3.84-.341-8.21-4.181-9.74z"/>
                                    <path d="m483.028 240.84c-4.15-.04-7.54 3.28-7.58 7.43-.043 4.475 3.654 6.967 7.5 7.57 4.109 0 7.46-3.31 7.5-7.42.04-4.15-3.28-7.54-7.42-7.58z"/>
                                    <path d="m468.507 173.6c.88 0 1.771-.149 2.641-.479 3.869-1.46 5.829-5.78 4.38-9.66-3.815-9.177-17.219-4.127-14.04 5.28 1.13 3.009 3.989 4.859 7.019 4.859z"/>
                                    <path d="m472.158 207.84c.651 3.702 4.966 6.767 8.68 6.09 4.08-.71 6.811-4.6 6.09-8.68-.71-4.08-4.6-6.811-8.68-6.09-4.08.71-6.811 4.6-6.09 8.68z"/>
                                    <path d="m427.158 395.29c-3.03-2.83-7.771-2.66-10.601.37-2.819 3.029-2.649 7.779.38 10.6 3.584 2.798 7.117 2.674 10.601-.37 2.82-3.04 2.66-7.781-.38-10.6z"/>
                                    <path d="m480.137 282.689c-4.069-.8-8.01 1.851-8.81 5.91-.822 4.237 3.107 8.95 7.37 8.95 3.51 0 6.649-2.48 7.35-6.05.8-4.069-1.849-8.009-5.91-8.81z"/>
                                    <path d="m273.748 464.88v-.01c-4.13.34-7.21 3.949-6.88 8.08.295 3.634 4.333 7.245 8.08 6.88 4.13-.33 7.21-3.95 6.88-8.08-.34-4.13-3.96-7.21-8.08-6.87z"/>
                                    <path d="m351.628 443.67c-3.729 1.81-5.28 6.29-3.47 10.02 1.71 3.513 6.518 5.203 10.02 3.471 3.73-1.811 5.28-6.29 3.471-10.021-1.811-3.72-6.291-5.281-10.021-3.47z"/>
                                    <path d="m313.677 457.899c-4 1.091-6.359 5.21-5.27 9.21 1.006 3.691 5.542 6.269 9.21 5.271 9.498-2.944 5.73-16.748-3.94-14.481z"/>
                                    <path d="m399.097 60.189c-.01 0-.01 0-.01 0-3.27-2.529-7.979-1.92-10.52 1.351-2.53 3.279-1.92 7.99 1.359 10.52 3.692 2.474 7.199 2.025 10.521-1.35 2.53-3.28 1.921-7.99-1.35-10.521z"/>
                                    <path d="m386.307 422.67c-3.33 2.46-4.029 7.16-1.569 10.49 3.282 3.436 6.778 3.959 10.489 1.569 3.33-2.46 4.03-7.16 1.57-10.489-2.459-3.33-7.16-4.03-10.49-1.57z"/>
                                    <path d="m233.177 464.439v-.01c-4.12-.42-7.8 2.58-8.229 6.7-.407 3.99 3.447 8.27 7.47 8.27 3.8 0 7.06-2.88 7.46-6.739.42-4.12-2.58-7.801-6.701-8.221z"/>
                                    <path d="m392.245 247.435c0-8.677-3.784-16.486-9.788-21.866 12.85-11.54 12.867-32.292 0-43.822 12.848-11.538 12.868-32.286.005-43.817 18.308-16.413 8.685-47.977-15.866-51.089v-56.776c0-16.578-13.487-30.065-30.064-30.065h-95.03c-9.697 0-9.697 15 0 15h95.03c8.307 0 15.064 6.759 15.064 15.065v3.969h-185.18v-3.969c0-8.308 6.759-15.065 15.065-15.065h19.036c9.697 0 9.697-15 0-15h-19.036c-16.578 0-30.065 13.487-30.065 30.065v109.794c-20.418-13.013-48.011 2.373-48.011 26.521v175.869l-14.043 14.107c-15.256-7.126-34.114-3.72-45.973 8.194-15.834 15.905-15.834 41.785 0 57.69l46.421 46.634c6.841 6.873 17.471-3.709 10.631-10.582l-46.421-46.634c-10.025-10.07-10.025-26.456 0-36.526 9.864-9.909 26.536-9.855 36.345 0l77.425 77.779c10.023 10.07 10.023 26.456 0 36.526-11.462 11.515-29.283 8.875-39.283-2.951-6.842-6.874-17.471 3.71-10.631 10.582 35.741 37.784 92.421-4.347 65.499-48.708l13.512-13.574c40.589 3.097 79.999-19.31 98.205-55.747h41.44c16.577 0 30.064-13.487 30.064-30.065v-72.313c14.444-1.831 25.649-14.203 25.649-29.226zm-15 .099c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.443 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.923c-.255 7.677-6.427 14.462-14.361 14.462h-13.095c-19.069-.794-19.068-28.029 0-28.822h13.095c7.918-.001 14.361 6.442 14.361 14.36zm-25.649-66.933v37.572c-27.913-1.369-41.896 32.834-21.386 51.322-12.973 11.262-12.968 32.565 0 43.822-12.973 11.262-12.968 32.565 0 43.822-20.518 18.502-6.511 52.692 21.386 51.322v37.572h-142.212c-4.749-25.583-19.496-49.612-42.968-61.863v-203.569zm-146.827 371.104-10.504-.489c-2.101-.084-4.172.701-5.664 2.201l-15.283 15.353-71.634-71.962 14.537-14.604c1.399-1.405 2.185-3.308 2.185-5.291v-178.966c0-21.125 32.57-21.125 32.57 0v90.744c0 2.99 1.776 5.695 4.521 6.883 17.869 7.732 31.09 23.744 37.227 45.086 6.922 24.074 3.23 50.65-9.635 69.358-5.337 7.76 6.625 16.838 12.359 8.5 1.737-2.526 3.334-5.169 4.79-7.911h77.721c-15.605 25.506-42.92 41.04-73.19 41.098zm131.763-56.098h-130.031c3.453-10.916 5.01-22.717 4.552-34.572h140.543v19.507c0 8.306-6.757 15.065-15.064 15.065z"/>
                                    <path d="m187.845 105.867c3.554 2.883 7.089 2.837 10.605-.139l21.953-22.534c6.767-6.945-3.979-17.415-10.744-10.467l-21.953 22.534c-2.89 2.968-2.827 7.716.139 10.606z"/>
                                    <path d="m187.845 154.088c3.554 2.883 7.089 2.837 10.605-.139l68.929-70.755c6.767-6.945-3.979-17.415-10.744-10.467l-68.929 70.755c-2.89 2.967-2.827 7.715.139 10.606z"/>
                                </g>
                            </svg>
                        </div>
                        <span>Accepting Virtual Appointment</span>
                    </div>
                    <figure>
                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">
                            <?php
                            $image=null;
                            if ($userCustomField['user_registration_profile_pic_url'][0]) {
                                $image = $userCustomField['user_registration_profile_pic_url'][0];
                            } else {
                                $image = get_site_url() . "/wp-content/uploads/2021/05/360_F_346936114_RaxE6OQogebgAWTalE1myseY1Hbb5qPM.jpg";
                            }
                            ?>
                            <img src="<?php echo $image; ?>"
                                 class="img-fluid" alt=""></a>
                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>" class="preview"><span>Read more</span></a>
                    </figure>
                    <div class="wrapper">
                        <small><?php echo $userCustomField['user_registration_speciality'][0] ?></small>
                        <h3><?php echo $user->first_name;
                            echo ' ' . $user->last_name;

                            if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No") {
                                ?>
                                <img src="<?php echo get_template_directory_uri() . "/images/unverified.png" ?>" alt=""
                                     width="70">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo get_template_directory_uri() . "/images/verified.png" ?>" alt=""
                                     width="70">
                                <?php
                            }
                            ?></h3>
                        <!-- <p><?php echo $userCustomField['user_registration_textarea_1614152627'][0] ?></p> -->
                        <?php
                        if(bestReview($user->ID)->comment)
                        {?>
                            <p>
                                <i> " <?php echo bestReview($user->ID)->comment; ?> " </i>

                            </p>
                            <span> -<?=bestReview($user->ID)->review_by;?> </span>
                        <?php }?>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a class="mr-2 themeclr" href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">Read More</a>
                            <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                        class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>(<small
                                            class="totalRating"><?php echo round(totalReviews($user->ID)->averageRating, 2); ?></small>)</small></span>
                        </div>

                    </div>
                    <ul>
                        <!-- <li><i class="fa fa-eye"></i> 854 Views</li> -->
                        <li>
                            <!-- <a href="<?php echo get_home_url(); ?>/book-a-doctor/?doctor-id=<?php echo $user->ID ?>&doctor-email=<?php echo $user->user_email ?>">Book
                                now</a> -->
                            <form action="<?php echo get_home_url(); ?>/book-a-doctor/" method="post">
                                <input type="text" name="doctor-id" hidden value="<?php echo $user->ID ?>">
                                <input type="text" name="doctor-email" hidden value="<?php echo $user->user_email ?>">
                                <button type="submit" class="btn_1 medium">BOOK NOW</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


            <?php

        }
        ?>

    </div>
    <?php
}


add_shortcode('recent_reviews', 'recent_reviews_func');
function recent_reviews_func()
{
    ?>
    <div class="row">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <!-- <ol class="carousel-indicators reviewPagination">
			<?php
                $counter = 0;
                // print_r(recentReviews());
                foreach (recentReviews() as $singleReview) {
                    ?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $counter ?>" class="<?php if ($counter == 0) {
                        echo 'active';
                    } ?>"></li>
						<?php
                    $counter++;
                }
                ?>
              
            </ol> -->
                <div class="carousel-inner">
                    <?php
                    $counterSecond = 0;
                    foreach (recentReviews() as $singleReview) {
                        ?>
                        <div class="carousel-item <?php if ($counterSecond == 0) {
                            echo 'active';
                        } ?>">
                            <div class="reviewSingleSlider">
                                <span class="reviewTo text-center d-block">To <?php echo $singleReview->display_name ?></span>
                                <p class="m-0"><?php echo $singleReview->comment ?></p>
                                <span class="reviewFrom text-center d-block">By - <?php echo $singleReview->review_by ?></span>
                            </div>
                        </div>
                        <?php
                        $counterSecond++;
                    }
                    ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="sliderBtn prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</span>

                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	  <span class="sliderBtn next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
	  </span>
                </a>
            </div>

        </div>

    </div>
    <?php
}

//Leads  Insertion


$GLOBALS["billingPrice"] = 7;
// Fire AJAX to save un hide questions
function conuslt_doctor()
{
    $_getDoctorID = $_POST['getDoctorID'];
    $_getDoctorEmail = $_POST['getDoctorEmail'];
    $_getUserFirstName = $_POST['getUserFirstName'];
    $_getUserLastName = $_POST['getUserLastName'];
    $_getUserEmail = $_POST['getUserEmail'];
    $_getUserPhone = $_POST['getUserPhone'];
    // Query Arguments
    global $wpdb;

    $table_name = "wp_doctors_leads";
    $retrieve_data = $wpdb->insert($table_name, array(
        "user_id" => $_getDoctorID,
        "customer_firstname" => $_getUserFirstName,
        "customer_lastname" => $_getUserLastName,
        "customer_email" => $_getUserEmail,
        "customer_phone" => $_getUserPhone
    ));
    echo "ok";
    exit;
}


add_action('wp_ajax_conuslt_doctor', 'conuslt_doctor');
add_action('wp_ajax_nopriv_conuslt_doctor', 'conuslt_doctor');


//Get  Current Month Leads against current user

function currentMonthLeads()
{
    $user = wp_get_current_user();
    $query_date = date('Y-m-d');
    $startDate = date('Y-m-01', strtotime($query_date));
    $endDate = date('Y-m-t', strtotime($query_date));
    $query = "SELECT *  FROM `wp_doctors_leads`  WHERE (`created_at` >='$startDate'  AND `created_at` <='$endDate') AND `user_id`=$user->ID";

    $currentMonthLeads = $GLOBALS['wpdb']->get_results($query, OBJECT);
    // print_r($currentMonthLeads);
    return $currentMonthLeads;

}

//Get All leads against current user
function allLeads()
{
    $user = wp_get_current_user();
    $query = "SELECT *  FROM `wp_doctors_leads`  WHERE `user_id` = $user->ID";
    $allLeads = $GLOBALS['wpdb']->get_results($query, OBJECT);
    // print_r($allLeads);
    return $allLeads;

}

//total price
function totalBill(): int
{
    return totalNumberOfLeads() * $GLOBALS["billingPrice"];
}

//total number of leads
function totalNumberOfLeads(): int
{
    return count(allLeads());
}

//User Profile From Admin Area
add_action('edit_user_profile', 'extra_user_profile_fields');

function extra_user_profile_fields($user)
{
    $query_date = date('Y-m-d');
    $startDate = date('Y-m-01', strtotime($query_date));
    $endDate = date('Y-m-t', strtotime($query_date));
    $query = "SELECT *  FROM `wp_doctors_leads`  WHERE (`created_at` >='$startDate'  AND `created_at` <='$endDate') AND `user_id`=$user->ID";
    $currentMonthLeads = $GLOBALS['wpdb']->get_results($query, OBJECT);
    if ($_GET["user_id"]) {

    }
    $reviews = listUserReviews($_GET["user_id"]);

    ?>

    <h3><?php echo count($currentMonthLeads); ?></h3>
    <style>
        #myTable {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            background: #fff;
        }

        /* #myTable tr:nth-of-type(even) {
            display: none;
        } */

        /* #myTable tr:nth-of-type(even) p {
            margin: 0px;
            padding-left: 57px;
            font-size: 17px;
            font-weight: 700;
            padding: 10px;
            background: white;
            box-shadow: 0 6px 23px 0px #0000001f;
        } */

        #myTable th, #myTable td {
            padding: 10px 15px;
            border-bottom: 0.1rem solid #dcd7ca;
        }

        #myTable th {
            padding: 10px 15px;
            background: #efefef;
            color: #3f4079;
            border: 0;
            text-align: left;
        }

        #myTable td {
            font-size: 15px;
        }

        #myTable tr td:first-child {
            width: inherit;
        }


        #myTable img {
            width: 50px;
            object-fit: cover;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 9px 0px #00000038;
        }

        .rating {
            display: inline-block;
            position: relative;
        }

        .rating i.voted {
            color: #ffc107;
        }

        .rating i {
            color: #ddd;
            font-size: 13px;
            font-size: .8125rem;
        }

        .rating small {
            margin-bottom: 0;
            display: inline-block;
            font-size: 12px;
            font-size: .75rem;
        }
    </style>
    <h1>
        Doctor Reviews
    </h1>
    <table id="myTable">
        <thead>
        <tr>
            <th>Attachement</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Rating</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reviews as $review) {
            ?>
            <tr>
                <td>
                    <a href="<?= get_theme_root_uri() . '/' . $review->attachement ?>" target="_blank"> <img
                                src="<?= get_theme_root_uri() . '/' . $review->attachement ?>" alt=""> </a>
                </td>
                <td><?= $review->review_by ?></td>
                <td><?= $review->comment ?></td>

                <td>
                    <div class="rating">
                        <?php
                        if ($review->rating == 1) {
                            ?>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <?php
                        } else if ($review->rating == 2) {
                            ?>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <?php
                        } else if ($review->rating == 3) {
                            ?>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <?php
                        } else if ($review->rating == 4) {
                            ?>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star"></i>
                            <?php
                        } else {
                            ?>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <i class="fa fa-star voted"></i>
                            <?php
                        }
                        ?>
                    </div>
                </td>
                <td><?= $review->created_at ?>2</td>
                <td><?php if ($review->status == 1) {
                        ?>

                        <span class="badge badge-success">Approved</span>
                        <?php
                    } else {
                        $queries = array();

                        ?>
                        <span class="badge badge-warning">Pending</span>
                        <a href="<?php echo '?' . $_SERVER['QUERY_STRING'] . '&review_id=' . $review->id . '&approve=true'; ?>"
                           class="blueAnchor">Approve it?</a>


                        <?php
                    }
                    ?></td>

            </tr>
            <?php
        }

        ?>
        </tbody>
    </table>


<?php }

//Get offered services 
function getServices()
{
    $servcies = [];
    $query = "SELECT * FROM `wp_usermeta` WHERE `meta_key` LIKE 'user_registration_services_offered' Group By `meta_value` ";
    $services = $GLOBALS['wpdb']->get_results($query);
    if (count($services) > 0) {
        $services = flattenServices($services);
    }
    return $services;
}

//Flatten the services
function flattenServices(array $services)
{
    $iterator = 0;
    $flattenServices = [];
    foreach ($services as $service) {
        if ($service->meta_value) {
            if ($iterator > 0) {
                @$flattenServices[0] = array_merge($flattenServices[$iterator - 1 ?? 0], explode(",", $service->meta_value));
            } else {
                $flattenServices[0] = explode(",", $service->meta_value);
            }
            $iterator++;
        }
    }
    if ($flattenServices) {
        return current($flattenServices);
    }
    return $flattenServices;
}

//Total reviews
function totalReviews($getID)
{
    $commulativeReviews = 0;
    $table = "wp_doctors_reviews";
    $query = "Select count(*) as totalReviews,AVG(rating) as averageRating from {$table} where user_id = {$getID} AND status = 1";
    $totalReviews = $GLOBALS["wpdb"]->get_results($query);

    return current($totalReviews);
}

//Recent Reviews
function recentReviews()
{
    $table = "wp_doctors_reviews";
    $query = "Select * from {$table}  LEFT JOIN wp_users ON wp_users.ID = user_id where status = 1 order by wp_doctors_reviews.id desc";
    $recentReview = $GLOBALS["wpdb"]->get_results($query);
    return $recentReview;
}

//Recent Doctors
function recentVerifiedDoctors()
{
    $users = get_users(array('role__in' => array('author', 'doctors')));
    $recentDoctors = [];
    foreach ($users as $user) {
        $userMeta = get_user_meta($user->ID);
        if (!empty($userMeta["user_registration_verified_member"]) && $userMeta["user_registration_verified_member"][0] == "Yes") {
            $recentDoctors[] = $user;
        }
    }
    return $recentDoctors;
}

function getAllDoctors()
{
    return get_users(array('role__in' => array('doctors')));

}

//Get distance against coordinates
function distance($lat1, $lon1, $lat2, $lon2, $unit = "K")
{
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

// print_r(recentVerifiedDoctors());

//list all reviews
function listUserReviews(int $userId)
{
    $table = "wp_doctors_reviews";
    $currentUserId = get_current_user_id();
    $reviews = $GLOBALS["wpdb"]->get_results("SELECT * FROM {$table} where `user_id` = {$userId}");
    return $reviews;
}

//update status of review by id
function updateReviewStatus(int $reviewId)
{
    $currentUserId = get_current_user_id();
    $table = "wp_doctors_reviews";
    $GLOBALS["wpdb"]->update($table, array('status' => '1'), array('id' => $reviewId));
    return true;
}

//approve review
if (!empty($_GET["review_id"]) && !empty($_GET["approve"])) {
    updateReviewStatus($_GET["review_id"]);
}

//get all specialities
function getAllSpecialities()
{
    $table = "wp_usermeta";
    $query = "Select * from {$table} where (meta_key='user_registration_speciality')";
    return $GLOBALS["wpdb"]->get_results($query);
}

//search by speciality or services of user
function searchByServicesOrSpeciality(string $keyword)
{
    $table = "wp_usermeta";
    $query = "select * from wp_usermeta where (meta_key ='user_registration_speciality' OR meta_key ='user_registration_services_offered') AND meta_value like '$keyword%' Group By 'user_id'";
    $users = $GLOBALS["wpdb"]->get_results($query);
    print_r($users);
}

//prepare all suggestions
function prepareSuggestions($searchString, $userMetaValues)
{
    $iterateMore = true;
    $suggestedKeywords = [];
    $searchString = strtolower($searchString);
    for ($i = 0; $i < count($userMetaValues); $i++) {

        $tokenizedSearchString = explode(" ", $searchString);
        if (count($tokenizedSearchString) >= 2) {
            for ($iter = 0; $iter < count($tokenizedSearchString); $iter++) {
                if ($tokenizedSearchString[$iter] == strtolower($userMetaValues[$i])) {
                    $suggestedKeywords = [];
                    $iterateMore = false;
                    break 2;
                } elseif ($tokenizedSearchString[$iter] != strtolower($userMetaValues[$i]) && !(in_array($userMetaValues[$i], $suggestedKeywords))) {
                    $suggestedKeywords[] = $userMetaValues[$i];
                }

            }
        } else if (
            $searchString != strtolower($userMetaValues[$i]) && !(in_array($userMetaValues[$i], $suggestedKeywords))) {
            $suggestedKeywords[] = $userMetaValues[$i];
        }

    }
    return $suggestedKeywords;

}

//substr in array
function substr_in_array($needle, array $haystack, &$matchedMetaTempValue)
{
    foreach ($haystack as $item) {
        $tempHayStack = strtolower(trim($item));
        $tempNeedle = strtolower(trim($needle));
        if (strpos($tempHayStack, $tempNeedle) !== false) {
            $matchedMetaTempValue = $item;
            return true;
        }
    }

    return false;
}

//to enable js of geolocation
//wp_register_script('dummy-handle-footer', '', [], '', true);
//wp_enqueue_script('dummy-handle-footer');
//wp_add_inline_script('dummy-handle-footer', 'if (sessionStorage.latitude && sessionStorage.longitude ) {
//
//jQuery("#Longitude").val(sessionStorage.longitude);
//jQuery("#Latitude").val(sessionStorage.latitude );
//
//}
//else
//{
//window.onload = getLocation();
//
//}
//function getLocation() {
//if (navigator.geolocation) {
//navigator.geolocation.watchPosition(storePosition);
//} else {
//alert("Geolocation is not supported by this browser.");
//}
//}
//
//function storePosition(position) {
//
//if (sessionStorage.latitude && sessionStorage.longitude ) {
//} else {
//sessionStorage.setItem("latitude",position.coords.latitude);
//sessionStorage.setItem("longitude",position.coords.longitude);
//jQuery("#Longitude").val(position.coords.longitude);
//jQuery("#Latitude").val(position.coords.latitude);
//
//}
//}');

//add new column to users table
function new_modify_user_table($column)
{
    $column['notification'] = 'Pending Approval reviews';
    return $column;
}

add_filter('manage_users_columns', 'new_modify_user_table');
//add values to notification
add_action('manage_users_custom_column', 'new_review_notification', 10, 3);
function new_review_notification($value, $column_name, $user_id)
{
    if ($column_name == "notification") {
        $table = "wp_doctors_reviews";
        $query = "Select * from {$table}  where user_id = {$user_id} AND status = 0 order by wp_doctors_reviews.id desc";
        $recentReview = $GLOBALS["wpdb"]->get_results($query);
        $editUrl = get_edit_user_link($user_id) . "#myTable";
        return sprintf("<a href=%s>%s review pending</a>", $editUrl, count($recentReview));

    }

}

//new filter
function advancedSearch($userData, $userInput, &$advancedFilterUsers, &$suggestionsList, &$fullMatchedFlag,&$locationBasedMatched,&$extra)
{
    $meta = get_user_meta($userData->ID);
    $spacedString = explode(" ", $userInput);
    if (isset($_POST["Latitude"]) && $_POST["Longitude"]) {
        $latitude1 = $_POST["Latitude"];
        $longitude1 = $_POST["Longitude"];

        $latitude2 = $meta["user_registration_Latitude"][0];
        $longitude2 = $meta["user_registration_Longitude"][0];

        if (isset($latitude2) && $latitude2 && isset($longitude2) && $longitude2) {
            if (distance($latitude1, $longitude1, $latitude2, $longitude2) <= 10 || !empty($_POST["languagepage-submit-review.php"])) {
                if(!$extra)
                {
                    $advancedFilterUsers=[];
                }
                populateFilteredData($meta, $userData, $userInput, $advancedFilterUsers, $suggestionsList, $fullMatchedFlag);
                $locationBasedMatched=true;
                $extra=true;
            }
            else if($_POST["language"]&&!$locationBasedMatched)
            {
                if($extra)
                {
                    $advancedFilterUsers=[];
                }
                populateFilteredData($meta, $userData, $userInput, $advancedFilterUsers, $suggestionsList, $fullMatchedFlag);
                $locationBasedMatched=false;
                $extra=false;
            }
        }
    } else {
        if (strlen($userInput) == 1) {
            populateFilteredDataOnlyWithFirstLetter($meta, $userData, $userInput, $advancedFilterUsers, $suggestionsList, $fullMatchedFlag);
        } else {
            populateFilteredData($meta, $userData, $userInput, $advancedFilterUsers, $suggestionsList, $fullMatchedFlag);

        }
    }

    //get only unique suggestions
    $suggestionsList = array_unique($suggestionsList);

}

//check if it matches completely
function fullMatch($userData, $userInput): ?bool
{
    if ((strtolower($userData) == strtolower($userInput))) {
        return true;
    }
    return null;
}

//check if record already existed in the $advancedFilterUsers
function isPresent($userData, $userId)
{
    foreach ($userData as $user) {
        if ($user->ID == $userId) {
            return true;
        }
    }
    return false;
}

//populate user data and suggestions list intelligently
function populateFilteredData($meta, $userData, $userInput, &$advancedFilterUsers, &$suggestionsList, &$fullMatchedFlag)
{
    if ($userInput) {
        $temp = null;
        $servicesArray = explode(",", $meta["user_registration_services_offered"][0]);

        //convert services array value to lowercase
        $servicesArray = array_map('strtolower', $servicesArray);
        $servicesArray = array_map('trim', $servicesArray);

        //full match a user by its name
        if (fullMatch($meta["first_name"][0], $userInput)) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $fullMatchedFlag = true;
        }
        //full match a user by its full name
        if (fullMatch($meta["first_name"][0] . " " . $meta["last_name"][0], $userInput)) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $fullMatchedFlag = true;
        } //partial match a user by its name
        else if (strpos(strtolower($meta["first_name"][0]), strtolower($userInput)) !== false) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $suggestionsList[] = $meta["first_name"][0];
        } //partial match a user by its last name
        else if (strpos(strtolower($meta["last_name"][0]), strtolower($userInput)) !== false) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $suggestionsList[] = $meta["first_name"][0] . " " . $meta["last_name"][0];
        }
        //full match a user by its speciality
        if (fullMatch($meta["user_registration_speciality"][0], $userInput)) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $fullMatchedFlag = true;

        } //partial match a user by its speciality
        else if (strpos(strtolower($meta["user_registration_speciality"][0]), strtolower($userInput)) !== false) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $suggestionsList[] = $meta["user_registration_speciality"][0];
        } //full match with services
        else if (in_array(strtolower($userInput), $servicesArray)) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $fullMatchedFlag = true;
        } else if (substr_in_array($userInput, $servicesArray, $temp)) {
            if (!isPresent($advancedFilterUsers, $userData->ID)) {
                $advancedFilterUsers[] = $userData;
            }
            if (!empty($_POST["language"]) && $_POST["language"]) {
                matchLanguage($meta, $advancedFilterUsers);
            }
            $suggestionsList[] = $temp;
        }

        if ($fullMatchedFlag) {
            $suggestionsList = [];
        }
    } else if (!empty($_POST["language"])) {
        $languageMatched=false;
        $userLangs=(unserialize($meta["user_registration_select_language"][0]));
        foreach($userLangs as $userlang)
        {
            if (!empty($meta["user_registration_select_language"][0]) && fullMatch($userlang, $_POST["language"]) && !$languageMatched) {
                $languageMatched=true;
                $advancedFilterUsers[] = $userData;
            }
        }

    }
    if (empty($_POST["language"]) && empty($userInput)) {
        $advancedFilterUsers[] = $userData;
    }


}


//populate user data and suggestions list intelligently
function populateFilteredDataOnlyWithFirstLetter($meta, $userData, $userInput, &$advancedFilterUsers, &$suggestionsList, &$fullMatchedFlag)
{
    $temp = null;
    $servicesArray = explode(",", $meta["user_registration_services_offered"][0]);
    //convert services array value to lowercase
    $servicesArray = array_map('strtolower', $servicesArray);

    //full match a user by its name
    if (fullMatch($meta["first_name"][0], $userInput)) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $fullMatchedFlag = true;
    }
    //full match a user by its full name
    if (fullMatch($meta["first_name"][0] . " " . $meta["last_name"][0], $userInput)) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $fullMatchedFlag = true;
    } //partial match a user by its name
    else if (str_starts_with(strtolower($meta["first_name"][0]), strtolower($userInput)) !== false) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $suggestionsList[] = $meta["first_name"][0];
    } //partial match a user by its last name
    else if (str_starts_with(strtolower($meta["last_name"][0]), strtolower($userInput)) !== false) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $suggestionsList[] = $meta["first_name"][0] . " " . $meta["last_name"][0];
    }
    //full match a user by its speciality
    if (fullMatch($meta["user_registration_speciality"][0], $userInput)) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $fullMatchedFlag = true;

    } //partial match a user by its speciality
    else if (str_starts_with(strtolower($meta["user_registration_speciality"][0]), strtolower($userInput)) !== false) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $suggestionsList[] = $meta["user_registration_speciality"][0];
    } //full match with services
    else if (in_array(strtolower($userInput), $servicesArray)) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $fullMatchedFlag = true;
    } else if (substr_in_array($userInput, $servicesArray, $temp)) {
        if (!isPresent($advancedFilterUsers, $userData->ID)) {
            $advancedFilterUsers[] = $userData;
        }
        $suggestionsList[] = $temp;
    }
    if ($fullMatchedFlag) {
        $suggestionsList = [];
    }
}

//match the language
function matchLanguage($meta, &$advancedFilterUsers)
{
    if (empty($meta["user_registration_select_language"][0])) {
        array_pop($advancedFilterUsers);
    } else if (!empty($meta["user_registration_select_language"][0]) && !fullMatch($meta["user_registration_select_language"][0], $_POST["language"])) {
        array_pop($advancedFilterUsers);
    }

}

/**
 * @param string $haystack
 * @return string
 */

function profanityFilter(string $haystack): string
{
    $commentArray = explode(" ", $haystack);
    foreach ($commentArray as &$comment) {
        if (in_array($comment, PROFINITY)) {
            $comment = str_repeat("*", strlen($comment));
        }
    }
    unset($comment);
    return implode(" ", $commentArray);
}

/**
 * @param int $userId
 * @return false|mixed|null
 */
function bestReview(int $userId)
{
    $table = "wp_doctors_reviews";
    $query = "Select * from {$table}  where user_id = {$userId} AND (comment IS NOT NULL AND comment != '') AND  status = 1 order by wp_doctors_reviews.rating desc limit 0,1";
    $recentReview = $GLOBALS["wpdb"]->get_results($query);
    if ($recentReview) {
        return current($recentReview);
    }
    return null;
}


function getLoggedInUserSubscriptions()
{
    $email = wp_get_current_user()->user_email;
    $table = "wp_fullstripe_subscribers";
    $query = "Select * from {$table}  where email = '{$email}'";
    $subscription = $GLOBALS["wpdb"]->get_results($query);
    if ($subscription) {
        return $subscription;
    }
    return null;
}
function getLoggedInUserActiveSubscriptions()
{
    $email = wp_get_current_user()->user_email;
    $table = "wp_fullstripe_subscribers";
    $query = "Select * from {$table}  where email = '{$email}' AND status = 'running'";
    $subscription = $GLOBALS["wpdb"]->get_results($query);
    if ($subscription) {
        return $subscription;
    }
    return null;
}

function cancelSubscriptionFromStripe(string $subscriptionId): Requests_Response
{
    $url = sprintf("https://api.stripe.com/v1/subscriptions/%s", $subscriptionId);
    return Requests::delete($url, ["Authorization" => "Bearer sk_test_hZUSKL3AjYDcXoIN8frDZWaR00h8yQUNez"]);

}

function updateSubscriptionFromDB(string $subscriptionId): bool
{
    $email = wp_get_current_user()->user_email;
    $table = "wp_fullstripe_subscribers";
    $GLOBALS["wpdb"]->update($table, array('status' => 'cancelled'), array('stripeSubscriptionID' => $subscriptionId));
    return true;
}

//check_subscription_status hook
add_action('check_subscription_status', 'check_subscription_status_callback');
//get all subscription where status is cancelled but the cancelled attribute is NULL
function check_subscription_status_callback()
{
    var_dump("in here");
    $table = "wp_fullstripe_subscribers";
    $query = "Select * from {$table}  where status = 'cancelled' AND cancelled  is NULL ";
    $subscriptions = $GLOBALS["wpdb"]->get_results($query);
    foreach ($subscriptions as $subscription) {
        $date1 = date('Y-m-d h:i:s', strtotime($subscription->created . ' + 1 month'));
        if ($date1 <= date('Y-m-d h:i:s')) {
            //update the cancelled date time
            $GLOBALS["wpdb"]->update($table, array('cancelled' => date('Y-m-d h:i:s')), array('subscriberID' => $subscription->subscriberID));
            $user = get_user_by('email', $subscription->email);
            if ($user) {
                update_user_meta($user->id, 'user_registration_verified_member', 'No');

            }
        }
    }
    if ($subscription) {
        return $subscription;
    }
    return null;
}

//non dependency of php 8
if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle)
    {
        return (string)$needle !== '' && strncmp($haystack, $needle, count($needle)) === 0;
    }
}
