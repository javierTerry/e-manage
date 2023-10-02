<div class="right_col" role="main">

	<div class="">

        <button type="button" class="btn btn-lg btn-default" id="verinicio">
            <span class="glyphicon glyphicon-home"></span> Inicio
        </button>
        
        <?php
		    if ($vMenu["render"]) {
		        $this->load->view("main/vMenu", $vMenu["data"]);
		    }
        ?>

    </div>

    <div class="card-body">
        <?php
            $this->load->view("utilerias/loader");
        ?>
        <form id="myForm" >

            <?php
                $this->load->view("deal/mm/catalogo");
            ?>
            <a type="submit" id="subirArchivoMM" class="btn btn-success "> Guardar
            </a> 
        </form>
    </div>
</div>
