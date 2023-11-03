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

//Inicio Seccion #agregarCC
$("#agregarCC").click(function (event) {
    console.log("agregarCC");
    ofertaId= $("#ofertaId").val();
    var archivo = $("#fArchivo")[0].files[0];

    var formData = new FormData();
    
	$("#collapseOne .form-control").serializeArray().forEach(function(field) {
	  formData.append(field.name, field.value)
	});
    formData.append("oferta_id", ofertaId);
    formData.append('archivo', archivo);

    fdValidateOk = true
    for (const values of formData.entries()) {
        console.log(values[0]+" - "+values[1]);
        
        campoValidado = true
        switch (values[0]) {
            case 'oferta_id':
                campoValidado = (values[1] >0)
                break;
            case 'selDivision':
                campoValidado = (values[1] >0)
                break;
            case 'selZC':
                campoValidado = (values[1] >0)
                break;
            case 'archivo_captura':
                campoValidado = (true)
                break;
            case 'archivo':
                campoValidado = (true)
                break;
          
            default:
                campoValidado = (values[1] != '')
        }
        
        fdValidateOk = ( fdValidateOk && campoValidado )
       
    }
    //console.log(formData);
    console.log(fdValidateOk)
    if (fdValidateOk) {
        agregarCCConfirmacion(formData)
    } else {
        
        Swal.fire(
            'Favor de validar campos.',
            'Todos los campos son obligatorios.',
            'warning'
        )    
    }

});

function agregarCCConfirmacion(formData){
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
            agregarCCEnvio(formData)    
            

        } else {
            console.log("No confirmado ");    
        }
        
    })
}

function agregarCCEnvio (formData){
    console.log("Inicia Ajax");
    $.ajax({
        url: 'agregarCCAjax',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
        ,beforeSend: function () {
            
        },
        success: function (data, textStatus, xhr) {
            console.log(textStatus)
            console.log(xhr)
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
}
//Fin Seccion #agregarCC

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
            ,autoWidth: true
            ,processing: true
            ,serverSide: false 
            ,pagingType: "full_numbers"
            ,deferRender: true
            ,bDestroy: true
            ,data: json.tabla
            ,autoWidth: false
            ,order: [[1, 'asc']]
            ,paging: true
            ,aLengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'Todo' ]
            ]
            ,dom: 'lfrtip'
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
                ,{ "data": "division" } 
                ,{ "data": "zona_carga" }
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
                row.child(calculoCC( row.data().calculoCC) ).show();

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
                    <input type="text" width="10" class="form-control" id="enegia'+data.id+'" \
                        placeholder="" name="energia'+data.id+'"> \
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
        var subTabla = $('#tablaCCPaso2').DataTable({
            "oLanguage": {
                "sEmptyTable": "No se puede mostrar los registros"
            }
            ,processing: true
            ,serverSide: false 
            ,pagingType: "full_numbers"
            ,deferRender: false
            ,bDestroy: true
            ,data: json.tabla
            ,autoWidth: false
            ,"targets": 'no-sort'
            ,bSort: false
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
                {
                    className: 'dt-control-paso2',
                    orderable: false,
                    data: null,
                    defaultContent: '+'
                }
                ,{ "data": "id" } //0
                ,{ "data": "nombre" }
                ,{ "data": "rpu_id" }
                ,{ "data": "tarifa" }
                ,{ "data": "division_id" } 
                ,{ "data": "division" } 
                ,{ "data": "zona_carga" }
                ,{ "data": "demanda_contratada" }
                ,{ "data": "demanda_contratada"
                        ,render: function (data, type, row) {
                            return ""; //inputEnergia(data);   
                        }  
                }
                ,{ "data": "demanda_contratada" }
                ,{ "data": "demanda_contratada" }
                
            ],
        });

        subTabla.on('click', 'td.dt-control-paso2', function (e) {
            let tr = e.target.closest('tr');
            let row = subTabla.row(tr);
            
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                row.child( precioCondComerciales( row.data().calculoCC ) ).show();

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
            console.log( "complete tablaCCPaso2" );
    });
}

