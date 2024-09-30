<script src="<?php echo $this->config->item('public_url')."ang/inc/".$dir."/ang-".$route.".js";?>"></script>


<!-- <section id="create-section" ng-controller="request-create" ng-init="init(<?php //echo htmlspecialchars(json_encode($uiconfigs)); ?>)"> -->
<section id="authorize-section" ng-controller="RequestController">

<!-- start of section-form -->
<div id="section-form" class="ap-section-component">
<div id="app-tab-create">
<div class="row ap-padding-0">
<div class="col-lg-12 col-md-12 ap-padding-0">
<div class="panel blank-panel">

<div class="panel-heading no-print">

<div id="tabs-not-allowed" class="panel-options">	


<ul class="nav nav-tabs">
	
<li id="tab_first" class="active"><a href="#tab-1"  data-toggle="tab" tabindex="-1"><?php echo $tabtitle1; ?></a></li>
</ul>
</div>
</div>

<div class="panel-body">
<div class="tab-content">

<div class="tab-pane active" id="tab-1">
<div class="col-md-12 ap-tab-pane-content-wrapper">
<div class="ap-orgin-form-container">
<?php echo $operation_view; ?>	
</div>
</div>
</div>

</div>
</div>


</div>
</div>
</div>  
</div>  
</div>
<!-- end of section-form -->

<!-- The Modal -->
<div id="ap-modal-container"></div>

</section>







