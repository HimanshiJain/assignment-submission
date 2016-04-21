$().ready(function(){

$("#upload_form").validate({
    
        // Specify the validation rules
        rules: {
            assignment_name: "required"
        },
        
        // Specify the validation error messages
        messages: {
            assignment_name: "Please enter the assignment name"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
}

);
