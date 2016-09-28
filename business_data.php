
<?php $this->load->view('header.php');?>
<script>
$(window).load(function() {   
  $('#loader').hide();
  $('#dataaTable').show('slow','linear');
});
</script>

<style>
thead select {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
		background-color:#ea4b4b !important;
		color:white !important;
		
		
    }
#dataaTable { display:none }

</style>
                    
                    <!-- BEGIN PAGE HEADER-->
                    <h3 class="page-title"> Business Projects </h3>
                    <div class="page-bar">
                      <ul class="page-breadcrumb">
                        <li> <i class="fa fa-home"></i> <a href="<?php echo "site_url();"?>">Home</a> <i class="fa fa-angle-right"></i> </li>
                        <li> Business Projects </li>
                      </ul>
                      
                    </div>
                    <!-- END PAGE HEADER--> 
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                      <div class="col-md-12"> 
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue-hoki">
                          <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-briefcase"></i>Business Projects </div>
                            <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="remove"> </a> </div>
                          </div>
                          <div class="portlet-body">
                            <div class="table-toolbar">
                            	<?php
                                  	if(isset($_GET['msg']))
									  { 
										echo '<div class="alert alert-success alert-dismissable">  
												<a class="close" data-dismiss="alert">×</a>  
												Business Project Added Successfully.  
											  </div>';
									  }
								  ?>
                                  <?php
                                  	if(isset($_GET['upt']))
									  { 
										echo '<div class="alert alert-success alert-dismissable">  
												<a class="close" data-dismiss="alert">×</a>  
												Business Project Updated Successfully.  
											  </div>';
									  }
								  ?>
                                  <?php
                                  	if(isset($_GET['del']))
									  { 
										echo '<div class="alert alert-success alert-dismissable">  
												<a class="close" data-dismiss="alert">×</a>  
												Business Project Deleted Successfully.  
											  </div>';
									  }
								  ?>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="btn-group">
                                    <a href="<?php echo base_url();?>complaint/add_business_project" id="sample_editable_1_new" class="btn green-meadow"> 
                                    	 New Business Project
                                        <i class="fa fa-plus"></i> 
                                    </a>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  
                                </div>
                              </div>
                            </div>
                        <div class="portlet-body flip-scroll">
						
						<div id="loader" ><h3>Loading Data. Please Wait....</h3></div>
						
                             <table class="table table-striped table-bordered table-hover flip-content " id="dataaTable">
                              <thead class="bg-grey-cascade">
                                <tr>
                                  <!--<th> 	</th>-->
                                  <th>  					</th>
                                  <th>  				</th>
                                  <th>  				</th>
                                  <th> 			</th>
                                  <th>  	</th>
                                  <th> 			</th>
                                  <th> 		</th>
                                  <th> 			</th>
                                  <th> 		</th>
                                  <th> 	</th>
								  <th> 	</th>
								  <th> 	</th>
								  <th> 		</th>
                                  <th> 	</th>
								  <th> 	</th>
								  <th> 	</th>
								<!--  <th> 	</th>
								  <th> 	</th> -->
                                  <!--<th> Dead Line 					</th>-->
                                </tr>
                             
                                <tr>
                                  <!--<th> Territory 				</th>-->
                                  <th> City 					</th>
                                  <th> Customer 				</th>
                                  <th> Area 				</th>
                             <!--     <th> Department 			</th> -->
                                  <th> Sales Person 	</th>
                                  <th> Date 			</th>
                                  <th> Project Type		</th>
                                  <th> Category		</th>
                                  <th> Project Description			</th>
                                  
                                  <th> Last Visit </th>
                                  <th> Visits </th>
                                 <!-- <th> Strategy Date</th> -->
								  <th> Target Date </th>
								  <th> Strategy </th>
								  <th> Tactics </th>
								  <th> Investment </th>
								  <th> Sales/Month </th>
                                  
								  <th> Actions	</th>
                                  <!--<th> Dead Line 					</th>-->
                                </tr>
                              </thead>
                              <tbody>
                                <?php
								
								$dbres = $this->db->query("
								SELECT 
								business_data.*, 
								COALESCE(tbl_cities.city_name) AS city_name,
								COALESCE(tbl_clients.client_name) AS client_name,
								COALESCE(tbl_area.area) AS area,
								COALESCE(user.first_name) AS first_name,
								COALESCE(tbl_business_types.businesstype_name) AS businesstype_name 
								
								FROM business_data 
								
								LEFT JOIN tbl_cities ON business_data.City = tbl_cities.pk_city_id 
								LEFT JOIN tbl_area ON business_data.Area = tbl_area.pk_area_id 
								LEFT JOIN tbl_clients ON business_data.Customer = tbl_clients.pk_client_id 
								LEFT JOIN user ON business_data.`Sales Person` = user.id 
								LEFT JOIN tbl_business_types ON business_data.`Business Project`  = tbl_business_types.pk_businesstype_id 
								
								WHERE business_data.status='0'");
								$business_dataa	=	$dbres->result_array();
									  if (sizeof($business_dataa) == "0") { // $business_data if you want to fetch from model
										  
									  } else {
										  foreach ($business_dataa as $my_business_data) {
											  ?>
											  <tr class="<?php if($my_business_data['priority']==1){ echo "danger even";} else { echo "odd gradeX";}?>">
                                                  <!--
												  <td>
                                                      <?php 
													  /*
													  $ty=$this->db->query("select * from tbl_offices where pk_office_id='".$my_business_data["Territory"]."'");
													  if($ty->num_rows()>0)
													  {
													  $rt=$ty->result_array();
													  echo $rt[0]["office_name"]; 
													  }*/ ?>
												  </td>
												  -->
												  <td> <!-- tbl_cities.pk_city_id = business_data.City ... city_name -->
                                                      <?php /*
													  $ty=$this->db->query("select * from tbl_cities where pk_city_id='".$my_business_data["City"]."'");
													  if($ty->num_rows()>0)
													  {
													  $rt=$ty->result_array();
													  echo $my_business_data["city_name"]; 
													  } */
													  echo $my_business_data["city_name"];  
													  ?>
												  </td>
                                                  <td> <!-- tbl_clients.pk_client_id = business_data.Customer ... client_name -->
													  <?php 
													  /*$ty=$this->db->query("select * from tbl_clients where pk_client_id='".$my_business_data["Customer"]."'");
													  if($ty->num_rows()>0)
													  {
													  $rt=$ty->result_array();
													  echo $my_business_data["client_name"]; 
													  }*/
													  echo $my_business_data["client_name"]; 
													  ?> 
												  </td>
												  
                                                  <td> <!-- tbl_area.pk_area_id = business_data.Area ... area -->
                                                      <?php 
													  // $ty=$this->db->query("select * from tbl_area where pk_area_id='".$my_business_data["Area"]."'");
													  // if($ty->num_rows()>0)
													  // {
													  // $rt=$ty->result_array();
													  // echo $my_business_data["area"]; 
													  // }
													  echo $my_business_data["area"]; 
													  ?> 
												  </td>
                                         <!--         <td>
													  <?php echo $my_business_data["Department"] ?>
												  </td> -->
                                                   <td> <!-- user.id = business_data.`Sales Person` ... first_name -->
                                                      <?php 
													  // $ty=$this->db->query("select * from user where id='".$my_business_data["Sales Person"]."'");
													  // if($ty->num_rows()>0)
													  // {
													  // $rt=$ty->result_array();
													  // echo $my_business_data["first_name"]; 
													  // }
													  echo $my_business_data["first_name"]; 
													  ?> 
												  </td>
												  <td>
													  <?php echo date('d-M-Y', strtotime($my_business_data["Date"])); ?>
												  </td>
												  <td>
													  <?php echo $my_business_data["project_type"]; ?>
												  </td>
                                                  <td> <!-- tbl_business_types.pk_businesstype_id = business_data.Business Project.. businesstype_name-->
                                                       <?php 
													  // $ty=$this->db->query("select * from tbl_business_types where pk_businesstype_id='".$my_business_data["Business Project"]."'");
													  // if($ty->num_rows()>0)
													  // {
													  // $rt=$ty->result_array();
													  // echo $my_business_data["businesstype_name"]; 
													  // }
													  echo $my_business_data["businesstype_name"]; 
													  ?>
												  </td>
												  
                                                  <td>
													  <?php echo $my_business_data["Project Description"] ?>
												  </td>
                                                  
                                                  
                                                  <td>
                                                  	<?php 
													  $ty=$this->db->query("select * from tbl_dvr 
													  where fk_business_id='".$my_business_data["pk_businessproject_id"]."' ORDER BY  `pk_dvr_id` DESC ");
													  if($ty->num_rows()>0)
													  {
													  $rt=$ty->result_array();
													  //echo $rt[0]["date"];
													  echo date('d-M-Y', strtotime($rt[0]["date"])); 
													  }?>
												  </td>
                                                  <td>
                                                  	<?php 
													  
													  echo $ty->num_rows(); 
													  ?>
												  </td>
												  
												  <!----- Below Four are for strategy --------->
												   <?php $strategy_date = "";
														$strategy_target = "";
														$strategyy = "";
														$tactics = "";
														$investment = "";
														$sales_per_month = "";
														$q = $this->db->query("SELECT * FROM tbl_project_strategy WHERE fk_project_id='".$my_business_data['pk_businessproject_id']."' AND strategy_status='1' ORDER BY `date` DESC");
														$strategies = $q->result_array();
														
														if (sizeof($strategies)>0) {
															if ($strategies[0]["date"]!="0000-00-00")
																$strategy_date = date('d-M-Y',strtotime($strategies[0]["date"]));
															if ($strategies[0]["target_date"]!="0000-00-00")
																$strategy_target = date('d-M-Y',strtotime($strategies[0]["target_date"]));
															$strategyy = urldecode($strategies[0]["strategy"]);
															$tactics = urldecode($strategies[0]["tactics"]);
															$investment = $strategies[0]["investment"];
															$sales_per_month = $strategies[0]["sales_per_month"];
														}
												  ?>
												  <!--
												  <td >
                                                  	<?php 
														if (sizeof($strategies)>0) {
															echo '<table class="table-bordered table-condesnsed">';
															foreach($strategies AS $strategy) {
																echo '<tr>';
																echo '<td>'.date('d-M-Y',strtotime($strategy["date"])).'</td>'; 
																if ($strategy["target_date"] != '0000-00-00') 
																	echo '<td>'.date('d-M-Y',strtotime($strategy["target_date"])).'</td>'; 
																else echo '<td></td>';
																	echo '<td>'.urldecode($strategy["strategy"]).'</td>'; 
																	echo '<td>'.$strategy["investment"].'</td>'; 
																	echo '<td>'.$strategy["sales_per_month"].'</td>'; 
																echo '</tr>';
															}
															echo '</table>';
														}
													?>
												  </td>
												  -->
												  
											<!--	  
												  <td>
                                                  	<?php echo $strategy_date; ?>
												  </td>
												  -->
                                                  <td>
                                                  	<?php echo $strategy_target ; ?>
												  </td>
												  <td>
                                                  	<?php echo $strategyy; ?>
												  </td>
												  <td>
                                                  	<?php echo $tactics; ?>
												  </td>
												  <td>
                                                  	<?php echo $investment; ?>
												  </td>
												  <td>
                                                  	<?php echo $sales_per_month; ?>
												  </td>
                                                  
                                                  <td>
												  <div class="btn-group-vertical btn-group-solid">
                                                  	<a class="btn btn-sm default green-meadow-stripe" 
                                                    href="<?php echo base_url();?>complaint/update_business_project/<?php echo $my_business_data["pk_businessproject_id"];?>">
                                                    	Update <i class="fa fa-edit"></i>
                                                    </a>
													<a class="btn btn-sm default purple-stripe" 
                                                    href="<?php echo base_url();?>complaint/add_strategy/<?php echo $my_business_data["pk_businessproject_id"];?>">
                                                      	Strategy &nbsp;<i class="fa fa-eye"></i>
                                                    </a>
													<a class="btn btn-sm default blue-stripe" 
                                                    href="<?php echo base_url();?>complaint/strategy_history/<?php echo $my_business_data["pk_businessproject_id"];?>">
                                                      	Strategy History &nbsp;<i class="fa fa-eye"></i>
                                                    </a>
													<a class="btn btn-sm default blue-hoki-stripe" 
                                                    href="<?php echo base_url();?>complaint/details_business_project/<?php echo $my_business_data["pk_businessproject_id"];?>">
                                                      	Details &nbsp;<i class="fa fa-eye"></i>
                                                      </a>
													<!--  
                                                    <a class="btn btn-sm default red-thunderbird" onClick="return confirm('Are you sure you want to delete?')" 
                                                      href="<?php echo base_url();?>complaint/delete_business_project/<?php echo $my_business_data["pk_businessproject_id"];?>">
                                                      	Delete &nbsp;&nbsp;<i class="fa fa-trash-o"></i>
                                                      </a>
													 --> 
													<a href="#" id="sample_editable_1_new" class="btn btn-sm default red-thunderbird-stripe" data-toggle="modal" data-target="#myModal<?php echo $my_business_data["pk_businessproject_id"];?>" > 
														Delete
														<i class="fa fa-trash-o"></i> 
													</a>
													</div>
													
													<!-- Modal -->
							<div id="myModal<?php echo $my_business_data["pk_businessproject_id"];?>" class="modal fade" role="dialog">
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Delete Project</h4>
								  </div>
								  <div class="modal-body">
								  <!-- Modal from Metronics -->
								   <form action="<?php echo base_url();?>complaint/delete_business_project/<?php echo $my_business_data["pk_businessproject_id"];?>" class="form-horizontal" method="post">
								   
                                    <div class="form-group row">
									<label class="col-md-3 control-label">Result</label>
									<div class="col-md-9">
									<select id="result" name="result" class="form-control" required>
                                        <option value="">--Choose--</option>
                                        <option value="Won" >Won</option>
                                        <option value="Lost" >Lost</option>
                                        <option value="Discarded" >Discarded</option>
                                    </select> 
									</div>
									</div>
                                    
									<input type="hidden" name="fk_complaint_id" value="<?php //echo $this->uri->segment(3);?> ">
                    
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-8 col-md-4">
                                                        <input type="hidden" name="complaint_id" value="<?php //echo $this->uri->segment(3);?>" />
                                                        <button type="submit" class="btn red-thunderbird" >
                                                        	Delete
                                                        </button>
                                                <!--        <button type="button" class="btn default" data-dismiss="modal">Cancel</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    </div>
            					</form>
								  <!-- Form End -->
						
								  </div>
								  
								</div>

							  </div>
							</div>
                        <!-- End Modal -->
                                                      
                                                  	
												  </td>
                                                  <!--<td>
													  <?php echo $my_business_data["Date"] ?>
												  </td>-->
                                                  
                                                  
											  </tr>
											  <?php
										  }
									  }
                              ?>
                                
                              </tbody>
                            </table>
                                      </div>
                          </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET--> 
                      </div>
                    </div>
      				<!-- END PAGE CONTENT-->
                    
                    
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
       
        <!-- END CONTAINER -->
        <?php $this->load->view('footer.php');?>
        
         <script>
		 
		 $(document).ready(function() { 
			var table = $('#dataaTable').dataTable({
			  'iDisplayLength': 1000,
			  'order': [[ 6, "desc" ]]
			}).columnFilter({ sPlaceHolder: "head:before",
					aoColumns: [ 	{type: "text" },
					            { type: "text" },
								{ type: "text" },
								{ type: "text" },
								{ type: "text" },
								{ type: "text" },
				    	 		{ type: "text" },
								{ type: "text" },
								{ type: "text" },
                                { type: "text" },
								{ type: "text" },
								{ type: "text" },
								{ type: "text" },
                                { type: "text" },
								{ type: "text" },
								null
						]

		});
});
/*
$(document).ready(function(){
     $('#dataaTable').dataTable()
		  .columnFilter({ sPlaceHolder: "head:before",
					aoColumns: [ 	{type: "text" },
					            { type: "text" },
								{ type: "text" },
								{ type: "text" },
								{ type: "text" },
								{ type: "text" },
				    	 		{ type: "text" },
								{ type: "text" },
								{ type: "text" },
                                { type: "text" },
								{ type: "text" },
								null
						]

		});
});
*/
</script>
		
