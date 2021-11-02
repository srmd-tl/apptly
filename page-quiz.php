<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Metabox
global $post;
global $wpdb;
$elsey_id   = ( isset( $post ) ) ? $post->ID : false;
$elsey_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $elsey_id;
$elsey_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elsey_id;
$elsey_meta = get_post_meta( $elsey_id, 'page_type_metabox', true );

$elsey_content_padding = ($elsey_meta) ? $elsey_meta['content_spacings'] : '';

if ($elsey_content_padding && $elsey_content_padding !== 'els-padding-none') {
  $elsey_content_top_spacings = $elsey_meta['content_top_spacings'];
  $elsey_content_btm_spacings = $elsey_meta['content_btm_spacings'];
  if ($elsey_content_padding === 'els-padding-custom') {
    $elsey_content_top_spacings = $elsey_content_top_spacings ? 'padding-top:'. elsey_check_px($elsey_content_top_spacings) .' !important;' : '';
    $elsey_content_btm_spacings = $elsey_content_btm_spacings ? 'padding-bottom:'. elsey_check_px($elsey_content_btm_spacings) .' !important;' : '';
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
$elsey_page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );

if ($elsey_page_layout_options) {
  $elsey_page_layout           = $elsey_page_layout_options['page_layout'];
  $elsey_page_show_sidebar     = $elsey_page_layout_options['page_show_sidebar'];
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
    $elsey_column_class     = 'col-lg-12 col-md-12 col-sm-12 col-12 els-no-sidebar';
    $elsey_sidebar_position = 'sidebar-hide';
  }
} else {
  $elsey_page_show_sidebar = false;
  $elsey_sidebar_position  = 'sidebar-hide';
  $elsey_parent_class = 'els-less-width';
  $elsey_layout_class = 'container els-reduced';
  $elsey_column_class = 'col-lg-12 col-md-12 col-sm-12 col-12 els-no-sidebar';
}

get_header(); ?>
<style>

