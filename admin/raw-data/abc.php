<?php
require_once '../init.php'; 

if(not_logged_in() === TRUE) {
	header('location: ../index.php');
}
		$id_for_lr=$_GET['id_for_lr'];
		$lr_number=$_GET['lr_number'];
		$status_lr=$_GET['status_lr'];

		?>
	<div>
 <table id="reee" class="table table-bordered" style="height:177px;overflow: auto;">
    <thead>
      <tr style="background:navy; color:#fff;">
        <th class="poke4">LR  NO.</th>
      
		   <th class="poke4">Invoice/Other Number</th>
		   <th class="poke4">Quantity</th>
		   <?php if($status_lr=="closed"){}else{ ?>
		   
		    <th class="poke4">Action</th>
		   <?php } ?>
      </tr
	  
    </thead>
    <tbody ">
	
		<?php
$sql_query="SELECT bd.invoice_no,ld.lr_number,bd.box_id,bd.qunatity FROM `box_data` bd join vehicle_in_out_lr_data ld on ld.id=bd.relation_id where bd.relation_id='".$id_for_lr."'";
      $result = mysqli_query($mycon, $sql_query);
         if (mysqli_num_rows($result) > 0) {
			 $cnt=1;
          while ($row = mysqli_fetch_assoc($result)) {  ?>

 
  
      <tr >
        <td><?php echo $row['lr_number'];; ?></td>
       
		 <td><?php echo $row['invoice_no']; ?></td>
		 <td><?php echo $row['qunatity']; ?></td>
		 
		 <?php if($status_lr !=="closed"){ ?>
		  <td class="rohit">
		  <span style="display:none;">
		  <i class="fa fa-play " aria-hidden="true" style="color:green; font-size: 13px;"></i>
		  </span>
		   <?php if($status_lr=="closed"){} else{ ?>
		   <span>
		   <i onclick=" delete_box_data(<?php echo $row['box_id']; ?>)" class="fa fa-minus-circle" aria-hidden="true" style="color:red; font-size: 13px;"></i>
		  
		   </span>
		   <?php } ?>
		    <span style="display:none;">
			 <i class="fa fa-print" aria-hidden="true" style="color:navy; font-size: 13px;"></i>
			
			</span>
		 </td> <?php } ?>
      </tr>
		 <?php $cnt++;} } ?>
     
    </tbody>
  </table>
	</div> 
