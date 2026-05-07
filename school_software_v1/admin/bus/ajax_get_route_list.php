<?php include("../attachment/session.php"); ?>
			
			<table class="table table-responsive">
			<thead >
                <tr>
                <th>S.No.</th>
                <th>Route Name</th>
                <th>Stop Name</th>
                <th>Time</th>
                <th>Trip</th>
                <th>Bus No.</th>
                </tr>
			</thead>
			<tbody>
			<?php			
			$route_name=$_GET['route_name'];
			if($route_name!=''){
				$condition1=" and bus_route ='$route_name'";
			}else{
				$condition1="";
			}
			
			$query="select * from bus_route_details where bus_route!=''$condition1";
			$result=mysqli_query($conn73,$query)or die(mysqli_error($conn73));
			$serial_no=0;
			while($row=mysqli_fetch_assoc($result)){
			$bus_route=$row['bus_route'];
			$bus_stop_name=$row['bus_stop_name'];
			$bus_route_time=$row['bus_route_time'];
			$bus_trip=$row['bus_trip'];
			$bus_no=$row['bus_no'];
			
			$serial_no++;
			?>
			<tr>
			<td><?php echo $serial_no.'.'; ?></td>
			<td><?php echo $bus_route; ?></td>
			<td><?php echo $bus_stop_name; ?></td>
			<td><?php echo $bus_route_time; ?></td>
			<td><?php echo $bus_trip; ?></td>
			<td><?php echo $bus_no; ?></td>
			</tr>
			<?php } ?>
			</tbody>
			</table>