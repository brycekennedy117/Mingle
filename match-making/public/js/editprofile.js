$( document ).ready(function() {
    $("#password-toggle").click(function(){
        if($("#password-toggle").text() === "Change Password")
        {
            $("#password-toggle").text("Cancel");
            $("#password-form").show();
        }
        else
        {
            $("#password-toggle").text("Change Password");
            $("#password-form").hide();
        }
    });
});

$( document ).ready(function() {
    $("#greeting-edit").click(function (){
        if($("#greeting").prop('disabled'))
        {
            $("#greeting").prop('disabled', false);
        }
        else
        {
            $("#greeting").prop('disabled', true);
        }
    });
});

$( document ).ready(function() {
    $("#email-edit").click(function (){
        if($("#email").prop('disabled'))
        {
            $("#email").prop('disabled', false);
        }
        else
        {
            $("#email").prop('disabled', true);
        }
    });
});

$( document ).ready(function() {
    $("#interested-edit").click(function (){
        if($("#interested_in").prop('disabled'))
        {
            $("#interested_in").prop('disabled', false);
        }
        else
        {
            $("#interested_in").prop('disabled', true);
        }
    });
});

