	
<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>



<?php 
$totalcommision = $txn->commissionAmount + $txn->ceilingOrFloorCommission;
$customerTotal = $txn->totalToCustomer;

$totalLkrinc = $txn->totalLKR;
$totalLkrcom = $txn->totalLKR;

$totalcommision = $txn->commissionAmount + $txn->ceilingOrFloorCommission;
$refundedAmount = $txn->refundAmount;
$receivedAmount = $txn->receivedAmount;

$nature = 'PFC Withdrawal';

?>



<div id="print_area" >
		<div id="purchaseForm" style="width: 900px; margin:auto;">

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
			<span style="text-align: center;width: 20%;display: block;float: left;">Customer Copy</span>
			<?php endif ?>
			<span style="text-align: center;width: 60%;display: block;float: left;"><?php echo $nature; ?></span>
			<span style="width: 20%;display: block;float: left;">User : <?php echo $txn->user; ?></span>
		</div>
		</strong>

		
		<div style="width:100%;overflow: hidden;border-width: 0px 1px 0px 1px !important;">

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Reference Number : </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->referenceNo; ?></div>
			</div>

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Customer Name : </strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->cusname; ?></div>
			</div>


			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>NIC/ Passport/ Company Reg. No.</strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->uinnumber; ?></div>
			</div>

			<?php if ($txn->natureOfTxnCode == "2" ) : ?>
			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>Air Ticket No</strong></div>
				<div style="width:70%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->airTicketNo; ?> </div>
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
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;">Sub Total (LKR)</div>
			</strong>
			</div>

			<?php if ($txn->icurrencyselector1 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector1; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount1;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate1?></div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($txn->camount1), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->icurrencyselector2 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector2; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount2;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate2?></div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($txn->camount2), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->icurrencyselector3 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector3; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount3;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate3?></div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($txn->camount3), 2) ; ?></div>
			</div>
			<?php endif ?>


			<?php if ($txn->icurrencyselector4 != "0") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo $txn->icurrencyselector4; ?></div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;"><?php echo $txn->tamount4;?></div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> <?php echo $txn->rate4?></div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($txn->camount4), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "1" && $txn->itrscode == "1501") : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Incentive</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($txn->totalIncentive), 2) ; ?></div>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "1" ) : ?>
			

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Total LKR</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($totalLkrinc), 2); ?></div>
			</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Rounding Off </div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->ceilingOrFloorCommission; ?></div>
			</strong>
			</div>

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Net Amount to Customer</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($customerTotal), 2) ; ?></div>
			</strong>
			</div>
			<?php endif ?>

			<?php if ($txn->natureOfTxnCode == "2" ) : ?>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Commision Fee (<?php echo $txn->commissionPercentage; ?>%)</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->commissionAmount; ?></div>
			</div>
			
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Total LKR</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($totalLkrcom), 2); ?></div>
			</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Rounding Off </div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $txn->ceilingOrFloorCommission; ?></div>
				</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Total Receivable Amount </div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($customerTotal), 2) ; ?></div>
			</strong>
			</div>

			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Received Amount</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($receivedAmount), 2) ; ?></div>
			</strong>
			</div>
			<div style="width:100%;">
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;">&nbsp;</div>
				<div style="width:20%;float: left;border-width: 0px 1px 1px 0px !important; padding-left: 10px;">&nbsp;</div>
				<strong>
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"> Refunded Amount</div>
				<div style="width:30%;float: left;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo number_format(floatval ($refundedAmount), 2) ; ?></div>
			</strong>
			</div>
			<?php endif ?>


			<!-- <div style="width:100%;float: left;border-width: 0px 0px 1px 0px !important;padding-left: 10px;">
				&nbsp;
			</div> -->

			<div style="width:100%;float: left;border-width: 0px 0px 1px 0px !important;padding-left: 10px;">
				<div style="width:100%;float: left;padding-left: 20px;padding-top: 20px; padding-bottom: 10px; padding-right: 20px;">
						<span>This is a computer generated receipt, No need of teller's signature.</span><br/>
						
						<span><strong>Important Notice:</strong>Please count cash before leave the counter. The bank is not liable for any complaints made after leaving the counter.</span><br/>
						<div style="width: 10%;">&nbsp;</div>
							<div style="width: 80%;"> 
						<span align="center" style="width:900px;"><strong>Thank You!</strong></span>
					</div>
					<div style="width: 10%;">&nbsp;</div>


				</div>
			</div>


	</div>	

	
</div>
</div>