function calculoCC(resultados) {
    
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
            <th>'+data.cm_kWh_ip+'</th> \
            <th>'+data.ct_kWh+'</th> \
            <th>'+data.dm_kW+'</th> \
            <th>'+data.dmp_kW+'</th> \
            <th>'+data.er_kVARh+'</th> \
            <th>'+data.tr_MXN_kWh+'</th> \
            <th>'+data.promedio_horario_kWh_ib+'</th> \
            <th>'+data.promedio_horario_kwh_ii+'</th> \
            <th>'+data.promedio_horario_kwh_ip+'</th> \
            <th>'+data.pcc_ib+'</th> \
            <th>'+data.pcc_ii+'</th> \
            <th>'+data.pcc_ip+'</th> \
            <th>'+data.porcentaje_ib+'</th> \
            <th>'+data.porcentaje_ii+'</th> \
            <th>'+data.porcentaje_ip+'</th> \
            <th>'+data.pb_ib+'</th> \
            <th>'+data.pb_ii+'</th> \
            <th>'+data.pb_ip+'</th> \
            <th>'+data.ppt+'</th> \
            <th>'+data.ppnt+'</th> \
            <th>'+data.total_perdidas+'</th> \
        </tr>   \
        '
    });
    
                         

    tabla = '<table id="tablaCC" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr >    \
                    <th>Año</th>  \
                    <th>Mes</th>  \
                    <th class="CellWithComment">IB <span class="CellComment">Cantidad horas intervalo Base CFE</span></th>  \
                    <th class="CellWithComment">II <span class="CellComment">Cantidad horas intervalo Intermedia CFE</span></th> \
                    <th class="CellWithComment">IP<span class="CellComment">Cantidad horas intervalo Punta CFE</span></th> \
                    <th class="CellWithComment">3I<span class="CellComment">Total horas tres intervalos CFE</span></th> \
                    <th class="CellWithComment">CIB <span class="CellComment">Consumo mensual kWh en Intervalo Base </span> </th> \
                    <th class="CellWithComment">CII <span class="CellComment">Consumo mensual kWh en Intervalo Intermedia </span> </th> \
                    <th class="CellWithComment">CIP <span class="CellComment">Consumo mensual kWh en Intervalo Punta </span> </th> \
                    <th class="CellWithComment">CT <span class="CellComment">Consumos totales (kWh) </span> </th> \
                    <th class="CellWithComment">DM <span class="CellComment">Demanda máxima (kW) </span> </th> \
                    <th class="CellWithComment">DMP <span class="CellComment">Demanda máxima en punta (kW) </span> </th> \
                    <th class="CellWithComment">ER <span class="CellComment">Energía reactiva (kVARh) </span> </th> \
                    <th class="CellWithComment">TR <span class="CellComment">Tarifa recibo (MXN/kWh) </span> </th> \
                    <th class="CellWithComment">PIB <span class="CellComment">Promedio horario (kWh) Intevalo Base </span> </th> \
                    <th class="CellWithComment">PII <span class="CellComment">Promedio horario (kWh) Intervalo Intermedia </span> </th>  \
                    <th class="CellWithComment">PIP <span class="CellComment">Promedio horario (kWh) Intervalo Punta </span> </th>  \
                    <th class="CellWithComment">PCCIB <span class="CellComment">Perfil Centro de Carga Intervalo Base </span> </th>  \
                    <th class="CellWithComment">PCCII <span class="CellComment">Perfil Centro de Carga Intervalo Intermedia </span> </th> \
                    <th class="CellWithComment">PCCIP <span class="CellComment">Perfil Centro de Carga Intervalo Punta </span> </th> \
                    <th class="CellWithComment">%IB <span class="CellComment">Porcentaje intervalo Base </span> </th> \
                    <th class="CellWithComment">%II <span class="CellComment">Porcentaje intervalo Intermedia </span> </th> \
                    <th class="CellWithComment">%IP <span class="CellComment">Porcentaje intervalo Punta </span> </th> \
                    <th class="CellWithComment">PBIB <span class="CellComment">Perfil Base Intervalo Base </span> </th> \
                    <th class="CellWithComment">PBII <span class="CellComment">Perfil Base Intervalo Intermedia </span> </th> \
                    <th class="CellWithComment">PBIP <span class="CellComment">Perfil Base Intervalo Punta </span> </th> \
                    <th class="CellWithComment">PPT <span class="CellComment">Pérdidas Técnicas (PPT) </span> </th> \
                    <th class="CellWithComment">PPNT <span class="CellComment">Pérdidas no Técnicas (PPNT) </span> </th> \
                    <th class="CellWithComment">TCP <span class="CellComment">Total Cálculo de Pérdidas </span> </th> \
                </tr>   \
            </thead>    \
            <tbody>'
            +tBody+ 
            '</tbody>    \
        </table>' 
    ;

    return tabla;
}

