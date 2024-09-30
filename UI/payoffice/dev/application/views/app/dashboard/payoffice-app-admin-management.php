 <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='4' )): ?>

<div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #337ab7;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-chalkboard-teacher"></span> Admin Module</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='4' )): ?>
                          

                          <a href="<?php echo $this->config->item('base_url');?>user/create/new?operationtype=CRTUSR&subtitle=CREATE NEW USER" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-user-circle glyphsize green"></span> 
                            <br/>Create<br />User
                          </a>
                         


                         
                          <a href="<?php echo $this->config->item('base_url');?>user/assign/new?operationtype=ASSUSR&subtitle=ASSIGN USER" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-user-plus glyphsize green"></span> 
                            <br/>Assign<br />User
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>user/reset/password?operationtype=RSTUSR&subtitle=RESET USER PASSWORD" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-user-secret glyphsize green"></span> 
                            <br/>Reset<br />Password
                          </a>

                                                  
                           
                                                  
                           <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWSYSUSR&subtitle=VIEW SYSTEM USERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-users  glyphsize green"></span> 
                            <br/>View<br /> System Users
                          </a>
                         

                                                   
                           <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=DELETESYSUSR&subtitle=DELETE SYSTEM USERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class=" fas fa-user-times  glyphsize green"></span> 
                            <br/>Delete<br /> System Users
                          </a>
                      
                        

                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWASSIGNMENT&subtitle=VIEW DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-chalkboard-teacher glyphsize green"></span> 
                            <br/>View<br />Daily Assignments
                          </a>
                         

                           

                        

                       
                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=DELETEASSIGNMENT&subtitle=DELETE DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-user-slash  glyphsize green"></span> 
                            <br/>Delete<br />Daily Assignments
                          </a>


                         
                           <?php endif ?>
                                 
                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



<?php endif ?>
    

