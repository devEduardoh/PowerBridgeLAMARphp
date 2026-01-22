$(document).ready(function(){

    $("#zip_code").on('change', function () {
                var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
                $.post("option-form/country.php", { zip_code: zip_code }, function(data) {
                    $("#pais").html(data);
                    });			
                });  

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
                $("#colonia").html(data);
                });			
            });
    
    $("#anio").on('change', function () {
            $("#anio option:selected").each(function () {
                var anio = $(this).val();
                $.post("option-form/academic_term.php", { anio:anio }, function(data) {
                    $("#periodo").html(data);
                });			
            });
    });

    $("#periodo").on('change', function () {
            $("#periodo option:selected").each(function () {
                var periodo = $(this).val();
                var anio = $("#anio").val();            
                $.post("option-form/academic_session.php", {periodo:periodo, anio:anio}, function(data) {
                    $("#sesion").html(data);
                });			
            });
    });

    $("#sesion").on('change', function () {
            $("#sesion option:selected").each(function () {
                var sesion = $(this).val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();            
                $.post("option-form/degree.php", {periodo:periodo, anio:anio, sesion:sesion}, function(data) {
                    $("#nivel").html(data);
                });			
            });
    });

    $("#nivel").on('change', function () {
            $("#nivel option:selected").each(function () {
                var nivel = $(this).val();
                var sesion = $("#sesion").val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();            
                $.post("option-form/program.php", {periodo:periodo, anio:anio, sesion:sesion, nivel:nivel}, function(data) {
                    $("#programa").html(data);
                });			
            });
    });

    $("#programa").on('change', function () {
            $("#programa option:selected").each(function () {
                var programa = $(this).val();
                var nivel = $("#nivel").val();
                var sesion = $("#sesion").val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();            
                $.post("option-form/curriculum.php", {periodo:periodo, anio:anio, sesion:sesion, nivel:nivel, programa:programa}, function(data) {
                    $("#carrera").html(data);
                });			
            });
    });

   

    $("#sesion").on('change', function () {
        $("#sesion option:selected").each(function () {
                var sesion = $(this).val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();         
                $.post("option-form/beca_crm.php", {periodo:periodo, anio:anio, sesion:sesion}, function(data) {
                    $("#beca_crm").html(data);
                });			
            });
    });

    $("#beca_crm").on('change', function () {
            $("#beca_crm option:selected").each(function () {
                var beca_crm = $(this).val();        
                $.post("option-form/percentage_crm.php", {beca_crm:beca_crm }, function(data) {
                    $("#porcen_crm").html(data);
                });			
            });
    });

    $("#sesion").on('change', function () {
        $("#sesion option:selected").each(function () {
                var sesion = $(this).val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();         
                $.post("option-form/beca_parc.php", {periodo:periodo, anio:anio, sesion:sesion}, function(data) {
                    $("#beca_parc").html(data);
                });			
            });
    });

    $("#beca_parc").on('change', function () {
            $("#beca_parc option:selected").each(function () {
                var beca_parc = $(this).val();        
                $.post("option-form/percentage_parc.php", {beca_parc:beca_parc }, function(data) {
                    $("#porcen_parc").html(data);
                });			
            });
});

// se obtiene escuela de procedencia a partir del cct
$("#cct").on('change', function () {
             var cct = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/organization.php", { cct: cct }, function(data) {
                console.log("Response from organization.php:", data);
                $("#esc_proc").html(data);
                });			
            });

// se obtienen datos para la direción del tutor a partir del CP

