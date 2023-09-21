var ofertaId = 0;
$(document).ready(function() {
    if ($('#tablaCC').length) {
        ofertaId= $("#oferta_id").val();
        ccTabla()     
    }

}) 

$("#agregarCC").click(function (event) {
    console.log("agregarCC");
    ofertaId= $("#oferta_id").val();
    
    var formData = $('#collapseOne .form-control').serializeArray()
    console.log(formData);

    var formData = new FormData();
	$("#collapseOne .form-control").serializeArray().forEach(function(field) {
	  formData.append(field.name, field.value)
	});
 
    $("#collapseOne .form-control").serializeArray().forEach(function(field) {
      $("#"+field.name).val("");
    });


    var confirmar = false; //confirm("¿Está seguro de subir los archivos?");
    Swal.fire({
      title: '¿Está seguro agregar un CC?',
      text: 'Favor de Confirmar',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Agregar CC!',
      cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {

            console.log("confirmado ");
            $('#loader').show();
    
            console.log("Inicia Ajax");
            $.ajax({
                url: 'agregarCCAjax',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false
                ,beforeSend: function () {
                    
                },
                success: function (data) {
                    $("#collapseOne .form-control").serializeArray().forEach(function(field) {
                      $("#"+field.name).val("");
                    });
                    
                	const myJSON = JSON.parse(data); 
                    console.log(myJSON);
                    $('#loader').hide();
                    
                    Swal.fire(
                        myJSON.mensaje,
                        'Fue Exitoso',
                        'success'
                    )
                    //location.reload();
                    ccTabla();
                },
                error: function () {
                    console.log("Seccion error");
                    $('#loader').hide();
                    Swal.fire(
                        'Ocurrió un error al guardar el archivo.',
                        'Por favor, inténtelo de nuevo más tarde.',
                        'error'
                    )
                  
                },
                complete: function () {
                    console.log("Seccion complete");
                  $('#loader').hide();
                }
              });

        } else {
            console.log("No confirmado ");    
        }
        
    })

});

function ccTabla(){
    
    
    $.ajax({
        url: 'obtenerCCAjax/?oferta_id='+ofertaId,
        type: 'GET',
        //data: formData,
        processData: false,
        contentType: false
        
    }).done(function( response ) {
        const json = JSON.parse(response);
        console.log(json)
        var tablaCC = $('#tablaCC').DataTable({
            "oLanguage": {
                "sEmptyTable": "No se puede mostrar los registros"
            }
            ,processing: true
            ,serverSide: false 
            ,pagingType: "full_numbers"
            ,deferRender: true
            ,bDestroy: true
            ,data: json.tabla
            ,autoWidth: false
            ,order: [[0, 'desc']]
            ,lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todo' ]
            ]
            ,dom: 'Bfrtip'
            ,buttons: [ 
                'pageLength'
            ]
            ,columns: [
                { "data": "id" } //0
                ,{ "data": "nombre" }
                ,{ "data": "rpu_id" }
                ,{ "data": "tarifa" }
                ,{ "data": "esquema" }//4
                ,{ "data": "division_id" } 
                ,{ "data": "zona_carga_id" }
                ,{ "data": "demanda_contratada" }

            ],
        });
    }).fail( function( data,jqXHR, textStatus, errorThrown ) {
        console.log( "fail" );
        console.log(data);
        Swal.fire(
            data.status+' '+data.statusText,
            'Por favor, inténtelo de nuevo más tarde o Consulte con su administrador.',
            'error'
        )


    }).always(function() {
            console.log( "complete agregarCC" );
    });
}


$("#guardarPaso1CC").click(function (event) {
    console.log("guardarPaso1CC");

    var ofertaId = $("#oferta_id").val();

    var formData = new FormData();
    formData.append("oferta_id", ofertaId);
    

    $.ajax({
        url: 'guardarPaso1CC',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
        
    }).done(function( response ) {

        Swal.fire(
            "Paso 1 Registrado",
            'Favor de agregar.',
            'success'
        )
        location.reload();
    }).fail( function( data,jqXHR, textStatus, errorThrown ) {
        console.log( "fail" );
        console.log(data);
        Swal.fire(
            data.status+' '+data.statusText,
            'Por favor, inténtelo de nuevo más tarde o Consulte con su administrador.',
            'error'
        )


    }).always(function() {
            console.log( "complete agregarCC" );
    });

});