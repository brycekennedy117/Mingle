$(document).ready(function() {
    $("#edit").click(function(){
        if ($("#edit").text() === "Edit") {
            $("#edit-form").show();
            $("#edit").text("Cancel");
        }
        else {
            $("#edit-form").hide();
            $("#edit").text("Edit");
        }
    });
});