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

get_header(); ?>

<div class="els-container-wrap els-less-width els-padding-none">
  <div class="container">
    <div class="row">
      <div class="col">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-allLeads-tab" data-toggle="pill" href="#pills-allLeads" role="tab" aria-controls="pills-allLeads" aria-selected="true">All Leads</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-thisMonth-tab" data-toggle="pill" href="#pills-thisMonth" role="tab" aria-controls="pills-thisMonth" aria-selected="false">This Month Leads</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-allLeads" role="tabpanel" aria-labelledby="pills-allLeads-tab">
            
          <table id="myTable">
                   <thead>
                        <tr>
                           
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>   
                            <th>Phone Number</th>   
                            <th>Date</th>
                        </tr>
                   </thead>
                   <tbody>   
                     <?php 
                    //  print_r(allLeads());
                     $allLeads = allLeads();
                      foreach($allLeads as $singleLead)
                      {
                        ?>
                          <tr>
                            <td><?php echo $singleLead->customer_firstname?></td>
                            <td><?php echo $singleLead->customer_lastname?></td>
                            <td><?php echo $singleLead->customer_email?></td>
                            <td><?php echo $singleLead->customer_phone?></td>
                            <td><?php echo $singleLead->created_at?></td>
                          </tr>
                        <?php
                      }
                     ?>      
                     
                        
                  </tbody>
                </table>
          </div>
          <div class="tab-pane fade" id="pills-thisMonth" role="tabpanel" aria-labelledby="pills-thisMonth-tab">

          <table id="myTable">
                   <thead>
                        <tr>
                           
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>   
                            <th>Phone Number</th>   
                            <th>Date</th>
                        </tr>
                   </thead>
                   <tbody>   
                     <?php 
                    //  print_r(allLeads());
                     $thisMonthLeads = currentMonthLeads();
                      foreach($thisMonthLeads as $singleLead)
                      {
                        ?>
                          <tr>
                            <td><?php echo $singleLead->customer_firstname?></td>
                            <td><?php echo $singleLead->customer_lastname?></td>
                            <td><?php echo $singleLead->customer_email?></td>
                            <td><?php echo $singleLead->customer_phone?></td>
                            <td><?php echo $singleLead->created_at?></td>
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
<?php

// currentMonthLeads();
// echo totalBill();
// echo totalNumberOfLeads();


?>
<!-- Container End -->

<?php get_footer();
