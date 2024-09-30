	
<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>

<?php 
$nature = '';
if ($txn->transactionType == "FCP") {
	$nature = 'Currency Purchase';
} elseif ($txn->transactionType == "FCS") {
	$nature = 'Currency Sell';
} elseif ($txn->transactionType == "FCR") {
	$nature = 'Currency Re-Exchange';
} elseif ($txn->transactionType == "FCI") {
	$nature = 'Currency Issuing';
} elseif ($txn->transactionType == "PFC") {
	$nature = 'Currency Withdrawal';
}



?>

<?php 
$totalcommision = $txn->commissionAmount + $txn->ceilingOrFloorCommission;
$customerTotal = $txn->totalToCustomer;
$totalLkrinc = $txn->totalLKR;
$totalLkrcom = $txn->totalLKR;
$totalcommision = $txn->commissionAmount + $txn->ceilingOrFloorCommission;
$refundedAmount = $txn->refundAmount;
$receivedAmount = $txn->receivedAmount;

$url = $this->config->item('base_url')."transaction/print/internationTxn?duplicate=Y&txnNo=".$txn->referenceNo;
?>

<script src="<?php echo $this->config->item('public_url')."ang/inc/".$dir."/ang-".$route.".js";?>"></script>

<div class="pg-frm-wrp" ng-controller="<?php echo $controller."Controller"; ?>">




	<div id="print_area" style="page-break-after: always;">
		<div id="purchaseForm" style="width: 900px; margin:auto; ">

		<img src="<?php echo $this->config->item('public_url');?>images/assets/boc_logo.png" class="img_logo"  style="width: 60px;margin: 0 auto;display: block;" alt="boc-logo">
		<div style="text-align:center;">
			<span><b>Pay Office - Bandaranayake International Airport</b></span><br/>
			<span>Telephone : Direct 0112252424 / Arrival Counter 0112264750 / Departure Counter 0112264751 / Email: payoffice@boc.lk </span><br/>
			<span>Pay Office Control Unit, Head Office 011 2541936  </span><br/>
			<span><?php echo $c_timestamp; ?></span><br/>
		</div>
		<br/>

		<strong>
		<div style="width:100%;overflow: hidden;border-width: 1px 1px 1px 1px !important; padding: 10px;">
			



			<?php if ($txn->status == "C" ) : ?>
			<span style="text-align: center;width: 20%;display: block;float: left;">CANCELLED</span>
			<?php elseif ($txn->status == "X" ) : ?>
			<span style="text-align: center;width: 20%;display: block;float: left;">PENDING CANCEL</span>
			<?php else : ?>
			<span style="text-align: center;width: 20%;display: block;float: left;">OFFICE COPY</span>
			<?php endif ?>
			<span style="text-align: center;width: 60%;display: block;float: left;"><?php echo $nature; ?></span>
			<span style="width: 20%;display: block;float: left;">User : <?php echo $txn->user; ?></span>
		</div>
		</strong>



		
		<div style="width:100%;overflow: hidden;border-width: 0px 1px 1px 1px !important;">

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Reference Number  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->referenceNo; ?></div>
			</div>

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Customer Name  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->cusname; ?></div>
			</div>


			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>NIC/ Passport/ Company Reg. No.</strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->uinnumber; ?></div>
			</div>
			<?php if ($txn->transactionType == "FCI"  || $txn->transactionType == "PFC") : ?>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Debit Account Number  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->accountNo; ?></div>

			</div>
			<?php endif ?>

			
			<?php if (trim($txn->remarks) != "" ) : ?>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Remarks</strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->remarks; ?> </div>
			</div>
			<?php endif ?>

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Transaction Created Details </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;">User - <?php echo $txn->user; ?> | Time - <?php echo $txn->timestamp; ?> </div>
			</div>
			<?php if ($txn->status == "X" ) : ?>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Transaction Cancelled Details  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;">User - <?php echo $txn->cancelleduser; ?> | Time - <?php echo $txn->cancelledtimestamp; ?> | Reason - <?php echo $txn->reason; ?></div>

			</div>
			<?php endif ?>

			<?php if ($txn->status == "C" ) : ?>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Transaction Cancelled Details  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;">User - <?php echo $txn->cancelleduser; ?> | Time - <?php echo $txn->cancelledtimestamp; ?> | Reason - <?php echo $txn->reason; ?></div>

			</div>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Transaction Authorization Details  </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;">User - <?php echo $txn->authuser; ?> | Time - <?php echo $txn->authtimestamp; ?> | Reason - <?php echo $txn->authreason; ?></div>

			</div>
			<?php endif ?>


			<div style="width:100%;float: left;border-width: 0px 0px 1px 0px !important;padding-left: 10px;">
				&nbsp;
			</div>

			<div style="width:100%;">
				<strong>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">Currency</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">Amount</div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">Exchange Rate</div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;">Sub Total (LKR)</div>
			</strong>
			</div>

			<?php if ($txn->icurrencyselector1 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector1; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount1;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate1?></div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($txn->camount1), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->icurrencyselector2 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector2; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount2;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate2?></div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($txn->camount2), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->icurrencyselector3 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector3; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount3;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate3?></div>
				<div style="width:30%;float: left; text-align:right; border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($txn->camount3), 2) ; ?></div>
			</div>
			<?php endif ?>


			<?php if ($txn->icurrencyselector4 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector4; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount4;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate4?></div>
				<div style="width:30%;float: left; text-align:right; border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($txn->camount4), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "1" && $txn->itrscode == "1501") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Incentive</div>
				<div style="width:30%;float: left; text-align:right; border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($txn->totalIncentive), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "2" ) : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Commision Fee (<?php echo $txn->commissionPercentage; ?>%)</div>
				<div style="width:30%;float: left; text-align:right; border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo $txn->commissionAmount; ?></div>
			</div>
			

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Total LKR</div>
				<div style="width:30%;float: left; text-align:right; border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($totalLkrcom), 2) ; ?></div>
			</strong>
			</div>
			
            
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Rounding Off </div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo $txn->ceilingOrFloorCommission; ?></div>
				</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">Total Receivable Amount </div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($customerTotal), 2) ; ?></div>
			</strong>
			</div>

			
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Received Amount</div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($receivedAmount), 2) ; ?></div>
			</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Refunded Amount</div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($refundedAmount), 2) ; ?></div>
			</strong>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "1" ) : ?>
			

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Total LKR</div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($totalLkrinc), 2); ?></div>
			</strong>
			</div>

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Rounding Off </div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo $txn->ceilingOrFloorCommission; ?></div>
			</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Net Amount to Customer</div>
				<div style="width:30%;float: left; text-align:right;border-width: 0px 0px 1px 0px !important; padding-right: 10px;"><?php echo number_format(floatval ($customerTotal), 2) ; ?></div>
			</strong>
			</div>
			<?php endif ?>

		   

			<!-- <div style="width:100%;float: left;border-width: 0px 0px 1px 0px !important;padding-left: 10px;">
				&nbsp;
			</div> -->

			<div style="width:100%;float: left;border-width: 0px 0px 0px 0px !important;padding-left: 10px;">
				<div style="width:100%;float: right;padding-left: 60px;padding-top: 10px; padding-bottom: 10px;padding-right: 60px;">
					<div class="form-group pull-left">
						<a id="ap-backbtn-view-international" class="ap-btn ap-btn-back ">
							<span>
								<i class="fas fa-chevron-left blue"></i>
							</span>
							<span>BACK</span>	
						</a>	
					</div>	
					<div class="form-group pull-right">
						<a href="<?php echo $url?>" id="ap-printbtn" class="ap-btn ap-btn-back back">
							<span>PRINT TRANSACTION RECEIPT </span>	&nbsp;
							<span>
								<i class="fas fa-print blue"></i>
							</span>
						
						</a>	
					</div>
				</div>
			</div>


		

	</div>
