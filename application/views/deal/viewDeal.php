<div class="right_col" role="main">

    <div class="">

        <button type="button" class="btn btn-lg btn-default" id="backOfertas">
            <span class="glyphicon glyphicon-home"></span> Ofertas
        </button>

        <?php
        if ($vMenu["render"]) {
            $this->load->view("main/vMenu", $vMenu["data"]);

        }
        ?>

    </div>


    <input id="empid" name="empid" type="hidden" value="<?php echo $userData["employee_id"]; ?>">

    <input id="ofertaId" name="ofertaId" type="hidden" value="<?php echo $ofertaId; ?>">

    <div id="findPasoValue" data-findpaso="<?php echo $findPaso; ?>"></div>

    <div id="validarPrecioValue" data-validarPrecio="<?php echo $validarPrecio; ?>"></div>
    <div id="validarTarifaValue" data-validarTarifa="<?php echo $validarTarifa; ?>"></div>
    <div id="validarHorarioValue" data-validarHorario="<?php echo $validarHorario; ?>"></div>
    <div id="validarGeneradorValue" data-validarGenerador="<?php echo $validarGenerador; ?>"></div>


    <!-- inicio stepper ///////////////////// -->
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="steps">
                <progress id="progress" value=0 max=100></progress>
                <div class="step-item">
                    <button id="sb1" class="step-button text-center" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        1
                    </button>
                    <div class="step-title">
                        Validar Datos
                    </div>
                </div>
                <div class="step-item">
                    <button id="sb2" class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        2
                    </button>
                    <div class="step-title">
                        Generar
                    </div>
                </div>
                <div class="step-item">
                    <button id="sb3" class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        3
                    </button>
                    <div class="step-title">
                        Oferta
                    </div>
                </div>
                <div class="step-item">
                    <button id="sb4" class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        4
                    </button>
                    <div class="step-title">
                        Contratos
                    </div>
                </div>
                <div class="step-item">
                    <button id="sb5" class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        5
                    </button>
                    <div class="step-title">
                        Ejecucion
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- paso uno -->
                <div id="headingOne">
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
                        <div class="container px-4 text-left">
                            <!-- <div class="row gx-5">
                                <div class="col">
                                    <div class="p-3">
                                        <?php if ($validarPrecio == 1) { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chkprecios" checked
                                            disabled>
                                        <?php } else { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chkprecios">
                                        <?php } ?>
                                        <label class="form-check-label" for="chkprecios">
                                            Precios
                                        </label>
                                        <div class="input-group">
                                            <?php if ($validarPrecio == 1) { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file hidden">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bprecios" type="file" id="bprecios">
                                                </span>
                                            </label>
                                            <?php } else { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bprecios" type="file" id="bprecios">
                                                </span>
                                            </label>
                                            <?php } ?>
                                            <input class="form-control" id="precios_captura" readonly="readonly"
                                                name="precios_captura" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row gx-5">
                                <div class="col">
                                    <div class="p-3">
                                        <?php if ($validarTarifa == 1) { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chktarifas" checked
                                            disabled>
                                        <?php } else { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chktarifas">
                                        <?php } ?>
                                        <label class="form-check-label" for="chktarifas">
                                            Tarifas
                                        </label>
                                        <div class="input-group">
                                            <?php if ($validarTarifa == 1) { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file hidden">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="btarifas" type="file" id="btarifas">
                                                </span>
                                            </label>
                                            <?php } else { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="btarifas" type="file" id="btarifas">
                                                </span>
                                            </label>
                                            <?php } ?>
                                            <input class="form-control" id="tarifa_captura" readonly="readonly"
                                                name="tarifa_captura" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- chs -->

                             <div class="row gx-5">
                                <div class="col">
                                    <div class="p-3">
                                        <?php if ($validarHorario == 1) { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chkdatoshorarios"
                                            checked disabled>
                                        <?php } else { ?>
                                        <input class="form-check-input" type="checkbox" value="" id="chkdatoshorarios">
                                        <?php } ?>
                                        <label class="form-check-label" for="chkdatoshorarios">
                                            Datos Horarios
                                        </label>
                                        <div class="input-group">
                                            <?php if ($validarHorario == 1) { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file hidden">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bdatoshorarios" type="file" id="bdatoshorarios">
                                                </span>
                                            </label>
                                            <?php } else { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bdatoshorarios" type="file" id="bdatoshorarios">
                                                </span>
                                            </label>
                                            <?php } ?>
                                            <input class="form-control" id="datoshorarios_captura" readonly="readonly"
                                                name="datoshorarios_captura" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-5">
                                <div class="col">
                                    <div class="p-3">
                                        <?php if ($validarGenerador == 1) { ?>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="chkgeneradosbloques" checked disabled>
                                        <?php } else { ?>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="chkgeneradosbloques">
                                        <?php } ?>
                                        <label class="form-check-label" for="chkgeneradosbloques">
                                            Generador de bloques
                                        </label>
                                        <div class="input-group">
                                            <?php if ($validarGenerador == 1) { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file hidden">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bgenerador" type="file" id="bgenerador">
                                                </span>
                                            </label>
                                            <?php } else { ?>
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary btn-file">
                                                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                                        name="bgenerador" type="file" id="bgenerador">
                                                </span>
                                            </label>
                                            <?php } ?>
                                            <input class="form-control" id="generador_captura" readonly="readonly"
                                                name="generador_captura" type="text" value="">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- chs -->
                        </div>

                        <!-- <button type="button" id="subir" class="btn btn-success ">Guardar</button> -->
                        <button type="submit" id="subir" class="btn btn-success ">Guardar</button>

                        <?php if ($validarBtnValidar == 1 ) { ?>
                        <button type="button" id="validar" class="btn btn-success ">Validar</button>
                        <?php } else { ?>
                        <button type="button" id="validar" class="btn btn-success "
                            style="display: none;">Validar</button>
                        <?php } ?>

                        <?php if ($validarBtnPasoSi == 1 ) { ?>
                        <button type="button" id="paso1" class="btn btn-success ">Siguiente Paso</button>
                        <?php } else { ?>
                        <button type="button" id="paso1" class="btn btn-success " style="display: none;">Siguiente
                            Paso</button>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="card">
                <!-- paso 2 -->
                <div id="headingTwo">

                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selTarifa" class="form-label">Tarifa:</label>
                                    <select class="form-control" id="selTarifa" name="selTarifa">
                                        <option value='GDMTH'>GDMTH</option>
                                        <option value='DIST'>DIST</option>
                                        <option value='DIT'>DIT</option>
                                    </select>
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
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="txtD">Demanda Contratada:</label>
                                    <input type="text" class="form-control" id="txtD" placeholder="KWh" name="txtD">

                                </div>
                                <div class="form-group">

                                    <label for="selZC">Zona de Carga:</label>
                                    <select class="form-control" id="selZC" name="selZC">
                                        <option value=0>Seleccione una zona de carga...</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="selPerfil" class="form-label">Peril:</label>
                                    <select class="form-control" id="selPerfil" name="selPerfil">
                                        <option value=0>Seleccione un perfil...</option>
                                        <option value='_Base'>Base</option>
                                        <option value='CC'>CC</option>

                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                </br>
                                <label class="form-label">PRECIOS FIJOS</label>
                                </br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="txtEnergia" class="form-label">Energia:</label>
                                <input type="text" class="form-control" id="txtEnergia" placeholder="MXN/MWh"
                                    name="txtEnergia">
                            </div>
                            <div class="col-md-6">
                                <label for="txtPotencia" class="form-label">Potencia:</label>
                                <input type="text" class="form-control" id="txtPotencia" placeholder="MXN/MWh"
                                    name="txtPotencia">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="txtCel" class="form-label">CEL:</label>
                                <input type="text" class="form-control" id="txtCel" placeholder="MXN/CEL" name="txtCel">
                            </div>
                            <div class="col-md-6">
                                <label for="txtFee" class="form-label">Fee Intermediacion:</label>
                                <input type="text" class="form-control" id="txtFee" placeholder="" name="txtFee">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="txtCelMxn" class="form-label">CEL:</label>
                                <input type="text" class="form-control" id="txtCelMxn" placeholder="MXN/MWh"
                                    name="txtCelMxn">
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">    
                        <br></br>
                        <div class="row">
                            <div class="container text-center">
                                <button type="button" id="generar" class="btn btn-success">Generar</button>
                            </div>
                        </div>
                        <hr></hr>
                    </div>
                    <?php
                        $this->load->view("deal/paso2/tablaResultados")
                    ?>
                        
                    <div class="card-body">
                        <div class="row">
                            </br>
                        </div>                      
                        <button type="button" id="guardar" class="btn btn-success">Guardar</button>
                        <button type="button" id="validar2" class="btn btn-success ">Validar</button>
                        <?php if ($validarBtnPasoSi2 == 1 ) { ?>
                        <button type="button" id="paso2" class="btn btn-success">Siguiente Paso</button>
                        <?php } else { ?>
                        <button type="button" id="paso2" class="btn btn-success " style="display: none;">Siguiente
                            Paso</button>
                        <?php } ?>

                    </div>
                    
                </div>
                <div class="card">
                    <!-- paso 3 -->
                    <div id="headingThree">

                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <button type="button" id="excel" class="btn btn-success">Descargar Excel</button>
                                    <button type="button" id="generarWord" class="btn btn-success">Generar
                                        Reporte</button>
                                </div>
                                <button type="button" id="guardar2" class="btn btn-success">Guardar</button>
                                <button type="button" id="validar3" class="btn btn-success ">Validar</button>
                                <?php if ($validarBtnPasoSi3 == 1 ) { ?>
                                <button type="button" id="paso3" class="btn btn-success">Siguiente Paso</button>
                                <?php } else { ?>
                                <button type="button" id="paso3" class="btn btn-success "
                                    style="display: none;">Siguiente
                                    Paso</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">

                    <div id="headingFour"></div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="card-body">
                            <div class="p-1">
                                <label class="form-check-label" for="contrado_label">
                                    Contrato
                                </label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary btn-file">
                                            Archivos <input accept=".pdf" class="hidden" name="contrato[]" type="file"
                                                multiple id="contrato">
                                        </span>
                                    </label>
                                    <input class="form-control" id="contrato_captura" readonly="readonly"
                                        name="contrado_captura" type="text" value="">
                                </div>
                            </div>
                            <button type="button" id="guardar3" class="btn btn-success">Guardar</button>
                            <button type="button" id="validar4" class="btn btn-success">Validar</button>
                            <?php if ($validarBtnPasoSi4 == 1 ) { ?>
                            <button type="button" id="paso4" class="btn btn-success">Siguiente Paso</button>
                            <?php } else { ?>
                            <button type="button" id="paso4" class="btn btn-success" style="display: none;">Siguiente
                                Paso</button>
                            <?php } ?>
                        </div>
                        <h5>DOCUMENTOS DE LA OFERTA</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha de carga</th>
                                    <th>Descarga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getFiles as $file): ?>
                                <tr>
                                    <td><?php echo $file['name']; ?></td>
                                    <td><?php echo $file['fecha']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-lg btn-default download-btn"
                                            data-nombre="<?php echo $file['name']; ?>">
                                            <span class="glyphicon glyphicon-cloud-download"></span>
                                        </button>


                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <!-- paso 5 -->
                    <div id="headingFive">
                    </div>
                    <br>
                    <br>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample">
                        <div class="card-body text-center">
                            <button type="button" id="validar5" class="btn btn-success btn-lg">Validar</button>
                            <?php if ($validarBtnPasoSi5 == 1 ) { ?>
                            <button type="button" id="paso5" class="btn btn-success btn-lg">
                                <span class="glyphicon glyphicon-ok"></span> Finalizar
                            </button>
                            <?php } else { ?>
                            <button type="button" id="paso5" class="btn btn-success btn-lg" style="display: none";>
                            <span class=" glyphicon glyphicon-ok"></span> Finalizar
                            </button>
                            <?php } ?>
                        </div>

                    </div>
                </div>
                <h5>MOVIMIENTOS DE LA OFERTA</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Validó</th>
                            <th>Movimiento</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($auditoria as $audi): ?>
                        <tr>
                            <td><?php echo $audi['employee']; ?></td>
                            <td><?php echo $audi['paso']; ?></td>
                            <td><?php echo $audi['fecha']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Fin stepper  /////////////////////// -->
    </div>
