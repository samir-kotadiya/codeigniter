<style>
.group_block {
    /*border: 1px solid;*/
}
.group_content{
    padding-left: 20px;
    padding-right: 20px;
}
</style>

<div class="alert alert-info col-sm-12 clearfix">
    <div class="col-sm-10">
        <h4 class="pull-left">Package</h4>
    </div>
    <div class="col-sm-2">        
        <button class="btn btn-primary" onclick="return frontsubmit();" type="button">Save</button> 

        <a href="<?php echo $forms['cancel_url']?>" class="btn btn-default">Cancel</a>              
    </div>
</div>
<div class="frontformcontainer">
<form id="frontForm" class="form-horizontal frontForm" action="<?php echo (isset($forms['action']))?$forms['action']:''; ?>" method="post">
<?php if(count($forms['fieldsets']) > 1){ ?>
<ul class="nav nav-pills">
<?php foreach ($forms['fieldsets'] as $fkey => $fieldset){ ?>
    <li class="<?php echo ($fieldset['active'] == 1)?'active':''; ?>"><a href="#<?php echo $fkey; ?>-tab" data-toggle="tab"><?php echo $fieldset['label']; ?></a></li>
<?php } ?>
</ul>
<?php } ?>

<div class="tab-content">

<?php 

//flag is set default false    
$gFlage = false;

?>    
<?php foreach ($forms['fieldsets'] as $fkey => $fieldset){ ?>
        <div class="tab-pane <?php echo ($fieldset['active'] == 1)?'active':''; ?>" id="<?php echo $fkey; ?>-tab">
            <?php foreach ($fieldset['fields'] as $key => $value) {
                $showlabel = true;
                if(isset($value['showlabel'])){
                    if(!$value['showlabel']){
                        $showlabel = false;
                    }
                }
                
               /* if(isset($value['group']) && $gFlage == false){
                    $gFlage = true;
                ?>
                    <div class="group_block" style="border:1px solid balck;">
                        <h1><?php echo $value['group']; ?></h1>
                        <div class="group_content">
                <?php         
                }

                */
                if($value['type'] == 'custom'){
                    echo $value['html'];
                    continue;
                }

                ?>
                


                <div class="form-group">
                    <label class="col-xs-2 control-label">
                    <?php if($showlabel && $value['type'] != 'hidden'){  
                        echo $value['label']; 
                    } ?></label>
                    <div class="col-xs-10">
                        <?php 
                        switch ($value['type']){
                            case 'text':
                                ?>
                                    <input type="text" class="form-control" placeholder="<?php echo $value['label']?>" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                                <?php
                                break;
                            case 'hidden':
                                ?>
                                    <input type="hidden" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                                <?php
                                break;
                            case 'password':
                                ?>
                                    <input type="password" class="form-control" placeholder="<?php echo $value['label']?>" name="<? echo $value['name'] ?>" value="<?php echo (isset($value['value']))?$value['value']:''; ?>" />
                                <?php
                                break;
                            case 'file':
                                ?>
                                    <input class="file" type="file" class="form-control" name="<? echo $value['name'] ?>" />
                                <?php
                                    break;
                            case 'textarea':
                                ?>
                                  <textarea class="form-control" name="<? echo $value['name'] ?>"><?php echo (isset($value['value']))?$value['value']:''; ?></textarea>
                                <?php
                                break;
                            case 'select':
                                ?>
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
                                <?php
                                break;
                            case 'radio':
                                ?><div class="radio radio-warning"><?php 
                                $default = 'checked';
                                foreach ($value['options'] as $optionkey=>$optionvalue) {                                        
                                     if(isset($value['value']))
                                     {
                                        $default = '';
                                        if($value['value'] == $optionvalue)
                                            $default = 'checked';                                        
                                     }   
                                    ?>
                                    <input  type="radio" name="<?php echo $value['name']?>[]" value="<?php echo $optionvalue; ?>" <?php echo $default ?> />
                                    <label for="radio3" id="sty"> 
                                        <?php echo $optionkey; ?>  
                                    </label>
                                    <?php
                                }
                                ?></div><?php
                                break;
                            case 'checkbox':
                                
                                foreach ($value['options'] as $optionkey=>$optionvalue) {
                                    $default = '';
                                    if(isset($value['value']) && is_array($value['value']) && in_array($optionvalue,$value['value']))                                    
                                        $default = 'checked';                                        

                                ?>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox2" type="checkbox" name="<? echo $value['name'] ?>[]" value="<?php echo $optionvalue; ?>" class="form-control" <?php echo $default ?> >
                                        <label for="checkbox2">
                                         <div class="form_label"><?php echo $optionkey; ?></div>    
                                        </label>
                                    </div>
                                <?php }
                                   break;
                                  case 'datepicker':
                                ?>
                                <div class='input-group date'>
                                    <input type='text'  class="form-control datetimepicker "  name="<? echo $value['name'] ?>" placeholder="<? echo $value['label'] ?>" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                       
                                <?php


                                break;
                                case 'captcha':
                                    echo $value['captcha']['image'];
                                    ?>
                                    <input type="text" class="form-control" name="<? echo $value['name'] ?>" />
                               <?php    
                                   break;
                                case 'tag':
                                  
                                    ?>
                                    <span class="tag-style">
                                    <input type="text" class="" name="<? echo $value['name'] ?>" data-role="tagsinput" placeholder="<?php echo $value['label']?>" value="" />
                                   </span>
                                    <?php 
                                    break;
                            default:
                                ?>
                                    <input type="text" class="form-control" placeholder="<?php echo $value['label']?>" name="<? echo $value['name'] ?>" />
                                <?php
                                break;
                        }
                        ?>

                    </div>
                </div>                

                <?php 
            } ?>
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
    <div class="form-group has-feedback">
        <label class="col-xs-2 control-label">
        </label>
        <div class="col-xs-10">
            <!-- <input class="btn btn-default submit_btn"  onclick="return frontsubmit();" value="Submit"> -->
        </div>
    </div>
<?php } ?>

<input type="hidden" id="siteurl" name="siteurl" value="<?php echo site_url(); ?>" />
</form>

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

      
   // var check = $(".datetimepicker").find('.datetimepicker');
   var check =  $(".datetimepicker").length;

    if(check > 0){
        $('.datetimepicker').datetimepicker();                                
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
                    foreach ($fieldset['fields'] as $key => $value) {

                        if(!isset($value['valid'])){
                            continue;
                        }
                        ?>
                        <?php if($value['type'] == 'checkbox' or $value['type'] == 'radio'){echo '"'.$value['name'].'[]"';}else{echo $value['name'];} ?>:{
                                validators: {
                                    <?php if(in_array('require', $value['valid'])){ 
                                        if($value['type'] != 'textarea'){ 
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

                                                return text.length <= 200 && text.length > 0;
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
                                        message: 'The Salary Must Be Minmum <?php echo $value['validrange']['min']?> And Maximum <?php echo $value['validrange']['max']?>'
                                    },

                                    <?php } ?>
                                    
                                }
                            },
                        <?php   
                      }
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
        selector: 'textarea',
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