</div>
</div>

</div>



<script>

// 	window.onload = function(){
//         window.print();
//     }
// 	//javascript:window.print();

	javascript:window.onafterprint = (event) => {
    javascript:window.history.back();
};
	 // $(document).keypress(function(event) {

	 // 		if (event.keyCode === 13 && '<?php //echo $txn->transactionType; ?>' == 'FCP') {
	 // 				alert('hjhjhg');
	 // 		javascript:history.back(); 		
  //              // window.location.href =  "<?php //echo $this->config->item('base_url');?>transaction/create/purchase/new?txncode=1&txntype=FCP&subtitle=FOREIGN CURRENCY PURCHASE";


  //           } else if (event.keyCode === 13 && '<?php //echo $txn->transactionType; ?>' == 'FCS') {
  //           	window.location.href = "<?php //echo $this->config->item('base_url');?>transaction/create/sales/new?txncode=2&txntype=FCS&subtitle=FOREIGN CURRENCY SALES";

  //           } else if (event.keyCode === 13 && '<?php //echo $txn->transactionType; ?>' == 'FCR') {
  //           	window.location.href =  "<?php //echo $this->config->item('base_url');?>transaction/create/exchange/new?txncode=2&txntype=FCR&subtitle=FOREIGN CURRENCY RE_EXCHANGE";

  //           } else if (event.keyCode === 13 && '<?php //echo $txn->transactionType; ?>' == 'FCI') {
  //           	window.location.href =  "<?php //echo $this->config->item('base_url');?>transaction/create/payment/new?txncode=2&txntype=FCI&subtitle=FOREIGN CURRENCY ISSUING";

  //           }

 

	 // });
</script>

