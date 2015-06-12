<?php	
	if($firstvisit==1&&!isset($_POST["update"])){
		echo'	<h3>New Flightsheet</h3>
			 <table class="table table-hover table-condensed input_table">
				<tr>
					<th class="text-right col-md-3">Date:</th>
					<td><input class="form-control" type="text" id="date" name="date"></td>
				</tr>
				<tr>
					<th class="text-right col-md-3">Operations Director:</th>
					<td>
						<select class="form-control" name="od">';
						for($i=0;$i<count($od);$i++){
							echo'<option value="'.htmlspecialchars($od[$i][0]).'">'.htmlspecialchars($od[$i][1]).' '.htmlspecialchars($od[$i][2]).'</option>';
						}
						echo'
						</select>
					</td>
				</tr>
				<tr>
					<th class="text-right col-md-3">Service</th>
					<td>
						<select class="form-control" name="svctype" id="svctype">
							<option value="">--</option>
							<option value="soar">Soar</option>
							<option value="pr">Plane Rental</option>
							<option value="rb">Towline Break</option>
							<option value="at">Aerotow</option>					
						</select>
					</td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Engined Plane Pilot:</th>
					<td>
						<select class="form-control" name="towpilot" id="towpilot">';
						for($i=0;$i<count($tow_pilots);$i++){
							echo'<option value="'.htmlspecialchars($tow_pilots[$i][0]).'">'.htmlspecialchars($tow_pilots[$i][1]).' '.htmlspecialchars($tow_pilots[$i][2]).'</option>';
						}
						echo'
						</select>
					</td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Engined Plane:</th>
					<td>
						<select class="form-control" name="towplane" id="towplane">';
						for($i=0;$i<count($towplanes);$i++){
							echo'<option value="'.htmlspecialchars($towplanes[$i][0]).'">'.htmlspecialchars($towplanes[$i][1]).' '.htmlspecialchars($towplanes[$i][2]).'</option>';
						}
						echo'
						</select>
					</td>
				</tr>
				<tr class="hideme pr">
					<th class="text-right col-md-3">Member</th>
					<td><input type="checkbox" name="member"></td>
				</tr>
				<tr class="hideme soar at rb">
					<th class="text-right col-md-3">Glider Pilot:</th>
					<td>
						<select class="form-control" name="gliderpilot" id="gliderpilot">';
							for($i=0;$i<count($glider_pilots);$i++){
								echo'<option value="'.htmlspecialchars($glider_pilots[$i][0]).'">'.htmlspecialchars($glider_pilots[$i][1]).' '.htmlspecialchars($glider_pilots[$i][2]).'</option>';
							}
							echo'
						</select>
					</td>
				</tr>
				<tr class="hideme soar rb">
					<th class="text-right col-md-3">Instructor:</th>
					<td>
						<select class="form-control" name="instructor" id="instructor">
							<option value="">--</option>';
							for($i=0;$i<count($instructors);$i++){
								echo'<option value="'.htmlspecialchars($instructors[$i][0]).'">'.htmlspecialchars($instructors[$i][1]).' '.htmlspecialchars($instructors[$i][2]).'</option>';
							}
							echo'
						</select>
					</td>
				</tr>
				<tr class="hideme soar at rb">
					<th class="text-right col-md-3">Glider Plane:</th>
					<td>
						<select class="form-control" name="gliderplane" id="gliderplane">';
							for($i=0;$i<count($gliders);$i++){
								echo'<option value="'.htmlspecialchars($gliders[$i][0]).'">'.htmlspecialchars($gliders[$i][1]).' '.htmlspecialchars($gliders[$i][2]).'</option>';
							}
							echo'
						</select>
					</td>
				</tr>
				<tr class="hideme rb">
					<th class="text-right col-md-3">Towline Break Simulation:</th>
					<td><input type="checkbox" name="sim" id="sim"> Check if simulated
						<div id="dtbox"></div></td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Takeoff time:</th>
					<td><input class="form-control" type="time" name="takeoff" id="takeoff"></td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Engined Plane Landing time:</th>
					<td><input class="form-control" type="time" name="tlanding" id="towlanding"></td>
				</tr>
				<tr class="hideme soar at rb">
					<th class="text-right col-md-3">Glider Landing time:</th>
					<td><input class="form-control" type="time" name="glanding" id="gliderlanding"></td>
				</tr>
				<tr class="hideme soar">
					<th class="text-right col-md-3">Release Altitude (ft):</th>
					<td><input class="form-control" type="text" name="altitude" id="altitude"></td>
				</tr>
				<tr class="hideme at">
					<th class="text-right col-md-3">Miles:</th>
					<td><input class="form-control" type="text" name="miles" id="miles"></td>
				</tr>
				<tr class="hideme at">
					<th class="text-right col-md-3">Pickup Location:</th>
					<td><input class="form-control" type="text" name="pickup" id="pickup"></td>
				</tr>
				<tr class="hideme soar at rb pr">
					<th class="text-right col-md-3">Comments:</th>
					<td><textarea class="form-control" name="comment" rows="4" ></textarea></td>
				</tr>
				<tr class="hideme soar">
					<th class="text-right col-md-3">Penalty: $</th>
					<td><input class="form-control" type="text" name="penalty" id="penalty"></td>
				</tr>
				<tr class="hideme soar at rb pr">
					<th class="text-right col-md-3">Total Cost:</th>
					<td>$000.00</td>
				</tr>
				<tr class="hideme soar at rb pr">
					<th class="text-right col-md-3">Outstanding Balance:</th>
					<td><b>$000.00<b></td>
				</tr>
			</table>
			<script>
				$(function() {
					$(".hideme").hide();
					$("#svctype").change(function(){
						$(".hideme").hide();
						$("." + $(this).val()).show();
					});	
				});
			</script>';
	}
	if(isset($_POST["update"])||$firstvisit==0&&$fail==0){
		echo'    <h3>Edit Flightsheet</h3>
			 <table class="table table-hover table-condensed input_table">
				<tr>
					<th class="text-right col-md-3">Date:</th>
					<td><input class="form-control" type="text" id="date" name="date" value="'.$_POST["date"].'"></td>
				</tr>
				<tr>
					<th class="text-right col-md-3">Operations Director:</th>
					<td>
						<select class="form-control" name="od">';
						for($i=0;$i<count($od);$i++){
							if($od[$i][0]==$_POST["od"]){
								echo'<option value="'.htmlspecialchars($od[$i][0]).'" selected>'.htmlspecialchars($od[$i][1]).' '.htmlspecialchars($od[$i][2]).'</option>';
							}else{
								echo'<option value="'.htmlspecialchars($od[$i][0]).'">'.htmlspecialchars($od[$i][1]).' '.htmlspecialchars($od[$i][2]).'</option>';
							}
						}
						echo'
						</select>
					</td>
				</tr>
				<tr>
					<th class="text-right col-md-3">Service</th>
					<td>
						<select class="form-control" name="svctype" id="svctype">';
							if($_POST["svctype"]=="soar"){
								echo'
									<option value="soar" selected>Soar</option>';
							}else if($_POST["svctype"]=="pr"){
								echo'
									<option value="pr" selected>Plane Rental</option>';
							}else if($_POST["svctype"]=="rb"){
								echo'
									<option value="rb" selected>Towline Break</option>';
							}else if($_POST["svctype"]=="at"){
								echo'
									<option value="at" selected>Aerotow</option>';
							}
							echo'					
						</select>
					</td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Engined Plane Pilot:</th>
					<td>
						<select class="form-control" name="towpilot" id="towpilot">';
							for($i=0;$i<count($tow_pilots);$i++){
								if($tow_pilots[$i][0]==$_POST["towpilot"]){
									echo'<option value="'.htmlspecialchars($tow_pilots[$i][0]).'" selected>'.htmlspecialchars($tow_pilots[$i][1]).' '.htmlspecialchars($tow_pilots[$i][2]).'</option>';
								}else{
									echo'<option value="'.htmlspecialchars($tow_pilots[$i][0]).'">'.htmlspecialchars($tow_pilots[$i][1]).' '.htmlspecialchars($tow_pilots[$i][2]).'</option>';
								}	
							}
							echo'
						</select>
					</td>
				</tr>
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Engined Plane:</th>
					<td>
						<select class="form-control" name="towplane" id="towplane">';
							for($i=0;$i<count($towplanes);$i++){
								if($towplanes[$i][0]==$_POST["towplane"]){
									echo'<option value="'.htmlspecialchars($towplanes[$i][0]).'" selected>'.htmlspecialchars($towplanes[$i][1]).' '.htmlspecialchars($towplanes[$i][2]).'</option>';
								}else{
									echo'<option value="'.htmlspecialchars($towplanes[$i][0]).'">'.htmlspecialchars($towplanes[$i][1]).' '.htmlspecialchars($towplanes[$i][2]).'</option>';
								}
							}
							echo'
						</select>
					</td>
				</tr>';
				if($_POST["svctype"]=="pr"){
					if($_POST["member"]==1){
						echo'
						<tr class="hideme pr">
							<th class="text-right col-md-3">Member</th>
							<td><input type="checkbox" name="member" checked></td>
						</th>';
					}else{
						echo'
						<tr class="hideme pr">
							<th class="text-right col-md-3">Member</th>
							<td><input type="checkbox" name="member"></td>
						</th>';
					}
				}
				if($_POST["svctype"]=="soar"||$_POST["svctype"]=="rb"||$_POST["svctype"]=="at"){
					echo'
					<tr class="hideme soar at rb">
						<th class="text-right col-md-3">Glider Pilot:</th>
						<td>
							<select class="form-control" name="gliderpilot" id="gliderpilot">';
								for($i=0;$i<count($glider_pilots);$i++){
									if($glider_pilots[$i][0]==$_POST["gliderpilot"]){
										echo'<option value="'.htmlspecialchars($glider_pilots[$i][0]).'" selected>'.htmlspecialchars($glider_pilots[$i][1]).' '.htmlspecialchars($glider_pilots[$i][2]).'</option>';
									}else{
										echo'<option value="'.htmlspecialchars($glider_pilots[$i][0]).'">'.htmlspecialchars($glider_pilots[$i][1]).' '.htmlspecialchars($glider_pilots[$i][2]).'</option>';
									}
								}
								echo'
							</select>
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="soar"||$_POST["svctype"]=="rb"){
					echo'
					<tr class="hideme soar rb">
						<th class="text-right col-md-3">Instructor:</th>
						<td>
							<select class="form-control" name="instructor" id="instructor">
								<option value="">--</option>';
								for($i=0;$i<count($instructors);$i++){
									if($instructors[$i][0]==$_POST["instructor"]){
										echo'<option value="'.htmlspecialchars($instructors[$i][0]).'" selected>'.htmlspecialchars($instructors[$i][1]).' '.htmlspecialchars($instructors[$i][2]).'</option>';
									}else{
										echo'<option value="'.htmlspecialchars($instructors[$i][0]).'">'.htmlspecialchars($instructors[$i][1]).' '.htmlspecialchars($instructors[$i][2]).'</option>';
									}
								}
								echo'
							</select>
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="soar"||$_POST["svctype"]=="rb"||$_POST["svctype"]=="at"){
					echo'
					<tr class="hideme soar at rb">
						<th class="text-right col-md-3">Glider Plane:</th>
						<td>
							<select class="form-control" name="gliderplane" id="gliderplane">';
								for($i=0;$i<count($gliders);$i++){
									if($gliders[$i][0]==$_POST["gliderplane"]){
										echo'<option value="'.htmlspecialchars($gliders[$i][0]).'" selected>'.htmlspecialchars($gliders[$i][1]).' '.htmlspecialchars($gliders[$i][2]).'</option>';
									}else{
										echo'<option value="'.htmlspecialchars($gliders[$i][0]).'">'.htmlspecialchars($gliders[$i][1]).' '.htmlspecialchars($gliders[$i][2]).'</option>';
									}
								}
								echo'
							</select>
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="rb"){
					echo'
					<tr class="hideme rb">
						<th class="text-right col-md-3">Towline Break Simulation:</th>
						<td>';
							if(isset($_POST["sim"])){
								echo'<input type="checkbox" name="sim" id="sim" checked> Check if simulated';
							}else{
								echo'<input type="checkbox" name="sim" id="sim"> Check if simulated';
							}echo'
						</td>
					</tr>';
				}echo'
				<tr class="hideme soar pr at rb">
					<th class="text-right col-md-3">Takeoff time:</th>
					<td>';
						if(isset($_POST["takeoff"])){
							echo'<input class="form-control" type="time" name="takeoff" id="takeoff" value="'.htmlspecialchars($_POST["takeoff"]).'">';
						}else{
							echo'<input class="form-control" type="time" data-field="time" name="takeoff" id="takeoff">';
						}echo'
					</td>
				</tr>
				<tr class="hideme soar pr at rb">';
					include 'php/newsheet_get_tlanding.php';
					echo'
					<th class="text-right col-md-3">Engined Plane Landing time:</th>
					<td>';
						if($_POST["tlanding"]!=""){
							echo'<input class="form-control" type="time" name="tlanding" id="towlanding" value="'.htmlspecialchars($_POST["tlanding"]).'">';
						}else{
							echo'<input class="form-control" type="time" name="tlanding" id="towlanding">';
						}echo'
					</td>
				</tr>';
				if($_POST["svctype"]=="soar"||$_POST["svctype"]=="rb"||$_POST["svctype"]=="at"){
					echo'
					<tr class="hideme soar at rb">';
						include 'php/newsheet_get_glanding.php';
						echo'
						<th class="text-right col-md-3">Glider Landing time:</th>
						<td>';
							if($_POST["glanding"]!=""){
								echo'<input class="form-control" type="time" name="glanding" id="gliderlanding" value="'.htmlspecialchars($_POST["glanding"]).'">';
							}else{
								echo'<input class="form-control" type="time" name="glanding" id="gliderlanding">';
							}echo'
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="soar"){
					echo'
					<tr class="hideme soar">
						<th class="text-right col-md-3">Release Altitude (ft):</th>
						<td>';
							if(isset($_POST["altitude"])){
								echo'<input class="form-control" type="text" name="altitude" id="altitude" value="'.htmlspecialchars($_POST["altitude"]).'">';
							}else{
								echo'<input class="form-control" type="text" name="altitude" id="altitude">';
							}echo'
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="at"){
					echo'
					<tr class="hideme at">
						<th class="text-right col-md-3">Miles:</th>';
						if(isset($_POST["miles"])){
							echo'<td><input class="form-control" type="text" name="miles" id="miles" value="'.htmlspecialchars($_POST["miles"]).'"></td>';
						}else{
							echo'<td><input class="form-control" type="text" name="miles" id="miles"></td>';
						}echo'
					</tr>
					<tr class="hideme at">
						<th class="text-right col-md-3">Pickup:</th>';
						if(isset($_POST["pickup"])){
							echo'<td><input  class="form-control" type="text" name="pickup" id="pickup" value="'.htmlspecialchars($_POST["pickup"]).'"></td>';
						}else{
							echo'<td><input class="form-control" type="text" name="pickup" id="pickup"></td>';
						}
					echo'</tr>';
				}
				echo'
				<tr class="hideme soar at rb pr">
					<th class="text-right col-md-3">Comments:</th>
					<td>';
						if(isset($_POST["comment"])){
							echo'<textarea class="form-control" name="comment" rows="4"  value="'.htmlspecialchars($_POST["comment"]).'"></textarea>';
						}else{
							echo'<textarea class="form-control" name="comment" rows="4"></textarea>';
						}echo'
					</td>
				</tr>';
				if($_POST["svctype"]=="soar"){
					echo'
					<tr class="hideme soar">
						<th class="text-right col-md-3">Penalty: $</th>
						<td>';
							if(isset($_POST["penalty"])){
								echo'<input class="form-control" type="text" name="penalty" id="penalty" value="'.htmlspecialchars($_POST["penalty"]).'">';
							}else{
								echo'<input class="form-control" type="text" name="penalty" id="penalty">';
							}echo'
						</td>
					</tr>';
				}
				if($_POST["svctype"]=="soar"){
					echo'
					<tr class="hideme soar at rb pr">
						<th class="text-right col-md-3">Total Cost: $</th>
						<td><input class="form-control" type="text" name="cost" value="'.htmlspecialchars((($_POST["cost"]/100)+(float)$_POST["penalty"])).'"></td>
					</tr>';
				}else if($_POST["svctype"]=="pr"){
					echo'
					<tr class="hideme soar at rb pr">
						<th class="text-right col-md-3">Total Cost: $</th>
						<td><input class="form-control" type="text" name="cost" value="'.htmlspecialchars($_POST["cost"]).'"></td> 
					</tr>';
				}else if($_POST["svctype"]=="rb"){
					if(isset($_POST["sim"])){
						echo'
						<tr class="hideme soar at rb pr">
								<th class="text-right col-md-3">Total Cost: $</th>
								<td><input class="form-control" type="text" name="cost" value="'.(10).'">.00</td>
						</tr>';
					}else{
					echo'
						<tr class="hideme soar at rb pr">
								<th class="text-right col-md-3">Total Cost: $</th>
								<td><input class="form-control" type="text" name="cost" value="00">.00</td>
						</tr>';
					}
				}else if($_POST["svctype"]=="at"){
					echo'
					<tr class="hideme soar at rb pr">
							<th class="text-right col-md-3">Total Cost: $</th>
							<td><input class="form-control" type="text" name="cost" value="'.htmlspecialchars(($_POST["cost"]/100)).'"></td>
					</tr>';
				}
				if($_POST["svctype"]=="soar"){
					echo'
					<tr class="hideme soar at rb pr">
						<th class="text-right col-md-3">Outstanding Balance: $</th>
						<td><b>'.htmlspecialchars(((($_POST["cost"]/100)+(float)$_POST["penalty"])-$paid)).'<b></td>
					</tr>';
				}else if($_POST["svctype"]=="pr"){	
					echo'
					<tr class="hideme soar at rb pr">
						<th class="text-right col-md-3">Outstanding Balance: $</th>
						<td><b>'.htmlspecialchars(($_POST["cost"]-$paid)).'<b></td>
					</tr>';
				}else if($_POST["svctype"]=="rb"){
					echo'
					<tr class="hideme soar at rb pr">
							<th class="text-right col-md-3">Outstanding Balance:</th>';
							if(isset($_POST["sim"])){
								echo '<td><b>$'.htmlspecialchars((10-$paid)).'<b></td>'; 
							}else{
								echo'<td><b>$000.00<b></td>';
							}echo'
					</tr>';
				}else if($_POST["svctype"]=="at"){
					echo'
					<tr class="hideme soar at rb pr">
							<th class="text-right col-md-3">Outstanding Balance: $</th>
							<td><b>'.htmlspecialchars((($_POST["cost"]/100)-$paid)).'<b></td>
					</tr>';
				}
				echo'
			</table>
			<input type="hidden" name="id" value="'.htmlspecialchars(($_POST["id"])).'">';
	}
?>
