var ofertaId = 0;
$(document).ready(function() {
    ofertaId= $("#ofertaId").val();

    if ($('#tablaCC').length) {
        ccTabla()     
    }
    if ($('#tablaCCPaso2').length) {
    
        tablaCCPaso2()
    }


}) 

$("#agregarCC").click(function (event) {
    console.log("agregarCC");
    ofertaId= $("#ofertaId").val();
    
    var formData = $('#collapseOne .form-control').serializeArray()
    console.log(formData);

    var formData = new FormData();
    formData.append("oferta_id", ofertaId);
	$("#collapseOne .form-control").serializeArray().forEach(function(field) {
	  formData.append(field.name, field.value)
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
                    
                	const myJSON = JSON.parse(data); 
                    console.log(myJSON);
                    $('#loader').hide();
                    Swal.fire({
                        title: myJSON.mensaje,
                        text: 'Fue Exitoso',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                        
                    }).then((result) => {
                        location.reload();
                    }); 
                                        
                    
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
            console.log( "complete ccTabla" );
    });
}

function documentoRetorno(row, rol){

    //console.log(data)

    var doc = documento(row)

    var htmlRetorno = '<span> <i title="Retorno de la guia" class="si si-action-undo text-warning tx-20"> </i> </span>';
    var htmlEliminarGuia = "";
    if (rol == "admin"){
        var htmlEliminarGuia =' <a  class="remove-list text-danger tx-20 remove-button ">    \
                            <i id="eliminarGuia" title="Eliminar Guia id '+row.id +'" class="fa fa-trash" alt="Eliminar"></i>\
                            </a>';
        
    }
    return doc+htmlRetorno+htmlEliminarGuia;
}



function inputEnergia(data) {
    var html = '<div class="form-group">  \
                    <input type="text" width="50%" class="form-control" id="enegia'+data.id+'" \
                        placeholder="Ingrese energia" name="energia'+data.id+'"> \
                </div>';

    return html;
}

function inputPotencia(data) {
    var html = '<div class="form-group">  \
                    <input type="text" class="form-control" id="potencia'+data.id+'" \
                        placeholder="Ingrese Potencia" name="potencia'+data.id+'"> \
                </div>';

    return html;
}


function inputCel(data) {
console.log(data)

    var html = '<div class="form-group">  \
                    <input type="text" class="form-control" id="cel'+data.id+'" \
                        placeholder="Ingrese CEL" name="cel'+data.id+'"> \
                </div>';

    return html;
}

function tablaCCPaso2(){
    
    $.ajax({
        url: 'obtenerCCAjax/?oferta_id='+ofertaId,
        type: 'GET',
        //data: formData,
        processData: false,
        contentType: false
        
    }).done(function( response ) {
        const json = JSON.parse(response);
        console.log(json)
        var tablaCC = $('#tablaCCPaso2').DataTable({
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
                ,{ "data": "id"
                        ,render: function(data, type, row){   
                            return inputEnergia(row); 
                        }
                }
                ,{ "data": "id"
                        ,render: function(data, type, row){   
                            return inputPotencia(row); 
                        }
                }
                ,{ "data": "id"
                        ,render: function(data, type, row){   
                            return inputCel(row); 
                        }
                }


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
            console.log( "complete tablaCCPaso2" );
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