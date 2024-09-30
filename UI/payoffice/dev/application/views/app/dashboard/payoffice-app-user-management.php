 <?php if ((isset($_SESSION['user_level']) && ($_SESSION['user_level']=='3' || $_SESSION['user_level']=='1' ) )): ?>

<div class="row">
		<div class="col-md-11">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #337ab7;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-chalkboard-teacher"></span> User Management</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          
                         <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWSYSUSR&subtitle=VIEW SYSTEM USERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-users  glyphsize green"></span> 
                            <br/>View<br /> System Users
                          </a>


                         
                          <a href="<?php echo $this->config->item('base_url');?>user/assign/new?operationtype=ASSUSR&subtitle=ASSIGN USER" class="btn btn-dpurple btn-lg" role="button">
                          	<span class="fa fa-user-plus glyphsize green"></span> 
                          	<br/>Assign<br />User
                          </a>
                         
                           
                                                  
                 
                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWASSIGNMENT&subtitle=VIEW DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-chalkboard-teacher glyphsize green"></span> 
                            <br/>View<br />Daily Assignments
                          </a>                       

                           

                        

                       
                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=DELETEASSIGNMENT&subtitle=DELETE DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-user-slash  glyphsize green"></span> 
                            <br/>Delete<br />Daily Assignments
                          </a>

                          <a href="<?php echo $this->config->item('base_url');?>user/change/password?operationtype=CHGUSR&subtitle=CHANGE USER PASSWORD" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-id-badge glyphsize green"></span> 
                            <br/>Change<br />Password
                          </a>

                           <?php endif ?>

                           <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='1' )): ?>
                          
                         <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWSYSUSR&subtitle=VIEW SYSTEM USERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-users  glyphsize green"></span> 
                            <br/>View<br /> System Users
                          </a>
                   
                 
                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWASSIGNMENT&subtitle=VIEW DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-chalkboard-teacher glyphsize green"></span> 
                            <br/>View<br />Daily Assignments
                          </a>                       

                          <a href="<?php echo $this->config->item('base_url');?>user/change/password?operationtype=CHGUSR&subtitle=CHANGE USER PASSWORD" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-user-secret glyphsize green"></span> 
                            <br/>Change<br />Password
                          </a>

                           <?php endif ?>
                          

                          
                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif ?>
    

