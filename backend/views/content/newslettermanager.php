 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>NEWSLETTER MANAGER</h2>	<p>Newsletter manager</p></div>
         <div class="clear"></div>
     </div>
</div>
 <!-- end page title -->

  <!-- START CONTENT -->
<div class="content">
 <div class="simplebox grid740" style="margin:0 auto;">
 						
                        <?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Succes :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
							<?php if($this->session->flashdata('message_error')){?>
						      	<div class="albox errorbox" style="z-index: 670;">
                                	<b>Error :</b> <?php echo $this->session->flashdata('message_error'); ?> 
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
                        	<div class="titleh">
                        	  <div class="shortcuts-icons-button" style="z-index: 450;">
                            	<a class="icon-button editbutton" href="<?php echo base_url();?>backend.php/cpanel/editnewsletter"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create.png"><span>Create a New Newsletter</span></a>
                            </div>
                        	                            
                            </div>
                            
                            
                            <!-- Start Data Tables Initialisation code -->
							<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
    								oTable = $('#example').dataTable({
        							"bJQueryUI": true,
        							"sPaginationType": "full_numbers"
        							});
    							} );
    						</script>
                            <!-- End Data Tables Initialisation code -->
			
							<table cellpadding="0" cellspacing="0" border="0" class="display data-table" id="example">             
								<thead>
									<tr>
                                    	<th class="" rowspan="1" colspan="1" style="width: 10px;">ID</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Title</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Template</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Created Date</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 120px;">Action</th>
                                    </tr>
                               	</thead>
                                <tbody>
                                 <?php
									$i=0;
									foreach($banners as $item)
									{
									$i++;
									?>
									 <tr class="<?php if($i%2==0) {?>odd <?php } else {?>even<?php }?>">
				                        <td style="text-align:center;" class=" sorting_1"><?php echo $i; ?></td>
				                        <td><?php echo $item['title']; ?></td>    
				                        <td style="text-align:center;"><?php echo $item['template']; ?></td>                  
				                        <td style="text-align:center;"><?php echo my_int_date($item['date_created']); ?></td>
				                        <td class="center" style="text-align:center;">
				                            <?php if($item['type']!=6) {?>
				                            <a class="icon-button tips button-form" href="<?php echo base_url(); ?>backend.php/cpanel/editnewsletter/<?php echo $item['id']; ?>" original-title="Edit"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"></a>
				                            <?php } else {?>
				                             <a class="icon-button tips button-form" href="<?php echo base_url(); ?>backend.php/cpanel/selectsubscribers/<?php echo $item['id']; ?>" original-title="Send"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/mail.png"></a>
				                            <a class="icon-button tips button-form" href="<?php echo base_url(); ?>backend.php/cpanel/editnewsletter/<?php echo $item['id']; ?>" original-title="Edit"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/create1.png"></a>
						                    <a class="icon-button tips button-form" title="[Delete]" href="javascript:;" onclick="if(confirm('Do you want to delete it?')) document.location.href='<?php echo base_url(); ?>backend.php/cpanel/deletenewsletter/<?php echo $item['id']; ?>'" original-title="Delete"><img width="18" height="18" alt="icon" src="<?php echo base_url(); ?>assets/backend/img/icons/button/delete.png"></a>
						                    <?php }?>
				                        </td>
				                    </tr>
						           <?php }?>     
								</tbody>
							</table>
                        </div>
</div>
  <!-- END CONTENT -->