<div class="right_col" role="main">

	<div class="">

        <button type="button" class="btn btn-lg btn-default" id="verinicio">
            <span class="glyphicon glyphicon-home"></span> Inicio
        </button>
        <button type="button" class="btn btn-lg btn-default" id="nuevaoferta" data-toggle="modal"
            data-target="#nuevaOferta">
            <span class="glyphicon glyphicon-pencil"></span> Nueva Oferta
        </button>
        <button type="button" class="btn btn-lg btn-default" id="nuevatarifa" data-toggle="modal"
            data-target="#nuevaTarifa">
            <span class="glyphicon glyphicon-pencil"></span> Subir Tarifa
        </button>
        <?php
            if ($vMenu["render"]) {
                $this->load->view("main/vMenu", $vMenu["data"]);
            }
            ?>

    </div>

</div>