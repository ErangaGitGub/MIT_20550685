<!-- <?php //if (isset($permissions['payment_view']) && $permissions['payment_view']): ?> -->
<?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
<div class="row">
		<div class="col-md-10">
            <div class="panel panel-primary" style=" border: 1px solid transparent;border-color: #3c763d;">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fas fa-chalkboard-teacher"></span> User Management</h3>
                </div>
                <div class="panel-dash-body">
                    <div class="row">
                        <div class="col-md-12">
                          <!-- dpurple -->
                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          <a href="<?php echo $this->config->item('base_url');?>user/create/new?operationtype=CRTUSR&subtitle=CREATE NEW USER" class="btn btn-dpurple btn-lg" role="button">
                          	<span class="fa fa-user-circle glyphsize white"></span> 
                          	<br/>Create<br />User
                          </a>
                          <?php endif ?>


                          <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          <a href="<?php echo $this->config->item('base_url');?>user/assign/new?operationtype=ASSUSR&subtitle=ASSIGN USER" class="btn btn-dpurple btn-lg" role="button">
                          	<span class="fa fa-user-plus glyphsize lilac"></span> 
                          	<br/>Assign<br />User
                          </a>
                           <?php endif ?>
                           
                           <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>                         
                           <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWSYSUSR&subtitle=VIEW SYSTEM USERS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fa fa-users  glyphsize mblue"></span> 
                            <br/>Manage<br /> System Users
                          </a>
                           <?php endif ?>

                        

                         <?php if ((isset($_SESSION['user_level']) && $_SESSION['user_level']=='3' )): ?>
                          <a href="<?php echo $this->config->item('base_url');?>user/view?operationtype=VIEWASSIGNMENT&subtitle=MANAGE DAILY ASSIGNMENTS" class="btn btn-dpurple btn-lg" role="button">
                            <span class="fas fa-chalkboard-teacher glyphsize yellow"></span> 
                            <br/>Manage<br />Daily Assignments
                          </a>
                           <?php endif ?>

                          
                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endif ?>  