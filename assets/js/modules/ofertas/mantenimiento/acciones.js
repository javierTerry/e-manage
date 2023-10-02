$(document).ready(function() {
	
});

$("#subirArchivoMM").click(function (event) {
	console.log("Subir archivo de mm");

	var archivo = $("#archivo")[0].files[0];
  	var catalogoId = $("#catalogo_id").val();

  	var bArchivo = (archivo=== undefined)
  	var bCatalogId = (catalogoId == 0)
  	var mensajeArchivo = "";
  	var mensajeCatalogId = "";


  	console.log( (bArchivo) );
	console.log( bCatalogId  );
	
  	if ( bArchivo || bCatalogId ) {
  		if (bArchivo) {
  			mensajeArchivo = "* Seleccione un archivo <p>";
  		}
  		if (bCatalogId) {
  			mensajeCatalogId = "* Seleccione el tipo de catalogo";
  		}
  		Swal.fire(
          mensajeArchivo+mensajeCatalogId,
          'Favor de validar ',
          'warning'
        )
  	} else {

  		$('#loader').show();
	  	var formData = new FormData();
	    formData.append('archivo', archivo);
	    formData.append('catalogoId', catalogoId);

	   	$.ajax({
			url: 'guardarCatalogoArchivo',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
			    
			},
			success: function (data) { 
			    console.log("Seccion success");
			    
			    Swal.fire({
                    title: 'Se guardo el archivo',
                    text: 'Con Exitoso',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                    
                }).then((result) => {
                    location.reload();
                }); 
			    
			},
			error: function () {
			    console.log("Seccion error");
			    
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

  	}//Fin Else
  	
  	

    
});