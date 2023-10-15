<!-- paso uno -->
<p>
<div id="headingOne" >
</div>
<p>
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
    <div class="card-body" id="cargarCCform">
        <div class="row row-sm">
            <div class="input-group mb-3">
                <div class="col-lg-3">
                    <div class="input-group-prepend">
                        <label for="nombreCC" class="form-label">nombreCC:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre que se usara en el CC" name="nombre">
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="input-group-prepend">
                        <label for="RPUID" class="form-label">RPU/ID:</label>
                        <input type="text" class="form-control" id="rpu_id" placeholder="Ingrese RPUID" name="rpu_id">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group-prepend">
                        <label for="txtD">Demanda Contratada:</label>
                        <input type="text" class="form-control" id="demanda_contratada" placeholder="KWh" name="demanda_contratada">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group-prepend">
                        <label for="selTarifa" class="form-label">Tarifa:</label>
                        <select class="form-control" id="tarifa" name="tarifa">
                            <option value=''>Seleccione una Tarifa</option>
                            <option value='GDMTH'>GDMTH</option>
                            <option value='DIST'>DIST</option>
                            <option value='DIT'>DIT</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="input-group-prepend">
                        <label for="tensionTarifa" class="form-label">Tensión   Tarifa:
                        </label>
                        <input type="text" class="form-control" id="tensionTarifa" placeholder="KWh" name="tensionTarifa" readonly value="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Row -->

        <div class="row row-sm">
            <div class="input-group mb-3">
                <div class="col-lg-3">
                    <div class="input-group-prepend">
                        <label for="selDivision">Division:</label>
                        <select class="form-control" id="selDivision" name="selDivision">
                            <option value=0>Seleccione una division...</option>
                            <?php foreach ($divisionesSelect as $ds) {
                                echo "<option value='" . $ds["of_divisiones_id"] . "'>" . $ds["division"] . "</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group-prepend">
                        <label for="selZC">Zona de Carga:</label>
                        <select class="form-control" id="selZC" name="selZC">
                            <option value=0>Seleccione una zona de carga...</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="input-group-prepend">
                        <label class="form-check-label" for="tipoCatalago">
                            Carga
                        </label>
                        <div class="input-group">
                            
                            <label class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    Archivo 
                                    <input accept=".xls,.xlsx,.csv" class="hidden" name="fArchivo" type="file" id="fArchivo" multiple>
                                </span>
                            </label>
                            
                            <input class="form-control" id="archivo_captura" readonly="readonly" name="archivo_captura" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Row -->
        
  
    </div>
     <!-- Fin Row -->
    <?php if ($validarBtnPasoSi == 1 ) { ?>
    <button type="button" id="paso1" class="btn btn-success ">Siguiente Paso </button>
    
    <?php } else { ?>
        <button type="button" id="validar" class="btn btn-success ">Validar</button>
        <button id="agregarCC" class="btn btn-success ">Agregar CC</button>

    <?php } ?>

    
    <?php
        $this->load->view("deal/ofertas/paso1/tabla");
    ?>
            
</div>


<!-- id="collapseOne" -->