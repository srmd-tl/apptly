<?php
/*
 * The template for displaying archive pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

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
		$elsey_content_top_spacings = ($elsey_content_top_spacings) ? 'padding-top:'. elsey_check_px($elsey_content_top_spacings) .' !important;' : '';
		$elsey_content_btm_spacings = ($elsey_content_btm_spacings) ? 'padding-bottom:'. elsey_check_px($elsey_content_btm_spacings) .' !important;' : '';
		$elsey_custom_padding = $elsey_content_top_spacings . $elsey_content_btm_spacings;
  } else {
		$elsey_custom_padding = '';
  }
} else {
  $elsey_custom_padding = '';
}

// Theme Options
$elsey_blog_page_layout      = cs_get_option('blog_page_layout');
$elsey_blog_listing_style    = cs_get_option('blog_listing_style');
$elsey_blog_listing_columns  = cs_get_option('blog_listing_columns');
$elsey_blog_sidebar_position = cs_get_option('blog_sidebar_position');

// Page Layout
if ($elsey_blog_page_layout === 'full-width') {
  $elsey_parent_class = 'els-full-width';
  $elsey_layout_class = 'container';
} else {
  $elsey_parent_class = 'els-less-width';
  $elsey_layout_class = 'container els-reduced';
}

// Sidebar Position
if ($elsey_blog_sidebar_position === 'sidebar-hide') {
  $elsey_column_class     = 'col-lg-12 col-md-12 col-sm-12 col-12 els-no-sidebar';
  $elsey_sidebar_position = 'sidebar-hide';
} elseif ($elsey_blog_sidebar_position === 'sidebar-left') {
  $elsey_column_class     = 'col-lg-9 col-md-9 col-sm-12 col-12 els-has-sidebar els-has-left-col';
  $elsey_sidebar_position = 'sidebar-left';
} else {
  $elsey_column_class     = 'col-lg-9 col-md-9 col-sm-12 col-12 els-has-sidebar els-has-right-col';
  $elsey_sidebar_position = 'sidebar-right';
}

// Blog Style
if ($elsey_blog_listing_style === 'els-blog-masonry') {
  $elsey_blog_listing_style_class = 'els-blog-masonry';
  $elsey_blog_masonry_grid_class  = 'els-blog-masonry-wrap';
  $elsey_blog_masonry_item_class  = 'els-blog-masonry-item';
} else {
  $elsey_blog_listing_style_class = 'els-blog-standard';
  $elsey_blog_masonry_grid_class  = '';
  $elsey_blog_masonry_item_class  = '';
}

// Column Style
if($elsey_blog_listing_columns === 'els-blog-col-2') {
  $elsey_blog_grid_number  = 2;
  $elsey_blog_column_class = 'col-lg-6 col-md-6 col-sm-6 col-12';
} else if($elsey_blog_listing_columns === 'els-blog-col-3') {
  $elsey_blog_grid_number  = 3;
  $elsey_blog_column_class = 'col-lg-4 col-md-4 col-sm-6 col-12';
} else {
  $elsey_blog_grid_number  = 1;
  $elsey_blog_column_class = 'col-lg-12 col-md-12 col-sm-12 col-12';
}

get_header(); 

$author = get_user_by( 'slug', get_query_var( 'author_name' ) );

$table= "wp_doctors_reviews";
$reviews= $GLOBALS["wpdb"]->get_results("SELECT * FROM {$table} where `user_id` = {$author->ID} AND `status` = 1 Order By id desc");

?>

<!-- Container Start -->
<div id="_singleDoctor">
   <div class="container">
      <div class="row">
         <aside class="col-xl-4 col-lg-4" id="sidebar">
            <div class="theiaStickySidebar">
               <div class="box_profile">
                  <figure>
                     <?php
                                 $image;
                                 if(nl2br(get_the_author_meta('user_registration_profile_pic_url' , $author->ID)))
                                 {
                                    $image = nl2br(get_the_author_meta('user_registration_profile_pic_url' , $author->ID));
                                 }
                                 else
                                 {
                                    $image = get_site_url() . "/wp-content/uploads/2021/05/360_F_346936114_RaxE6OQogebgAWTalE1myseY1Hbb5qPM.jpg";
                                 }
                                ?>
                     <img src="<?php echo $image; ?>" alt="" class="img-fluid">
                  </figure>
                  <small><?php echo nl2br(get_the_author_meta('user_registration_speciality' , $author->ID)); ?></small>
                  <h1><?php
                     echo $author->first_name . ' ' . $author->last_name;
                     if(get_the_author_meta('user_registration_verified_member' , $author->ID) == "No")
                     {
                        ?>
                           <img src="<?php echo get_template_directory_uri() . "/images/unverified.png"?>" alt="" width="70">
                        <?php
                     }
                     else
                     {
                        ?>
                         <img src="<?php echo get_template_directory_uri() . "/images/verified.png"?>" alt="" width="70">
                        <?php
                     }
                  
                  ?></h1>
                  <span class="rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <small>(<small class="totalRating"><?php echo round(totalReviews($author->ID)->averageRating, 2);?></small>)</small>
                 
                  </span>
				   <div class="text-center">
                     <p class="text-center mb-0">
						 <?php
                         
							 if(get_the_author_meta('user_registration_verified_member' , $author->ID) == "No")
							 	{
						     ?>
						 	  <button id="confirmUnverified" class="btn_1 medium" data-verify="no">BOOK NOW</button> 
						 <?php
							 }
                             else if(!getLoggedInUserActiveSubscriptions())
                             {
                                 ?>
                                 <button id="confirmUnverified" class="btn_1 medium" data-subscription="no">BOOK NOW</button>
                                 <?php
                                  
                             }
						 else{
							 ?>
                      <form action="<?php echo get_home_url();?>/book-a-doctor/" method="post">
                        <input type="text" name="doctor-id" hidden value="<?php echo $author->ID?>">
                        <input type="text" name="doctor-email" hidden value="<?php echo $author->user_email?>">
                        <button type="submit" class="btn_1 medium">BOOK NOW</button>
                      </form>
							  <!-- <a href="<?php echo get_home_url();?>/book-a-doctor/?doctor-id=<?php echo $author->ID?>&doctor-email=<?php echo $author->user_email;?>" class="btn_1 medium">BOOK NOW</a> -->
							 <?php
							 }
						 ?>
						
					  </p>
					   
                  </div>
                  
                  <ul class="contacts">
                     <li>
                        <h6>Address</h6>
                      <p id="addressDivision"> <?=get_the_author_meta('user_registration_location' , $author->ID);?> </p>
                        <iframe 
                           width="300" 
                           height="170" 
                           frameborder="0" 
                           scrolling="no" 
                           marginheight="0" 
                           marginwidth="0" 
                           src="https://maps.google.com/maps?q=<?php echo nl2br(get_the_author_meta('user_registration_Latitude' , $author->ID)); ?>, <?php echo nl2br(get_the_author_meta('user_registration_Longitude' , $author->ID)); ?>&t=&z=15&ie=UTF8&iwloc=&output=embed"
                           >
                           </iframe>
                     </li>
                     <li>
                        <h6>Phone</h6>
                        
                        <a href="tel:<?php echo nl2br(get_the_author_meta('user_registration_phone_number' , $author->ID)); ?>"><?php echo nl2br(get_the_author_meta('user_registration_phone_number' , $author->ID)); ?></a>
                     </li>
                  </ul>
                  
               </div>
              
            </div>
         </aside>
         <!-- /asdide -->
         <div class="col-xl-8 col-lg-8">
			 
			 
			 
			     <div class="box_general_3">
                     <div class="indent_title_in">
                        <i class="pe-7s-user"></i>
                        <h3>Professional statement</h3>
                        
                     </div>
                     <div class="wrapper_indent">
                        <p>
                           <?php echo nl2br(get_the_author_meta('user_registration_textarea_1614152627' , $author->ID)); ?>
                        </p>
                        
                        <!-- /row-->
                     </div>
                     <!-- /wrapper indent -->
                     <hr>
                     <div class="indent_title_in">
                        <i class="pe-7s-news-paper"></i>
                        <h3>Offering Services:</h3>
                       
                     </div>
                     <div class="wrapper_indent">
                        <ul class="list_edu">
                        <?php
                           $str = get_the_author_meta('user_registration_services_offered' , $author->ID);
                           $newString = explode(",",$str);
                        ?>

                        <?php
                           foreach($newString as $single)
                           {
                        ?>
                            <li>
                              <strong>
                                 <?php echo $single; ?>.
                              </strong>
                           </li>
                        <?php
                           }
                        ?>
                          
                           
                        </ul>
                     </div>

                     <!--  End wrapper_indent -->
                  </div>
			      <div class="box_general_3" id="reviews">
                     <div class="reviews-container">
                        <div class="row">
                           <div class="col-lg-12">
                              <div id="review_summary">
                                 <strong><?php echo round(totalReviews($author->ID)->averageRating, 2);?></strong><br>
                                 <div class="rating">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><small class="totalRating d-none"><?php echo round(totalReviews($author->ID)->averageRating, 2);?></small>
                                 </div>
                                 <small>Based on <?php echo totalReviews($author->ID)->totalReviews;?> reviews</small>
                              </div>
                           </div>
                           
                        </div>
                        <!-- /row -->
                        <hr>
                        <div class="parentReviews">
                           <?php

                              
                           
                              foreach($reviews as $review)
                              {
                                 ?>

                                    <!-- /review-box -->
                                    <div class="review-box clearfix <?php if(!empty($review->attachement)){}else{echo "empty";}?>">
                                       <div class="rev-content">
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
                                                <?php if(!empty($review->attachement))
                                             {
                                             ?>
                                             <img data-toggle="tooltip" data-placement="top" title="Verified Review" src="<?php echo get_template_directory_uri() . "/images/check.png"?>" alt="" style="width: 17px;margin-left: 10px;">
                                                <?php
                                             } ?>
                                          </div>
                                          <div class="rev-info">
                                          <?=$review->review_by?> – <?=$review->created_at?>
                                          </div>
                                          <div class="rev-text">
                                             <p>
                                             <?=$review->comment?>
                                             
                                             </p>

                                          </div>
                                          
                                          <?php if(!empty($review->attachement))
                                             {


                                             ?>
                                             <div class="rev-image">
                                                <a href="<?= get_theme_root_uri() . "/".$review->attachement?>" target="_blank">
                                                <img src="<?= get_theme_root_uri() . "/".$review->attachement?>">
                                                </a>
                                                
                                                </div>
                                                <?php
                                             } ?>
                                          
                                       </div>
                                    </div>
                                    <!-- End review-box -->
                                 <?php

                              }
                           ?>
                        </div>
                     </div>
                     <!-- End review-container -->
                     <hr>
                     <div class="text-right">

                     <form action="<?php echo get_home_url();?>/submit-review/" method="post">
                        <input type="text" name="doctor-id" hidden value="<?php echo $author->ID?>">
                        <input type="text" name="doctor-email" hidden value="<?php echo $author->user_email?>">
                        <button type="submit" class="btn_1 add_bottom_15">Write a review</button>
                      </form>
                        <!-- <a href="<?php echo get_home_url();?>/submit-review/?doctor-id=<?php echo $author->ID?>&doctor-email=<?php echo $author->user_email;?>" class="btn_1 add_bottom_15">Write a review</a> -->
                     </div>
                  </div>
					
            <!-- /tabs_styled -->
         </div>
         <!-- /col -->
      </div>
   </div>
</div>
<!-- Container End -->
<div id="getUnverified" class="modalCustom">

  <!-- Modal content -->
  <div class="modal-contentCustom">

    <div class="modal-bodyCustom">
		<span class="closeModal">&times;</span>
      <h5>Sorry!</h5>
      <p>This doctor is currently not accepting patients through Apply at the moment</p>
		<div class="d-flex align-items-center justify-content-between">
<!-- 			<a href="/find-doctors/" class="medium text-primary text-decoration-underline">Search for Verified Doctors?</a> -->
<!-- 			<a href="<?php echo get_home_url();?>/book-a-doctor/?doctor-id=<?php echo $author->ID?>&doctor-email=<?php echo $author->user_email;?>" class="btn_1 medium">Proceed Anyway</a> -->
<!-- 			<a class="closeModal btn_1 medium text-light">Go Back</a>  -->
		</div>	
    </div>

  </div>

</div>
<?php get_footer();
?>
