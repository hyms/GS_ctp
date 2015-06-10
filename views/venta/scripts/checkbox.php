<?php
    echo "
<script>
    $('#f_". $index ."').change(function(e){
        $('#c_" . $index . "').prop('checked',$('#f_" . $index . "').is(':checked'));
        $('#m_" . $index . "').prop('checked',$('#f_" . $index . "').is(':checked'));
        $('#y_" . $index . "').prop('checked',$('#f_" . $index . "').is(':checked'));
        $('#k_" . $index . "').prop('checked',$('#f_" . $index . "').is(':checked'));
        return true;
    })
    $('#c_". $index ."').change(function(e){
        if($('#c_" . $index . "').is(':checked')==false)
            $('#f_" . $index . "').prop('checked',false);
        else
            todos" . $index . "();
    });
    $('#m_". $index ."').change(function(e){
        if($('#m_" . $index . "').is(':checked')==false)
            $('#f_" . $index . "').prop('checked',false);
        else
            todos" . $index . "();
    });
    $('#y_". $index ."').change(function(e){
        if($('#y_" . $index . "').is(':checked')==false)
            $('#f_" . $index . "').prop('checked',false);
        else
            todos" . $index . "();
    });
    $('#k_". $index ."').change(function(e){
        if($('#k_" . $index . "').is(':checked')==false)
            $('#f_" . $index . "').prop('checked',false);
        else
            todos" . $index . "();
    });
    function todos".$index."()
    {
        if($('#c_" . $index . "').is(':checked')==true && $('#m_" . $index . "').is(':checked')==true && $('#y_" . $index . "').is(':checked')==true && $('#k_" . $index . "').is(':checked')==true)
            $('#f_" . $index . "').prop('checked',true);
    }
</script>
";