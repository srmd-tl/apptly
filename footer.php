<?php
/*
 * The template for displaying the footer.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

global $post;
$elsey_id    = ( isset( $post ) ) ? $post->ID : false;
$elsey_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $elsey_id;
$elsey_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $elsey_id;
$elsey_meta  = get_post_meta( $elsey_id, 'page_type_metabox', true );

if ($elsey_meta) {
  $elsey_hide_footer     = $elsey_meta['hide_footer'];
  $elsey_menubar_options = $elsey_meta['menubar_options'];

  if ($elsey_menubar_options === 'hide') {
    $elsey_menubar_rightmenu = false;
  } elseif ($elsey_menubar_options === 'custom') {
    $elsey_menubar_rightmenu = $elsey_meta['menubar_rightmenu'];
  } else {
    $elsey_menubar_rightmenu = cs_get_option('menubar_rightmenu');
  }
} else {
  $elsey_hide_footer  = false;
  $elsey_menubar_rightmenu  = cs_get_option('menubar_rightmenu');
}

$services = getServices();
$doctors =getAllDoctors();
?>

</div>
<!-- Content Background End -->

</div>
<!-- Wrapper End -->

<?php
$elsey_footer_widget  = cs_get_option('footer_widget_block');
$elsey_need_copyright = cs_get_option('need_copyright');

if (!$elsey_hide_footer) {
  if ($elsey_footer_widget || $elsey_need_copyright) { ?>
    <!-- Footer Start -->
    <footer class="els-footer">
      <?php if (isset($elsey_footer_widget)) {
        // Footer Widget Block
        get_template_part( 'layouts/footer/footer', 'widgets' );
      }
      if (isset($elsey_need_copyright)) {
        // Copyright Block
        get_template_part( 'layouts/footer/footer', 'copyright' );
      } ?>
    </footer>
    <!-- Footer End-->
<?php
  }
} ?>

</div><!-- Wrap End -->
<div id="termsNCondModal" class="modalCustom">

  <!-- Modal content -->
  <div class="modal-contentCustom">

    <div class="modal-bodyCustom">
		<span class="closeModal">×</span>
      <h5>Terms & Condition</h5>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		<div class="d-flex align-items-center justify-content-between">
		</div>	
    </div>

  </div>

</div>
<div class="cookiePrompt">
    <div class="container d-flex align-items-center justify-content-between">
        <p class="mb-0">
            This site uses cookies to offer you better experience. Find out more on <a href=""> Cookie Policy </a>
        </p>
        <div>
            <button class="" id="accepted">I accept Cookies</button>
            <button id="notAccepted">I refuse Cookies</button>
        </div>
    </div>
</div>
<?php
if ($elsey_menubar_rightmenu) {
  echo '<a href="javascript:void(0)" id="els-sidebar-menu-footer-close" class="els-sidebar-menu-footer-close"><i class="fa fa-times" aria-hidden="true"></i></a>';
}

if (function_exists('elsey_preloader_option')) { echo elsey_preloader_option(); } else { echo ''; }

wp_footer(); ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>

function updateUserName() {
let getFirstName = jQuery("#first_name").val();
let getLastName = jQuery("#last_name").val();
jQuery("#user_login").val(getFirstName + getLastName)
}
jQuery("#first_name, #last_name").on("input",function(){
    updateUserName();
});




    jQuery("#accepted").on("click",function(){
        localStorage.setItem("cookies_accepted",true);
        jQuery(".cookiePrompt").hide();
    });
    jQuery("#notAccepted").on("click",function(){
        localStorage.setItem("cookies_accepted",false);
        jQuery(".cookiePrompt").hide();
    });
    if(JSON.parse(localStorage.getItem("cookies_accepted")))
    {
        jQuery(".cookiePrompt").hide();
    }
    else
    {
        jQuery(".cookiePrompt").show();
    }
  jQuery('.js-source-states').select2({
          placeholder: "Select by Specialty/Services",
          allowClear: true
      });
  document.addEventListener( 'wpcf7mailsent', function( event ) {
    
   if(event.detail.contactFormId == "202")
   {
      setTimeout(function () {
        window.location.href = window.location.origin+"/my-account/";
      },2500)
   }
    let getDoctorID = event.detail.inputs[0].value;
    let getDoctorEmail = event.detail.inputs[1].value;
    let getUserFirstName = event.detail.inputs[2].value;
    let getUserLastName = event.detail.inputs[3].value;
    let getUserEmail = event.detail.inputs[4].value;
    let getUserPhone = event.detail.inputs[5].value;

    /* 
				=====================================================
						Send AJAX
				=====================================================
				*/
        jQuery.ajax({
					type: 'POST',
					url: "<?php echo admin_url('admin-ajax.php');?>",
					data: {
						action: 'conuslt_doctor',
						getDoctorID : getDoctorID,
            getDoctorEmail : getDoctorEmail,
            getUserFirstName : getUserFirstName,
            getUserLastName : getUserLastName,
            getUserEmail : getUserEmail,
            getUserPhone : getUserPhone
					
					},
					success: function (response) {
						window.location.href = window.location.origin;
						// if(response == 'ok')
						// {
						// 	$("#snackbar").text(`Flashcard successfully un hidden`)
						// 	showSnackBar();
						// }
						// else
						// {
						// 	alert('Flashcard is already un hidden.');
						// }
					}
				});
  }, false );

  jQuery("#services_offered").attr("disabled","disabled");
  if(jQuery("body").attr("data-user-verify") == "No" && jQuery("#user_registration_services_offered").length > 0)
  {
    jQuery("#user_registration_services_offered").attr("disabled","disabled");
  }



    jQuery('.totalRating').each(function () {
        let getThis = parseFloat(jQuery(this).html());
        let ratingStars = jQuery(this).closest(".rating");
        if (getThis >= 1 && getThis <= 1.25) {
            ratingStars.find(`i:nth-child(1)`).addClass('voted');
        }
        else if (getThis >= 1.26 && getThis <= 1.75) {
            ratingStars.find(`i:nth-child(1)`).addClass('voted');
            ratingStars.find(`i:nth-child(2)`).addClass('fa-star-half-o voted');
        }
        else if (getThis >= 1.76 && getThis <= 2.25) {
            ratingStars.find(`i:nth-child(2)`).addClass('voted');
            ratingStars.find(`i:nth-child(2)`).prevAll().addClass('voted')
        }
        else if (getThis >= 2.26 && getThis <= 2.75) {
            ratingStars.find(`i:nth-child(3)`).addClass('fa-star-half-o voted');
            ratingStars.find(`i:nth-child(3)`).prevAll().addClass('voted')
        }
        else if (getThis >= 2.76 && getThis <= 3.25) {
            ratingStars.find(`i:nth-child(3)`).addClass('voted');
            ratingStars.find(`i:nth-child(3)`).prevAll().addClass('voted')
        }
        else if (getThis >= 3.26 && getThis <= 3.75) {
            ratingStars.find(`i:nth-child(4)`).addClass('fa-star-half-o voted');
            ratingStars.find(`i:nth-child(4)`).prevAll().addClass('voted')
        }
        else if (getThis >= 3.76 && getThis <= 4.25) {
            ratingStars.find(`i:nth-child(4)`).addClass('voted');
            ratingStars.find(`i:nth-child(4)`).prevAll().addClass('voted')
        }
        else if (getThis >= 4.26 && getThis <= 4.75) {
            ratingStars.find(`i:nth-child(5)`).addClass('fa-star-half-o  voted');
            ratingStars.find(`i:nth-child(5)`).prevAll().addClass('voted')
        }
        else if (getThis >= 4.76) {
            ratingStars.find(`i:nth-child(5)`).addClass('voted');
            ratingStars.find(`i:nth-child(5)`).prevAll().addClass('voted')
        }
    });




