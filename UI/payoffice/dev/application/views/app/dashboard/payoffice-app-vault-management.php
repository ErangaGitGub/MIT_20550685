<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> -->

<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2' || $_SESSION['user_level']=='3' )): ?>
  <div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #337ab7;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-clipboard"></span> Vault Management</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                          
                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          <a href="<?php echo $this->config->item('base_url');?>vault/transfer/t4stopos?operationtype=TSFT4STOPOS&subtitle=TRANSFER CASH INTO VAULT" class="btn btn-dpurple btn-lg" role="button">
                          	<span class="fas fa-arrow-circle-down glyphsize blue"></span> 
                          	<br/>Transfer Cash<br />Into Vault
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>vault/transfer/postot4s?operationtype=TSFPOSTOT4S&subtitle=TRANSFER CASH FROM VAULT" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-arrow-circle-up glyphsize blue"></span> 
                            <br/>Transfer Cash<br />From Vault
                          </a>
                          <?php endif ?>
        
                      <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                           <a href="<?php echo $this->config->item('base_url');?>vault/transfer/tilltotill?operationtype=TSFPOSTOTILL&subtitle=PAY OFFICE SYSTEM VAULT TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-file-export glyphsize blue"></span> 
                            <br/>Transfer Cash<br />To Till
                           </a>

                           <a href="<?php echo $this->config->item('base_url');?>vault/transfer/acceptTransfers?operationtype=TSFCASH&subtitle=ACCEPT CASH TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-file-import alendar-alt   glyphsize blue"></span>
                            <br/>Accept<br />Cash Transfers
                            </a>
                            <?php endif ?>


                           <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2' )): ?>   
                           <a href="<?php echo $this->config->item('base_url');?>vault/transfer/tilltotill?operationtype=TSFPOSTOTILL&subtitle=PAY OFFICE SYSTEM VAULT TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-file-export glyphsize blue"></span> 
                            <br/>Create<br />Cash Transfers
                          </a>  
                           
                          <a href="<?php echo $this->config->item('base_url');?>vault/transfer/acceptTransfers?operationtype=TSFCASH&subtitle=ACCEPT CASH TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-check to slot  glyphsize blue"></span>
                            <br/>Accept<br />Cash Transfers
                          </a>
                        <!-- fas fa-file-import alendar-alt -->
                          
                            <?php endif ?>

                            <a href="<?php echo $this->config->item('base_url');?>vault/view/tillbalance?operationtype=VEWTILBAL&subtitle=VIEW TILL BALANCE" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-calendar-alt   glyphsize blue"></span>
                            <br/>View<br />Till Balance
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>vault/transfer/viewTransfers?operationtype=VEWTSFCASH&type=I&subtitle=VIEW INITIATED CASH TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-book circle arrow up glyphsize blue"></span>
                            <br/>View Initiated <br />Cash Transfers
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>vault/transfer/viewTransfers?operationtype=VEWTSFCASH&type=R&subtitle=VIEW RECEIVED CASH TRANSFERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-book circle arrow up glyphsize blue"></span>
                            <br/>View Received <br />Cash Transfers
                          </a>
                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif ?>  