function precioCondComerciales(datos) {

    console.log("precioCondComerciales");
    var cCoemrciales = condicionesComerciales(datos);
    var ahorros = tablaCCPaso2Ahorros(datos)
    var resultados = tablaCCPaso2Resultados(datos)
    var roi = tablaCCPaso2Roi(datos)
    var utilidad = tablaCCUtilidad(datos)

    return cCoemrciales + ahorros + resultados +  utilidad +  roi;

}

function condicionesComerciales(resultados){
     var tBody = "";
    var tabla = '<table id="condicionesComerciales" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr BGCOLOR ="#86a899" align="center"> \
                    <th colspan="4" style="text-align:center">Condiciones comerciales de la oferta </th> \
                    <th></th>\
                    <th colspan="2" style="text-align:center">Condiciones de cobertura </th> \
                </tr> \
            </thead>    \
            <tbody>\
                <tr>    \
                    <td>Fee de intermediación</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td>% exposición MTR</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td></td>  \
                    <td>Nodo Cobertura</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                </tr>   \
                <tr>    \
                    <td>Diferencias Nodales asumidas por</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td>Fee MTR (MXN/MWh)</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td></td>  \
                    <td>Costo Energía</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                </tr>   \
                <tr>    \
                    <td>Nodo Diferencias Nodales</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td>Incluir Financiamiento</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td></td>  \
                    <td>Moneda</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                </tr>   \
                <tr>    \
                    <td>Costos regulados</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td>Años</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td></td>  \
                    <td>% Cobertura</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                </tr>   \
                <tr>    \
                    <td>Otros costos (MWh)</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td>Otro monto mensual</td>  \
                    <td><input id="empid" name="empid"  ></td>  \
                    <td></td>  \
                    <td></td>  \
                    <td></td>  \
                </tr>   \
            </tbody>    \
        </table>' 
    ;

    return tabla;

}

function tablaCCPaso2Ahorros(resultados){

    var tBody = "";
    
    resultados.forEach( function(data, indice) {
        
        tBody +='<tr>    \
            <th>'+data.anio+'</th>  \
            <th>'+data.mes+'</th>  \
            <th>'+data.csp_kwh+'</th>  \
            <th></th>  \
            <th></th>  \
            <th></th>  \
            <th></th>  \
        </tr>   \
        '
    });
    
                         
    //           
    var tabla = '<table id="tablaCCPaso2Ahorros" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr BGCOLOR ="#86a899" align="center"> <th colspan="7" style="text-align:center">Ahorros</th></tr>\
                <tr>    \
                    <th>Año</th>  \
                    <th>Mes</th>  \
                    <th>Consumo sin pérdidas (kWh)</th>  \
                    <th>Facturación Fénix estimada (MXN)</th>  \
                    <th>Facturación CFE SSB estimada (MXN)</th>  \
                    <th>Ahorros (MXN)</th>  \
                    <th>% Ahorro</th>  \
                </tr>   \
            </thead>    \
            <tbody>'
            +tBody+ 
            '</tbody>    \
        </table>' 
    ;

    return tabla;

}

