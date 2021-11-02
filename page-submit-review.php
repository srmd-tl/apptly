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

//Insert Review into db
if(!empty($_POST["submit"])&&$_POST["submit"])
{
    /*Profanity filter here*/
    $comment=profanityFilter($_POST["comment"]);
    $query=[
      "review_by"=>$_POST["review_by"],
      "rating"=>$_POST["rating"],
      "comment"=>$comment,
      "user_id"=>$_POST["userId"],
    ];
      //save file and get file path
    if(($_FILES["attachement"]["name"]))
    {
      $path=uploadFile();
      $query["attachement"]=$path;

    }
    else
    {
        //if there is no attachment then admin dont need to verify the review
        $query["status"]=1;

    }
    $table= "wp_doctors_reviews";
   
    $reviewObject=$GLOBALS['wpdb']->insert($table, $query);
    $review = $reviewObject->id;
    if(wp_get_environment_type()=="local")
    {
        header('Location: http://wp.com');
    }
    else
    {
        header('Location: http://www.apptly.ca/');
    }
    exit();
    try
    {
      // sendMail($_POST["userEmail"]);
    }
    catch(Exception $e)
    {
      die("error");
    }
    
    
}

//function insert file
function uploadFile()
{
  $fileTmpPath = $_FILES['attachement']['tmp_name'];
  $fileName = $_FILES['attachement']['name'];
  $fileSize = $_FILES['attachement']['size'];
  $fileType = $_FILES['attachement']['type'];
  $fileNameCmps = explode(".", $fileName);
  $fileExtension = strtolower(end($fileNameCmps));

  $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

  // $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
  // if (in_array($fileExtension, $allowedfileExtensions)) {
  // }
 
  $uploadFileDir = trailingslashit( plugin_dir_path( dirname( __FILE__ ) ) ) . 'images/';
  wp_mkdir_p( $uploads_dir );

  // directory in which the uploaded file will be moved
  $destination = $uploadFileDir . $newFileName;
  
  if(move_uploaded_file($fileTmpPath, $destination))
  {
    $message ='File is successfully uploaded.';
  }
  else
  {
    $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
  }
  return 'images/'.$newFileName;
}
//send mail 
function sendMail(string $doctorEmail)
{
  // the message
  $msg = "First line of text\nSecond line of text";

  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);

  // send email
  mail($doctorEmail,"My subject",$msg);
}
get_header(); ?>

<?php
if(!empty($_POST["doctor-id"]) || !empty($_POST["doctor-email"]) )
{
?>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="userId" value="<?=$_POST["doctor-id"]?>">
<input type="hidden" name="userEmail" value="<?=$_POST["doctor-email"]?>">

<div id="_submit_review">
   <div class="container">
   <div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="box_general_3 write_review">
						<h1>Write a review for 
              <?php
                $author_obj = get_user_by('id', $_POST["doctor-id"]);
                // print_r($author_obj);
                echo $author_obj->first_name . ' ' . $author_obj->last_name;
              ?>
            
            </h1>
						<div class="rating_submit">
							<div class="form-group">
							<label class="d-block">Overall rating</label>
							<span class="rating">
								<input required type="radio" class="rating-input" id="5_star" name="rating" value="5"><label for="5_star" class="rating-star"></label>
								<input required type="radio" class="rating-input" id="4_star" name="rating" value="4"><label for="4_star" class="rating-star"></label>
								<input required type="radio" class="rating-input" id="3_star" name="rating" value="3"><label for="3_star" class="rating-star"></label>
								<input required type="radio" class="rating-input" id="2_star" name="rating" value="2"><label for="2_star" class="rating-star"></label>
								<input required type="radio" class="rating-input" id="1_star" name="rating" value="1r"><label for="1_star" class="rating-star"></label>
							</span>
							</div>
						</div>
						<!-- /rating_submit -->
						<div class="form-group">
							<label>Your name</label>
							<input class="form-control" type="text" placeholder="John Doe" name="review_by" required>
						</div>
						<div class="form-group">
							<label>Your review</label>
							<textarea class="form-control" style="height: 180px;" placeholder="Write your review here ..." name="comment"></textarea>
						</div>
						<div class="form-group">
							<label>Add your Invoice (optional)<br> Adding an invoice lets us verify your review and push it to the top for others to see</label>
							<div class="fileupload"><input type="file" name="attachement" accept="image/*"></div>
						</div>
						<hr>

						<button type="submit" class="btn_1" name="submit" value="1">Submit review</button>
					</div>
				</div>
			</div>
    </div>
</div>
</form>
    <?php
}
else
{
    printf("<p >%s</p>", "Can't find any doctor");
}
    ?>
<!-- Container End -->

<?php get_footer();
