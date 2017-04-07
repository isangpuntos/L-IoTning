 <!-- start page title -->
<div class="page-title">
     <div class="in">
         <div class="titlebar">	<h2>CONTENT MANAGER</h2>	<p>You can selected subscribers to send newsletter</p></div>
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
                        	  <a id="check_all" href="javascript:;" class="icon-button editbutton">Select All</a>
                        	  <input type="hidden" id="check" value="0">
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
							<form action="<?php echo base_url().index_page(); ?>/cpanel/action_sendmailtemplate/" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm" autocomplete="off" style="width:100%;">
							<table cellpadding="0" cellspacing="0" border="0" class="display data-table" id="example">             
								<thead>
									<tr>
                                    	<th class="" rowspan="1" colspan="1" style="width: 10px;"></th>
					                    <th class="" rowspan="1" colspan="1" style="width: 100px;">Email</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Group</th>
					                    <th class="" rowspan="1" colspan="1" style="width: 70px;">Created Date</th>
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
				                        <td style="text-align:center;" class=" sorting_1"><input type="checkbox" name="<?php if ($item['group']!="Subscriber") {?>check_u[]<?php }else {?>check[]<?php }?>" id="check<?php echo $item['id']; ?>" class="checkboxes" value="<?php echo $item['id']; ?>" /></td>
				                        <td><?php echo $item['email']; ?></td>                  
				                        <td style="text-align:center;"><?php echo $item['group']; ?></td>
				                        <td style="text-align:center;"><?php echo isset($item['date'])?my_int_date($item['date']):''; ?></td>
				                    </tr>
						           <?php }?>     
								</tbody>
							</table>
							<div style="margin-top:15px;">
							<a href="<?php echo base_url(); ?>backend.php/cpanel/newslettermanager" class="button-gray" style="float:left;">&laquo; Back</a>
							<a onclick="send_form();" href="javascript:;" class="icon-button editbutton" style="width:200px;float:left;margin-left:10px;"><span>SEND NEWSLETTER OUT</span></a>
							
                            <input type="submit" value="send" name="send" id="bt_send" style="display: none;" />
                            <input type="hidden" value="<?php echo $id;?>" name="currentid" />
                            </div>
                            </form>
                        </div>
</div>
  <!-- END CONTENT -->
  <!-- START TABLE -->
<script>
    function send_form(){
        document.getElementById('bt_send').click();
    };
    $('#check_all').click(function() {
        var checkboxes = $('#adminForm').find('.checkboxes');
        if($("#check").val()=="0") {
            checkboxes.attr('checked', 'checked');
            $("#check").val("1");
        } else {
            checkboxes.removeAttr('checked');
            $("#check").val("0");
        }
    });



</script>