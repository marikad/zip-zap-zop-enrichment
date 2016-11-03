



  
<?php

   /**
 * Template Name: Donate
 *
 * @package WordPress
 * @subpackage Creativeforces
 * @since  Creativeforces Group 1.0
 */
 ?>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="/wp-content/themes/creativeforces/css/donate.css">
	<meta charset="utf-8">
	<title>Zip Zap Zop Enrichment | Donate</title>


 </head>


   <?php get_header(); ?>

   <h3>Support Our Students! Donations are Tax Deductable.</h3>
   <h3>Zip Zap Zop is a project of Social and Environmental Entrepreneurs (SEE), a registered 501(c)3.</h3>
   <div class="text-center">
   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5YM5WAXW9NE2E">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>









<!-- <div class="form-container">
<div class="donate-heading text-center">
  <h1>Support our Students!</h1>
</div>
<div class="form-content">
 
<form action="" method="POST" id="payment-form">
  <span class="payment-errors"></span>

  <div class="content-inner">
  <div class="row">
    <div class="form-group">
      <fieldset>
        <legend class="text-center">How much would you like to donate</legend>
        <div class="choose-pricing">
          <div class="btn-group">
          <div class="buttons">
            <button type="button" id="default" class="btn btn-default selectvalue hover-color active" value="50">50</button>
            <button type="button" id="btn2" class="btn btn-default selectvalue hover-color" value="100">100</button>
            <button type="button" id="btn3" class="btn btn-default selectvalue hover-color" value="150">150</button>
            <input type="Custom" name="donation-amount" class="inpt-first form-control" id="donation-amount" onclick="if(this.defaultValue == this.value) this.value = ''" onblur="if(this.value=='') this.value = this.defaultValue" value="Custom">
            </div>
            <input type="hidden" name="donation-amount-value" id="donation-amount-value">
          </div>
          <div class="money-donate">
            <div class="display-amount" id="display-amount">
            </div>
          </div>
        </div>
      </fieldset>
    </div>
  </div>
  <legend class="text-center">Enter your card details</legend>
  <div class="credit-card-num">
    <input type="text" name="cardNumber" id="creditCardNumber" style=" background-color: #f4f4f4;" onclick="if(this.defaultValue == this.value) this.value = ''" onblur="if(this.value=='') this.value = this.defaultValue" value="Enter yor 16 digit card number" data-stripe="number">
  </div>
  <div class="">
  <div class="date-wrapper">
    <div class="month">
      <span class="full">Month & Year of Expiry:</span>
      <select name="month" id="expMonth" class="selectBox chzn-done" data-stripe="exp-month">
        <option data-stripe="cvc">Select Month</option>
        <option value="1">1</option>
      </select>
      <div id="expMonth_chzn" class="chzn-container chzn-container-single">
        <a href="javascript:void(0)" class="chzn-single" tabindex="-1">
        </a>
      </div>
      <select name="year" id="expYear" class="selectBox chzn-done" data-stripe="exp-year">
        <option value="">Select Year</option>
        <option value="1">1</option>
      </select>
    </div>
    <div class="cvn">
    <span>Card Verification Number</span>
      <span class="full">
        <a href="#" class="tooltip">
          <img src="/wp-content/themes/creativeforces/images/question.png" alt="question">
        </a>
        <div class="tooltip-hover">
          <img src="" alt="">
        </div>
      </span>
      <input type="password" name="cardVeriNum" id="cardVeriNum">
    </div>
  </div>
  </div>
  <fieldset class="personal-detail">
    <legend class="text-center">Personal Details</legend>
    <div class="row">
      <div class="form-group">
        <input type="text" name="name" class="form-control" id="name" placeholder="First Name">
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
      </div>
    </div>
       <div class="row">
      <div class="form-group">
        <textarea name="notes" class="form-control" id="add-note" placeholder="Additional Notes"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="form-group button">
      <div class="text-center">
      <button id="donate-btn" value="Donate" class="btn btn-default">Donate</button>
        </div>
      </div>
    </div>
  </fieldset>
  </div>
</form>
</div>
  </div> -->


   <?php get_footer(); ?>

      <script src="/wp-content/themes/creativeforces/js/form.js"></script>