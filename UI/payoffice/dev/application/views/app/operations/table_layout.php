<section id="view-section" style="margin-top:65px;">
<!-- start of section-header -->
<div id="section-header" class="container ap-section-header">



<header class="navbar navbar-default ap-navbar ap-navbar-default ap-page-header">
<div class="">
<div class="navbar-header">
<a class="navbar-brand ap-navbar-brand " href="#"><b><?php echo $title;?></b>
    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subtitle;?></a>
</div>

<div class="navbar-collapse collapse">



<ul class="nav navbar-nav navbar-right ap-page-header-right-ul">  
<li>
    <div class="ap-btn-group"> 
    <?php if (true) { ?>
    <a data-toggle="dropdown" class="dropdown dropdown-toggle ap-btn ap-btn-settings">
    <span><i class="fas fa-cog"></i></span>
    </a>
    <ul class="dropdown-menu ap-dropdown-menu">
    <?php if (true) { ?>
    <li><a href="#">Export to Excel</a></li>
    <?php } ?>
    <?php if (true) { ?>
    <li><a href="#">Export to PDF</a></li>
    <?php } ?>
    </ul>
    <?php } ?>
    </div>
</li>
</ul>


</div>

</div>
</header>
</div>
<!-- end of section-header -->
<!-- start of section-table -->
<div id="section-table" class="ap-section-tblcomponent container">

  
<?php echo $table_view; ?>

</div>


<!-- end of section-table -->
</section>
 


