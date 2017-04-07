 <style>
.scrollbox {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    height: 100px;
    overflow-y: scroll;
    width: 350px;
}

.scrollbox div.even {
    background: none repeat scroll 0 0 #FFFFFF;
}
.scrollbox div {
    padding: 3px;
}

.scrollbox div.odd {
    background: none repeat scroll 0 0 #E4EEF7;
}
 </style>
                <!-- start page title -->
                <div class="page-title">
                	<div class="in">
                    		<div class="titlebar">	<h2>BACKUP - RESTORE</h2></div>
                            <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->
                	<!-- START CONTENT -->
                    <div class="content">
						<div class="grid360-left"  style="z-index: 420;width:740px;">
	                        
	                            		<!-- start statistics codes -->
	                                    <div class="simplebox" style="z-index: 410;">
	                                    	<div class="titleh" style="z-index: 400;"><h3 style="float:left;">Backup - Restore</h3>
	                                    	</div>
	                                        <div class="body" style="z-index: 390;padding:10px;">
	                                        <?php if($this->session->flashdata('success')){?>
										        <div class="albox succesbox" style="z-index: 690;">
				                                	<b>Succes :</b> <?php echo $this->session->flashdata('success'); ?>
				                                	<a class="close tips" href="#" original-title="close">close</a>
				                                </div>
											<?php } ?>
											<?php if($this->session->flashdata('error')){?>
										        <div class="albox errorbox" style="z-index: 690;">
				                                	<b>Succes :</b> <?php echo $this->session->flashdata('error'); ?>
				                                	<a class="close tips" href="#" original-title="close">close</a>
				                                </div>
											<?php } ?>
											<?php if($this->session->flashdata('warning')){?>
										        <div class="albox warningbox" style="z-index: 690;">
				                                	<b>Succes :</b> <?php echo $this->session->flashdata('warning'); ?>
				                                	<a class="close tips" href="#" original-title="close">close</a>
				                                </div>
											<?php } ?>

	                                			<form action="<?php echo $restore; ?>" method="post" enctype="multipart/form-data" id="restore">
											        <table class="form" style="margin-bottom:20px;" >
											          <tr>
											            <td style="width:150px;">Restore</td>
											            <td><input style="width:250px;" type="file" name="import" /></td>
											          </tr>
											        </table>
											      </form>
											      <form action="<?php echo $backup; ?>" method="post" enctype="multipart/form-data" id="backup">
											        <table class="form">
											          <tr>
											            <td style="width:150px;">Backup</td>
											            <td><div class="scrollbox" style="margin-bottom: 5px;">
											                <?php $class = 'odd'; ?>
											                <?php foreach ($tables as $table) { ?>
											                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
											                <div class="<?php echo $class; ?>">
											                  <input type="checkbox" name="backup[]" value="<?php echo $table; ?>" checked="checked" />
											                  <?php echo $table; ?></div>
											                <?php } ?>
											              </div>
											              <a onclick="$(this).parent().find(':checkbox').attr('checked', true);">Check All</a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);">Uncheck All</a></td>
											          </tr>
											          <tr>
												          <td></td>
												          <td>
													          <button class="btn" onclick="$('#restore').submit();" type="button">Restore</button>
													          <button class="btn" onclick="$('#backup').submit();" type="submit">Backup</button>
												          </td>
											          </tr>
											        </table>
											      </form>
	                                        </div>
	                                    </div>
	                            		<!-- end statistics codes -->
	                     </div>
	                    <div style="clear:both;"></div>         
                    </div>