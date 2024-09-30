<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> --><?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2' || $_SESSION['user_level']=='3')): ?>
<div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #337ab7;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="   fas fa-money-bill-alt"></span> Transactions </h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' || $_SESSION['user_level']=='2'  )): ?>
                            

                           <a href="<?php echo $this->config->item('base_url');?>transaction/create/purchase/new?txncode=1&txntype=FCP&subtitle=FOREIGN CURRENCY PURCHASE" class="btn btn-dpurple btn-lg" role="<!-- button" tabindex="2">
                            <span class="fa fa-money-bill-alt glyphsize orange" ></span> 
                            <br/>Currency<br />Purchase
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>transaction/create/sales/new?txncode=2&txntype=FCS&subtitle=FOREIGN CURRENCY SALES" class="btn btn-dpurple btn-lg" role="button" tabindex="1">
                            <span class="far fa-money-bill-alt glyphsize orange"></span> 
                            <br/>Currency<br />Sales
                          </a>
                          
                          <!-- dpurple -->
                         <a href="<?php echo $this->config->item('base_url');?>transaction/create/exchange/new?txncode=2&txntype=FCR&subtitle=FOREIGN CURRENCY RE_EXCHANGE" class="btn btn-dpurple btn-lg" role="button" tabindex="3">
                          
                            <span class="fas fa-comments-dollar glyphsize  orange"></span> 
                            <br/>Currency<br />Re-Exchange
                          </a>
                          
                                                   
                          
                          <a href="<?php echo $this->config->item('base_url');?>transaction/view?txncode=4&txntype=till&subtitle=FC SALES" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-calendar-alt   glyphsize orange"></span> 
                            <br/>Daily<br /> Report
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>transaction/cancel?txncode=4&txntype=cancel&subtitle=FC SALES" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-times   glyphsize orange"></span> 
                            <br/>Cancel<br /> Transaction
                          </a>
                           <?php endif ?>
                            

                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                            
                            <a href="<?php echo $this->config->item('base_url');?>transaction/view?txncode=4&txntype=till&subtitle=FC SALES" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-calendar-alt   glyphsize orange"></span> 
                            <br/>Daily Transaction<br /> Report
                          </a>


                         <a href="<?php echo $this->config->item('base_url');?>transaction/admin/view" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-calendar-alt   glyphsize orange"></span> 
                            <br/>All Transaction<br /> Report
                          </a>

                            <a href="<?php echo $this->config->item('base_url');?>transaction/approvecancel?txncode=4&txntype=pendingcancel&subtitle=FC SALES" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-times   glyphsize orange"></span> 
                            <br/>Approve <br /> Cancelled  <br /> Transactions
                          </a>

                          <?php endif ?>

                  
                          
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

<?php endif ?>  