</style>
<div class="els-container-wrap els-less-width els-padding-none">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="text-center text-light">
          Health Quiz
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="quizStartedSlider">
        <div class="totalScore">
            <span>Total Score: <span id="_counterStart">0</span> / 35 </span>
        </div>
           <div class="swiper-container">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I am ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="age" value="18"> &#60; 18 years old </label>
                        <label class="btn btn-primary active">
                          <input type="radio" name="age" value="19-15"> 19 – 25 years old  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="age" value="26-35"> 26 – 35 years old </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="age" value="35-55"> 36 – 55 years old  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="age" value="56-75"> 56- 75 years old </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="age" value="75+"> 75+ </label>
                      </div>
                      <div class="text-center">
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next Question <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I sleep ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sleep" value="5"> 7-9 hours a night <span id="_marks"> (5 marks) </span></label>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="sleep" value="3"> 6 or less hours a night <span id="_marks"> (3 marks) </span> </label>
                          <p class="appendedText">
                          Sleeping Paragraph.
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sleep" value="3"> More than 9 hours a night <span id="_marks"> (3 marks) </span> </label>
                          <p class="appendedText">
                          Sleeping Paragraph.
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sleep" value="1"> I wake up every few hours <span id="_marks"> (1 marks) </span>  </label>
                          <p class="appendedText">
                          Sleeping Paragraph.
                          </p>
                        
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I most often find myself sipping on ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sipping" value="2"> Soda/pop  <span id="_marks"> (2 marks) </span></label>
                          <p class="appendedText">
                          caffeine Paragraph.
                          </p>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="sipping" value="2"> Coffee   <span id="_marks"> (2 marks) </span> </label>
                          <p class="appendedText">
                          Caffeine Paragraph.
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sipping" value="5"> Water  <span id="_marks"> (5 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sipping" value="2"> Juice   <span id="_marks"> (2 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="sipping" value="2"> I don’t drink many liquids <span id="_marks"> (2 marks) </span></label>
                     
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I am motivated to hit my goals and learn new things ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="motivated" value="5"> Most of the time <span id="_marks"> (5 marks) </span> </label>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="motivated" value="4"> Often   <span id="_marks"> (4 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="motivated" value="3"> Sometimes <span id="_marks"> (3 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="motivated" value="2">Rarely  <span id="_marks"> (2 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="motivated" value="1"> Almost Neve<span id="_marks"> (1 marks) </span> </label>
                        
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>In terms of my diet ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="diet" value="3"> I count calories vigilantly  <span id="_marks"> (3 marks) </span> </label>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="diet" value="5"> I avoid excess fats and carbs   <span id="_marks"> (5 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="diet" value="5"> I follow nutritional guidelines whenever possible  <span id="_marks"> (5 marks) </span> </label>
                          <p class="appendedText">
                          Working with a dietitian could maximize the benefits you get from your food. <a href=""> Check out the ones near you. </a>
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="diet" value="1"> I eat junk food almost every day <span id="_marks"> (1 marks) </span> </label>
                          <p class="appendedText">
                          Working with a dietitian could maximize the benefits you get from your food. <a href=""> Check out the ones near you. </a>
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="diet" value="2"> I miss meals often <span id="_marks"> (2 marks) </span> </label>
                          <p class="appendedText">
                          Working with a dietitian could maximize the benefits you get from your food. <a href=""> Check out the ones near you. </a>
                          </p>
            
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I exercise ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="exercise" value="5"> Everyday   <span id="_marks"> (5 marks) </span></label>
                          <p class="appendedText">
                         Did you know that personal trainers are licensed to work with all sorts? <a href=""> Finding a personal trainer </a> could help you achieve your goals, whether that be forming a good habit, working with an injury, or just wanting to feel better
                          </p>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="exercise" value="4"> 3 times a week   <span id="_marks"> (4 marks) </span></label>
                          <p class="appendedText">
                         Did you know that personal trainers are licensed to work with all sorts? <a href=""> Finding a personal trainer </a> could help you achieve your goals, whether that be forming a good habit, working with an injury, or just wanting to feel better
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="exercise" value="3"> Once a week <span id="_marks"> (3 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="exercise" value="2"> When I can remember   <span id="_marks"> (2 marks) </span></label>
                          <p class="appendedText">
                         Did you know that personal trainers are licensed to work with all sorts? <a href=""> Finding a personal trainer </a> could help you achieve your goals, whether that be forming a good habit, working with an injury, or just wanting to feel better
                          </p>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="exercise" value="1"> I don’t remember the last time I exercised  <span id="_marks"> (1 marks) </span></label>
                
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>When was the last time you went for a check-up?</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="checkup" value="5"> I see my doctors regularly  <span id="_marks"> (5 marks) </span></label>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="checkup" value="2"> Around once every 5 years  <span id="_marks"> (2 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="checkup" value="4"> I go when they call me to remind me <span id="_marks"> (4 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="checkup" value="1"> I hate going to the doctors and avoid it whenever possible  <span id="_marks"> (1 marks) </span></label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="checkup" value="0"> I do not have a family doctor.  <span id="_marks"> (0 marks) </span></label>
                          <p class="appendedText">
                          Finding a family doctor can be difficult, especially given the current situation. Here is a list of <a href="">family doctors accepting new patients </a> near you. Alternatively, if you prefer on-the-go virtual care, here are <a href=""> physicians who are taking online consultations</a>.
                          </p>
   
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>For my health, I prefer natural remedies to medication ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="health" value=""> Most of the time </label>
                          <p class="appendedText">
                          Navigating natural remedies can be challenging given all the information that’s available on the internet. You may consider <a href=""> finding a naturopath </a> to help avoid unnecessary supplements or herbals.
                          </p>
                        <label class="btn btn-primary active">
                          <input type="radio" name="health" value=""> Often  </label>
                          <p class="appendedText">
                         Navigating natural remedies can be challenging given all the information that’s available on the internet. You may consider <a href=""> finding a naturopath </a> to help avoid unnecessary supplements or herbals.
                          </p>
                        <label class="btn btn-primary">
                          <input type="radio" name="health" value="">Sometimes </label>
                          <p class="appendedText">
                         Navigating natural remedies can be challenging given all the information that’s available on the internet. You may consider <a href=""> finding a naturopath </a> to help avoid unnecessary supplements or herbals.
                          </p>
                        <label class="btn btn-primary">
                          <input type="radio" name="health" value=""> Rarely  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="health"> Almost never </label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
              <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>In terms of my sexual life, I am ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="sexual" value=""> Completely satisfied </label>
                        <label class="btn btn-primary active">
                          <input type="radio" name="sexual" value=""> Mostly satisfied  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="sexual" value=""> Mostly unsatisfied  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="sexual" value=""> Completely unsatisfied   </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="sexual"> Currently not sexually active </label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I have a job that can be hazardous (ie. Stressful, dangerous, or hard on your body)</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="job" value=""> Completely true  </label>
                        <label class="btn btn-primary active">
                          <input type="radio" name="job" value=""> Mostly true  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="job" value=""> Somewhat true or false</label>
                        <label class="btn btn-primary">
                          <input type="radio" name="job" value=""> Mostly false  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="job"> Completely False  </label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>Check all that apply ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="checkbox" id="smoking" name="drugs" value=""> I smoke cigarettes </label>
                          <p class="appendedText">
                          Alcohol Paragraph.
                          </p>
                        <label class="btn btn-primary active">
                          <input type="checkbox" name="drugs" value=""> I have more than 1-2 alcoholic drinks a day  </label>
                          <p class="appendedText">
                          Quitting smoking is hard, but not impossible. If you’re looking for an effective way to quit smoking and protect your lungs, you may run into all sorts of advice. A great place to start might be <a href="">a psychologist</a> . Studies have shown that smoking is comprised of both a physical dependency and mental dependency1. The physical dependency can be overcome with nicotine replacement products but the mental dependency is much more difficult to conquer and explains why smokers relapse even after all traces of nicotine has disappeared from the body. You can also check to see if there are any <a href=""> local clinics near you that offer smoking cessation programs </a>.
                          </p>
                        <label class="btn btn-primary">
                          <input type="checkbox" id="smoking" name="drugs" value=""> I smoke marijuana </label>
                          <p class="appendedText">
                          Quitting smoking is hard, but not impossible. If you’re looking for an effective way to quit smoking and protect your lungs, you may run into all sorts of advice. A great place to start might be <a href="">a psychologist</a> . Studies have shown that smoking is comprised of both a physical dependency and mental dependency1. The physical dependency can be overcome with nicotine replacement products but the mental dependency is much more difficult to conquer and explains why smokers relapse even after all traces of nicotine has disappeared from the body. You can also check to see if there are any <a href=""> local clinics near you that offer smoking cessation programs </a>.
                          </p>
                        <label class="btn btn-primary">
                          <input type="checkbox" name="drugs" value=""> I do other recreational drugs more than once a month  </label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>I am happy in my relationship ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="relationship" value=""> I am single and happy </label>
                        <label class="btn btn-primary active">
                          <input type="radio" name="relationship" value=""> I am single and unhappy  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="relationship" value="">I am in a committed relationship and happy</label>
                        <label class="btn btn-primary">
                          <input type="radio" name="relationship" value=""> I am in a committed relationship and unhappy  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="relationship"> I am unsure </label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>When I am stressed ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="stressed" value="5"> I know how to de-stress and manage my stress well <span id="_marks"> (5 marks) </span> </label>
                        <label class="btn btn-primary active">
                          <input class="countAppear" type="radio" name="stressed" value="3"> I am never stressed <span id="_marks"> (3 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="stressed" value="1"> I let my stress overwhelm me <span id="_marks"> (1 marks) </span> </label>
                        <label class="btn btn-primary">
                          <input class="countAppear" type="radio" name="stressed" value="4"> I reach out to others to help me de-stress  <span id="_marks"> (4 marks) </span> </label>
                        
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Next &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper">
                  <div class="_card-title">
                    <h1>My mood is ...</h1>
                  </div>
                  <div class="_card-body">
                    <div class="mx-440">
                      <div class="btn-group btn-group-toggle mb-5 mt-3" data-toggle="buttons">
                        <label class="btn btn-primary">
                          <input type="radio" name="mood" value=""> Often down in the dumps </label>
                        <label class="btn btn-primary active">
                          <input type="radio" name="mood" value=""> Changes easily and difficult to control  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="mood" value=""> Mostly bright and positive </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="mood" value=""> I don’t know  </label>
                        <label class="btn btn-primary">
                          <input type="radio" name="mood"> Stable and something I don’t worry about</label>
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Prev </button>
                        <button type="button" class="btn _theme-btn" id="_viewNext">Results &nbsp;&nbsp; <i class="fa fa-angle-right"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                  <div class="_card-wrapper resultWrapper">
                 
                  <div class="_card-body m-4">
                    
                        <p>
                          We are constantly bombarded with choices each day, but how do we know which ones lead to a healthier life? Between experts who sometimes give conflicting information and gurus who start trends, ultimately, we must decide what is right for us. The stressors of life push and pull us towards choices that can influence our health either positively or negatively. Overtime, our choices form our habits, which form our lifestyles.<br><br> Whether you’re trying to tweak a couple things here and there, or trying to turn your life around 180 degrees, a healthy lifestyle starts with the courage to make a choice. And if you are here, you’ve made the right one! 
                        </p>
                        <img src="<?php echo get_template_directory_uri() . "/images/woman-doing-yoga-in-pink.jpg"?>" alt="">
                        <h2 id="textBasedOnScore">
                        
                        </h2>
                        <div class="text-center">
                        <button type="button" class="btn _theme-btn" id="_viewPrev"><i class="fa fa-angle-left"></i> &nbsp;&nbsp; Go Back</button>
                        
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container End -->

<?php get_footer();
