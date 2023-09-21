<!-- paso uno -->
<div id="headingOne" >
    Hola <?php echo sprintf(" %s, Seguimiento al Folio: %s", $deal['cliente'],$deal['fol']); ?>
</div>

<style>
    #loader {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .loader-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .loader-text {
        font-size: 24px;
        color: white;
    }
</style>
<div id="loader">
    <div class="loader-content">
        <span class="loader-text">Cargando...</span>
        <div class="loader-spinner"></div>
    </div>
</div>

<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
    data-bs-parent="#accordionExample">
    <div class="card-body">
        <div class="container px-3 text-left" id="cargarCCform">
            <div class="row gx-4">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombreCC" class="form-label">nombreCC:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre que se usara en el CC" name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="selDivision">Division:</label>
                        <select class="form-control" id="selDivision" name="selDivision">
                            <option value=0>Seleccione una division...</option>
                            <?php foreach ($divisionesSelect as $ds) {
                            echo "<option value='" . $ds["of_divisiones_id"] . "'>" . $ds["division"] . "</option>";
                        } ?>
                        </select>
                    </div>
                                          
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="RPUID" class="form-label">RPU/ID:</label>
                        <input type="text" class="form-control" id="rpu_id" placeholder="Ingrese RPUID" name="rpu_id">
                    </div>

                    <div class="form-group">

                        <label for="selZC">Zona de Carga:</label>
                        <select class="form-control" id="selZC" name="selZC">
                            <option value=0>Seleccione una zona de carga...</option>
                        </select>

                    </div>
                                       
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="selTarifa" class="form-label">Tarifa:</label>
                        <select class="form-control" id="tarifa" name="tarifa">
                            <option value='GDMTH'>GDMTH</option>
                            <option value='DIST'>DIST</option>
                            <option value='DIT'>DIT</option>
                        </select>
                    </div>

                    <div class="form-group">

                        <label for="txtD">Demanda Contratada:</label>
                        <input type="text" class="form-control" id="demanda_contratada" placeholder="KWh" name="demanda_contratada">

                    </div>

                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="selTarifa" class="form-label">Esquema Suministro:</label>
                        <select class="form-control" id="esquema" name="esquema">
                            <option value=0>Seleccione un esquema...</option>
                            <option value='basico'>Basico</option>
                            <option value='calificado'>Calificado</option>
                        </select>
                    </div>
                    
                </div>

                <input id="oferta_id" name="oferta_id" type="hidden" value="<?php echo $ofertaId; ?>" class="form-control">
            </div>
        </div>
    </div>

    <?php if ( !$guardarPaso1 ) { ?>
        <button id="guardarPaso1CC" class="btn btn-success ">Guardar</button>
    <?php } else { ?>
        <?php if ($validarBtnPasoSi == 1 ) { ?>
        <button type="button" id="paso1" class="btn btn-success ">Siguiente Paso </button>
        
        <?php } else { ?>
            <button type="button" id="validar" class="btn btn-success ">Validar</button>
            <button id="agregarCC" class="btn btn-success ">Agregar CC</button>

        <?php } ?>
    <?php } ?>

    

    
    <?php
        $this->load->view("deal/ofertas/paso1/tabla");
    ?>
            
</div>
<!-- id="collapseOne" -->