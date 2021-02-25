<?php

require_once '../init.php';
include_once 'function.php';


if (not_logged_in() === TRUE) {
   header('location: ../index.php');
}



$state= $_GET['state'];
$city= $_GET['city'];


function get_country_id($mycon,$state){
    if(is_numeric($state)){
        $sql_query = "select country_id from states where state_id ='".$state."' limit 1";

    }else{
        $sql_query = "select country_id from states where state_name ='".$state."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $country_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $country_id = $row['country_id'];
            
        }
        
        return $country_id;
}

function get_city_id($mycon, $city){

    if(is_numeric($city)){
        return $city;

    }else{
        $sql_query = "select city_id from cities where city_name ='".$city."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $city_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $city_id = $row['city_id'];
            
        }
        return $city_id;
}


function get_state_id($mycon, $state){
    if(is_numeric($state)){
        return $state;

    }else{
        $sql_query = "select state_id from states where state_name ='".$state."' limit 1";

    }
        $result = mysqli_query($mycon , $sql_query);
        $state_id = "";
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            $state_id = $row['state_id'];
            
        }
        return $state_id;
}

if($state != ""){
$country_id = get_country_id($mycon,$state);
$state_id = get_state_id($mycon, $state);
?>

<div class="form-group">
		<select id="country" onchange="change_country('country','state','city');"  name="country" class="form-control">
			<option value="">select country </option>

			<?php
			$sql_query = "SELECT * FROM `countries` ";
			$result = mysqli_query($mycon, $sql_query);
			if (mysqli_num_rows($result) > 0) {

				while ($row = mysqli_fetch_assoc($result)) {
			?>
                    <option value="<?php echo $row['country_name'] ?>" <?php 
                    if ($row['country_id'] == $country_id) {
																			echo 'selected="selected"';
																		} ?>><?php echo $row['country_name'] ?></option>

			<?php
				}
			}
			?>

		</select>
		<label for="country_name">Country Name &#9734;</label>
	</div>
	<span class="error" style="display: none;" id="errorcountry" >
                                                                 <p  class="text-danger">This Field cannot be left Empty*</p>
                                                             </span>









<!-- // STATE DROPDOWN -->


<div class="form-group form-md-line-input form-md-floating-label has-success">
		<select id="state" name="state" onchange="change_state('state','city'); checkPrev(this);" class="form-control reqpr select2">
			<option value="">Select State</option>
			<?php
			$sql_query_search123 = "SELECT * FROM `states`";

			$result_s123 = mysqli_query($mycon, $sql_query_search123);
			if (mysqli_num_rows($result_s123) > 0) {

				while ($row123 = mysqli_fetch_assoc($result_s123)) {

			?>
					<option value="<?php echo $row123['state_id']; ?>" <?php if ($row123['state_id'] == $state_id) {
																			echo 'selected="selected"';
																		} ?>><?php echo $row123['state_name']; ?></option>
			<?php
				}
			}
			?>

		</select>
		<label for="state_name">State Name &#9734;</label>
	</div>
	<span class="error" style="display: none;" id="errorstate" >
                                                                 <p  class="text-danger">This Field cannot be left Empty*</p>
                                                             </span>
<!-- // END STATE DROPDOWN -->



<?php } 

if($city !=""){

    // it could be city id or city name 
$city_id = get_city_id($mycon,$city);


?>


<!-- // CITY DROPDOWN -->



<select id="city" class="form-control">
	<option value="">Select City</option>
	<?php
	$sql_query = "SELECT * FROM `cities`";
	$result = mysqli_query($mycon, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
?>
		<option value="<?php echo $row['city_name']; ?>" <?php if ($row['city_id'] == $city_id) {
																			echo 'selected="selected"';
																		} ?>>		
			
			<?php echo $row['city_name']; ?></option>
			<?php
				}
			}
			?>

</select>


<!-- // END city DROPDOWN -->

<?php  

}

?>