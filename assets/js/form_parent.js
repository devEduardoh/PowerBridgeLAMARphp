$(document).ready(function(){

    // Se obtienen datos para la direción del padre a partir del CP

    $("#zip_code").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/state.php", { zip_code: zip_code }, function(data) {
                
                $("#estado").html(data);
                });			
            });
        
    $("#zip_code").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/county.php", { zip_code: zip_code }, function(data) {
                $("#municipio").html(data);
                });			
            });

    $("#zip_code").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/city.php", { zip_code: zip_code }, function(data) {
                $("#ciudad").html(data);
                });			
            });

    $("#zip_code").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/colony.php", { zip_code: zip_code }, function(data) {
                console.log("Response from colony.php:", data);
                $("#colonia").html(data);
                });			
            });
    

});