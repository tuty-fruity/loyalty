<?php get_header(); ?>
<!-- -->
<style>
label {
    left: -13px;
}
</style>
<!-- -->

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form id="form-register" method="post">
                <legend><h1>Register</h1></legend>
                <div class="form-group">
                    <label class="col-md-4 control-label control-label-edit" for="textinput">Name</label>
                    <input name="customer_name" type="text" placeholder="customer name" data-validation="length alphanumeric" 
                        data-validation-length="min1" class="form-control input-md">                
                </div>
                <div class="form-group">
                    <label class="col-md-7 control-label" for="textinput">Security Code</label>
                    <input name="eight_digit_num" type="text" placeholder="8 digit number" maxlength="8" class="form-control input-md eight_dgt_field"
                        data-validation="length" data-validation-length="min8" data-validation-error-msg="please put last 8 digit number"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Register">
                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
