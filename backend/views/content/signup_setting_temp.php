<link href="<?php echo base_url();?>assets/signup/css/custom.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/signup/js/jquery.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/jquery_003.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/jquery_005.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/jquery_002.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/jquery_004.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/drag-drop-custom.js"></script>
<script src="<?php echo base_url();?>assets/signup/js/jquery.blockUI.js"></script>

<script>
	$(function() {
		$( "#sortable" ).sortable({
			revert: true
		});
		$( "#draggable" ).draggable({
			connectToSortable: "#sortable",
			helper: "clone",
			revert: "invalid"
		});
		$( "ul, li, table" ).disableSelection();
	});
	</script>
  <!-- START CONTENT -->
<div class="content">
<?php if($this->session->flashdata('message')){?>
						        <div class="albox succesbox" style="z-index: 690;">
                                	<b>Succes :</b> <?php echo $this->session->flashdata('message'); ?>
                                	<a class="close tips" href="#" original-title="close">close</a>
                                </div>
							<?php } ?>
<div class="simplebox grid740" style="z-index: 720;margin:0 auto;">
                            	<div class="titleh" style="z-index: 710;">
                                	<h3>Paypal Setting</h3>
                                </div>
                                <div class="body" style="z-index: 690;">
<div id="global_content_wrapper">
            <div id="global_content">
                <table><tr><td valign="top" >
                <!-- LEFT MENU -->
                <ul class="tablist">
                    <li id="tab_title">
                        <img src="<?php echo base_url();?>assets/signup/images/image.png"/> Title
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">New Title</td><td></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Title</label>
                                    <input type="text" value="New Title" class="widefat val_title" name="title">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_paragraph">
                        <img src="<?php echo base_url();?>assets/signup/images/para.png"/> Paragraph
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">New Paragraph</td><td></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Paragraph</label>
                                    <textarea cols="10" rows="4" class="widefat  val_title" name="paragraph" >New Paragraph</textarea>
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_email">
                        <img src="<?php echo base_url();?>assets/signup/images/email.png"/> Email
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Email</td><td><input type="text" class="boxhidden" /></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Email" class="widefat  val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_signlelinetext">
                        <img src="<?php echo base_url();?>assets/signup/images/singleline.png"/> Single Line Text
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Single Line Text</td><td><input type="text" class="boxhidden" /></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Single Line Text" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_multilinetext">
                        <img src="<?php echo base_url();?>assets/signup/images/multiline.png"/> Multi-line Text
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Multi-lines Text</td><td><textarea class="boxhidden"></textarea></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Multi-lines Text" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Rows</label>
                                    <input type="text" value="" class="widefat" name="rows">
                                </p>
                                <p>
                                    <label for="">Cols</label>
                                    <input type="text" value="" class="widefat" name="cols">
                                </p>  
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_checkbox">
                        <img src="<?php echo base_url();?>assets/signup/images/checkbox.png"/> Checkboxes
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Checkboxes</td><td><input type="checkbox"> &nbsp; <input type="checkbox"></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Checkboxes" class="widefa val_titlet" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                 <p>
                                    <label for="">List Items</label>
                                    <input type="button" value="Enter items as text" class="widefat" onclick="add_checkbox(jQuery(this).parentsUntil('li').parent().attr('id'))">
                                    <table class="checkboxlist"></table>
                                 </p>
                                
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_radio">
                        <img src="<?php echo base_url();?>assets/signup/images/radio.png"/> Radio Buttons
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Radio Buttons</td><td><input type="radio"> &nbsp;<input type="radio"></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Radio Buttons" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                 <p>
                                    <label for="">List Items</label>
                                    <input type="button" value="Enter items as text" class="widefat" onclick="add_checkbox(jQuery(this).parentsUntil('li').parent().attr('id'))">
                                    <table class="checkboxlist"></table>
                                 </p>
                                
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_dropdown">
                        <img src="<?php echo base_url();?>assets/signup/images/select.png"/> Drop-down List
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Drop-down List</td><td><select style="width: 200px !important;" disabled><option>Select</option></select></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Drop-down List" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                 <p>
                                    <label for="">List Items</label>
                                    <input type="button" value="Enter items as text" class="widefat" onclick="add_checkbox(jQuery(this).parentsUntil('li').parent().attr('id'))">
                                    <table class="checkboxlist"></table>
                                 </p>
                                
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_multidropdow">
                        <img src="<?php echo base_url();?>assets/signup/images/multiselect.png"/> Multi Select Dropdow
                        <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Multi Select Dropdow</td><td><select style="width: 200px !important;" disabled><option>Select</option></select></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Multi Select Dropdow" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Width</label>
                                    <input type="text" value="" class="widefat" name="width">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                 <p>
                                    <label for="">List Items</label>
                                    <input type="button" value="Enter items as text" class="widefat" onclick="add_checkbox(jQuery(this).parentsUntil('li').parent().attr('id'))">
                                    <table class="checkboxlist"></table>
                                 </p>
                                
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_upload">
                        <img src="<?php echo base_url();?>assets/signup/images/upload.png"/> Upload
                         <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Upload</td><td><input type="file" disabled></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Upload" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_date"><img src="<?php echo base_url();?>assets/signup/images/date.png"/> Date
                         <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Date</td><td><input type="text" class="boxhidden" /></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Date" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                     <li id="tab_time"><img src="<?php echo base_url();?>assets/signup/images/time.png"/> Time
                         <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Time</td><td><input type="text" class="boxhidden" /></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Time" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li id="tab_captcha"><img src="<?php echo base_url();?>assets/signup/images/captcha.png"/> Captcha
                         <div class="tab_element">
                            <div class="widget-content">
                                <table><tr><td class="tab_title">Captcha</td><td><input type="text" class="boxhidden" /></td><td><span class="edit" onclick="showedit(jQuery(this).parentsUntil('li').parent().attr('id')) ">Edit</span> &nbsp;&nbsp; <span class="delete" onclick="jQuery(this).parentsUntil('li').parent().remove()">Delete</span></td></tr></table>
                                <div class="expand">
                                <p>
                                    <label for="">Label</label>
                                    <input type="text" value="Captcha" class="widefat val_title" name="title">
                                </p>
                                <p>
                                    <label for="">Required <span class="red">*</span></label>
                                    <input type="checkbox" value="1" class="widefat" name="required">
                                </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                        </td><td>&nbsp;</td><td>
                <!-- MAIN AREA -->
                <div class="settings">
                    <div class="headerarea"><a href="javascript:void(0)" onclick="jQuery('#sortable').empty()">Clear Form</a></div>
                    <!-- Form Fields Area --> 
                    <ul id="sortable" class="form-elements" >
                        <?php if(isset($html)) echo $html; ?>
                    </ul>
                    
                    <!-- Form Settings Area  -->
                    <form id="form_settings">
                        <div class="footerarea">
                            <p>
                                <label for="">Username </label>
                                <select name="username" class="settingl">
                                    <option value="1" <?php echo $status[0][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[0][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            <p>
                                <label for="">First Name </label>
                                <select name="firstname" class="settingl">
                                    <option value="1" <?php echo $status[0][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[0][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Last Name</label>
                                <select name="lastname" class="settingl">
                                    <option value="1" <?php echo $status[1][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[1][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            <p>
                                <label for="">E-Mail Address</label>
                                <select name="email" class="settingl">
                                    <option value="1" <?php echo $status[2][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[2][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            
                             <p>
                                <label for="">Payment Method</label>
                                <select name="payment_method" class="settingl">
                                    <option value="1" <?php echo $status[3][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[3][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            
                            <p>
                                <label for="">Telephone</label>
                                <select name="telephone" class="settingl">
                                    <option value="1" <?php echo $status[4][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[4][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            
                            <p>
                                <label for="">Website</label>
                                <select name="website" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            
                             <p>
                                <label for="">Avatar</label>
                                <select name="avatar" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            
                             <p>
                                <label for="">Company</label>
                                <select name="company" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Address1</label>
                                <select name="avatar" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Address2</label>
                                <select name="avatar" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Post Code</label>
                                <select name="postcode" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Country</label>
                                <select name="country" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                             <p>
                                <label for="">Region</label>
                                <select name="region" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            <p>
                                <label for="">city</label>
                                <select name="region" class="settingl">
                                    <option value="1" <?php echo $status[5][1] ? 'selected' : '' ?>>Enable</option>
                                    <option value="0" <?php echo !$status[5][1] ? 'selected' : '' ?>>Disable</option>
                                </select>
                            </p>
                            <div style="clear: both;"></div>
                        </div>
                    </form>
                    <div class="form-wrapper" id="submit-wrapper">
                        <button type="button" onclick="submitform()">Save Changes</button>
                    </div>
                </div>
                </td></tr></table>
                <script type="text/javascript">

            jQuery('.footerarea input').click(function(){jQuery(this).focus();});
            jQuery('.footerarea select').click(function(){jQuery(this).focus();});

            function check_empty_form(){
                if(!jQuery('#sortable li').length)  
                    jQuery('#submit-wrapper').hide(); 
            }

            // Custom drop actions for <div id="dropBox">
            function dropItems(idOfDraggedItem,targetId,x,y)
            {
                key = Math.floor((Math.random()*100)+1);
                    jQuery('#sortable').append('<li id="form_' + idOfDraggedItem + '_' + key + '"><form id="' + key + '_id">' + jQuery('#' + idOfDraggedItem + ' .tab_element').html() + '</form></li>');
                    // check form have child ? 
                        jQuery('#submit-wrapper').show(); 
            }


                var dragDropObj = new DHTMLgoodies_dragDrop();
                jQuery('.tablist li').each(function(){
                    eleid = jQuery(this).attr('id');
                    dragDropObj.addSource(eleid,true);
                });

            dragDropObj.addTarget('sortable','dropItems');	// Set <div id="dropBox"> as a drop target. Call function dropItems on drop
            dragDropObj.init();



            function showedit(eleID){ 
                if(jQuery('#'  + eleID + ' .edit').hasClass('open')){
                    jQuery('#' + eleID + ' .edit').removeClass('open');
                    jQuery('#' + eleID + ' .edit').text('Edit');
                    jQuery('#' + eleID + ' .expand').hide(); 
                    jQuery('#' + eleID + ' form .tab_title').text(jQuery('#' + eleID + ' form .val_title').val());

                }else{  
                    jQuery('#' + eleID + ' .edit').addClass('open');
                    jQuery('#' + eleID + ' .edit').text('Hide');
                    jQuery('#' + eleID + ' .expand').show(0,function(){ jQuery('#' + eleID + ' .widefat').click(function(){ jQuery(this).focus().select();});}); 
                }

            }

                function checkValidate(){
                            if(jQuery('#form_url').val() == ''){
                                alert('Form Url can not be empty !');
                                return false;
                            }

                            if(jQuery('#form_email').val() == ''){
                                alert('Please enter valid email!');
                                return false;
                            }
                            return true; 
                        }


        function submitform(){

            // check validate 
            if(!checkValidate())  
                return false;

            $data  =  new Array();
           
            $i = 0 ; 
            jQuery('#sortable li').each(function(){
                $rootID      = jQuery(this).attr('id');
                $input       = jQuery('#' + $rootID + ' form').serializeArray();
                $data[$i++]  = new Array($rootID,$input) ; 
            });
            
             $setting = new Array();  $j = 0 ; 
             jQuery('#form_settings .settingl').each(function(){
               
                $setting[$j++]  = new Array(jQuery(this).attr('name'),jQuery(this).val()) ; 
                
            });



            jQuery.post(document.URL,
                        {form_data : $data, form_settings :  $setting},
                        function($redirect){ 
                             document.location.href = $redirect.replace("amp;",""); ;
                        }); 
            }

        function add_checkbox(rootID){
            var items = prompt("Enter items separated by commas");
            array_items = items.split(',');
            for (var i = 0; i < array_items.length; i++)
                        {   key = Math.floor((Math.random()*10000)+1);
            jQuery('#' + rootID + ' .checkboxlist').append('<tr id="checkbox_' + key + '"><td><input type="text" name="option[]" value="' + array_items[i] + '"></td><td><a href="javascript:void(0);" onclick="remove_this(\'checkbox\',\'' + key + '\')">Remove</a></td></tr>'); 

            }
        }

        function remove_this(key, item_id){
            jQuery('#' + key + "_" +  item_id).remove(); 
        }
                    
    </script>
   
        </div>
    </div>
     
                                </div>
                            </div>
</div>
  <!-- END CONTENT -->