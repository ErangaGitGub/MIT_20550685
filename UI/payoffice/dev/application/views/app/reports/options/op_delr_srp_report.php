<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 0, 'asc' ],
"dom": 'Bfrtip',
buttons: [

{
extend: 'excelHtml5',
text: 'Export to Excel',
title: '',
filename: '<?php echo 'Special Rates Progress Report - '.$created_by.' - '.$created_on; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',
exportOptions: {
orthogonal: 'sort',
},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {
if (j===0) {
data.body[i][j] = '\u200C' + data.body[i][j];
}

//remove commas for calculations after excel extracted
if (j===5 || j===7) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}            
}}}
},

]

});

});
</script>