$("#zip_code_tutor").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/state_name.php", { zip_code: zip_code }, function(data) {
                $("#estado_tutor").html(data);
                });			
            });
        
    $("#zip_code_tutor").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/county_name.php", { zip_code: zip_code }, function(data) {
                $("#municipio_tutor").html(data);
                });			
            });

    $("#zip_code_tutor").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/colony.php", { zip_code: zip_code }, function(data) {
                $("#colonia_tutor").html(data);
                });			
            });
    
    // Se obtienen datos para la direción del padre a partir del CP

    $("#zip_code_padre").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/state.php", { zip_code: zip_code }, function(data) {
                //console.log("Response from state.php:", data);
                $("#estado_padre").html(data);
                });			
            });
        
    $("#zip_code_padre").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/county.php", { zip_code: zip_code }, function(data) {
                $("#municipio_padre").html(data);
                });			
            });

    $("#zip_code_padre").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/city.php", { zip_code: zip_code }, function(data) {
                $("#ciudad_padre").html(data);
                });			
            });

    $("#zip_code_padre").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/colony.php", { zip_code: zip_code }, function(data) {
                $("#colonia_padre").html(data);
                });			
            });
    // Se obtienen datos para la direción de la madre a partir del CP

    $("#zip_code_madre").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/state.php", { zip_code: zip_code }, function(data) {
                $("#estado_madre").html(data);
                });			
            });
        
    $("#zip_code_madre").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/county.php", { zip_code: zip_code }, function(data) {
                $("#municipio_madre").html(data);
                });			
            });

    $("#zip_code_madre").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/city.php", { zip_code: zip_code }, function(data) {
                $("#ciudad_madre").html(data);
                });			
            });

    $("#zip_code_madre").on('change', function () {
             var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/colony.php", { zip_code: zip_code }, function(data) {
                $("#colonia_madre").html(data);
                });			
            });

    // Se obtienen datos para la direción de la empresa a partir del CP 

$("#zip_code_emp").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/state_name.php", { zip_code: zip_code }, function(data) {
                $("#estado_emp").html(data);
                });			
            });
        
    $("#zip_code_emp").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/county_name.php", { zip_code: zip_code }, function(data) {
                $("#municipio_emp").html(data);
                });			
            });
    
    $("#zip_code_emp").on('change', function () {
            var zip_code = $(this).val();  // Obtiene el valor del input de tipo texto
            $.post("option-form/colony.php", { zip_code: zip_code }, function(data) {
                //console.log("Response from colony.php:", data);
                $("#colonia_emp").html(data);
                });			
            });


    // se obtienen valores de la información de becas y descuentos
    $("#promedio").on('change', function () {
        var promedio = $(this).val();  // Obtiene el valor del input de tipo texto
        $.post("option-form/calculate_percentage.php", { promedio: promedio }, function(data) {
            $("#porcentaje_beca").html(data);
            });			
        });

        $("#porcentaje_beca").on('change', function () {
            $("#porcentaje_beca option:selected").each(function () {
                var porcentaje_beca = $(this).val();
                var sesion = $("#sesion").val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();           
                $.post("option-form/beca_crm.php", {periodo:periodo, anio:anio, sesion:sesion, porcentaje_beca:porcentaje_beca }, function(data) {
                    //console.log("Response from beca_crm.php:", data);
                    $("#beca_crm").html(data);
                });			
            });
    });

    $("#beca_crm").on('change', function () {
            $("#beca_crm option:selected").each(function () {
                var porcentaje_beca = $("#porcentaje_beca").val();
                var sesion = $("#sesion").val();
                var periodo = $("#periodo").val();
                var anio = $("#anio").val();           
                $.post("option-form/beca_parc.php", {periodo:periodo, anio:anio, sesion:sesion, porcentaje_beca:porcentaje_beca }, function(data) {
                    $("#beca_parc").html(data);
                });			
            });
    });

    // Se agrega combo para lugar de nacimiento
    $("#edo_nac").on('change', function () {
        $("#edo_nac option:selected").each(function () {
                var edo_nac = $(this).val();        
                $.post("option-form/county_birth.php", {edo_nac:edo_nac }, function(data) {
                    //console.log("Response from county_birth.php:", data);
                    $("#lugar_nac").html(data);
                });			
            });
    });

});