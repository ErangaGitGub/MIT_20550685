<section id="view-section" style="margin-top:65px;">
<div id="section-header" class="container ap-section-header">

<style>
.dboard-menu-sub-ul li {
    font-size: 13px;
}
</style>


<div id="section-header" class="container ap-section-header">

<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand" href="#"><?php echo $title;?></a>
</div>

<div class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li></li>
</ul>
</div>

</div>
</header>
</div>

<div class="col-md-6">

<!-- Type 1 -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='DEALER')): ?>
<div class="row wid-no-margin">
<div class="panel-group wid-panel-group"> 
<div class="panel panel-default wid-panel">
<div class="panel-heading wid-panel-heading">
<h4 class="panel-title wid-pannel-title">
<a role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span><i class="fas fa-list"></i></span>
<span>&nbsp;&nbsp;</span>
<span>Forex Deal Origination</span>
</a>
</h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12 wid-no-padding">
<div class="table-responsive">            
<table class="table table-sm table-hover wid-table">
<tbody> 

<?php if (true): ?>                                     
<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/create/new">
    Spot Deal
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>  
<?php endif ?>  



<?php if (true): ?>
<tr>
<td >
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/forward/create/new">
    Forward Deal
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?> 

<?php if (true): ?>
<tr>
<td >
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/swap/create/new">
    Swap Deal
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?>
</tbody>
</table>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>  


<!-- Type 1 -->


<!-- Type 1.5 -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='BO1')): ?>
<div class="row wid-no-margin">
<div class="panel-group wid-panel-group"> 
<div class="panel panel-default wid-panel">
<div class="panel-heading wid-panel-heading">
<h4 class="panel-title wid-pannel-title">
<a role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span><i class="fas fa-list"></i></span>
<span>&nbsp;&nbsp;</span>
<span>Forex Deal Verification </span>
</a>
</h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12 wid-no-padding">
<div class="table-responsive">            
<table class="table table-sm table-hover wid-table">
<tbody>     

<?php if (true) : ?>                                  
<tr>
<td style="border-bottom: none;">
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=New&subtitle=Verification">
    Deal Verification
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?> 
</tbody>
</table>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>  
<!-- Type 2 -->


<!-- Type 1.5 -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='BO2')): ?>
<div class="row wid-no-margin">
<div class="panel-group wid-panel-group"> 
<div class="panel panel-default wid-panel">
<div class="panel-heading wid-panel-heading">
<h4 class="panel-title wid-pannel-title">
<a role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span><i class="fas fa-list"></i></span>
<span>&nbsp;&nbsp;</span>
<span>Forex Deal Authorization </span>
</a>
</h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12 wid-no-padding">
<div class="table-responsive">            
<table class="table table-sm table-hover wid-table">
<tbody>     

<?php if (true) : ?>                                  
<tr>
<td style="border-bottom: none;">
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Verified&subtitle=Authorization">
    Deal Authorization
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?> 
</tbody>
</table>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>  
<!-- Type 2 -->

<!-- Type 2 -->
<?php if (true): ?>
<div class="row wid-no-margin">
<div class="panel-group wid-panel-group"> 
<div class="panel panel-default wid-panel">
<div class="panel-heading wid-panel-heading">
<h4 class="panel-title wid-pannel-title">
<a role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span><i class="fas fa-list"></i></span>
<span>&nbsp;&nbsp;</span>
<span>Forex Deal Enquiry </span>
</a>
</h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12 wid-no-padding">
<div class="table-responsive">            
<table class="table table-sm table-hover wid-table">
<tbody>     

<?php if (true) : ?>                                  
<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=All&subtitle=All&task=view">
    All Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>

<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=New&subtitle=New&task=view">
    New Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>


<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Verified&subtitle=Verified&task=view">
    Verified Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>

<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Authorized&subtitle=Authorized&task=view">
    Authorized Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>





<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Rejected&subtitle=Rejected&task=view">
    Rejected Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>

<tr>
<td>
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Deleted&subtitle=Deleted&task=view">
    Deleted Deals
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr>

<?php endif ?>  


</tbody>
</table>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?>  
<!-- Type 2 -->


<!-- Type 3 -->
<?php if ((isset($_SESSION['user_level']) && ($_SESSION['user_level']=='BO1' || $_SESSION['user_level']=='BO2'))): ?>
<div class="row wid-no-margin">
<div class="panel-group wid-panel-group"> 
<div class="panel panel-default wid-panel">
<div class="panel-heading wid-panel-heading">
<h4 class="panel-title wid-pannel-title">
<a role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<span><i class="fas fa-list"></i></span>
<span>&nbsp;&nbsp;</span>
<span>Forex Account Entry/Message Confirmation </span>
</a>
</h4>
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12 wid-no-padding">
<div class="table-responsive">            
<table class="table table-sm table-hover wid-table">
<tbody>     

<?php if ((isset($_SESSION['user_level']) && ($_SESSION['user_level']=='BO1'))): ?>                                
<tr>
<td style="border-bottom: none;">
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Confirm1&subtitle=Confirmation BO1">
    Account Entry / Message Confirmation 
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?>

<?php if ((isset($_SESSION['user_level']) && ($_SESSION['user_level']=='BO2'))): ?>                                 
<tr>
<td style="border-bottom: none;">
<span class="pull-left">
<a class="btn-view-fund btn btn-default btn-xs wid-btn-dot">
<i class="fas fa-chevron-right"></i>
</a> 
</span>
<span class="pull-left wid-subtitle">
<a href="<?php echo $this->config->item('base_url');?>fx/list?dealState=Confirm2&subtitle=Confirmation BO2">
    Account Entry / Message Confirmation 
</a>
</span> 
<span class="clearfix"></span>  
</td>
</tr> 
<?php endif ?>

</tbody>
</table>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif ?> 
<!-- Type 3 -->


</div>
</div>
</section>