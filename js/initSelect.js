$('#govList').change(function() {
    $i = 1;
    for ($i = 1; $i < 28; $i++) {
        $('.from'+$i).css("display", "none");
    }
    $('.from'+$(this).val()).css("display", "block");
    $('.from'+$(this).val()+':first').prop("selected", true);

});