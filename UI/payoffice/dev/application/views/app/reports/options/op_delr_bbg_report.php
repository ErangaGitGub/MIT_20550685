<script>
$(document).ready(function() {   

var selected = false;
var exportIDS = "";
var all_selected = false;


$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 1, 'asc' ],
"dom": 'Bfrtip',
buttons: [

{

text: 'Select All',
action: function ( e, dt, node, config ) {

	if (typeof (all_selected) == 'undefined' || all_selected == false) {
	selected = true;
	all_selected = true;
	this.text('Deselect All') ;
	$('input:checkbox').prop('checked', true);
	
	$('#rtgs-report [type="checkbox"]').each(function(i, chk) {

    if (chk.checked) {
    selected = true;
    if (exportIDS=="") { exportIDS = this.id; }
    else { exportIDS = exportIDS+","+this.id; }
    }

  	});

	} else {
	selected = false;
	exportIDS = "";
	all_selected = false;
	this.text('Select All');
	$('input:checkbox').prop('checked', false);
	}

	}
},

{
extend: 'excelHtml5',
text: 'Export to Excel',
title: '',
filename: '<?php echo 'Bloomberg Report (BBG) Report - '.$created_on.'-'.$created_at; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',
exportOptions: {
orthogonal: 'sort',
columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ],
},


action: function ( e, dt, node, config ) {

	if (selected) {
	
	var b = $("input[name=app-baseurl]").val();
	var u = b+'reports/view/bbg_report_to_excel';
	var json_array = { exportIDS: exportIDS, return_json: true };

	$.ajax({
	type: 'POST',
	url: u,
	data: JSON.stringify(json_array),
	dataType: "json",
	contentType: "application/json; charset=utf-8",
	headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	success: function (response) {  

	var r = response;

	if (!r.error_status) {
		alert("Export completed successfully.");
		window.location.reload(false); 
	} else {
		alert(r.error_message);
		window.location.reload(false); 
	}

	},
	error: function() {
		alert("An error occurred during the process.");
	},

	});
		
	$.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
		
	} else {
		alert('Please select all records.');
	}

},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {

//remove commas for calculations after excel extracted
if (j===6) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}           
}}}
},

]

});

});
</script>