<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Metabox
global $post;
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

$reviews = listReviews();
//list all reviews
function listReviews()
{
    $table= "wp_doctors_reviews";
    $currentUserId = get_current_user_id();
    $reviews= $GLOBALS["wpdb"]->get_results("SELECT * FROM {$table} where `user_id` = {$currentUserId}"); 
    return $reviews;
}



get_header(); ?>


<div class="els-container-wrap els-less-width els-padding-none">
  <div class="container">
    <div class="row">
      <div class="col">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">All Reviews</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

          <div class="tab-pane fade show active"  id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">

          <table id="myTable">
                   <thead>
                        <tr>
                        <th>Attachement</th>   
                            <th>Name</th>
                            <th>Comment</th>
                            
                            <th>Rating</th>   
                            <th>Date</th>
                        </tr>
                   </thead>
                   <tbody>   
                    <?php
                    foreach($reviews as $review)
                    {
                        ?>
                         <tr>
                         <td>
                           <img src="<?= get_theme_root_uri() .'/'. $review->attachement?>" alt="">
                         </td>
                            <td><?=$review->review_by?></td>
                            <td><?=$review->comment?></td>
                            
                            <td>
                              <div class="rating">
                            <?php
                                          if($review->rating == 1)
                                          {
                                             ?>
                                                <i class="fa fa-star voted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                             <?php
                                          }
                                          else if($review->rating == 2)
                                          {
                                             ?>
                                                <i class="fa fa-star voted"></i>
                                                <i class="fa fa-star voted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                             <?php
                                          }
                                          else if($review->rating == 3)
                                          {
                                             ?>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                          <?php
                                          }
                                          else if($review->rating == 4)
                                          {
                                             ?>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star voted"></i>
                                             <i class="fa fa-star"></i>
                                          <?php
                                          }
                                          else
                                          {
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
                            <td><?=$review->created_at?>2</td>
                            

                          </tr>
                        <?php
                    }
                    ?>
                       
                  </tbody>
                </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Table -->

<?php get_footer();
