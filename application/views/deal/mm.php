<div class="right_col" role="main">

	<div class="">

        <button type="button" class="btn btn-lg btn-default" id="verinicio">
            <span class="glyphicon glyphicon-home"></span> Inicio
        </button>
        <button type="button" class="btn btn-lg btn-default" id="cargarArchivo" data-toggle="modal"
            data-target="#cargarArchivoModal">
            <span class="glyphicon glyphicon-pencil"></span> Cargar Archivo
        </button>
       
        <?php
		    if ($vMenu["render"]) {
		        $this->load->view("main/vMenu", $vMenu["data"]);
		    }
        ?>

    </div>
</div>

<div class="">
	<?php
        $this->load->view("deal/mm/modal/cargarArchivo")
    ?>
	
</div>

