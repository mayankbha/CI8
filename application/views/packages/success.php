<!-- Page Content -->
<style>
	.message{
		text-align: center;
		font-size: 18px;
		padding-top: 100px;
		color: green;
		font-family: airal;
	}
</style>
<div class="container-fluid p-0 bg-green">
  <div class="container row-first">
    <div class="inner-main">
      <div class="inner-sec">
        <div class="row" style="min-height:350px;">           
			<div class='message'>Thank You. Your order status is SUCCESS .</div><br>
			<div class='message'>Your Transaction ID for this transaction is  <?php echo $transaction_id ?>.</div>
        </div>
		<div class="row"> 
			<div style="float:right;"><a href="<?php echo base_url('student/account'); ?>">Account Section.</a></div>
		</div>
      </div>
    </div>
  </div>
</div>