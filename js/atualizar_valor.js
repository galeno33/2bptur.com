$(document).ready(function(){
    function updateToken() {
        $.ajax({
            url: 'descautelar_material.php',
            success: function(data) {
                $('#token-value').text(parseInt(data, 10));
            }
        });
    }

    // Update every second
    setInterval(updateToken, 500);
});