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
                <!-- paso 1 -->
                <?php
                    $this->load->view("deal/ofertas/paso1/body");

                ?>
            </div>
            <div class="card">
                <!-- paso 2 -->
                <div id="headingTwo">

                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="card-body">
                        <?php
                            $this->load->view("deal/ofertas/paso2/tablaCC");
                        ?>
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
                        $this->load->view("deal/ofertas/paso2/tablaResultados")
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
