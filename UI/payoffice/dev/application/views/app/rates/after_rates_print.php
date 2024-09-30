	
<?php 
$now = new DateTime('now');
$c_date = $now->format('l, d F, Y');
$c_time = date("h:i:s");
$c_timestamp = $c_date." ".$c_time;
?>


	<div id="print_area" >
		<div id="purchaseForm" style="width: 900px; margin:auto;">

		<img src="<?php echo $this->config->item('public_url');?>images/assets/boc_logo.png" class="img_logo"  style="width: 100px;margin: 0 auto;display: block;" alt="boc-logo">
		<div style="text-align:center;">
			<span><b>Pay Office - Bandaranayake International Airport</b></span><br/>
			<span>Telephone : Direct 0112252424 / Arrival Counter 0112264750 / Departure Counter 0112264751 / Email: payoffice@boc.lk </span><br/>
			<span>Pay Office Control Unit, Head Office 011 2541936  </span><br/>
			<span><?php echo $c_timestamp; ?></span><br/>
		</div>
		<br/>

        <?php if (isset($list) && is_array($list) && !empty($list)): ?>
        <?php foreach ($list as $item): ?>
        	<?php if ( $item->curshrt== 'USD'): ?>
        		<?php  $middlerate = $item->middlerate; ?> 
        	<?php endif ?>

        <?php endforeach ?> 
            

		<strong>
		<div style="width:100%;overflow: hidden;border-width: 1px 1px 1px 1px !important; padding: 10px;">
			
			<span style="text-align: center;display: block;">Daily Statement of Foreign Currency </span>
			
		
		</div>
		</strong>



		
		<div style="width:100%;overflow: hidden;border-width: 0px 1px 1px 1px !important;">

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><strong>CURRENCY NAME</strong></div>
				<div style="width:25%;float: right;border-width: 0px 0px 1px 1px !important; padding-left: 10px;"><strong>SELLING RATE</strong></div>
				<div style="width:25%;float: right;border-width: 0px 0px 1px 1px !important; padding-left: 10px;"><strong>BUYING RATE </strong></div>
				<div style="width:20%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><strong>CODE</strong></div>
			</div>

			
            <?php if (isset($list) && is_array($list) && !empty($list)): ?>
            <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
            <?php foreach ($list as $item): ?>
            <?php 
            $crtuser = $item->createduser;
            $crttime = $item->createdtime;
            $autuser = $item->authorizeduser;
            $auttime = $item->authorizedtime;
            $middlerate = $item->middlerate;
            ?> 

			<div style="width:100%;">
				<div style="width:30%;float: left;border-width: 0px 1px 1px 0px !important;padding-left: 10px;"><?php echo ucwords(strtolower($item->curdesc)); ?></div>
				<div style="width:25%;float: right;border-width: 0px 0px 1px 1px !important; padding-left: 10px;"><?php echo number_format(floatval($item->sellrate),4); ?></div>
				<div style="width:25%;float: right;border-width: 0px 0px 1px 1px !important; padding-left: 10px;"><?php echo number_format(floatval($item->buyrate),4); ?></div>
				<div style="width:20%;float: right;border-width: 0px 0px 1px 0px !important; padding-left: 10px;"><?php echo $item->curshrt; ?></div>
			</div>
			<?php endforeach ?> 
            <?php endif ?>
            <?php endif ?>
           

			
            <div style="width:100%;float: center;border-width: 0px 0px 0px 0px !important;padding-left: 10px;">
				<div style="width:100%;float: center;padding-left: 10px;padding-top: 30px; padding-bottom: 30px;">
						<span>Created By &nbsp; &nbsp;&nbsp; &nbsp;: <?php echo $crtuser; ?> on <?php echo $crttime; ?> </span> </br>
						<span>Authorized By  &nbsp; : <?php echo $autuser; ?> on <?php echo $auttime; ?></span>
				</div>
				<!--  -->
			</div>
			



		

	</div>
	<?php else: ?>
	<div style="width:100%;overflow: hidden;border-width: 1px 1px 1px 1px !important; padding: 10px;">
			
			<span style="text-align: center;display: block;">No Authorized Rates For Current Date</span>
			
		
	</div>
    <?php endif ?> 	
</div>
</div>

<script>

	 javascript:window.print();

</script>





