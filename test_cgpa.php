<div id="qualification" class="tab-pane fade">	
							<h3>Academic Qualification</h3>
							<div class="border rounded m-2 p-2 border-secondary" id="">
								<?php
								for($i=1; $i<=$_POST['add_rows_id']; $i++){
								?>
								<div id="add_rows_length" class="row">
									<div class="col-md-2" >
										<div class="row">
											<div class="col-md-12">
												<?php echo $i; ?>.
												<label >Name Of Examination </label>
												<select name="part_desc<?php echo $i; ?>" id="part_desc<?php echo $i; ?>" onBlur="tab_fill(1,8)" onFocus="getCurrent(<?php echo $i; ?>)" >
												<option value="<?php echo isset($_POST['part_desc'.$i])?$_POST['part_desc'.$i] :''; ?>" selected><?php if(isset($_POST['part_desc'.$i.''])){echo $_POST['part_desc'.$i.''];} ?></option>
											   
												<option value="B.Ed">B.Ed</option>
												<?php
													$sql = 'select * from class_detail order by sort_no, year';
													$result = execute_query($sql,$db);
													if($result){
														while($name = mysqli_fetch_array($result)){
															echo '<option value="'.$name['sno'].'" ';
															echo '>'.$name['class_description'].'</option>';
														}
													}
													?>
												</option>
											</select>										
											</div>
										</div>
										<div class="row">
											<div class="col-md-6" <?php echo $display_desc; ?> id="description_<?php echo $i; ?>">
												<label >Description</label>
												<input type="text" name="qual_description_<?php echo $i; ?>" id="qual_description_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_description_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
											</div>
											<div class="col-md-6" <?php echo $display_desc; ?> id="description_subject_<?php echo $i; ?>">
												<label >Subjects</label>
												<input type="text" name="qual_description_sub_<?php echo $i; ?>" id="qual_description_sub_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_description_sub_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
											</div>
										</div>
																		
									</div>
									<div class="col-md-2">									
										<label ><strong>College/ School Name</strong></label>
										<input type="text" name="qual_college_name_<?php echo $i; ?>" id="qual_college_name_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_college_name_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
									</div>
									<div class="col-md-1">									
										<label >Board/ University</label>
										<input type="text" name="qual_board_name_<?php echo $i; ?>" id="qual_board_name_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_board_name_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
									</div>
									<div class="col-md-1">									
										<label >Roll No.</label>
										<input type="text" name="qual_roll_number_<?php echo $i; ?>" id="qual_roll_number_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_roll_number_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
									</div>
									<div class="col-md-1">									
										<label >Year of Passing</label>
										<input type="text" name="qual_year_<?php echo $i; ?>" id="qual_year_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_year_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
									</div>

									<div class="col-md-3">									
										<div class="row">
											<div class="col-md-12">
												<label >Percentage/ CGPA</label>
												<select name="cgpa_percent_<?php echo $i; ?>" id="cgpa_percent_<?php echo $i; ?>" class="form-control" tabindex="<?php echo $tab++; ?>" onChange="cgpa_show(<?php echo $i; ?>);">
													<option value="">--Select--</option>
													<option value="cgpa" <?php if($_POST['cgpa_percent_'.$i]=='cgpa'){ echo ' selected="selected" ';}?>>CGPA</option>
													<option value="percentage" <?php if($_POST['cgpa_percent_'.$i]=='percentage'){ echo ' selected="selected" ';}?>>Percentage</option>
												</select>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12" id="cgpa_<?php echo $i; ?>"  <?php if($_POST['cgpa_percent_'.$i]=='percentage'){ echo ' style="display: none;" ';}?>>
												<label >Obtained CGPA</label>
												<input type="text" name="qual_percentage_<?php echo $i; ?>" id="qual_percentage_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_percentage_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
											</div>

											<div class="col-md-6" id="percent_tot_<?php echo $i; ?>"  <?php if($_POST['cgpa_percent_'.$i]=='cgpa'){ echo ' style="display: none;" ';}?>>									
												<label >Total Marks</label>
												<input type="text" name="qual_total_marks_<?php echo $i; ?>" id="qual_total_marks_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_total_marks_'.$i]; ?>" tabindex="<?php echo $tab++; ?>">									
											</div>
											<div class="col-md-6" id="percent_obt_<?php echo $i; ?>"  <?php if($_POST['cgpa_percent_'.$i]=='cgpa'){ echo ' style="display: none;" ';}?>>									
												<label >Obtained Marks</label>
												<input type="text" name="qual_obtained_marks_<?php echo $i; ?>" id="qual_obtained_marks_<?php echo $i; ?>" class="form-control" placeholder="" value="<?php echo $_POST['qual_obtained_marks_'.$i]; ?>" tabindex="<?php echo $tab++; ?>" >									
											</div>
										</div>
									</div>
									<div class="col-md-1 d-flex justify-content- align-items-center">
										<button type="button" id="add_button" class="btn btn-info pull-right" onClick="add_rows()">Add</button>
									</div>
								</div>
								<?php } ?>
								<div id="test"></div>
								<input type="hidden" name="add_rows_id" id="add_rows_id" value="<?php echo $_POST['add_rows_id']; ?>">
							</div>
						</div>