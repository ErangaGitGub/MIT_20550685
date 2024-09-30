<?php if (
(isset($settings['export_excel']) && $settings['export_excel']) &&
(isset($settings['export_pdf']) && $settings['export_pdf']) 
): ?>
	

<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 1, 'asc' ],
"dom": 'Bfrtip',
buttons: [

{
extend: 'excelHtml5',
text: 'Export to Excel',
title: '',
filename: '<?php echo 'RTGS Inquiry Report - '.$created_by.' - '.$created_on; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',
exportOptions: {
orthogonal: 'sort',
},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {
if (j===1) {
data.body[i][j] = '\u200C' + data.body[i][j];
}

//remove commas for calculations after excel extracted
if (j===5) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}       
}}}
},



{
extend: 'pdfHtml5',
text: 'Export to PDF',
orientation: 'landscape',
pageSize: 'LEGAL',
footer: true,
header: true,
title: 'RTGS Inquiry Report',
filename: '<?php echo 'RTGS Inquiry Report - '.$created_by.' - '.$created_on; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',

customize: function ( doc ) {

doc.pageMargins = [30, 40, 30,50];

doc.content[1].table.widths = 
Array(doc.content[1].table.body[0].length + 1).join('*').split('');

doc.content[1].table.dontBreakRows = true;

var rowCount = document.getElementById("rtgs-report").rows.length;

for (i = 0; i < rowCount; i++) {
doc.content[1].table.body[i][0].alignment = 'center';
doc.content[1].table.body[i][1].alignment = 'center';
doc.content[1].table.body[i][2].alignment = 'center';
doc.content[1].table.body[i][3].alignment = 'left';
doc.content[1].table.body[i][4].alignment = 'center';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'left';
doc.content[1].table.body[i][7].alignment = 'center';
doc.content[1].table.body[i][8].alignment = 'left';
doc.content[1].table.body[i][9].alignment = 'center';


doc.content[1].table.body[i][0].lineHeight =  1.1;
doc.content[1].table.body[i][1].lineHeight =  1.1;
doc.content[1].table.body[i][2].lineHeight =  1.1;
doc.content[1].table.body[i][3].lineHeight =  1.1;
doc.content[1].table.body[i][4].lineHeight =  1.1;
doc.content[1].table.body[i][5].lineHeight =  1.1;
doc.content[1].table.body[i][6].lineHeight =  1.1;
doc.content[1].table.body[i][7].lineHeight =  1.1;
doc.content[1].table.body[i][8].lineHeight =  1.1;
doc.content[1].table.body[i][9].lineHeight =  1.1;
};

doc.footer = function(page, pages) {
var con = '<?php echo $created_on; ?>';
var cat = '<?php echo $created_at; ?>';
var cby = '<?php echo $created_by; ?>';

var left = cby+" - "+con+" "+cat; 

return {

columns: [
{
alignment: "left",
text: left,
margin:[20,20,0,0]
}, 
{
alignment: "center",
text: [{ text: page.toString(), italics: false }, " of ", { text: pages.toString(), italics: false }],
margin:[0,20,0,0]
},
{
alignment: "right",
text: 'All RIGHTS RESERVED  ©  BANK OF CEYLON  SRI LANKA',
margin:[0,20,20,0]
}, 
]

}
}

},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {
if (j===1) {
data.body[i][j] = '\u200C' + data.body[i][j];
}

//remove commas for calculations after excel extracted
if (j===5) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}       
}}},

},



]

});


});
</script>


<?php elseif (isset($settings['export_excel']) && $settings['export_excel']): ?>

<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 1, 'asc' ],
"dom": 'Bfrtip',
buttons: [

{
extend: 'excelHtml5',
text: 'Export to Excel',
title: '',
filename: '<?php echo 'RTGS Inquiry Report - '.$created_by.' - '.$created_on; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',
exportOptions: {
orthogonal: 'sort',
},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {
if (j===1) {
data.body[i][j] = '\u200C' + data.body[i][j];
}

//remove commas for calculations after excel extracted
if (j===5) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}       
}}}
},

]

});

});
</script>


<?php elseif (isset($settings['export_pdf']) && $settings['export_pdf']): ?>

<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 1, 'asc' ],
"dom": 'Bfrtip',
buttons: [

{
extend: 'pdfHtml5',
text: 'Export to PDF',
orientation: 'landscape',
pageSize: 'LEGAL',
footer: true,
header: true,
title: 'RTGS Inquiry Report',
filename: '<?php echo 'RTGS Inquiry Report - '.$created_by.' - '.$created_on; ?>',
author: '<?php echo $created_by; ?>',
keywords: '<?php echo $created_on.' '.$created_at; ?>',

customize: function ( doc ) {

doc.pageMargins = [30, 40, 30,50];

doc.content[1].table.widths = 
Array(doc.content[1].table.body[0].length + 1).join('*').split('');

doc.content[1].table.dontBreakRows = true;

var rowCount = document.getElementById("rtgs-report").rows.length;

for (i = 0; i < rowCount; i++) {
doc.content[1].table.body[i][0].alignment = 'center';
doc.content[1].table.body[i][1].alignment = 'center';
doc.content[1].table.body[i][2].alignment = 'center';
doc.content[1].table.body[i][3].alignment = 'left';
doc.content[1].table.body[i][4].alignment = 'center';
doc.content[1].table.body[i][5].alignment = 'right';
doc.content[1].table.body[i][6].alignment = 'left';
doc.content[1].table.body[i][7].alignment = 'center';
doc.content[1].table.body[i][8].alignment = 'left';
doc.content[1].table.body[i][9].alignment = 'center';



doc.content[1].table.body[i][0].lineHeight =  1.1;
doc.content[1].table.body[i][1].lineHeight =  1.1;
doc.content[1].table.body[i][2].lineHeight =  1.1;
doc.content[1].table.body[i][3].lineHeight =  1.1;
doc.content[1].table.body[i][4].lineHeight =  1.1;
doc.content[1].table.body[i][5].lineHeight =  1.1;
doc.content[1].table.body[i][6].lineHeight =  1.1;
doc.content[1].table.body[i][7].lineHeight =  1.1;
doc.content[1].table.body[i][8].lineHeight =  1.1;
doc.content[1].table.body[i][9].lineHeight =  1.1;

};

doc.footer = function(page, pages) {
var con = '<?php echo $created_on; ?>';
var cat = '<?php echo $created_at; ?>';
var cby = '<?php echo $created_by; ?>';

var left = cby+" - "+con+" "+cat; 

return {

columns: [
{
alignment: "left",
text: left,
margin:[20,20,0,0]
}, 
{
alignment: "center",
text: [{ text: page.toString(), italics: false }, " of ", { text: pages.toString(), italics: false }],
margin:[0,20,0,0]
},
{
alignment: "right",
text: 'All RIGHTS RESERVED  ©  BANK OF CEYLON  SRI LANKA',
margin:[0,20,20,0]
}, 
]

}
}

},

customizeData: function ( data ) {
for (var i=0; i<data.body.length; i++) {
for (var j=0; j<data.body[i].length; j++ ) {
if (j===1) {
data.body[i][j] = '\u200C' + data.body[i][j];
}

//remove commas for calculations after excel extracted
if (j===5) {
data.body[i][j] = data.body[i][j].replace( /,/g, '' );
}       
}}},

},

]

});

});
</script>



<?php else: ?>

<script>
$(document).ready(function() {   

$('#rtgs-report').DataTable({
"paging":   false,
"info":     false,
"order": [ 1, 'asc' ]

});

});
</script>


<?php endif ?>