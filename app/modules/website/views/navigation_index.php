<nav class="navi-bar navbar-expand-lg navbar-light fixed-top">
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navbar" aria-controls="main_navbar" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>


	<div class="oclogo_mobile">
		<a class="" href="<?php echo site_url(''); ?>"><img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/ortigaslogo.png"></a>
	</div>

	<?php $request = str_replace(base_url(),'',current_url()); preg_match("/".substr(preg_quote($request,'/'),0,3)."/", $request, $url_current);  ?>

	<div class="container">
		<div class="oclogo">
			<a class="oclogo_img" href="<?php echo site_url(''); ?>">
				<img src="<?php echo getenv('UPLOAD_ROOT'); ?>data/images/ortigaslogo.png">
			</a>

			
	<div id="new_search" class='d-flex flex-row-reverse align-items-center'>
				<i class="nav_search_button fa fa-search" aria-hidden="true"></i>
				<div class="default_search mt-4">
					<div class="gsearch_inputs">
						<input class="form-control" type="text" aria-label="Search" id="keyword" placeholder="WHAT ARE YOU LOOKING FOR?" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''?>">
						<div class="global_search_filters mt-0">
							<span>
							<input type="radio" id="search_any" class="checkbox-round search_any" name="global_search_filter" value="search_any" checked/>
							<label for="search_any">Any</label>
							</span>
							<span>
							<input type="radio" id="search_properties" class="checkbox-round search_properties" name="global_search_filter" value="search_properties" />
							<label for="search_properties">Malls</label>
							</span>
							<span>
							<input type="radio" id="search_properties" class="checkbox-round search_properties" name="global_search_filter" value="search_properties" />
							<label for="search_properties">Properties</label>
							</span>
							<span>
							<input type="radio" id="search_articles" class="checkbox-round search_articles" name="global_search_filter" value="search_articles" />
							<label for="search_articles">Articles</label>
							</span>
							<span>
							<input type="radio" id="search_careers" class="checkbox-round search_careers" name="global_search_filter" value="search_careers"/>
							<label for="search_careers">Careers</label>
							</span>
						</div>
					</div>
				</div>				
				<button type="button" class="btn font-weight-bold mr-2" id="back_to_top_button">BACK TO TOP</button>
			</div>
			
			<div class="main_menu" id="main_navbar">
		<ul class="navbar-nav mr-auto">
			<?php 
				$navigations = $this->navigations_model->get_frontend_navigations(1); 
				foreach ($navigations as $key => $value) { ?>

					<li class="nav-item base_nav_li">		<!-- 	/** base_nav_actives remove 's' to show highlights **/ -->
						<a class="nav-link base_nav nav_estates <?php echo (substr($request,0,3) == substr($value->navigation_link,0,4)) ? 'base_nav_actives' : ''; ?>" href="<?php echo site_url($value->navigation_link); ?>">
							<span><?php echo $value->navigation_name; ?></span>
							<div class="botborder"></div>
						</a>
						<?php if($value->navigation_link == "estates"){ ?>

							<div class = "sub_menu_estates">
								<ul class = "ul_sub_menu_estates">
										<?php
										$estates = $this->estates_model
												->where('estate_deleted',0)
												->where('estate_status','Active')
												->order_by('estate_order', 'ASC')
												->find_all();

										if($estates){
											foreach ($estates as $key => $estate) { 
										?>		
											<li class="estate_links nav-item li_nav_estates_active<?php echo ($key==0) ? '' : '_list'; ?> img_link" data-img='<?php echo isset($estate->estate_thumb) ? $estate->estate_thumb : "ui/images/placeholder.png" ?>'>
													<a class="nav-link a_sub_menu_estates" href="<?php echo site_url('').'estates/'.$estate->estate_slug; ?>"><?php echo $estate->estate_name; ?></a>
														<div class = "sub_menu_categ sub_nav_estates_active<?php echo $key; ?>">
															
														<ul class="ul_sub_menu_categ">
															<li>
																<div class="img_holder">
																	<img class="lazy" data-src="<?php echo getenv('UPLOAD_ROOT').$estate->estate_thumb; ?>">
																</div>
															</li>
														<?php
															$fields = [ 'estate_id' => $estate->estate_id, 'group_by' => 'category_name', 'order_by' => 'category_order' ];
															$categories = $this->properties_model->get_properties($fields);
															if($categories){

																foreach ($categories as $key => $category) {
														?>
																<li class="li_sub_menu_categ" >
																	
																	<a class="nav-link a_sub_menu_categ" href="<?php echo site_url('').strtolower($category->category_name); ?>"><?php echo $category->category_name; ?></a>
																	<div class="sub_menu_properties">

																		<ul>
																			<?php
																				$fields = [ 'estate_id' => $estate->estate_id, 'category_id' => $category->category_id ];
																				$properties = $this->properties_model->get_properties($fields);
																				if($properties){
																					foreach ($properties as $key => $property) {
		
																						$section = strtolower(str_replace("Amenity","Amenities",$property->category_name));

																							$link = site_url('').$section.'/'.$property->property_slug;
																							$target = null;
																							
																			?>
																						<li class="nav-item img_link" data-img='<?php echo isset($property->property_thumb) ? $property->property_thumb : "ui/images/placeholder.png" ?>'>
																							<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>"><?php echo $property->property_name; ?></a>
																						</li>
																			<?php	
																					}//endforeach
																				}//ifproperties
																			?>
																		</ul>
																	</div>
																</li>
														<?php	
																}//endforeach  
																
															}//ifcategories
														?>
														</ul> 
														</div>
												</li>
												
										<?php } //endforeach ?>

												<li class="estate_links nav-item li_nav_estates_active_list img_link">

													<a class="nav-link a_sub_menu_estates" href="#">Explore by location</a>


													<div class = "sub_menu_categ sub_nav_estates_active<?php echo $key; ?>">
														
														<?php
													
														$locations = $this->locations_model->get_locations();
														if($locations){
														
														?>

														<ul class="ul_sub_menu_categ owl-carousel-style owl-carousel">
																
															<?php foreach ($locations as $key => $location) { 
																$location_name = str_replace(' ','-', strtolower($location->location_name));
																$link = site_url('location/').$location_name;
																$target = null;
															?>
																<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>">
																	<img src="<?php echo isset($location->location_image) ? getenv('UPLOAD_ROOT').$location->location_image : "ui/images/placeholder.png" ?>" />
																	
																	<span><?php echo $location->location_name; ?></span>
																</a>
												

															<?php }//endforeach ?>
																
															
														</ul> 
														<?php }//ifproperties ?>
													</div>

												</li>

										<?php }//ifestates ?>
								</ul>
							</div>
						

							<?php if($value->navigation_link == "residences" || $value->navigation_link == "malls" || $value->navigation_link == "offices"){ ?>
								<div class = "sub_menu_estates sub_menu_estates_categs">

									<ul class="ul_sub_menu_categ">
									<?php
										if($value->navigation_link == "residences"){ $category_id = 1; }
										if($value->navigation_link == "malls"){ $category_id = 2; }
										if($value->navigation_link == "offices"){ $category_id = 3; }

										$estates = $this->estates_model
										->where('estate_deleted',0)
										->where('estate_status','Active')
										->where('property_deleted',0)
										->where('property_status','Active')
										->where('property_category_id',$category_id)
										->join('properties', 'properties.property_estate_id = estates.estate_id')
										->order_by('estate_order','asc')
										->group_by('estate_id')
										->find_all(); 


										if($estates){
											foreach ($estates as $key => $estates) {
									?>
											<li class="li_sub_menu_categ" >
												
												<a class="nav-link a_sub_menu_categ" href="<?php echo site_url('').'estates/'.strtolower($estates->estate_slug); ?>"><?php echo $estates->estate_name; ?></a>
												<div class="sub_menu_properties">

													<ul>
														<?php
															$fields = [ 'estate_id' => $estates->estate_id, 'category_id' => $category_id ];
															$properties = $this->properties_model->get_properties($fields);
															if($properties){
																foreach ($properties as $key => $property) {
																	$section = strtolower(str_replace("Amenity","Amenities",$property->category_name));

																	$link = site_url('').$section.'/'.$property->property_slug;
																	$target = null;
																
														?>
																	<li class="nav-item img_link" data-img='<?php echo isset($property->property_thumb) ? $property->property_thumb : "ui/images/placeholder.png" ?>'>
																		<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>"><?php echo $property->property_name; ?></a>
																	</li>
														<?php	
																}//endforeach
															}//ifproperties
														?>
													</ul>
												</div>
											</li>
									<?php	
											}//endforeach
										}//ifcategories
									?>
									</ul> 
															
								</div>
							<?php } //ul_sub_menu_categ if ?> 

						<?php } 

						else{

						 if($value->navigation_link == "residences" || $value->navigation_link == "malls" || $value->navigation_link == "offices"){ ?>
							<div class = "sub_menu_estates">
								<ul class = "ul_sub_menu_estates">
										<?php
										if($value->navigation_link == "residences"){ $category_id = 1; }
										if($value->navigation_link == "malls"){ $category_id = 2; }
										if($value->navigation_link == "offices"){ $category_id = 3; }

										$estates = $this->estates_model
										->where('estate_deleted',0)
										->where('estate_status','Active')
										->where('property_deleted',0)
										->where('property_status','Active')
										->where('property_category_id',$category_id)
										->join('properties', 'properties.property_estate_id = estates.estate_id')
										->order_by('estate_order','asc')
										->group_by('estate_id')
										->find_all(); 

										if($estates){
											foreach ($estates as $key => $estate) { 
										?>		
											<li class="estate_links nav-item li_nav_estates_active<?php echo ($key==0) ? '' : '_list'; ?> img_link" data-img='<?php echo isset($estate->estate_thumb) ? $estate->estate_thumb : "ui/images/placeholder.png" ?>'>
													<a class="nav-link a_sub_menu_estates" href="<?php echo site_url('').'estates/'.$estate->estate_slug; ?>"><?php echo $estate->estate_name; ?></a>




														<div class = "sub_menu_categ sub_nav_estates_active<?php echo $key; ?>">
														
														<?php
														if($value->navigation_link == "residences"){ $cat_id = 1; $section = 'redidences'; }
														else if($value->navigation_link == "malls"){ $cat_id = 2; $section = 'malls';}
														else if($value->navigation_link == "offices"){ $cat_id = 3; $section = 'offices';}

														$fields = [ 'estate_id' => $estate->estate_id, 'category_id' => $cat_id ];
														$properties = $this->properties_model->get_properties($fields);
														if($properties){
															if(count($properties) >= 4){
																$onCarousel = "owl-carousel";
															}
														?>

														<ul class="ul_sub_menu_categ owl-carousel-style <?php echo $onCarousel; ?>">
																
															<?php foreach ($properties as $key => $property) { ?>
											
																<?php $link = site_url('').$value->navigation_link.'/'.$property->property_slug;
																$target = null; ?>
														
															
																<a class="nav-link" target="<?php echo $target; ?>" href="<?php echo $link; ?>">
																<img src="<?php echo isset($property->property_thumb) ? getenv('UPLOAD_ROOT').$property->property_thumb : "ui/images/placeholder.png" ?>" />
																
																<span><?php echo $property->property_name; ?></span>
																</a>

															<?php }//endforeach ?>
																
															
														</ul> 
														<?php }//ifproperties ?>
															
														</div>



												</li>


												
										<?php	
											} //endforeach
	
										}//ifestates
									?>
								</ul>
							</div>
						
						<?php }?>
						<?php }?>

					</li>
			<?php } ?>								
		</ul>

		
		<!-- <form class="form-inline my-2 my-lg-0 d-none">
			<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form> -->
	</div>


	<!-- <div class="nav_search_button">
			<i class="fa fa-search " aria-hidden="true"></i>
		</div>	 -->
		</div>	
	</div>

	

	<div id="global_search_container">
			<?php if( substr($request,0,3) != "sea"){ echo $this->load->view('website/global_search_index'); } ?>
	</div>

</nav>