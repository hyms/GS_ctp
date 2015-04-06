<?php
Yii::app()->getClientScript()->registerScript("ajax_factura","
function factura(tipo)
{
	jsonObj = [];
		        
	$('#yw3 > tbody  > tr').each(function(index, value) {
		id = $(this).find('#idAlmacen').val();
		index = $(this).find('#indexs').val();
		item = {};
        item ['idAlmacenProducto'] = id;
		item ['index'] = index;
		jsonObj.push(item);
	});
	
	if(jsonObj.length>0){
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: '".$url."',
			data 		: {detalle:jsonObj,tipo:tipo".$id."}, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
            encode  	: true
		})
		.done(function(data) {
			$('#codigo').text(data['codigo']);
			var key;
			for(key in data) {
				if(data.hasOwnProperty(key)) {
		    		
				$('#costoUnidad_'+data[key]['index']).val(data[key]['precioU']);
				$('#costoPaquete_'+data[key]['index']).val(data[key]['precioP']);
		    	$('#costoTotal_'+data[key]['index']).val(redondeo(suma(suma($('#stockUnidad_'+data[key]['index']).val()*$('#costoUnidad_'+data[key]['index']).val(),$('#stockPaquete_'+data[key]['index']).val()*$('#costoPaquete_'+data[key]['index']).val()),$('#adicional_'+data[key]['index']).val())));
			}}
		   	calcular_total();
			$('#factura').prop('disabled', tipo);			
		});
	}	
			
}
",CClientScript::POS_READY);?>