var swiper = new Swiper('.swiper-container', {
  observer: true,
	observeParents: true, 
  allowTouchMove: false,
  calculateHeight:true,
  autoHeight: true,
  resizeObserver: true,
  observeSlideChildren : true,
  pagination: {
    el: '.swiper-pagination',
    type: 'progressbar',
  },

});
let countScore = 0;
jQuery("body").on("click", "[id*='_viewNext']", function () {
  swiper.slideNext(500);
  jQuery(window).scrollTop(jQuery(".quizStartedSlider").offset().top - 100);
  if(jQuery(this).closest("._card-wrapper").find(".countAppear").length > 0)
  {
    let getVal = jQuery(this).closest("._card-wrapper").find(".countAppear:checked").val();
    let parsingToInteger = parseInt(getVal == undefined ? 0 : getVal);
    console.log(parsingToInteger);
    countScore += parsingToInteger;
    jQuery("#_counterStart").html(countScore);
  }
	});
jQuery("body").on("click", "[id*='_viewPrev']", function () {
  swiper.slidePrev(500);
  jQuery(window).scrollTop(jQuery(".quizStartedSlider").offset().top - 100);
	});

  swiper.on("reachEnd", function (event) {
			
				if(countScore >= 8 && countScore <= 15)
        {
          jQuery("#textBasedOnScore").html('You’re taking the first steps towards a healthy lifestyle.');
        }
        else if(countScore > 15 && countScore <= 25)
        {
          jQuery("#textBasedOnScore").html('You are actively working towards a healthy lifestyle.');
        }
        else if(countScore > 25)
        {
          jQuery("#textBasedOnScore").html('You prioritize your health and it shows!');
        }
        else
        {
          jQuery("#textBasedOnScore").html('Your scores are too low to measure!!!');
        }


		});

    setInterval(() => {
      swiper.updateAutoHeight();	
    }, 100);

    jQuery('input[type="radio"], input[type="checkbox"]').on("change",function(){
      
      // swiper.updateSize();
      jQuery("p.appendedText").hide();
      
      if(jQuery(this).parent().next('p').length > 0)
      {
        jQuery(this).parent().next('p').show();
      }
    });



    // jQuery(document).ready(function() {
    //   jQuery(window).keydown(function(event){
    //     if(event.keyCode == 13) {
    //       event.preventDefault();
    //       return false;
    //     }
    //   });
    // });
