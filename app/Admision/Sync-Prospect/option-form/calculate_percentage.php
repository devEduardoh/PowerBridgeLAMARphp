<?php
$text_porcentaje = '<option value="">Selecciona el porcentaje</option>';
$promedio = $_POST['promedio'];

if($promedio >= 6 AND $promedio < 7) {
    $porcentaje = 10;
}elseif($promedio >= 7 AND $promedio < 8){
    $porcentaje = 15;
}
elseif($promedio >= 8 AND $promedio < 9)
{
    $porcentaje = 20;
}
elseif($promedio >= 9 AND $promedio <= 10)
{
    $porcentaje = 30;
}
else
{
    $porcentaje = 0;
}


    $text_porcentaje .= '<option value="'.$porcentaje.'">'.$porcentaje.' %</option>';
                                    
    echo $text_porcentaje;

?>