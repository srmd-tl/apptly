<?php
   if (is_user_logged_in() && !empty(get_option('fullstripe_options')['secretKey_test'])) {
   
       if (!empty($_POST['submit']) && !empty($_POST['subscriptionId'])) {
           $response = cancelSubscriptionFromStripe($_POST['subscriptionId']);
           $body = json_decode($response->body);
           if ($response->status_code == 200) {
               //Update subscription as cancelled
               updateSubscriptionFromDB($_POST['subscriptionId']);
   
           } else {
               echo $body->error->message;
           }
       }
       //setting here so that we may not experience headers issues
       get_header();
   
   
   
       ?>
<div class="els-container-wrap els-less-width els-padding-none">
   <div class="container">
      <div class="row">
         <div class="col">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="pills-thisMonth-tab" data-toggle="pill" href="#pills-thisMonth" role="tab" aria-controls="pills-thisMonth" aria-selected="false">Your Subscriptions</a>
               </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
               <div class="tab-pane fade show active"  id="pills-thisMonth" role="tabpanel" aria-labelledby="pills-thisMonth-tab">
                  <?php
                     $subscriptions = getLoggedInUserSubscriptions();
                         $addNewSubscriptionFlag = true;
                         if ($subscriptions) {
                             ?>
                             
                                <?php
                                 foreach ($subscriptions as $subscription) {
                                    if ($subscription->status == 'running') {
                                        $addNewSubscriptionFlag = false;
                                    }
                                }
                                     if ($addNewSubscriptionFlag) {
                                         ?>
                                         <div class="subsWrap">
                                            <svg width="60" height="60" viewBox="0 0 60 60" focusable="false" role="img" aria-hidden="true" class="Svg__Element-sc-1580yj3-0 efnMZB Icon"><path d="M44.7907 13.42C20.1696 16.2928 8.57706 42.9245 16.8908 51.0607" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="Arrow__Path-dcno05-0 hbwCnd"></path><path d="M39.3314 11.0299L46.2257 12.4164L41.809 19.3094" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="Arrow__Path-dcno05-0 hbwCnd"></path></svg>
                                            <a class="buySubs" id="confirmUnverified">Buy Subscription?</a>
                                            </div>
                                         <?php
                                        }
                                ?>
                               

                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                    <th>
                                        Subscriber
                                    </th>
                                    <th>
                                        Plan
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Created At
                                    </th>
                                    <th>
                                        Ends At
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subscriptions as $subscription) {
                                        if ($subscription->status == 'running') {
                                            $addNewSubscriptionFlag = false;
                                        }
                                        ?>
                                    <tr>
                                    <td>
                                        <?= $subscription->name; ?>
                                    </td>
                                    <td>
                                        <?= $subscription->planID; ?>
                                    </td>
                                    <td>
                                        <?php if($subscription->status == "cancelled")
                                            {
                                                ?>
                                        <span class="badgesStatus label-danger">
                                        <?= $subscription->status; ?>
                                        </span>
                                        <?php
                                            }
                                            else
                                            {   
                                                ?>
                                        <span class="badgesStatus label-success">
                                        <?= $subscription->status; ?>
                                        </span>
                                        <?php
                                            }
                                            ?>
                                    </td>
                                    <td>
                                        <?= $subscription->created; ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date1 = date('Y-m-d h:i:s', strtotime($subscription->created . ' + 1 month'));
                                            echo $date1;
                                            ?>
                                    </td>
                                    <td>
                                        <form method="POST" action="" class="mb-0">
                                            <input type="hidden" name="subscriptionId"
                                                value="<?= $subscription->stripeSubscriptionID; ?>">
                                            <?php
                                                if ($subscription->status == 'running') {
                                                    ?>
                                            <button type="button" id="modalCancel" class="redUnderline">
                                                Cancel?
                                            </button>

                                        <div id="cancelSubsModal" class="modalCustom ">
                                            <!-- Modal content -->
                                            <div class="modal-contentCustom">

                                                <div class="modal-bodyCustom">
                                                    <span class="closeModalSub">×</span>
                                                <h5 class='mb-3'>Are you sure you want to cancel?</h5>
                                                <ul>
                                                    <li class="fs-14">• Lorem Ipsum Dollar Smit</li>
                                                    <li class="fs-14">• Lorem Ipsum Dollar Smit</li>
                                                    <li class="fs-14">• Lorem Ipsum Dollar Smit</li>
                                                    <li class="fs-14">• Lorem Ipsum Dollar Smit</li>
                                                </ul>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                    <button name="submit" value="del" class="redUnderline withBg">
                                                        Cancel Anyway?
                                                        </button> 
                                                    </div>	
                                                </div>

                                            </div>
                                            </div>
                                            <?php
                                                } ?>
                                        </form>
                                        

                                
                                    </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>


                            


                  <?php

                     }
                     else
                     {
                         if ($addNewSubscriptionFlag) {
                                         ?>
                                         <div class="subsWrap">
                                            <svg width="60" height="60" viewBox="0 0 60 60" focusable="false" role="img" aria-hidden="true" class="Svg__Element-sc-1580yj3-0 efnMZB Icon"><path d="M44.7907 13.42C20.1696 16.2928 8.57706 42.9245 16.8908 51.0607" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="Arrow__Path-dcno05-0 hbwCnd"></path><path d="M39.3314 11.0299L46.2257 12.4164L41.809 19.3094" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="Arrow__Path-dcno05-0 hbwCnd"></path></svg>
                                            <a class="buySubs" id="confirmUnverified">Buy Subscription?</a>
                                            </div>
                                         <?php
                                        }
                     }
                     
                    
                     } else {
                     wp_redirect(get_bloginfo('wpurl') . '/my-account');
                     exit();
                     }
                     ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="getUnverified" class="modalCustom">

                            <!-- Modal content -->
                            <div class="modal-contentCustom">

                                <div class="modal-bodyCustom">
                                    <span class="closeModal">&times;</span>
                                    <h2 class="stripeHeading">
                                        Enter Your Credentials
                                    </h2>
                                <?php
                                     if ($addNewSubscriptionFlag) {
                                        $userService = get_user_meta(get_current_user_id(), 'user_registration_speciality');
                                        $userService = $userService ? strtolower(current($userService)) : null;
                                        if ($userService)
                                            echo do_shortcode("[fullstripe_form name={$userService} type='inline_subscription']");
                                    
                                    }
                                ?>
                                    <div class="d-flex align-items-center justify-content-between">
                            <!-- 			<a href="/find-doctors/" class="medium text-primary text-decoration-underline">Search for Verified Doctors?</a> -->
                            <!-- 			<a href="http://localhost/linkNbit/apptly/book-a-doctor/?doctor-id=81&doctor-email=Kamal@gmail.com" class="btn_1 medium">Proceed Anyway</a> -->
                            <!-- 			<a class="closeModal btn_1 medium text-light">Go Back</a>  -->
                                    </div>	
                                </div>

                            </div>

                            </div>

<?php
   get_footer();
   ?>