function tablaCCPaso2Resultados(resultados){

    var tBody = "";
    
    tBody +='<tr>    \
            <td>Ahorro MXP</td>  \
            <td>Ahorro %</td>  \
            <td></td>  \
            <td>Total Utilidad (MXN/MWh)</td>  \
            <td>% Utilidad Fenix </td>  \
            <td>Utilidad (MXN)</td>  \
        </tr>   \
        ' 
    tBody +='<tr>    \
            <td>1,688,752</td>  \
            <td>25%</td>  \
            <td></td>  \
            <td>223</td>  \
            <td>18%</td>  \
            <td>618,013</td>  \
        </tr>   \
        '    
                         
    //           
    var tabla = '<table id="tablaCCPaso2Resultados" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr BGCOLOR ="#86a899"> <th colspan="6" style="text-align:center">Resultados</th></tr>\
                <tr>    \
                    <th colspan="2" style="text-align:center" >Ahorros</th>  \
                    <th></th>  \
                    <th colspan="3" style="text-align:center" >Utilidades</th>  \
                </tr>   \
            </thead>    \
            <tbody>'
            +tBody+ 
            '</tbody>    \
        </table>' 
    ;

    return tabla;

}


function tablaCCPaso2Roi(resultados){

    var tBody = "";
    
    tBody +='<tr>    \
            <td >1,688,752 </td>  \
            <td>140,729</td>  \
            <td>1,800,000 </td>  \
            <td>13</td>  \
        </tr>   \
        ' 
    
                         
    //           
    var tabla = '<table id="tablaCCPaso2Roi" class="table table-striped table-bordered \
            dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
            <thead> \
                <tr BGCOLOR ="#86a899"> <th  colspan="4" style="text-align:center">ROI</th></tr>\
                <tr>    \
                    <th style="text-align:center">Ahorro anual (MXN)</th>  \
                    <th style="text-align:center">Ahorro mensual (MXN)    </th>  \
                    <th style="text-align:center">Inversión (MXN)</th>  \
                    <th style="text-align:center">Periodo de retorno de la inversión (meses)</th>  \
                </tr>   \
            </thead>    \
            <tbody>'
            +tBody+ 
            '</tbody>    \
        </table>' 
    ;

    return tabla;

}

function tablaCCUtilidad(datos){
    var tBody = "";
    /*    
    tBody +='<tr>    \
            <td >1,688,752 </td>  \
            <td>140,729</td>  \
            <td>1,800,000 </td>  \
            <td>13</td>  \
        </tr>   \
        ' 
*/

    var tabla = '<table id="tablaCCPaso2Utilidad" class="table table-striped table-bordered \
        dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">\
        <thead> \
            <tr BGCOLOR ="#86a899"> <th  colspan="13" style="text-align:center">UTILIDADES</th></tr>\
            <tr BGCOLOR ="#86a899"> \
                <th  colspan="7" style="text-align:center">Utilidad Fénix</th> \
                <th  colspan="6" style="text-align:center">Intermediario</th> \
            </tr>\
            <tr BGCOLOR ="#86a899"> \
                <th  colspan="4" style="text-align:center">Cobertura 100% NEC</th> \
                <th  colspan="3" style="text-align:center">Cobertura 60% NEC 40% Spot</th> \
                <th  colspan="3" style="text-align:center">Cobertura 100% NEC </th> \
                <th  colspan="3" style="text-align:center">Cobertura 60% NEC 40% Spot</th> \
            </tr>\
            <tr BGCOLOR ="#86a899"> \
                <th style="text-align:center">Consumo <p>+ PPT<p>+ PPNT (kWh)</th> \
                <th style="text-align:center">Total Utilidad<p> (MXN/MWh)</th> \
                <th style="text-align:center">% Utilidad </th> \
                <th style="text-align:center">Utilidad <p>(MXN)</th> \
                <th style="text-align:center">Total Utilidad<p> (MXN/MWh)</th> \
                <th style="text-align:center">% Utilidad <p>Fenix </th> \
                <th style="text-align:center">Utilidad <p>(MXN)</th> \
                <th style="text-align:center">Fee <p>(MXN/MWh)</th> \
                <th style="text-align:center">% Fee sobre<p> utilidad</th> \
                <th style="text-align:center">Total fee <p>(MXN)</th> \
                <th style="text-align:center">Fee<p> (MXN/MWh)</th> \
                <th style="text-align:center">% Fee <p>sobre utilidad</th> \
                <th style="text-align:center">Total fee<p> (MXN)</th> \
            </tr>\
        </thead>    \
        <tbody>'
        +tBody+ 
        '</tbody>    \
    </table>' 
    ;

    return tabla;

}