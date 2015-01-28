function check_textarea($min, $max, $value) {
    $min = ($min > 0) ? $min : 1;
    $max = ($max > 0) ? $max : 10000;
    if ($value.length < $min)
    {
        $return = "<font style='color:red;'>"+$value.length+"</font> / "+$max;
    }
    else
    {
        if ($value.length > $max)
        {
            $op = Number($value.length) - Number($max);
            $return = "<font style='color:red;'>-"+$op+"</font> / "+$max;
        }
        else
        {
            $return = $value.length+" / "+$max;
        }
    }
    return $return;
}

$("#message_p").bind('keypress, keyup', function () {
    $data_min = $(this).data("minlength");
    $data_max = $(this).data("maxlength");
    $value = $(this).val();
    
    $enter = check_textarea($data_min, $data_max, $value);
    $("#texarea_insert_data").html($enter);
});