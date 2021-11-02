<script>
    function hideOrUnhideToogleButtons() {
        var x = document.getElementById("toggleButtons");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function displaySuggestions(keywords) {
        var x = document.getElementById("suggestionKeywords");
        var notFoundString = document.getElementById("notFoundString");
        notFoundString.display = "block";

        x.innerText = keywords + "?";
    }

    function hideSuggestions() {
        var x = document.getElementById("notFoundString");
        x.style.display = "none";
    }
</script>
<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Metabox
global $post;
global $wpdb;
$elsey_id = (isset($post)) ? $post->ID : false;
$elsey_id = (is_home()) ? get_option('page_for_posts') : $elsey_id;
$elsey_id = (is_woocommerce_shop()) ? wc_get_page_id('shop') : $elsey_id;
$elsey_meta = get_post_meta($elsey_id, 'page_type_metabox', true);

$elsey_content_padding = ($elsey_meta) ? $elsey_meta['content_spacings'] : '';

if ($elsey_content_padding && $elsey_content_padding !== 'els-padding-none') {
    $elsey_content_top_spacings = $elsey_meta['content_top_spacings'];
    $elsey_content_btm_spacings = $elsey_meta['content_btm_spacings'];
    if ($elsey_content_padding === 'els-padding-custom') {
        $elsey_content_top_spacings = $elsey_content_top_spacings ? 'padding-top:' . elsey_check_px($elsey_content_top_spacings) . ' !important;' : '';
        $elsey_content_btm_spacings = $elsey_content_btm_spacings ? 'padding-bottom:' . elsey_check_px($elsey_content_btm_spacings) . ' !important;' : '';
        $elsey_custom_padding = $elsey_content_top_spacings . $elsey_content_btm_spacings;
    } else {
        $elsey_custom_padding = '';
    }
} else {
    $elsey_custom_padding = '';
}

if ($elsey_meta) {
    $elsey_titlebar_options = ($elsey_meta['titlebar_options']) ? $elsey_meta['titlebar_options'] : '';
    if ($elsey_titlebar_options === 'hide') {
        $elsey_title_bar_show = false;
    } elseif ($elsey_titlebar_options === 'custom') {
        $elsey_title_bar_show = true;
    } else {
        $elsey_title_bar_show = cs_get_option('need_titlebar');
    }
} else {
    $elsey_title_bar_show = cs_get_option('need_titlebar');
}

// Page Layout Options
$elsey_page_layout_options = get_post_meta(get_the_ID(), 'page_layout_options', true);

if ($elsey_page_layout_options) {
    $elsey_page_layout = $elsey_page_layout_options['page_layout'];
    $elsey_page_show_sidebar = $elsey_page_layout_options['page_show_sidebar'];
    $elsey_page_sidebar_position = $elsey_page_layout_options['page_sidebar_position'];

    if ($elsey_page_layout === 'full-width') {
        $elsey_parent_class = 'els-full-width';
        $elsey_layout_class = 'container';
    } else if ($elsey_page_layout === 'strech-width') {
        $elsey_parent_class = 'els-strech-width';
        $elsey_layout_class = 'container-fluid';
    } else {
        $elsey_parent_class = 'els-less-width';
        $elsey_layout_class = 'container els-reduced';
    }

    if ($elsey_page_show_sidebar) {

        if ($elsey_page_sidebar_position === 'sidebar-left') {
            $elsey_column_class = 'col-lg-9 col-md-9 col-sm-12 col-12 els-has-sidebar els-has-left-col';
            $elsey_sidebar_position = $elsey_page_sidebar_position;
        } else {
            $elsey_column_class = 'col-lg-9 col-md-9 col-sm-12 col-12 els-has-sidebar els-has-right-col';
            $elsey_sidebar_position = $elsey_page_sidebar_position;
        }

        if (!$elsey_title_bar_show) {
            $elsey_layout_class .= ' els-top-space';
        }

    } else {
        $elsey_column_class = 'col-lg-12 col-md-12 col-sm-12 col-12 els-no-sidebar';
        $elsey_sidebar_position = 'sidebar-hide';
    }
} else {
    $elsey_page_show_sidebar = false;
    $elsey_sidebar_position = 'sidebar-hide';
    $elsey_parent_class = 'els-less-width';
    $elsey_layout_class = 'container els-reduced';
    $elsey_column_class = 'col-lg-12 col-md-12 col-sm-12 col-12 els-no-sidebar';
}
$services = getServices();

get_header(); ?>

<!-- Container Start -->
<div id="results">
    <div class="container">
        <!-- <div class="row">
           <div class="col-md-12 text-center">
              <h4><strong>Showing 10</strong> of 140 results</h4>
           </div>
        </div> -->
        <div class="row ">
            <div class="col-md-12">

                <form action="" method="POST">
                    <div class="_wrapper_searchInputs">
                        <div class="d-lg-flex _searchInputs">
                            <div class="autocomplete" style="flex: 1;">
                                <input id="myInput" type="text" name="speciality" placeholder="Name / Specialty">
                            </div>
                            <input type="text" name="location" id="location" class="form-control"
                                   placeholder="City / Place / Postal Code">
                                    <select name="language" id="">
                                        <option value="" selected="" disabled="">Select your language</option>
                                        <option value="English">English</option>
                                        <option value="Mandarin Chinese">Mandarin Chinese</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Bengali">Bengali</option>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Western Punjabi">Western Punjabi</option>
                                        <option value="Marathi">Marathi</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Wu Chinese">Wu Chinese</option>
                                        <option value="Turkish">Turkish</option>
                                        <option value="Korean">Korean</option>
                                        <option value="French">French</option>
                                        <option value="German">German</option>
                                        <option value="Vietnamese">Vietnamese</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Yue Chinese">Yue Chinese</option>
                                        <option value="Urdu">Urdu</option>
                                        <option value="Javanese">Javanese</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Egyptian Arabic">Egyptian Arabic</option>
                                        <option value="Gujarati">Gujarati</option>
                                        <option value="Iranian Persian">Iranian Persian</option>
                                        <option value="Bhojpuri">Bhojpuri</option>
                                        <option value="Min Nan Chinese">Min Nan Chinese</option>
                                        <option value="Hakka Chinese">Hakka Chinese</option>
                                        <option value="Jin Chinese">Jin Chinese</option>
                                        <option value="Hausa">Hausa</option>
                                        <option value="Kannada">Kannada</option>
                                        <option value="Indonesian">Indonesian</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Yoruba">Yoruba</option>
                                        <option value="Xiang Chinese">Xiang Chinese</option>
                                        <option value="Malayalam">Malayalam</option>
                                        <option value="Odia">Odia</option>
                                        <option value="Maithili">Maithili</option>
                                        <option value="Burmese">Burmese</option>
                                        <option value="Eastern Punjabi">Eastern Punjabi</option>
                                        <option value="Sunda">Sunda</option>
                                        <option value="Sudanese Arabic">Sudanese Arabic</option>
                                        <option value="Algerian Arabic">Algerian Arabic</option>
                                        <option value="Moroccan Arabic">Moroccan Arabic</option>
                                        <option value="Ukrainian">Ukrainian</option>
                                        <option value="Igbo">Igbo</option>
                                        <option value="Northern Uzbek">Northern Uzbek</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="North Levantine Arabic">North Levantine Arabic</option>
                                        <option value="Romanian">Romanian</option>
                                        <option value="Tagalog">Tagalog</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Saʽidi Arabic">Saʽidi Arabic</option>
                                        <option value="Gan Chinese">Gan Chinese</option>
                                        <option value="Amharic">Amharic</option>
                                        <option value="Pashto">Pashto</option>
                                        <option value="Magahi">Magahi</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Saraiki">Saraiki</option>
                                        <option value="Khmer">Khmer</option>
                                        <option value="Chhattisgarhi">Chhattisgarhi</option>
                                        <option value="Somali">Somali</option>
                                        <option value="Malaysian">Malaysian</option>
                                        <option value="Cebuano">Cebuano</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Mesopotamian Arabic">Mesopotamian Arabic</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Sinhalese">Sinhalese</option>
                                        <option value="Northern Kurdish">Northern Kurdish</option>
                                        <option value="Hejazi Arabic">Hejazi Arabic</option>
                                        <option value="Nigerian Fulfulde">Nigerian Fulfulde</option>
                                        <option value="Bavarian">Bavarian</option>
                                        <option value="South Azerbaijani">South Azerbaijani</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Chittagonian">Chittagonian</option>
                                        <option value="Kazakh">Kazakh</option>
                                        <option value="Deccan">Deccan</option>
                                        <option value="Hungarian">Hungarian</option>
                                        <option value="Kinyarwanda">Kinyarwanda</option>
                                        <option value="Zulu">Zulu</option>
                                        <option value="South Levantine Arabic">South Levantine Arabic</option>
                                        <option value="Tunisian Arabic">Tunisian Arabic</option>
                                        <option value="Sanaani Spoken Arabic">Sanaani Spoken Arabic</option>
                                        <option value="Min Bei Chinese">Min Bei Chinese</option>
                                        <option value="Southern Pashto">Southern Pashto</option>
                                        <option value="Rundi">Rundi</option>
                                        <option value="Czech">Czech</option>
                                        <option value="Taʽizzi-Adeni Arabic">Taʽizzi-Adeni Arabic</option>
                                        <option value="Uyghur">Uyghur</option>
                                        <option value="Min Dong Chinese">Min Dong Chinese</option>
                                        <option value="Sylheti">Sylheti</option>
                                    </select>
                            <input type="hidden" name="Longitude" id="Longitude" value="">
                            <input type="hidden" name="Latitude" id="Latitude" value="">

                            <button type="submit" class="btn_1 medium pt-2" id="searchDoctor">Find Doctor</button>
                        </div>
                    </div>
                </form>
                <div class="clearfix" id="toggleButtons">

                <div id="filtationCheckBoxes">
                    <div class="filter-switch-item">
                    <input type="radio" name="gender" id="filter1-0" checked value="all">
                    <label for="filter1-0" class=" text-gray" >
                        All
                    </label>
                    </div>
                    <div class="filter-switch-item">
                    <input type="radio" name="gender" id="filter1-1" value="male">
                    <label for="filter1-1" class=" text-gray">
                        Male
                    </label>
                    </div>
                    <div class="filter-switch-item">
                    <input type="radio" name="gender" id="filter1-2" value="female">
                    <label for="filter1-2" class=" text-gray">
                        Female
                    </label>
                    </div>
                </div>
                <div id="filtationCheckBoxes">
                    <div class="filter-switch-item">
                    <input type="radio" name="verification" id="verification-0" checked value="all">
                    <label for="verification-0" class=" text-gray">
                        All
                    </label>
                    </div>
                    <div class="filter-switch-item">
                    <input type="radio" name="verification" id="verification-1"  value="verified">
                    <label for="verification-1" class=" text-gray">
                    Verified Only
                    </label>
                    </div>

                </div>

                    <!-- <div class="switchBox">
                        <p>
                            Male
                        </p>
                        <label class="switch">
                            <input type="checkbox" id="gender" name="gender">
                            <span class="slider round"></span>
                        </label>
                        <p>
                            Female
                        </p>
                    </div>
                    <div class="switchBox">
                        <p>
                            Un-Verified
                        </p>
                        <label class="switch">
                            <input type="checkbox" id="verification" name="verification ">
                            <span class="slider round"></span>
                        </label>
                        <p>
                            Verified
                        </p>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


<?php

if (isset($_POST['quickSearch'])) {
    ?>
    <div id="_search_wrapper" class="searchFromHomePage">
        <div class="container">
            <div class="row" class="notFoundString" id="notFoundString">
                <div class="col">
                    <p class="mb-1">
                        Sorry, we could not find any results for <span
                                class="text-danger"> <?= $_POST["quickSearch"]; ?> </span>
                    </p>
                    <h6>
                        <span class="text-danger">Did you mean</span>
                        <i class="text-primary" id="suggestionKeywords">?</i>
                    </h6>
                </div>
            </div>
            <div class="row">
                <?php
                $getQuickName = $_POST['quickSearch'];
                if (strlen($getQuickName) >= 3) {
                    $getQuickName = substr($getQuickName, 0, 3);
                    $records = $wpdb->get_results("SELECT user_id,meta_key,meta_value FROM `wp_usermeta` WHERE `meta_value` like '%$getQuickName%' AND (`meta_key` like 'first_name' OR `meta_key` like 'last_name' OR `meta_key` like 'user_registration_speciality') group BY user_id", ARRAY_A);
                    //get suggested keywords
                    $suggestions = prepareSuggestions($_POST['quickSearch'], array_column($records, 'meta_value'));
                    if ($suggestions) {
                        $suggestions = implode(",", $suggestions);
                        echo "<script type='text/javascript'> 
                            displaySuggestions('$suggestions');
                        </script>";
                    } else {
                        echo "<script type='text/javascript'> 
                            hideSuggestions();
                        </script>";
                    }
                    $userIds = array_column($records, 'user_id');
                    $blogusers = get_users(array('include' => $userIds));
                    // print_r($userIds);
                    if (!empty($userIds)) {

                        foreach ($blogusers as $user) {
                            // get_userdata( $user->ID )
                            $userCustomField = get_user_meta($user->ID);

                            //  print_r($userCustomField);

                            ?>
                            <!-- /box_list -->
                            <div data-virtual="<?php echo get_the_author_meta('user_registration_virtual_appointments', $user->ID);?>" class="col-lg-4 col-md-6 box-parent <?php echo get_the_author_meta('user_registration_verified_member', $user->ID) ?>"
                                 id="<?php echo get_the_author_meta('user_registration_gender', $user->ID); ?>">
                                <div class="box_list home">
                                    <div class="virtual">
                                <div class="appointment">
                                <svg id="Layer_1" enable-background="new 0 0 511.726 511.726" height="30" viewBox="0 0 511.726 511.726" width="30" xmlns="http://www.w3.org/2000/svg"><g><path d="m83.168 98.34c3.233 2.939 7.546 1.884 10.6-.48 2.79-3.05 2.58-7.8-.479-10.59-3.061-2.8-7.8-2.58-10.59.471-2.801 3.059-2.591 7.799.469 10.599z"/><path d="m58.927 132.59c3.375 2.094 8.234.966 10.33-2.4 2.19-3.52 1.11-8.149-2.399-10.33-3.521-2.189-8.15-1.119-10.33 2.4-2.19 3.52-1.12 8.139 2.399 10.33z"/><path d="m119.257 72.08c5.723 0 9.499-7.341 5.98-12.021-2.49-3.3-7.2-3.96-10.5-1.47-3.311 2.5-3.971 7.2-1.471 10.51 1.472 1.951 3.722 2.981 5.991 2.981z"/><path d="m41.418 170.729c3.605 1.377 8.286-.633 9.71-4.279 1.5-3.86-.42-8.21-4.28-9.71-3.859-1.5-8.199.409-9.699 4.279-1.512 3.861.408 8.201 4.269 9.71z"/><path d="m31.257 211.439c3.711.717 8.063-2.297 8.75-6 .76-4.069-1.92-7.989-5.99-8.739-4.08-.771-7.989 1.92-8.75 5.989-.76 4.071 1.92 7.991 5.99 8.75z"/><path d="m41.298 320.95c-3.86 1.5-5.78 5.84-4.28 9.699 1.15 2.98 3.98 4.801 6.99 4.801 4.761 0 8.769-5.628 7-10.21-1.501-3.87-5.84-5.79-9.71-4.29z"/><path d="m33.937 294.97c4.08-.75 6.771-4.67 6.011-8.74-.75-4.069-4.67-6.76-8.74-6.01-4.07.76-6.76 4.67-6.01 8.74.735 4.089 4.763 6.787 8.739 6.01z"/><path d="m28.778 253.33c9.926-.345 9.928-14.66 0-15-4.141-.011-7.5 3.35-7.5 7.489-.011 4.15 3.35 7.5 7.489 7.511z"/><path d="m451.717 361.26c-3.49-2.22-8.13-1.18-10.35 2.31-2.22 3.5-1.19 8.131 2.31 10.36 3.767 2.125 7.217 1.355 10.351-2.31 2.22-3.5 1.189-8.13-2.311-10.36z"/><path d="m446.278 121.979c-3.54 2.141-4.67 6.761-2.521 10.301 2.049 3.384 6.927 4.572 10.311 2.52 3.54-2.15 4.659-6.76 2.52-10.3-2.151-3.54-6.76-4.67-10.31-2.521z"/><path d="m420.217 89.1c-3.09 2.76-3.35 7.5-.59 10.59 3.448 3.123 6.978 3.32 10.59.591 3.08-2.761 3.351-7.5.59-10.591-2.759-3.081-7.5-3.35-10.59-.59z"/><path d="m469.597 323.31c-3.85-1.54-8.21.33-9.75 4.17-1.838 4.595 2.163 10.29 6.96 10.29 2.98 0 5.79-1.779 6.971-4.72 1.529-3.84-.341-8.21-4.181-9.74z"/><path d="m483.028 240.84c-4.15-.04-7.54 3.28-7.58 7.43-.043 4.475 3.654 6.967 7.5 7.57 4.109 0 7.46-3.31 7.5-7.42.04-4.15-3.28-7.54-7.42-7.58z"/><path d="m468.507 173.6c.88 0 1.771-.149 2.641-.479 3.869-1.46 5.829-5.78 4.38-9.66-3.815-9.177-17.219-4.127-14.04 5.28 1.13 3.009 3.989 4.859 7.019 4.859z"/><path d="m472.158 207.84c.651 3.702 4.966 6.767 8.68 6.09 4.08-.71 6.811-4.6 6.09-8.68-.71-4.08-4.6-6.811-8.68-6.09-4.08.71-6.811 4.6-6.09 8.68z"/><path d="m427.158 395.29c-3.03-2.83-7.771-2.66-10.601.37-2.819 3.029-2.649 7.779.38 10.6 3.584 2.798 7.117 2.674 10.601-.37 2.82-3.04 2.66-7.781-.38-10.6z"/><path d="m480.137 282.689c-4.069-.8-8.01 1.851-8.81 5.91-.822 4.237 3.107 8.95 7.37 8.95 3.51 0 6.649-2.48 7.35-6.05.8-4.069-1.849-8.009-5.91-8.81z"/><path d="m273.748 464.88v-.01c-4.13.34-7.21 3.949-6.88 8.08.295 3.634 4.333 7.245 8.08 6.88 4.13-.33 7.21-3.95 6.88-8.08-.34-4.13-3.96-7.21-8.08-6.87z"/><path d="m351.628 443.67c-3.729 1.81-5.28 6.29-3.47 10.02 1.71 3.513 6.518 5.203 10.02 3.471 3.73-1.811 5.28-6.29 3.471-10.021-1.811-3.72-6.291-5.281-10.021-3.47z"/><path d="m313.677 457.899c-4 1.091-6.359 5.21-5.27 9.21 1.006 3.691 5.542 6.269 9.21 5.271 9.498-2.944 5.73-16.748-3.94-14.481z"/><path d="m399.097 60.189c-.01 0-.01 0-.01 0-3.27-2.529-7.979-1.92-10.52 1.351-2.53 3.279-1.92 7.99 1.359 10.52 3.692 2.474 7.199 2.025 10.521-1.35 2.53-3.28 1.921-7.99-1.35-10.521z"/><path d="m386.307 422.67c-3.33 2.46-4.029 7.16-1.569 10.49 3.282 3.436 6.778 3.959 10.489 1.569 3.33-2.46 4.03-7.16 1.57-10.489-2.459-3.33-7.16-4.03-10.49-1.57z"/><path d="m233.177 464.439v-.01c-4.12-.42-7.8 2.58-8.229 6.7-.407 3.99 3.447 8.27 7.47 8.27 3.8 0 7.06-2.88 7.46-6.739.42-4.12-2.58-7.801-6.701-8.221z"/><path d="m392.245 247.435c0-8.677-3.784-16.486-9.788-21.866 12.85-11.54 12.867-32.292 0-43.822 12.848-11.538 12.868-32.286.005-43.817 18.308-16.413 8.685-47.977-15.866-51.089v-56.776c0-16.578-13.487-30.065-30.064-30.065h-95.03c-9.697 0-9.697 15 0 15h95.03c8.307 0 15.064 6.759 15.064 15.065v3.969h-185.18v-3.969c0-8.308 6.759-15.065 15.065-15.065h19.036c9.697 0 9.697-15 0-15h-19.036c-16.578 0-30.065 13.487-30.065 30.065v109.794c-20.418-13.013-48.011 2.373-48.011 26.521v175.869l-14.043 14.107c-15.256-7.126-34.114-3.72-45.973 8.194-15.834 15.905-15.834 41.785 0 57.69l46.421 46.634c6.841 6.873 17.471-3.709 10.631-10.582l-46.421-46.634c-10.025-10.07-10.025-26.456 0-36.526 9.864-9.909 26.536-9.855 36.345 0l77.425 77.779c10.023 10.07 10.023 26.456 0 36.526-11.462 11.515-29.283 8.875-39.283-2.951-6.842-6.874-17.471 3.71-10.631 10.582 35.741 37.784 92.421-4.347 65.499-48.708l13.512-13.574c40.589 3.097 79.999-19.31 98.205-55.747h41.44c16.577 0 30.064-13.487 30.064-30.065v-72.313c14.444-1.831 25.649-14.203 25.649-29.226zm-15 .099c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.443 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.923c-.255 7.677-6.427 14.462-14.361 14.462h-13.095c-19.069-.794-19.068-28.029 0-28.822h13.095c7.918-.001 14.361 6.442 14.361 14.36zm-25.649-66.933v37.572c-27.913-1.369-41.896 32.834-21.386 51.322-12.973 11.262-12.968 32.565 0 43.822-12.973 11.262-12.968 32.565 0 43.822-20.518 18.502-6.511 52.692 21.386 51.322v37.572h-142.212c-4.749-25.583-19.496-49.612-42.968-61.863v-203.569zm-146.827 371.104-10.504-.489c-2.101-.084-4.172.701-5.664 2.201l-15.283 15.353-71.634-71.962 14.537-14.604c1.399-1.405 2.185-3.308 2.185-5.291v-178.966c0-21.125 32.57-21.125 32.57 0v90.744c0 2.99 1.776 5.695 4.521 6.883 17.869 7.732 31.09 23.744 37.227 45.086 6.922 24.074 3.23 50.65-9.635 69.358-5.337 7.76 6.625 16.838 12.359 8.5 1.737-2.526 3.334-5.169 4.79-7.911h77.721c-15.605 25.506-42.92 41.04-73.19 41.098zm131.763-56.098h-130.031c3.453-10.916 5.01-22.717 4.552-34.572h140.543v19.507c0 8.306-6.757 15.065-15.064 15.065z"/><path d="m187.845 105.867c3.554 2.883 7.089 2.837 10.605-.139l21.953-22.534c6.767-6.945-3.979-17.415-10.744-10.467l-21.953 22.534c-2.89 2.968-2.827 7.716.139 10.606z"/><path d="m187.845 154.088c3.554 2.883 7.089 2.837 10.605-.139l68.929-70.755c6.767-6.945-3.979-17.415-10.744-10.467l-68.929 70.755c-2.89 2.967-2.827 7.715.139 10.606z"/></g></svg>
                                </div>
                                <span>Accepting Virtual Appointment</span>
                        </div>
                                    <figure>
                                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">
                                            <?php
                                 $image;
                                 if($userCustomField['user_registration_profile_pic_url'][0])
                                 {
                                    $image = $userCustomField['user_registration_profile_pic_url'][0];
                                 }
                                 else
                                 {
                                    $image = get_site_url() . "/wp-content/uploads/2021/05/360_F_346936114_RaxE6OQogebgAWTalE1myseY1Hbb5qPM.jpg";
                                 }
                                ?>
                                <img src="<?php echo $image; ?>"
                                            class="img-fluid" alt="">
                                        </a>
                                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>"
                                           class="preview"><span>Read more</span></a>
                                    </figure>
                                    <div class="wrapper">
                                        <small><?php echo $userCustomField['user_registration_speciality'][0] ?></small>
                                        <h3><?php echo $user->first_name;
                                            echo ' ' . $user->last_name;

                                            if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No") {
                                                ?>
                                                <img src="<?php echo get_template_directory_uri() . "/images/unverified.png" ?>"
                                                     alt="" width="70">
                                                <?php
                                            } else {
                                                ?>
                                                <img class="verified"
                                                     src="<?php echo get_template_directory_uri() . "/images/verified.png" ?>"
                                                     alt="" width="70">
                                                <?php
                                            }
                                            ?></h3>
                                        <!-- <p><?php echo $userCustomField['user_registration_textarea_1614152627'][0] ?></p> -->
                                        <?php if(bestReview($user->ID)->comment){
                                            
                                       ?>
                                        <p>
                                            <i> " <?php echo bestReview($user->ID)->comment;?> " </i>
                                        </p>
                                        <span> - <?= bestReview($user->ID)->review_by;?> </span>
                                        <?php }?>
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                        <a class="mr-2 themeclr" href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">Read More</a>
                                        <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> <small>(<small
                                                        class="totalRating"><?php echo round(totalReviews($user->ID)->averageRating, 2); ?></small>)</small></span></div>
                                    </div>
                                    <ul>
                                        <!-- <li><i class="fa fa-eye"></i> 854 Views</li> -->
                                         <li>
                                            <?php
                                
                                if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No")
                                {
                                    ?>
                                        <button type="button" id="confirmUnverified" data-verify="no" class="btn_1 medium">BOOK NOW</button>
                                        
                                    <?php
                                }
                                else if (!getLoggedInUserActiveSubscriptions())
                                {
                                    ?>
                                    <button type="button" id="confirmUnverified" data-subscription="no" class="btn_1 medium">BOOK NOW</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <form action="<?php echo get_home_url(); ?>/book-a-doctor/" method="post">
                                <input type="text" name="doctor-id" hidden value="<?php echo $user->ID ?>">
                                <input type="text" name="doctor-email" hidden value="<?php echo $user->user_email ?>">
                                <button type="submit" class="btn_1 medium">BOOK NOW</button>
                            </form>
                                    <?php
                                }
                                ?>
                                </li>
                                    </ul>
                                </div>
                            </div>


                            <?php

                        }
                    }
                    if (empty($userIds)) {

                        echo "<script type='text/javascript'> 
                            hideOrUnhideToogleButtons();
                        </script>";
                        echo "<script type='text/javascript'> 
                            hideSuggestions();
                        </script>";

                        ?>
                        <div class="col text-center">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>We are Sorry!</strong> No results found with your search

                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<script type='text/javascript'> 
                            hideOrUnhideToogleButtons();
                        </script>";
                    ?>
                    <div class="col text-center">
                        <?php
                        echo "<script type='text/javascript'> 
                            hideSuggestions();
                        </script>";
                        ?>

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> Type at least 3 characters

                        </div>
                    </div>

                    <?php
                }
                ?>


                <!-- /aside -->
            </div>
        </div>
    </div>
    <?php
} elseif (!empty($_POST['speciality'])
    || !empty($_POST["gender"])
    || !empty($_POST["doctorName"])
    || !empty($_POST["verifiedMembers"])
    || !empty($_POST["location"] )
    || !empty($_POST["services"])
    || !empty($_POST["language"])) {
    ?>
    <div id="_search_wrapper" class="searchFromAdvanceSearch">
        <div class="container">
            <div class="row" class="notFoundString" id="notFoundString">
                <div class="col">
                    <p class="mb-1">
                        Sorry, we could not find any results for <span
                                class="text-danger"> <?= $_POST["speciality"]; ?> </span>
                    </p>
                    <h6>
                        <span class="text-danger">Did you mean</span> <i class="text-primary" id="suggestionKeywords">?</i>
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <?php

                        //Addvanced Filter
                        $suggestionsList=[];
                        $advancedFilterUsers = [];
                        $args = array(
                            'role' => 'Doctors',
                            'orderby'=>'meta_value',
                            'meta_key'=>'user_registration_verified_member',
                            'order'=>'desc'
                        );
                        $users = get_users($args);
                        $fullMatchedFlag=false;
                        foreach ($users as $user) {
                            $meta = get_user_meta($user->ID);
                            if (strpos($meta["wp_capabilities"][0], 'Doctors') !== false) {

                                advancedSearch($user,$_POST["speciality"],$advancedFilterUsers,$suggestionsList,$fullMatchedFlag);
                            }
                        }
                        //To show/hide suggestion list
                        if ($suggestionsList) {
                            $suggestionsList = implode(",", $suggestionsList);
                            echo "<script type='text/javascript'>
                            displaySuggestions('$suggestionsList');
                        </script>";
                        } else {
                            echo "<script type='text/javascript'>
                            hideSuggestions();
                        </script>";
                        }
                        foreach ($advancedFilterUsers as $user) {
                            $userCustomField = get_user_meta($user->ID);
                            ?>
                            <!-- /box_list -->
                            <div data-virtual="<?php echo get_the_author_meta('user_registration_virtual_appointments', $user->ID);?>" class="col-lg-4 col-md-6 box-parent <?php echo get_the_author_meta('user_registration_verified_member', $user->ID) ?>"
                                 id="<?php echo get_the_author_meta('user_registration_gender', $user->ID); ?>">
                                <div class="box_list home">
                                    <div class="virtual">
                                <div class="appointment">
                                <svg id="Layer_1" enable-background="new 0 0 511.726 511.726" height="30" viewBox="0 0 511.726 511.726" width="30" xmlns="http://www.w3.org/2000/svg"><g><path d="m83.168 98.34c3.233 2.939 7.546 1.884 10.6-.48 2.79-3.05 2.58-7.8-.479-10.59-3.061-2.8-7.8-2.58-10.59.471-2.801 3.059-2.591 7.799.469 10.599z"/><path d="m58.927 132.59c3.375 2.094 8.234.966 10.33-2.4 2.19-3.52 1.11-8.149-2.399-10.33-3.521-2.189-8.15-1.119-10.33 2.4-2.19 3.52-1.12 8.139 2.399 10.33z"/><path d="m119.257 72.08c5.723 0 9.499-7.341 5.98-12.021-2.49-3.3-7.2-3.96-10.5-1.47-3.311 2.5-3.971 7.2-1.471 10.51 1.472 1.951 3.722 2.981 5.991 2.981z"/><path d="m41.418 170.729c3.605 1.377 8.286-.633 9.71-4.279 1.5-3.86-.42-8.21-4.28-9.71-3.859-1.5-8.199.409-9.699 4.279-1.512 3.861.408 8.201 4.269 9.71z"/><path d="m31.257 211.439c3.711.717 8.063-2.297 8.75-6 .76-4.069-1.92-7.989-5.99-8.739-4.08-.771-7.989 1.92-8.75 5.989-.76 4.071 1.92 7.991 5.99 8.75z"/><path d="m41.298 320.95c-3.86 1.5-5.78 5.84-4.28 9.699 1.15 2.98 3.98 4.801 6.99 4.801 4.761 0 8.769-5.628 7-10.21-1.501-3.87-5.84-5.79-9.71-4.29z"/><path d="m33.937 294.97c4.08-.75 6.771-4.67 6.011-8.74-.75-4.069-4.67-6.76-8.74-6.01-4.07.76-6.76 4.67-6.01 8.74.735 4.089 4.763 6.787 8.739 6.01z"/><path d="m28.778 253.33c9.926-.345 9.928-14.66 0-15-4.141-.011-7.5 3.35-7.5 7.489-.011 4.15 3.35 7.5 7.489 7.511z"/><path d="m451.717 361.26c-3.49-2.22-8.13-1.18-10.35 2.31-2.22 3.5-1.19 8.131 2.31 10.36 3.767 2.125 7.217 1.355 10.351-2.31 2.22-3.5 1.189-8.13-2.311-10.36z"/><path d="m446.278 121.979c-3.54 2.141-4.67 6.761-2.521 10.301 2.049 3.384 6.927 4.572 10.311 2.52 3.54-2.15 4.659-6.76 2.52-10.3-2.151-3.54-6.76-4.67-10.31-2.521z"/><path d="m420.217 89.1c-3.09 2.76-3.35 7.5-.59 10.59 3.448 3.123 6.978 3.32 10.59.591 3.08-2.761 3.351-7.5.59-10.591-2.759-3.081-7.5-3.35-10.59-.59z"/><path d="m469.597 323.31c-3.85-1.54-8.21.33-9.75 4.17-1.838 4.595 2.163 10.29 6.96 10.29 2.98 0 5.79-1.779 6.971-4.72 1.529-3.84-.341-8.21-4.181-9.74z"/><path d="m483.028 240.84c-4.15-.04-7.54 3.28-7.58 7.43-.043 4.475 3.654 6.967 7.5 7.57 4.109 0 7.46-3.31 7.5-7.42.04-4.15-3.28-7.54-7.42-7.58z"/><path d="m468.507 173.6c.88 0 1.771-.149 2.641-.479 3.869-1.46 5.829-5.78 4.38-9.66-3.815-9.177-17.219-4.127-14.04 5.28 1.13 3.009 3.989 4.859 7.019 4.859z"/><path d="m472.158 207.84c.651 3.702 4.966 6.767 8.68 6.09 4.08-.71 6.811-4.6 6.09-8.68-.71-4.08-4.6-6.811-8.68-6.09-4.08.71-6.811 4.6-6.09 8.68z"/><path d="m427.158 395.29c-3.03-2.83-7.771-2.66-10.601.37-2.819 3.029-2.649 7.779.38 10.6 3.584 2.798 7.117 2.674 10.601-.37 2.82-3.04 2.66-7.781-.38-10.6z"/><path d="m480.137 282.689c-4.069-.8-8.01 1.851-8.81 5.91-.822 4.237 3.107 8.95 7.37 8.95 3.51 0 6.649-2.48 7.35-6.05.8-4.069-1.849-8.009-5.91-8.81z"/><path d="m273.748 464.88v-.01c-4.13.34-7.21 3.949-6.88 8.08.295 3.634 4.333 7.245 8.08 6.88 4.13-.33 7.21-3.95 6.88-8.08-.34-4.13-3.96-7.21-8.08-6.87z"/><path d="m351.628 443.67c-3.729 1.81-5.28 6.29-3.47 10.02 1.71 3.513 6.518 5.203 10.02 3.471 3.73-1.811 5.28-6.29 3.471-10.021-1.811-3.72-6.291-5.281-10.021-3.47z"/><path d="m313.677 457.899c-4 1.091-6.359 5.21-5.27 9.21 1.006 3.691 5.542 6.269 9.21 5.271 9.498-2.944 5.73-16.748-3.94-14.481z"/><path d="m399.097 60.189c-.01 0-.01 0-.01 0-3.27-2.529-7.979-1.92-10.52 1.351-2.53 3.279-1.92 7.99 1.359 10.52 3.692 2.474 7.199 2.025 10.521-1.35 2.53-3.28 1.921-7.99-1.35-10.521z"/><path d="m386.307 422.67c-3.33 2.46-4.029 7.16-1.569 10.49 3.282 3.436 6.778 3.959 10.489 1.569 3.33-2.46 4.03-7.16 1.57-10.489-2.459-3.33-7.16-4.03-10.49-1.57z"/><path d="m233.177 464.439v-.01c-4.12-.42-7.8 2.58-8.229 6.7-.407 3.99 3.447 8.27 7.47 8.27 3.8 0 7.06-2.88 7.46-6.739.42-4.12-2.58-7.801-6.701-8.221z"/><path d="m392.245 247.435c0-8.677-3.784-16.486-9.788-21.866 12.85-11.54 12.867-32.292 0-43.822 12.848-11.538 12.868-32.286.005-43.817 18.308-16.413 8.685-47.977-15.866-51.089v-56.776c0-16.578-13.487-30.065-30.064-30.065h-95.03c-9.697 0-9.697 15 0 15h95.03c8.307 0 15.064 6.759 15.064 15.065v3.969h-185.18v-3.969c0-8.308 6.759-15.065 15.065-15.065h19.036c9.697 0 9.697-15 0-15h-19.036c-16.578 0-30.065 13.487-30.065 30.065v109.794c-20.418-13.013-48.011 2.373-48.011 26.521v175.869l-14.043 14.107c-15.256-7.126-34.114-3.72-45.973 8.194-15.834 15.905-15.834 41.785 0 57.69l46.421 46.634c6.841 6.873 17.471-3.709 10.631-10.582l-46.421-46.634c-10.025-10.07-10.025-26.456 0-36.526 9.864-9.909 26.536-9.855 36.345 0l77.425 77.779c10.023 10.07 10.023 26.456 0 36.526-11.462 11.515-29.283 8.875-39.283-2.951-6.842-6.874-17.471 3.71-10.631 10.582 35.741 37.784 92.421-4.347 65.499-48.708l13.512-13.574c40.589 3.097 79.999-19.31 98.205-55.747h41.44c16.577 0 30.064-13.487 30.064-30.065v-72.313c14.444-1.831 25.649-14.203 25.649-29.226zm-15 .099c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.443 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.923c-.255 7.677-6.427 14.462-14.361 14.462h-13.095c-19.069-.794-19.068-28.029 0-28.822h13.095c7.918-.001 14.361 6.442 14.361 14.36zm-25.649-66.933v37.572c-27.913-1.369-41.896 32.834-21.386 51.322-12.973 11.262-12.968 32.565 0 43.822-12.973 11.262-12.968 32.565 0 43.822-20.518 18.502-6.511 52.692 21.386 51.322v37.572h-142.212c-4.749-25.583-19.496-49.612-42.968-61.863v-203.569zm-146.827 371.104-10.504-.489c-2.101-.084-4.172.701-5.664 2.201l-15.283 15.353-71.634-71.962 14.537-14.604c1.399-1.405 2.185-3.308 2.185-5.291v-178.966c0-21.125 32.57-21.125 32.57 0v90.744c0 2.99 1.776 5.695 4.521 6.883 17.869 7.732 31.09 23.744 37.227 45.086 6.922 24.074 3.23 50.65-9.635 69.358-5.337 7.76 6.625 16.838 12.359 8.5 1.737-2.526 3.334-5.169 4.79-7.911h77.721c-15.605 25.506-42.92 41.04-73.19 41.098zm131.763-56.098h-130.031c3.453-10.916 5.01-22.717 4.552-34.572h140.543v19.507c0 8.306-6.757 15.065-15.064 15.065z"/><path d="m187.845 105.867c3.554 2.883 7.089 2.837 10.605-.139l21.953-22.534c6.767-6.945-3.979-17.415-10.744-10.467l-21.953 22.534c-2.89 2.968-2.827 7.716.139 10.606z"/><path d="m187.845 154.088c3.554 2.883 7.089 2.837 10.605-.139l68.929-70.755c6.767-6.945-3.979-17.415-10.744-10.467l-68.929 70.755c-2.89 2.967-2.827 7.715.139 10.606z"/></g></svg>
                                </div>
                                <span>Accepting Virtual Appointment</span>
                        </div>
                                    <figure>
                                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">
                                            <?php
                                 $image;
                                 if($userCustomField['user_registration_profile_pic_url'][0])
                                 {
                                    $image = $userCustomField['user_registration_profile_pic_url'][0];
                                 }
                                 else
                                 {
                                    $image = get_site_url() . "/wp-content/uploads/2021/05/360_F_346936114_RaxE6OQogebgAWTalE1myseY1Hbb5qPM.jpg";
                                 }
                                ?>
                                <img src="<?php echo $image; ?>"
                                            class="img-fluid" alt="">
                                        </a>
                                        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>"
                                           class="preview"><span>Read more</span></a>
                                    </figure>
                                    <div class="wrapper">
                                        <small><?php echo $userCustomField['user_registration_speciality'][0] ?></small>
                                        <h3><?php echo $user->first_name;
                                            echo ' ' . $user->last_name;

                                            if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No") {
                                                ?>
                                                <img src="<?php echo get_template_directory_uri() . "/images/unverified.png" ?>"
                                                     alt="" width="70">
                                                <?php
                                            } else {
                                                ?>
                                                <img class="verified"
                                                     src="<?php echo get_template_directory_uri() . "/images/verified.png" ?>"
                                                     alt="" width="70">
                                                <?php
                                            }
                                            ?></h3>
                                        <!-- <p><?php echo $userCustomField['user_registration_textarea_1614152627'][0] ?></p> -->
                                        <?php if(bestReview($user->ID)->comment){
                                            
                                       ?>
                                        <p>
                                            <i> " <?php echo bestReview($user->ID)->comment;?> " </i>
                                        </p>
                                        <span> - <?= bestReview($user->ID)->review_by;?> </span>
                                        <?php }?>
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                        <a class="mr-2 themeclr" href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">Read More</a>
                                        <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i> <small>(<small
                                                        class="totalRating"><?php echo round(totalReviews($user->ID)->averageRating, 2); ?></small>)</small></span> </div>
                                    </div>
                                    <ul>
                                        <!-- <li><i class="fa fa-eye"></i> 854 Views</li> -->
                                        <li>
                                            
                                       <?php
                                
                                if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No")
                                {
                                    ?>
                                        <button type="button" id="confirmUnverified" data-verify="no"  class="btn_1 medium">BOOK NOW</button>
                                        
                                    <?php
                                }
                                 else if (!getLoggedInUserActiveSubscriptions())
                                {
                                    ?>
                                    <button type="button" id="confirmUnverified" data-subscription="no" class="btn_1 medium">BOOK NOW</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <form action="<?php echo get_home_url(); ?>/book-a-doctor/" method="post">
                                <input type="text" name="doctor-id" hidden value="<?php echo $user->ID ?>">
                                <input type="text" name="doctor-email" hidden value="<?php echo $user->user_email ?>">
                                <button type="submit" class="btn_1 medium">BOOK NOW</button>
                            </form>
                                    <?php
                                }
                                ?>
                                </li>
                                    </ul>
                                </div>
                            </div>


                            <?php

                        }
                        if (empty($advancedFilterUsers)) {
                            echo "<script type='text/javascript'> 
                                    hideOrUnhideToogleButtons();
                                </script>";
                            ?>
                            <div class="col text-center">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>We are Sorry!</strong> No results found with your search

                                </div>
                            </div>

                            <?php
                        }

                        ?>


                    </div>
                    <!-- /row -->
                </div>
                <!-- /aside -->
            </div>
        </div>
    </div>
    <?php
} else {


?>
        <div id="_search_wrapper" class="allResults">
        <div class="container">
        <div class="row">
        <div class="col-lg-12">
        <div class="row">
        <?php
        echo "<script type='text/javascript'> 
                            var x = document.getElementById('toggleButtons');
                            x.style.display = 'block';
                            
                            
                        </script>";
        $blogusers = get_users(array('role__in' => array('doctors'),'orderby'=>'meta_value','meta_key'=>'user_registration_verified_member','order'=>'desc'));

        foreach ($blogusers as $user) {
            $userCustomField = get_user_meta($user->ID);

                    ?>
                    <!-- /box_list -->
                    <div data-virtual="<?php echo get_the_author_meta('user_registration_virtual_appointments', $user->ID);?>" class="col-lg-4 col-md-6 box-parent <?php echo get_the_author_meta('user_registration_verified_member', $user->ID) ?>"
                         id="<?php echo get_the_author_meta('user_registration_gender', $user->ID); ?>">
                        <div class="box_list home">
                            <div class="virtual">
                              <div class="appointment">
                                <svg id="Layer_1" enable-background="new 0 0 511.726 511.726" height="30" viewBox="0 0 511.726 511.726" width="30" xmlns="http://www.w3.org/2000/svg"><g><path d="m83.168 98.34c3.233 2.939 7.546 1.884 10.6-.48 2.79-3.05 2.58-7.8-.479-10.59-3.061-2.8-7.8-2.58-10.59.471-2.801 3.059-2.591 7.799.469 10.599z"/><path d="m58.927 132.59c3.375 2.094 8.234.966 10.33-2.4 2.19-3.52 1.11-8.149-2.399-10.33-3.521-2.189-8.15-1.119-10.33 2.4-2.19 3.52-1.12 8.139 2.399 10.33z"/><path d="m119.257 72.08c5.723 0 9.499-7.341 5.98-12.021-2.49-3.3-7.2-3.96-10.5-1.47-3.311 2.5-3.971 7.2-1.471 10.51 1.472 1.951 3.722 2.981 5.991 2.981z"/><path d="m41.418 170.729c3.605 1.377 8.286-.633 9.71-4.279 1.5-3.86-.42-8.21-4.28-9.71-3.859-1.5-8.199.409-9.699 4.279-1.512 3.861.408 8.201 4.269 9.71z"/><path d="m31.257 211.439c3.711.717 8.063-2.297 8.75-6 .76-4.069-1.92-7.989-5.99-8.739-4.08-.771-7.989 1.92-8.75 5.989-.76 4.071 1.92 7.991 5.99 8.75z"/><path d="m41.298 320.95c-3.86 1.5-5.78 5.84-4.28 9.699 1.15 2.98 3.98 4.801 6.99 4.801 4.761 0 8.769-5.628 7-10.21-1.501-3.87-5.84-5.79-9.71-4.29z"/><path d="m33.937 294.97c4.08-.75 6.771-4.67 6.011-8.74-.75-4.069-4.67-6.76-8.74-6.01-4.07.76-6.76 4.67-6.01 8.74.735 4.089 4.763 6.787 8.739 6.01z"/><path d="m28.778 253.33c9.926-.345 9.928-14.66 0-15-4.141-.011-7.5 3.35-7.5 7.489-.011 4.15 3.35 7.5 7.489 7.511z"/><path d="m451.717 361.26c-3.49-2.22-8.13-1.18-10.35 2.31-2.22 3.5-1.19 8.131 2.31 10.36 3.767 2.125 7.217 1.355 10.351-2.31 2.22-3.5 1.189-8.13-2.311-10.36z"/><path d="m446.278 121.979c-3.54 2.141-4.67 6.761-2.521 10.301 2.049 3.384 6.927 4.572 10.311 2.52 3.54-2.15 4.659-6.76 2.52-10.3-2.151-3.54-6.76-4.67-10.31-2.521z"/><path d="m420.217 89.1c-3.09 2.76-3.35 7.5-.59 10.59 3.448 3.123 6.978 3.32 10.59.591 3.08-2.761 3.351-7.5.59-10.591-2.759-3.081-7.5-3.35-10.59-.59z"/><path d="m469.597 323.31c-3.85-1.54-8.21.33-9.75 4.17-1.838 4.595 2.163 10.29 6.96 10.29 2.98 0 5.79-1.779 6.971-4.72 1.529-3.84-.341-8.21-4.181-9.74z"/><path d="m483.028 240.84c-4.15-.04-7.54 3.28-7.58 7.43-.043 4.475 3.654 6.967 7.5 7.57 4.109 0 7.46-3.31 7.5-7.42.04-4.15-3.28-7.54-7.42-7.58z"/><path d="m468.507 173.6c.88 0 1.771-.149 2.641-.479 3.869-1.46 5.829-5.78 4.38-9.66-3.815-9.177-17.219-4.127-14.04 5.28 1.13 3.009 3.989 4.859 7.019 4.859z"/><path d="m472.158 207.84c.651 3.702 4.966 6.767 8.68 6.09 4.08-.71 6.811-4.6 6.09-8.68-.71-4.08-4.6-6.811-8.68-6.09-4.08.71-6.811 4.6-6.09 8.68z"/><path d="m427.158 395.29c-3.03-2.83-7.771-2.66-10.601.37-2.819 3.029-2.649 7.779.38 10.6 3.584 2.798 7.117 2.674 10.601-.37 2.82-3.04 2.66-7.781-.38-10.6z"/><path d="m480.137 282.689c-4.069-.8-8.01 1.851-8.81 5.91-.822 4.237 3.107 8.95 7.37 8.95 3.51 0 6.649-2.48 7.35-6.05.8-4.069-1.849-8.009-5.91-8.81z"/><path d="m273.748 464.88v-.01c-4.13.34-7.21 3.949-6.88 8.08.295 3.634 4.333 7.245 8.08 6.88 4.13-.33 7.21-3.95 6.88-8.08-.34-4.13-3.96-7.21-8.08-6.87z"/><path d="m351.628 443.67c-3.729 1.81-5.28 6.29-3.47 10.02 1.71 3.513 6.518 5.203 10.02 3.471 3.73-1.811 5.28-6.29 3.471-10.021-1.811-3.72-6.291-5.281-10.021-3.47z"/><path d="m313.677 457.899c-4 1.091-6.359 5.21-5.27 9.21 1.006 3.691 5.542 6.269 9.21 5.271 9.498-2.944 5.73-16.748-3.94-14.481z"/><path d="m399.097 60.189c-.01 0-.01 0-.01 0-3.27-2.529-7.979-1.92-10.52 1.351-2.53 3.279-1.92 7.99 1.359 10.52 3.692 2.474 7.199 2.025 10.521-1.35 2.53-3.28 1.921-7.99-1.35-10.521z"/><path d="m386.307 422.67c-3.33 2.46-4.029 7.16-1.569 10.49 3.282 3.436 6.778 3.959 10.489 1.569 3.33-2.46 4.03-7.16 1.57-10.489-2.459-3.33-7.16-4.03-10.49-1.57z"/><path d="m233.177 464.439v-.01c-4.12-.42-7.8 2.58-8.229 6.7-.407 3.99 3.447 8.27 7.47 8.27 3.8 0 7.06-2.88 7.46-6.739.42-4.12-2.58-7.801-6.701-8.221z"/><path d="m392.245 247.435c0-8.677-3.784-16.486-9.788-21.866 12.85-11.54 12.867-32.292 0-43.822 12.848-11.538 12.868-32.286.005-43.817 18.308-16.413 8.685-47.977-15.866-51.089v-56.776c0-16.578-13.487-30.065-30.064-30.065h-95.03c-9.697 0-9.697 15 0 15h95.03c8.307 0 15.064 6.759 15.064 15.065v3.969h-185.18v-3.969c0-8.308 6.759-15.065 15.065-15.065h19.036c9.697 0 9.697-15 0-15h-19.036c-16.578 0-30.065 13.487-30.065 30.065v109.794c-20.418-13.013-48.011 2.373-48.011 26.521v175.869l-14.043 14.107c-15.256-7.126-34.114-3.72-45.973 8.194-15.834 15.905-15.834 41.785 0 57.69l46.421 46.634c6.841 6.873 17.471-3.709 10.631-10.582l-46.421-46.634c-10.025-10.07-10.025-26.456 0-36.526 9.864-9.909 26.536-9.855 36.345 0l77.425 77.779c10.023 10.07 10.023 26.456 0 36.526-11.462 11.515-29.283 8.875-39.283-2.951-6.842-6.874-17.471 3.71-10.631 10.582 35.741 37.784 92.421-4.347 65.499-48.708l13.512-13.574c40.589 3.097 79.999-19.31 98.205-55.747h41.44c16.577 0 30.064-13.487 30.064-30.065v-72.313c14.444-1.831 25.649-14.203 25.649-29.226zm-15 .099c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.443 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.822c0 7.919-6.442 14.361-14.361 14.361h-13.095c-19.07-.795-19.068-28.029 0-28.822h13.095c7.918 0 14.361 6.442 14.361 14.461zm0-43.923c-.255 7.677-6.427 14.462-14.361 14.462h-13.095c-19.069-.794-19.068-28.029 0-28.822h13.095c7.918-.001 14.361 6.442 14.361 14.36zm-25.649-66.933v37.572c-27.913-1.369-41.896 32.834-21.386 51.322-12.973 11.262-12.968 32.565 0 43.822-12.973 11.262-12.968 32.565 0 43.822-20.518 18.502-6.511 52.692 21.386 51.322v37.572h-142.212c-4.749-25.583-19.496-49.612-42.968-61.863v-203.569zm-146.827 371.104-10.504-.489c-2.101-.084-4.172.701-5.664 2.201l-15.283 15.353-71.634-71.962 14.537-14.604c1.399-1.405 2.185-3.308 2.185-5.291v-178.966c0-21.125 32.57-21.125 32.57 0v90.744c0 2.99 1.776 5.695 4.521 6.883 17.869 7.732 31.09 23.744 37.227 45.086 6.922 24.074 3.23 50.65-9.635 69.358-5.337 7.76 6.625 16.838 12.359 8.5 1.737-2.526 3.334-5.169 4.79-7.911h77.721c-15.605 25.506-42.92 41.04-73.19 41.098zm131.763-56.098h-130.031c3.453-10.916 5.01-22.717 4.552-34.572h140.543v19.507c0 8.306-6.757 15.065-15.064 15.065z"/><path d="m187.845 105.867c3.554 2.883 7.089 2.837 10.605-.139l21.953-22.534c6.767-6.945-3.979-17.415-10.744-10.467l-21.953 22.534c-2.89 2.968-2.827 7.716.139 10.606z"/><path d="m187.845 154.088c3.554 2.883 7.089 2.837 10.605-.139l68.929-70.755c6.767-6.945-3.979-17.415-10.744-10.467l-68.929 70.755c-2.89 2.967-2.827 7.715.139 10.606z"/></g></svg>
                              </div>
                              <span>Accepting Virtual Appointment</span>
                            </div>
                            <figure>
                                <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">
                                <?php
                                 $image;
                                 if($userCustomField['user_registration_profile_pic_url'][0])
                                 {
                                    $image = $userCustomField['user_registration_profile_pic_url'][0];
                                 }
                                 else
                                 {
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
                                        <img src="<?php echo get_template_directory_uri() . "/images/unverified.png" ?>"
                                             alt="" width="70">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="verified"
                                             src="<?php echo get_template_directory_uri() . "/images/verified.png" ?>"
                                             alt="" width="70">
                                        <?php
                                    }
                                    ?></h3>
                                <!-- <p><?php echo $userCustomField['user_registration_textarea_1614152627'][0] ?></p> -->
                                <?php if(bestReview($user->ID)->comment){
                                            
                                       ?>
                                        <p>
                                            <i> " <?php echo bestReview($user->ID)->comment;?> " </i>
                                        </p>
                                        <span> - <?= bestReview($user->ID)->review_by;?> </span>
                                        <?php }?>
                                        <div class="d-flex justify-content-center align-items-center mt-3">
                                        <a class="mr-2 themeclr"
                                        href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>">Read More</a>
                                <span class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                            class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>(<small
                                                class="totalRating"><?php echo round(totalReviews($user->ID)->averageRating, 2); ?></small>)</small></span></div>
                            </div>
                            <ul>
                                <!-- <li><i class="fa fa-eye"></i> 854 Views</li> -->
                                <li>
                                   <?php
                                
                                if (get_the_author_meta('user_registration_verified_member', $user->ID) == "No")
                                {
                                    ?>
                                        <button type="button" id="confirmUnverified" data-verify="no" class="btn_1 medium">BOOK NOW</button>
                                        
                                    <?php
                                }
                                 else if (!getLoggedInUserActiveSubscriptions())
                                {
                                    ?>
                                    <button type="button" id="confirmUnverified" data-subscription="no" class="btn_1 medium">BOOK NOW</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <form action="<?php echo get_home_url(); ?>/book-a-doctor/" method="post">
                                <input type="text" name="doctor-id" hidden value="<?php echo $user->ID ?>">
                                <input type="text" name="doctor-email" hidden value="<?php echo $user->user_email ?>">
                                <button type="submit" class="btn_1 medium">BOOK NOW</button>
                            </form>
                                    <?php
                                }
                                ?>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <?php



        }
    }
    ?>





    </div>
    <!-- /row -->
    </div>
    <!-- /aside -->
    </div>
    </div>
    </div>
    <div id="getUnverified" class="modalCustom">
        <!-- Modal content -->
        <div class="modal-contentCustom">

            <div class="modal-bodyCustom">
                <span class="closeModal">×</span>
            <h5>Sorry!</h5>
            <p>This doctor is currently not accepting patients through Apply at the moment</p>
                <div class="d-flex align-items-center justify-content-between">
        <!-- 			<a href="/find-doctors/" class="medium text-primary text-decoration-underline">Search for Verified Doctors?</a> -->
        <!-- 			<a href="http://localhost/linkNbit/apptly/book-a-doctor/?doctor-id=70&doctor-email=testtest@gmail.com" class="btn_1 medium">Proceed Anyway</a> -->
        <!-- 			<a class="closeModal btn_1 medium text-light">Go Back</a>  -->
                </div>	
            </div>

        </div>

        </div>
    <?php
//}
?>


<!-- Container End -->

<?php get_footer();
