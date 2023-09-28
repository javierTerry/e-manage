$("#btnGuardaOferta").click(function (event) {
    if (confirm("¿seguro que quiere crear la oferta?") == true) {
        var nombre = $("#selCliente").val();
        var clienteId = $("#selCliente").val();
        var f = $("#selTipoOferta").val() + "-"+ $("#selFormatoOferta").val();
        $.ajax({
            url: 'saveDeal',
            type: 'POST',
            data: { nombre: nombre, clienteId: clienteId , folio: f},
            error: function () {
                alert("Ocurrio un error al tratar de crear la oferta.");
            },
            success: function (data) {
                res = JSON.parse(data);
                if (res.status == "success") {
                    alert("Oferta Creada");
                    $("#selCliente").val('');
                    $("#selTipoOferta").val('');
                    $("#selFormatoOferta").val('');
                    $('#nuevaOferta').modal('hide');
                    location.reload();
                } else {
                    alert("Ocurrio un error al tratar de crear la oferta.");
                }
                
            }
        });
    }
});

  
function removeDeal(ofertaId) {
    if (confirm("¿seguro que quiere borrar la oferta?") == true) {

        $.ajax({
            url: 'removeDeal',
            type: 'POST',
            data: { ofertaId: ofertaId },
            error: function () {
                alert("Ocurrio un error al tratar de borrar la oferta.");
            },
            success: function (data) {
                res = JSON.parse(data);
                if (res.status == "success") {
                    alert("Oferta Borrada");
                    location.reload();
                } else {
                    alert("Ocurrio un error al tratar de borrar la oferta.");
                }

            }
        });
    }
}

function viewDeal(ofertaId) {
    window.location.href = window.location.origin + "/e-manage/module/deal/viewDeal?ofertaId=" + ofertaId;
    /*$.ajax({
        url: 'viewDeal',
        type: 'POST',
        data: {ofertaId: ofertaId},
        error: function() {
            alert("Ocurrio un error al tratar de visualizar la oferta.");
        },
        success: function(data) {
            res=JSON.parse(data);
            if (res.status == "success"){
                
            }else{
                alert("Ocurrio un error al tratar de visualizar la oferta.");
            }
            
        }
    });*/
}

$("#subir").click(function (event) {
    var tarifasFile = $("#btarifas")[0].files[0];
  
    if (!tarifasFile) {
        alert("Debe seleccionar los archivos.");
        return;
    }

    var confirmar = confirm("¿Está seguro de subir el archivo?");

    if (confirmar) {
        $('#loader').show();

        var formData = new FormData();
        formData.append('tarifasFile', tarifasFile);
        
        $("#cargarArchivoModal").modal('hide');
        alert("Archivo cargado con Exito.");

    }
});

$(".agregarOferta").click(function (event) {
    var clienteId = $(this).children(".clienteId").val()
    var nombre = $(this).children(".clienteNombre").val()
    console.log( clienteId );
    console.log( nombre );
    Swal.fire({
          title: nombre +' ¿Desea agregar una oferta?',
          text: 'Favor de Confirmar',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Agregar Oferta!',
          cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                var f = "SC"
                $.ajax({
                    url: 'saveDeal',
                    type: 'POST',
                    data: { nombre: nombre, clienteId: clienteId , folio: f},
                    error: function () {
                        alert("Ocurrio un error al tratar de crear la oferta.");
                    },
                    success: function (data) {
                        res = JSON.parse(data);
                        if (res.status == "success") {
                            alert("Oferta Creada");
                            $("#selCliente").val('');
                            $("#selTipoOferta").val('');
                            $("#selFormatoOferta").val('');
                            $('#nuevaOferta').modal('hide');
                            location.reload();
                        } else {
                            alert("Ocurrio un error al tratar de crear la oferta.");
                        }
                        
                    }
                });

            } else {
                console.log("No confirmado ");    
            }
            
        })
    
    });
