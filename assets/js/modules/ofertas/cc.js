var ofertaId = 0;
var tablaCC = null
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
    var archivo = $("#fArchivo")[0].files[0];
    
    var formData = $('#collapseOne .form-control').serializeArray()
    

    var formData = new FormData();
    formData.append("oferta_id", ofertaId);
	$("#collapseOne .form-control").serializeArray().forEach(function(field) {
	  formData.append(field.name, field.value)
	});
    formData.append('archivo', archivo);

    var confirmar = false; 
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

//Function

function ccTabla(){
    
    $.ajax({
        url: 'obtenerCCAjax/?oferta_id='+ofertaId,
        type: 'GET',
        //data: formData,
        processData: false,
        contentType: false
        
    }).done(function( response ) {
        const json = JSON.parse(response);
        //console.log(json)
        tablaCC = $('#tablaCC').DataTable({
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
            ,order: [[1, 'desc']]
            ,paging: true
            ,aLengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todo' ]
            ]
            ,dom: 'lBfrtip'
            ,buttons: [ 
                'pageLength'
            ]
            ,columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: '+'
                },
                { "data": "id" } //0
                ,{ "data": "nombre" }
                ,{ "data": "rpu_id" }
                ,{ "data": "tarifa" }
                ,{ "data": "division_id" } 
                ,{ "data": "zona_carga_id" }
                ,{ "data": "demanda_contratada" }

            ],
        });

        tablaCC.on('click', 'td.dt-control', function (e) {
            let tr = e.target.closest('tr');
            let row = tablaCC.row(tr);
         
            //$("#nuevoCliente").modal("show");
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                row.child(calculoCC( row.data().calculoCC )).show();

            }
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

function calculoCC(resultados) {
    // `d` is the original data object for the row
    var tBody = "";
    
    resultados.forEach( function(data, indice) {
        
        tBody +='<tr>    \
            <th>'+data.anio+'</th>  \
            <th>'+data.mes+'</th>  \
            <th>'+data.cantidad_horas_ib_CFE+'</th>  \
            <th>'+data.cantidad_horas_ii_CFE+'</th> \
            <th>'+data.cantidad_horas_ip_CFE+'</th> \
            <th>'+data.total_horas_tres_i_CFE+'</th> \
            <th>'+data.cm_kWh_ib+'</th> \
            <th>'+data.cm_kWh_ii+'</th> \
            <th>8</th> \
            <th>9</th> \
            <th>10</th> \
            <th>11</th> \
            <th>12</th> \
            <th>13</th> \
            <th>'+data.promedio_horario_kWh_ib+'</th> \
            <th>15</th> \
            <th></th> \
            <th></th> \
            <th></th> \
            <th></th> \
            <th></th> \
            <th>20</th> \
            <th></th> \
            <th></th> \
            <th></th> \
            <th></th> \
            <th>'+data.ppt+'</th> \
            <th>'+data.ppnt+'</th> \
            <th></th> \
        </tr>   \
        '
    });
    


    tabla = '<table id="tablaCC" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr>    \
                    <th>0</th>  \
                    <th>1</th>  \
                    <th>2</th>  \
                    <th>3</th> \
                    <th>4</th> \
                    <th>5</th> \
                    <th>6</th> \
                    <th>7</th> \
                    <th>8</th> \
                    <th>9</th> \
                    <th>10</th> \
                    <th>11</th> \
                    <th>12</th> \
                    <th>13</th> \
                    <th>14</th> \
                    <th>15</th>  \
                    <th>16</th>  \
                    <th>17</th>  \
                    <th>18</th> \
                    <th>19</th> \
                    <th>20</th> \
                    <th>21</th> \
                    <th>22</th> \
                    <th>23</th> \
                    <th>24</th> \
                    <th>25</th> \
                    <th>26</th> \
                    <th>27</th> \
                    <th>28</th> \
                </tr>   \
            </thead>    \
            <tbody>'
            +tBody+ 
            '</tbody>    \
        </table>' 
    ;

    return tabla;
}
