<!-- <?php //if (isset($permissions['report_view']) && $permissions['report_view']): ?> -->
<?php if (true): ?>
<ul class="list-group">

<li class="list-group-item" style="border-top: none;">
<a href="">
	<span class="ap-dash-header">
	<span>
	<img src="<?php echo $this->config->item('public_url');?>images/icons/report.svg" width="18">
	</span>
	<span>&nbsp;&nbsp;</span>
	<span>Reports</span></span>
</a>
</li>


<li class="list-group-item ap-dash-link">
<a href="<?php echo $this->config->item('base_url');?>transaction/report?reportType=TODAY&subtitle=Today's Transactions" >
	<span>Today's Transactions</span>
</a>
</li>


</ul>
<?php endif ?>  