<?php
function getFieldsListHtml($fields = array() , $showlabel = true){
    foreach ($fields as $key => $value) {
        
        //Check if title will be show or not?
        $islabel = ($showlabel) ? (isset($value['label'])) ? true : false : false;
        
        //initialize variables
        $maindivclass = array();
        $labelclass = array();
        $formfieldclass = array();
        $addmoreclass = array();
        
        //set basic class for fields properity
        $maindivclass[] = 'form-group col-sm-12'; 
        $labelclass[] = 'col-sm-2';
        $formfieldclass[] = 'col-sm-9';
        $addmoreclass[] = 'col-sm-1 addmorebtnemp';
        
        //Prepare string for all class
        $maindivclass = implode(' ', $maindivclass);
        $labelclass = implode(' ', $labelclass);
        $formfieldclass = implode(' ', $formfieldclass);
        $addmoreclass = implode(' ', $addmoreclass);
        
        //Add class from fields input
        $formfieldclass .= ' ';
        $formfieldclass .= isset($value['class'])?$value['class']:'';
        
        $fid = str_replace(array('[',']'), array('_','_'), $value['name']).'_'.rand(1111, 9999);
        ?>
        
        <?php if($islabel){ //There is no need of main div if there is no title.... Hmmm ?>
            <div class="<?php echo $maindivclass; ?> ">
        <?php } ?>
        
        <?php if($islabel){ ?>
            <label class="<?php echo $labelclass; ?> control-label"><?php echo $value['label']; ?></label>
        <?php } ?> 
        <?php 
        switch ($value['type']){
            case 'text':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?>">
                    <input type="text" class="form-control" placeholder="<?php echo (isset($value['placeholder']))?$value['placeholder']:''; ?>" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                </div>
                <?php
                break;
          	case 'textdisplay':
                ?>
				<div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?>">
					<input type="text" class="form-control" disabled="disabled" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
				</div>
				<?php
				break;
            case 'hidden':
                ?>
                    <input id="<?php echo $fid; ?>" type="hidden" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                <?php
                break;
            case 'password':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                    <input type="password" class="form-control" placeholder="<?php echo $value['placeholder']?>" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                </div>
                <?php
                break;
            case 'file':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                    <input class="file" type="file" class="form-control" name="<? echo $value['name'] ?>" />
                   <?php if(isset($value['value'])){?> <img src="<?php echo $value['value']; ?>"><?php }?>
                </div>
                <?php
                    break;
            case 'textarea':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                  <textarea class="form-control" name="<? echo $value['name'] ?>"><?php echo (isset($value['value']))?$value['value']:''; ?></textarea>
               </div>
                <?php
                break;
            case 'editor':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?>">
                  <textarea class="form-control editorarea" name="<? echo $value['name'] ?>"><?php echo (isset($value['value']))?$value['value']:''; ?></textarea>
               </div>
                <?php
                break;
            case 'select':   
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                <select class="form-control <?php echo (isset($value['class']))?$value['class']:''; ?>" name="<?php echo $value['name'] ?>">
                    <?php 
                    if(isset($value['options'])){
                        $defaultvalue = (isset($value['value']))?$value['value']:'';
                        foreach ($value['options'] as $optionkey=>$optionvalue) {
                            $selected = ($defaultvalue == $optionvalue)?'selected="selected"':'';
                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $optionvalue; ?>"><?php echo $optionkey; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                </div>
                <?php
                break;
            case 'radio':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                <div class="radio radio-warning"><?php 
                $defaultvalue = (isset($value['value']))?$value['value']:'';
                foreach ($value['options'] as $optionkey=>$optionvalue) {
					$selected = ($defaultvalue == $optionvalue)?'checked="checked"':'';                 
                    ?>
                    <div class="radio_btn">
                    <input  type="radio" id="<?php echo $value['name'].$optionvalue; ?>" name="<?php echo $value['name']; ?>" value="<?php echo $optionvalue; ?>" <?php echo $selected; ?> />
                    <label for="<?php echo $value['name'].$optionvalue; ?>"> 
                        <?php echo $optionkey; ?>  
                    </label>
                    </div>
                    <?php
                }
                ?></div></div><?php
                break;
            case 'checkbox': 
            	$defaultvalue = (isset($value['value']))?$value['value']:'';
				?><div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> "><?php 
                foreach ($value['options'] as $optionkey=>$optionvalue) { 
					$selected = ($defaultvalue == $optionvalue)?'checked="checked"':'';
					?>
                    <div class="checkbox checkbox-warning">
                        <input id="<?php echo $value['name'].$optionvalue; ?>" type="checkbox" name="<? echo $value['name'] ?>[]" value="<?php echo $optionvalue; ?>" class="form-control" <?php echo $selected; ?> >
                        <label for="<?php echo $value['name'].$optionvalue; ?>">
                         <div class="form_label"><?php echo $optionkey; ?></div>    
                        </label>
                    </div>
                <?php }
                ?></div><?php 
                break;
            case 'datepicker':
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                <div class='input-group date'>
                    <input type='text'  class="form-control datetimepicker "  name="<? echo $value['name'] ?>" value = "<?php echo (isset($value['value']))?$value['value']:''; ?>" placeholder="<? echo $value['placeholder'] ?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>                                       
                </div>
                <?php
                break;
            case 'captcha':
                ?>
                 <div class="col-sm-9 captcha_img">
                    <?php echo $value['captcha']['image']; ?>
                 </div>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> col-sm-offset-2">
                    <input type="text" class="form-control" name="<? echo $value['name'] ?>" />
                </div>
               <?php    
                break;
            case 'tag':      
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                <span class="tag-style">
                    <input type="text" class="" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" data-role="tagsinput" placeholder="<?php echo $value['placeholder']?>" value="" />
                </span>
                </div>
                <?php 
                break;
            case 'group':
                ?><div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?>  fields-group"><?php 
                getFieldsListHtml($value['fields']);
                ?></div><?php
                break;
            case 'addmore':
                /*?><div class="<?php echo $formfieldclass; ?>"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;</i>Add more</button></div><?php*/
                break;
			case 'custom':
                echo $value['code'];
				break;
            default:
                ?>
                <div id="<?php echo $fid; ?>" class="<?php echo $formfieldclass; ?> ">
                    <input type="text" class="form-control" placeholder="<?php echo $value['placeholder']?>" name="<? echo $value['name'] ?>" />
                </div>
                <?php
                break;
        }
        ?>
        
        <?php
        //Try to genrate dynamic add form fields
        if(isset($value['addmore']) && $value['addmore']){ ?>
            <div class="<?php echo $addmoreclass; ?>"><button data-inc="<?php echo (isset($value['incement']))?$value['incement']:1; ?>" data-template="<?php echo $fid; ?>" type="button" class="addmorebtn btn btn-primary btn-xs"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add more</button></div>
        <?php } ?>
        
        <?php if(isset($value['removable']) && $value['removable']){ ?>
        	<div class="col-sm-1 morebtnemp"><button class="removebtn btn btn-danger btn-xs" type="button" data-inc="1"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button></div>
      	<?php } ?>
        
        <?php if($islabel){ //There is no need of main div if there is no title.... Hmmm ?>
        </div>
        <?php } ?>
        
        <?php
        if(isset($value['addmore']) && $value['addmore']){ ?>
            <div id="addmorecontainer_<?php echo $fid; ?>"></div>
        <?php } ?>
        
        <?php 
    }
}
?>

<div class="frontformcontainer">
<form id="frontForm" class="formmaincont" enctype="multipart/form-data" class="form-horizontal frontForm" action="<?php echo (isset($forms['action']))?$forms['action']:''; ?>" method="post">

<?php if(count($forms['fieldsets']) > 1){ ?>
<ul class="nav nav-pills">
<?php foreach ($forms['fieldsets'] as $fkey => $fieldset){ ?>
    <li class="<?php echo ($fieldset['active'] == 1)?'active':''; ?>"><a href="#<?php echo $fkey; ?>-tab" data-toggle="tab"><?php echo $fieldset['label']; ?></a></li>
<?php } ?>
</ul>
<?php } ?>

<div class="tab-content">
<?php foreach ($forms['fieldsets'] as $fkey => $fieldset){ ?>
        <div class="tab-pane <?php echo ($fieldset['active'] == 1)?'active':''; ?>" id="<?php echo $fkey; ?>-tab">
            <?php getFieldsListHtml($fieldset['fields']); ?>
        </div>
    <?php 
} ?>
</div>

<?php if(count($forms['fieldsets']) > 1){ ?>
<ul class="pager wizard">
    <li class="previous"><a href="javascript: void(0);">Previous</a></li>
    <li class="next"><a href="javascript: void(0);">Next</a></li>
</ul>
<?php }else{ ?>
    <div class="form-group">
        <label class="col-xs-2 control-label">
        </label>
        <div class="col-sm-10">
            <input class="btn btn-default submit_btn"  onclick="return frontsubmit();" value="Submit">
        </div>
    </div>
<?php } ?>

<input type="hidden" id="siteurl" name="siteurl" value="<?php echo site_url(); ?>" />
</form>

<?php 
function redervalidation($fields){
    foreach ($fields as $key => $value) {
        if($value['type'] == 'group'){
            redervalidation($value['fields']);
        }
        
        if(!isset($value['valid'])){
            continue;
        }
        
        if(!isset($value['label'])){
            $value['label'] = 'field';
        }
        
        ?>
        <?php 
        if($value['type'] == 'checkbox'){echo '"'.$value['name'].'[]"';}else{echo '"'.$value['name'].'"';} ?>:{
            validators: {
                <?php if(in_array('require', $value['valid'])){ 
                    if($value['type'] != 'editor'){ 
                    ?>
                    notEmpty: {
                        message: 'The <?php echo strtolower($value['label']); ?> is required'
                    },
                    <?php 
                    }else{
                    ?>
                    callback: {
                        message: 'The <?php echo strtolower($value['label']); ?> is required',
                        callback: function(value, validator, $field) {

                            var text = tinyMCE.activeEditor.getContent({
                                format: 'text'
                            });

                            return text.length > 0;
                        }
                    }
                    <?php
                    }
                } ?>

                <?php if(in_array('email', $value['valid'])){ ?>
                emailAddress: {
                    message: 'The <?php echo strtolower($value['label']); ?> is not a valid email address'
                },
                <?php } ?>

                <?php if(in_array('remote', $value['valid'])){ ?>
                remote: {
                    url: '<?php echo $value['validationurl']; ?>',
                    type: 'POST',
                    message: 'The <?php echo strtolower($value['label']); ?> is already exists!'
                },
                <?php } ?>

                <?php if(in_array('identical', $value['valid'])){ ?>
                identical: {
                    field: '<?php echo $value['identicalfield']; ?>',
                    message: 'The <?php echo strtolower($value['label']); ?> and its confirm are not the same'
                },
                <?php } ?>


                <?php if(in_array('website', $value['valid'])){ ?>
                uri: {
                    message: 'The <?php echo strtolower($value['label']); ?> is not valid'
                },
                <?php } ?>

                <?php if(in_array('date', $value['valid'])){ ?>
                date: {
                    format: 'YYYY/MM/DD',
                    message: 'The <?php echo strtolower($value['label']); ?> is not valid'
                },
                <?php } ?>

                <?php if(in_array('numeric', $value['valid'])){ ?>
                numeric: {
                    message: 'The <?php echo strtolower($value['label']); ?> must be a number'
                },
                <?php } ?>
                 <?php if(in_array('range', $value['valid'])){ ?>
                  between: {
                    max: <?php echo $value['validrange']['max']?>,
                    min: <?php echo $value['validrange']['min']?>,
                    message: 'The <?php echo strtolower($value['label']); ?> must be minmum <?php echo $value['validrange']['min']?> and maximum <?php echo $value['validrange']['max']?>'
                },

                <?php } ?>
                
            }
        },
    <?php   
    }
}
?>


<script>
$(document).ready(function() {
    // You don't need to care about this function
    // It is for the specific demo
    function adjustIframeHeight() {
        var $body   = $('body'),
                $iframe = $body.data('iframe.fv');
        if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }

    //Add dynamic fields
    jQuery(".addmorebtn").bind('click',function(){
        var inc = jQuery(this).attr('data-inc');
        
        var templateid = jQuery(this).attr('data-template');
        var $current = jQuery(this);
        var $template = $('#'+templateid),
        $clone    = $template
                        .clone()
                        .addClass('col-xs-offset-2')
                        .addClass('recentadded')
                        .removeAttr('id');

        //console.log($clone);
        var fieldhtml = $clone.html();

    	var htmlprocess = fieldhtml.replace(/[0]/g,inc);
    	$clone.html(htmlprocess);
      
        $clone.children().each(function(){
        	jQuery(this).removeAttr('id');
        	$loopelement = jQuery(this).children();

        	$loopelement.each(function(){
            	if(jQuery(this).hasClass('help-block')){
            		jQuery(this).remove();
               	}

            	if(jQuery(this).hasClass('form-control-feedback')){
            		jQuery(this).remove();
               	}

            	jQuery(this).removeAttr("data-fv-field");

            	if(jQuery(this).get(0).tagName != 'OPTION'){
            		jQuery(this).val('');
				}

            	// Nested level div removal
            	jQuery(this).children().each(function(){
                	jQuery(this).removeAttr("data-fv-field");
                	if(jQuery(this).get(0).tagName != 'OPTION'){
                		jQuery(this).val('');
    				}
               	});
            	
           	});

        	if(jQuery(this).hasClass('help-block')){
        		jQuery(this).remove();
           	}

        	if(jQuery(this).hasClass('form-control-feedback')){
        		jQuery(this).remove();
           	}
           	
        	jQuery(this).removeAttr("data-fv-field");
        	
        	/*jQuery('#frontForm').formValidation('addField', $loopelement.attr('name'));
        	console.log($loopelement);*/
        });

        inc++;
        jQuery(this).attr('data-inc',inc);

		$removebtn = '<div class="col-sm-1"><button data-inc="1" type="button" class="removebtn btn btn-danger btn-xs"><i class="fa fa-minus">&nbsp;&nbsp;</i>Remove</button></div>'

		$wrapperdiv = '<div class="form-group col-sm-12 recentwrapper"></div>';

		jQuery('#addmorecontainer_'+templateid).append($clone);
        /*$clone.insertAfter($current.parent().parent());*/
		//$removebtn.insertAfter($current.parent().parent());
		//$current.parent().parent().append($clone);
		//$current.parent().parent().append($removebtn);


		$clone.wrap($wrapperdiv);
		jQuery(".recentwrapper").append($removebtn);

		jQuery(".recentadded").removeClass("recentadded");
		jQuery(".recentwrapper").removeClass("recentwrapper");
		
       	var check =  $(".datetimepicker").length;
        if(check > 0){
        	$('.datetimepicker').datetimepicker().change(function(e) {
                // Revalidate the date field
        		$('#frontForm').formValidation('revalidateField', jQuery(this).attr('name'));
            });                          
        }
    });

    //Remove elemet
    jQuery(document).on('click','.removebtn',function(){
        jQuery(this).parent().parent().remove();
        //jQuery(this).parent().remove();
    });

      
   // var check = $(".datetimepicker").find('.datetimepicker');
   var check =  $(".datetimepicker").length;
    if(check > 0){
        $('.datetimepicker').datetimepicker().change(function(e) {
            $('#frontForm').formValidation('revalidateField', jQuery(this).attr('name'));
        });
    }
       

    $('#frontForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
                <?php foreach ($forms['fieldsets'] as $fkey => $fieldset){
                    redervalidation($fieldset['fields']);
                } ?>
            }
        })
        .bootstrapWizard({
            tabClass: 'nav nav-pills',
            onTabClick: function(tab, navigation, index) {
                return validateTab(index);
            },
            onNext: function(tab, navigation, index) {
                var numTabs    = $('#frontForm').find('.tab-pane').length,
                    isValidTab = validateTab(index - 1);
                if (!isValidTab) {
                    return false;
                }

                if (index === numTabs) {
                    // We are at the last tab

                    // Uncomment the following line to submit the form using the defaultSubmit() method
                    $('#frontForm').formValidation('defaultSubmit');

                    // For testing purpose
                    //$('#completeModal').modal();
                }

                return true;
            },
            onPrevious: function(tab, navigation, index) {
                return validateTab(index + 1);
            },
            onTabShow: function(tab, navigation, index) {
                // Update the label of Next button when we are at the last tab
                var numTabs = $('#frontForm').find('.tab-pane').length;
                $('#frontForm')
                    .find('.next')
                        .removeClass('disabled')    // Enable the Next button
                        .find('a')
                        .html(index === numTabs - 1 ? 'Submit' : 'Next');

                // You don't need to care about it
                // It is for the specific demo
                adjustIframeHeight();
            }
        });

    function validateTab(index) {
        var fv   = $('#frontForm').data('formValidation'), // FormValidation instance
            // The current tab
            $tab = $('#frontForm').find('.tab-pane').eq(index);

        // Validate the container
        fv.validateContainer($tab);

        var isValidStep = fv.isValidContainer($tab);
        if (isValidStep === false || isValidStep === null) {
            // Do not jump to the target tab
            return false;
        }

        return true;
    }

    tinymce.init({
        selector: '.editorarea',
        setup: function(editor) {
            editor.on('keyup', function(e) {
                $('#frontForm').formValidation('revalidateField', editor.settings.id);
            });
        }
    });
});

function validateTab(index) {
    var fv   = $('#frontForm').data('formValidation'), // FormValidation instance
        // The current tab
        $tab = $('#frontForm').find('.tab-pane').eq(index);

    // Validate the container
    fv.validateContainer($tab);

    var isValidStep = fv.isValidContainer($tab);
    if (isValidStep === false || isValidStep === null) {
        // Do not jump to the target tab
        return false;
    }

    return true;
}

function frontsubmit(){
    var valid = validateTab('');
    if(valid == true){
        $('#frontForm').formValidation('defaultSubmit');
    }
}
</script>
</div>
