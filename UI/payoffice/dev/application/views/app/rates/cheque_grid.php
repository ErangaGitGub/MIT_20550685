

<script>
$(document).ready(function() {   
    $('#ap-data-table').DataTable({
    "aLengthMenu": [[18, 50, 100, -1], [18, 50, 100, "All"]],
    "pageLength": 18,
    "ordering": false,     
    "columns": [
    { "width": "5%" },
    { "width": "10%" },
    { "width": "25%" },
    { "width": "5%" },
    { "width": "5%" },
    { "width": "10%" },
    { "width": "10%" },
    { "width": "10%" },
   
   
   
    ],  
    "dom": 'Bfrtip',
    buttons: [


    {
    extend: 'pdfHtml5',
    text: 'Export to PDF',
    orientation: 'landscape',
    pageSize: 'A4',
    footer: true,
    header: true,
    title: '',
    filename: function(){
                var d = new Date();
                return 'Cheque Deposit Report_' + d.toDateString();
            },
    author: '',
    keywords: '',
    }


    ],



    });
});
</script>

<table id="ap-data-table" class="ap-data-table" style="width:100%">
    <thead>
    <tr>
    <th class="text-center">REFERENCE </th>
    <th class="text-center">ACCOUNT NUMBER</th>       
    <th class="text-center">CUSTOMER NAME</th>
    <th class="text-center">BANK CODE</th> 
    <th class="text-center">BRANCH CODE</th> 
    <th class="text-center">AMOUNT</th> 
    <th class="text-center">ENTERED BY</th> 
    <th class="text-center">TIMESTAMP</th> 
     
    
    </tr>
    </thead>
    <tbody>

    <?php if (isset($list) && is_array($list) && !empty($list)): ?>
    <?php if (!isset($list[0]->errorStatus) || $list[0]->errorStatus!=1): ?>   
    <?php foreach ($list as $item): ?>

    <?php 
    
    $url = "";
 
    $row_class = 'ap-rw-def';    

    ?>

    <tr class="<?php echo $row_class ?>"> 

    <td>
    <center>
    <a href="">
    <?php echo $item->REFNO; ?> 
    </a>
    </td>

    <td>
    <center>
    <?php echo $item->ACCOUNT; ?>
    </td>

    <td>
    <center>
    <?php echo $item->NAME; ?>
    </td>

    <td>
    <center>
    <?php echo $item->BANKCODE; ?>
    </td>

    <td>
    <center>
    <?php echo $item->BRANCHCODE; ?>
    </td>

    <td>
    <center>
    <?php echo number_format(floatval ($item->AMOUNT), 2); ?>

    </td>

    <td>
    <center>
    <?php echo $item->USER; ?>
    </td>

    <td>
    <center>
    <?php echo $item->DATE; ?>
    </td>



    </tr>

    <?php endforeach ?> 

    <?php endif ?>
    <?php endif ?> 


    </tbody>
</table>