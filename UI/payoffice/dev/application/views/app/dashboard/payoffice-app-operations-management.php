<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> -->

<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3')): ?>
  <div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #3c763d;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-clipboard"></span> Day End Operations</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                          
                          
                      
                    <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                           

                           <a href="<?php echo $this->config->item('base_url');?>opr/preCheckView?State=P&subtitle=Prior Check Process" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-check-circle glyphsize red"></span> 
                            <br/>Prior Check <br/> Process
                          </a>

                                                    
                             
                           <a href="<?php echo $this->config->item('base_url');?>opr/list?subtitle=View Daily Processes" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-file glyphsize red"></span> 
                            <br/>View Daily<br /> Processes
                          </a> 

                           <a href="<?php //echo $this->config->item('base_url');?>opr/dayEndView?State=E&subtitle=Day End Process" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-stop-circle alendar-alt   glyphsize red"></span>
                            <br/>Day End <br />Process
                            </a> 

                            <a href="<?php echo $this->config->item('base_url');?>opr/dayend/report?subtitle=View Day End Report" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-exclamation-triangle glyphsize red"></span> 
                            <br/>Day End<br /> Reports
                             </a> 
                                                 
                            <?php endif ?>

                            
                              
                               

                          

                          
                        </div>
                    </div>
                    <i class=""></i>

                </div>
            </div>
        </div>
    </div>

<?php endif ?>  