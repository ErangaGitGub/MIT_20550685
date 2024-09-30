<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2' || $_SESSION['user_level']=='3' )): ?>
<div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #337ab7;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-clipboard"></span> Currency Rates Management</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                         
                         <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2'  )): ?>
                         <a href="<?php echo $this->config->item('base_url');?>rates/upload?operationtype=rate_entry&subtitle=Upload Daily Currency Rates" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-edit glyphsize purple"></span> 
                            <br/>Upload<br />Daily Rates
                          </a>
                           <?php endif ?>


                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          <a href="<?php echo $this->config->item('base_url');?>rates/auth?type=before_auth&operationtype=rate_auth&subtitle=Authorize Daily Currency Rates " class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-check-square glyphsize purple"></span> 
                            <br/>Authorize/Reject<br /> Daily Rates
                          </a>
                           <?php endif ?>
                          

                           
                          <a href="<?php echo $this->config->item('base_url');?>rates/view?type=before_auth&subtitle=View Daily Rates" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas  fa-book glyphsize purple"></span> 
                            <br/>View<br />Daily Rates
                          </a> 

                           <!-- <a href="<?php echo $this->config->item('base_url');?>rates/before/print?subtitle=Print Rates Before Auth" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas  fa-print  glyphsize purple"></span> 
                            <br/>Print Rates<br />Before Auth
                          </a>  -->

                          <a href="<?php echo $this->config->item('base_url');?>rates/after/print?subtitle=Print Rates After Auth" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas  fa-print  glyphsize purple"></span> 
                            <br/>Print<br />Daily Rates
                          </a> 

                         

                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif ?>  