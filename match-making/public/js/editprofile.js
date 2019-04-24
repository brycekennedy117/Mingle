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