</script>



<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxwFJpkZw8fyT5wDYYn8V-DBCdNkwpw54&libraries=places&ver=5.5.3" id="google-maps-js"></script>

<script type="text/javascript">
	jQuery(function () {
 jQuery('[data-toggle="tooltip"]').tooltip()
})
	if(jQuery("#location").length > 0)
	{
	  document.getElementById("location").addEventListener("keydown", function(e) {
			if (e.keyCode == 13) {

			/*If the ENTER key is pressed, prevent the form from being submitted,*/
			  if(jQuery(".pac-container.pac-logo")[0].style.display != 'none' || jQuery("#Longitude").val() == '')
				  {
					  e.preventDefault();
				  }


		  }
	  });
	}
	

	
	
	
    function initialize() {
        var input = document.getElementById('location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            // document.getElementById('city2').value = place.name;
            jQuery("#Longitude").val(place.geometry.location.lng());
            jQuery("#Latitude").val(place.geometry.location.lat());
            // console.log(place.geometry.location.lat());
            // console.log( place.geometry.location.lng());
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
    jQuery('[data-toggle="tooltip"]').tooltip();
	
	
	
	
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
		  
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
		  if(jQuery(".autocomplete-active").length > 0)
			  {
				    e.preventDefault();
			  }
        
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

	
	/*An array containing all the country names in the world:*/
var countries = ["Audiologist","Speech Language Pathologist","Chiropodist","Podiatrist","Chiropractor","Dental Hygienist","Dentist","Denturist","Dietitian","Homeopath","Massage Therapist","Family Doctor","Plastic Surgeon","Dermatologist","Midwife","Naturopathy","Nurse Practitioner","Occupational Therapy","Optician","Optometrist","Physiotherapist","Psychologist","Psychotherapist","Traditional Chinese Medicine and Acupuncture","Ophthalmologist","Personal Trainer","Yoga Instructor","Ayurveda practitioner"];

	
	<?php 
		if($services)
		{
			foreach($services as $services)
			{
		?>
		countries.push('<?=$services?>');							 

		<?php
			}
		}
		if($doctors)
		{
            foreach($doctors as $doctor)
            {
                    $userMeta=get_user_meta ( $doctor->ID);
                    $doctorFullName = ucfirst($userMeta["first_name"][0])." ".ucfirst($userMeta["last_name"][0]);
                    ?>
                if(!countries.includes("<?=$doctorFullName?>"))
                {
                    countries.push("<?=$doctorFullName?>");

                }

                <?php
                }
        }


	?>
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
	if(jQuery("#myInput").length > 0)
		{
			autocomplete(document.getElementById("myInput"), countries);
		}
if(jQuery(".search-query").length > 0)
   {
   autocomplete(document.getElementsByClassName("search-query")[0], countries);
   }


let genderAndVerification = () =>  {

  let genderVal = jQuery('[name="gender"]:checked').val();
  let verificationVal = jQuery('[name="verification"]:checked').val();

	if(genderVal == "male" && verificationVal == "all")
	{
    jQuery(".box-parent").hide();
    jQuery("div[id*='Male']").show();
	}
  else if(genderVal == "male" && verificationVal == "verified")
  {
    jQuery(".box-parent").hide();
    jQuery("div[id*='Male'].Yes").show();
  }
  else if(genderVal == "male" && verificationVal == "unverified")
  {
    jQuery(".box-parent").hide();
    jQuery("div[id*='Male'].No").show();
  }
  if(genderVal == "all" && verificationVal == "all")
	{
    jQuery(".box-parent").show();
	}
  else if(genderVal == "all" && verificationVal == "verified")
  {
    jQuery(".box-parent").hide();
    jQuery(".Yes").show();
  }
  else if(genderVal == "all" && verificationVal == "unverified")
  {
    jQuery(".box-parent").hide();
    jQuery(".No").show();
  }
  if(genderVal == "female" && verificationVal == "all")
	{
    jQuery(".box-parent").hide();
    jQuery("div[id*='Female']").show();
	}
  else if(genderVal == "female" && verificationVal == "verified")
  {
    jQuery(".box-parent").hide();
    jQuery("div[id*='Female'].Yes").show();
  }
  else if(genderVal == "female" && verificationVal == "unverified")
  {
    jQuery(".box-parent").hide();
    jQuery("div[id*='Female'].No").show();
  }
}


jQuery('[name="gender"]').on("change",function(){
  genderAndVerification();
});
	
jQuery('[name="verification"]').on("change",function(){
  genderAndVerification();
});
	



jQuery('body').on('click', "[id*='confirmUnveri']", function() {

  if(jQuery(this).data('verify')=='no')
  {
        jQuery("#getUnverified > div:nth-child(1) > div:nth-child(1) > p:nth-child(3)").text("The Book now functionality is not available for Unverified Doctors");
  }
  else if(jQuery(this).data('subscription')=='no')
  {
      jQuery("#getUnverified > div:nth-child(1) > div:nth-child(1) > p:nth-child(3)").text("Sorry, this doctor is not accepting appointment at the moment");

  }
  
  jQuery("#getUnverified").show();
});
jQuery('body').on('click', "[id*='modalCanc']", function() {
  jQuery(this).next().show();
});
jQuery(".closeModal").on("click",function(){
	jQuery(".modalCustom").hide();
});	
jQuery(".closeModalSub").on("click",function(){
	jQuery(this).closest("#cancelSubsModal").hide();
});	


	
jQuery("#termsNCond").on("click",function(){
	jQuery("#termsNCondModal").show();
});
	// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == jQuery("#getUnverified")[0] || event.target == jQuery("#termsNCondModal")[0] || event.target == jQuery("#cancelSubsModal")[0]) {
    jQuery(".modalCustom").hide();
  }
}

var url_string = window.location.href; //window.location.href
var url = new URL(url_string);
var speciality =  url.searchParams.get("speciality") != null ? url.searchParams.get("speciality").toLowerCase() : '';
	if(speciality == 'dentist')
		{
			jQuery("#cpsoNumber").hide();
      jQuery("#cpsoNumber input").val("No CPSO Number Because the speciality is dentist")
		}
	else
		{
			jQuery("#registrationNumber").hide();
      jQuery("#registrationNumber input").val("No registration Number Because the speciality is not dentist")
		}


    let getText = jQuery("#addressDivision").text();
    let getArray = getText.split(",")
    jQuery("#addressDivision").text("");
    getArray.forEach(function(i, val){

      val == (getArray.length - 1) ? jQuery("#addressDivision").append("<span>"+i+".</span>") : jQuery("#addressDivision").append("<span>"+i+",</span>");
      
    });
</script>


</body>
</html>