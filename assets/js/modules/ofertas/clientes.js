
function callbackSuccess(data) {
    console.log(data)
    res= JSON.parse(data);
    if (res.status == "success"){
        $( "#txtNombreCliente" ).val('');
        $( "#txtRazonSocial" ).val('');
        $('.close').click();
        Swal.fire({
            title: 'Cliente Guardado',
            text: 'Con Exitoso',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
            
        }).then((result) => {
            location.reload();
        });         
        
    }else if (res.status == "Ya existe un cliente con ese nombre.") {
        $('.close').click();
        Swal.fire({
            title: res.status,
            text: 'favor de validar',
            icon: 'warning',
            showConfirmButton: false,
            timer: 2500
            
        }).then((result) => {
            console.log("asdfasd")
            $('#btnnuevocliente').click();
        }); 
    } else {
        
        $( "#txtNombreCliente" ).val('');
        $( "#txtRazonSocial" ).val('');
        $('.close').click();
        Swal.fire({
            title: 'Ocurrio un error al tratar de Guardar el cliente.',
            text: 'Favor de validar con su administrador',
            icon: 'error',
            showConfirmButton: false,
            timer: 375068900
            
        }); 
    }
}


$("#btnGuardaCliente").click(function(event){
    
    //if (confirm("¿seguro que quiere guardar este cliente?") == true) {
    $('.close').click();
    Swal.fire({
      title: '¿Seguro que quiere guardar este cliente?',
      text: 'Favor de Confirmar',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Agregar Cliente!',
      cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {

            var nombre = $( "#txtNombreCliente" ).val();
            var razonsocial = $( "#txtRazonSocial" ).val();

            $.ajax({
                url: 'saveClient',
                type: 'POST',
                data: {nombre: nombre, razonsocial: razonsocial},
                error: function() {
                    $( "#txtNombreCliente" ).val('');
                        $( "#txtRazonSocial" ).val('');
                        $('.close').click();
                        Swal.fire({
                            title: 'Ocurrio un error al tratar de Guardar el cliente.',
                            text: 'Favor de validar con su administrador',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3000
                            
                        }); 
                },
                
                success: function(data) {
                    callbackSuccess(data)
                }// fin success
            }); //fin Ajax
        } else {//fin IF
             $('#btnnuevocliente').click();
        }
    });

    //}
            
});


$("#btnGuardaRPU").click(function(event){
  
    if (confirm("¿seguro que quiere guardar este RPU?") == true) {
        var selCliente = $( "#selCliente" ).val();
        var txtRPU = $( "#txtRPU" ).val();
        var txtdireccion = $( "#txtdireccion" ).val();
        var txtRZ = $( "#txtRZ" ).val();
        var txtPlanta = $( "#txtPlanta" ).val();
        var txtNR = $( "#txtNR" ).val();
        var txtdivisiom = $( "#txtdivisiom" ).val();
        var txtDC = $( "#txtDC" ).val();
        var txtDM = $( "#txtDM" ).val();
        var txtCR = $( "#txtCR" ).val();
        var txtCA = $( "#txtCA" ).val();
        var txtDR = $( "#txtDR" ).val();
        if (txtRPU.trim() == '') {
            alert("Debe ingresar un RPU");
            return;
        }
        
        $.ajax({
            url: 'saveRPU',
            type: 'POST',
            data: {selCliente: selCliente, txtRPU: txtRPU,txtdireccion:txtdireccion,txtRZ:txtRZ,txtPlanta:txtPlanta,txtNR:txtNR,txtdivisiom:txtdivisiom,txtDC:txtDC,txtDM:txtDM,txtCR:txtCR,txtCA:txtCA,txtDR:txtDR},
            error: function() {
                alert("Ocurrio un error al tratar de Guardar el RPU");
            },
            success: function(data) {
                res=JSON.parse(data);
                if (res.status == "success"){
                    alert("RPU Guardado");
                    $( "#selCliente" ).val();
                    $( "#txtRPU" ).val('');
                    $( "#txtdireccion" ).val('');
                    $( "#txtRZ" ).val('');
                    $( "#txtPlanta" ).val('');
                    $( "#txtNR" ).val('');
                    $( "#txtdivisiom" ).val('');
                    $( "#txtDC" ).val('');
                    $( "#txtDM" ).val('');
                    $( "#txtCR" ).val('');
                    $( "#txtCA" ).val('');
                    $( "#txtDR" ).val('');
                    $('#nuevoRPU').modal('hide');
                    location.reload();
                }else{
                    alert("El RPU ya existe");
                }
                /*if (data==0) {
                    
                }else{
                    
                }*/
            }
        }); 
    }
           
});



  function removeRPU(RPUid){
    if (confirm("¿Seguro que quiere borrar el RPU?") == true) {
           
        $.ajax({
            url: 'removeRPU',
            type: 'POST',
            data: {RPUid: RPUid},
            error: function() {
                alert("Ocurrio un error al tratar de borrar el RPU.");
            },
            success: function(data) {
                res=JSON.parse(data);
                if (res.status == "success"){
                    alert("RPU Borrado Correctamente");
                    location.reload();
                }else{
                    alert("Ocurrio un error al tratar de borrar el RPU.");
                }
                
            }
        }); 
    }
}

  
  







  