

<div id="section-header" class="container-fluid ap-section-header">



<style>.dboard-menu-sub-ul li { font-size: 30px; }

body{font-family: "Raleway", sans-serif;color: #444444;}

</style>

<script>
setInterval(myTimer, 100);
function myTimer() {
  const date = new Date();
  document.getElementById("demo").innerHTML = date;
}
</script>



<div class="pull-right">
<div class="sw-hdr-timestamp"> <p id="demo"></p></div>
</div>
<div class="clearfix"></div>

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand ap-navbar-brand-header"><?php echo $title;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
</div>


<?php if ($this->config->item('app_ui_dashboard_layout')==="DEFAULT") { ?>
<div class="container-fluid">   
   	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-11">	
	<div class="">
	<div class="panel panel-default" style="border: 1px solid transparent;">
   	
   	<div class="panel-body" style="padding: 15px 0;">





<!-- 

    <?php include 'payoffice-app-default.php';?>
    <?php include 'payoffice-app-admin-management.php';?>	
	<?php include 'payoffice-app-user-management.php';?>	
	<?php include 'payoffice-app-txn-management.php';?>
	<?php include 'payoffice-app-vault-management.php';?>
	<?php include 'payoffice-app-rates-management.php';?>
	<?php include 'payoffice-app-operations-management.php';?> 



	<!-- <?php //include 'itrs-app-customer-inquiry-manager.php';?>  -->

   	</div>
	</div>
	</div>
	</div>


	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="margin-bottom: 20px;">	
	<div class="">
	<?php //if (isset($pendinglist)): ?>
	<?php //include 'app-pending-payments.php'; ?>
	<?php //endif ?>	
	</div>
	</div>
</div>
<?php } ?>




