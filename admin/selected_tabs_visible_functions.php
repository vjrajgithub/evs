<?php 



function get_type_of_verification($mycon, $app_id)
{

   $sql = "select type_of_check from tbl_application where application_ref_id = '" . $app_id . "' limit 1";
   $result =  mysqli_query($mycon, $sql);
   if (mysqli_num_rows($result) >  0) {
      $row = mysqli_fetch_assoc($result);
      return $row['type_of_check'];
   }
}

function is_visble_verification_tab($tab_no, $type_of_verification_array)
{
   if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
   else return 'style="display:none"';
}
function is_visble_verification_tab_multi($tab_no_array, $type_of_verification_array)
{

   foreach($tab_no_array as $tab_no){
      if (in_array($tab_no, $type_of_verification_array)) return 'style="display:block"';
      else $status= false;
      
   }

   if($status==false){
      return 'style="display:none"';
   }
}



?>