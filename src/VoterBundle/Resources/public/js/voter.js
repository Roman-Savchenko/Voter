$(document).ready(function(e){
   $("#voter").on("click", function(e) {
       e.preventDefault();
       $.ajax({
           type: 'POST',
           url: $(this).data('path'),
           dataType: 'json',
           data: {},
           success: function(data, dataType) {
               setMessage(data);
           }
       });
   });
    $("#result").on("click", function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).data('path'),
            dataType: 'json',
            data: {},
            success: function(data, dataType) {
                setMessage(data);
            }
        });
    });
    $("#form_voter_save").on("click", function(e) {
        if ($("#form_voter_select").val() == 1) {
            return false;
        }
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $("form").attr('action'),
            dataType: 'json',
            data: {},
            success: function(data, dataType) {
                setMessage(data);
            }
        });
    });
    function setMessage(data) {
        if (data.status != undefined) {
            $(".result").show().text(data.status);
        }
    }
    $("#form_voter_select").on("click", function(e) {
       $(this).val(0);
    });
    var register = $("#fos_user_registration_form_owner");
    register.val(0);
    register.on("change", function(e) {
        $(this).val(1);
    });
});