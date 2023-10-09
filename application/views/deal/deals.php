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


<div class="right_col" role="main">
    <div class="">

        <button type="button" class="btn btn-lg btn-default" id="verinicio">
            <span class="glyphicon glyphicon-home"></span> Inicio
        </button>
        
        <button type="button" class="btn btn-lg btn-default" id="btnnuevocliente" data-toggle="modal"
            data-target="#nuevoCliente">
            <span class="glyphicon glyphicon-pencil"></span> Nuevo Cliente
        </button>
        <?php
            if ($vMenu["render"]) {
                $this->load->view("main/vMenu", $vMenu["data"]);
            }
            ?>

    </div>
    <input id="empid" name="empid" type="hidden" value="<?php echo $userData["employee_id"]; ?>">
    <form class="form-inline" id="filter-form" action="" method="get">
        <div class="form-group">
            <label for="nombreCliente">Nombre del cliente:</label>
            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente">
        </div>
        
        <button type="submit" class="btn btn-lg btn-default" id="filtro" data-toggle="modal-filtro"
            data-target="#Filtro-m">
            <span class="glyphicon glyphicon-search"></span> FILTRO
        </button>

    </form>


    <?php
        define('MAX_ITEMS_PER_PAGE', 5);

        

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $total_items = count($clientes);
        $total_pages = ceil($total_items / MAX_ITEMS_PER_PAGE);
        $start_index = ($page - 1) * MAX_ITEMS_PER_PAGE;
        $clientes_subset = array_slice($clientes, $start_index, MAX_ITEMS_PER_PAGE);
    ?>
    <?php foreach ($clientes_subset as $cliente => $deals): 
    ?>
    <div class="panel panel-default " >
        <div class="panel-heading " >
            <div class="row">
                <div class="column_25">
                    <a  data-toggle="collapse" href="#collapse-<?php echo str_replace(' ', '', $cliente); ?>">
                        <?php echo $cliente." - Ofertas: ".count($deals['deals']); 
                        ?>
                        
                    </a>
                </div>
                <div class="column_25">
                    <label><?php echo $deals['suministro']  ?></label>
                </div>
                <div class="column_25">
                    <a type="button"  class="activarInactivarCliente" >
                    <?php if ($deals['activo']) { ?>
                        <span class="glyphicon glyphicon-ok btn-success">
                        </span> Activo    
                    <?php } else { ?> 
                        <span class="glyphicon glyphicon-remove btn-danger"></span> Inactivo
                    <?php } ?>
                    
             
                    </a>
                </div>
                <div class="column_25_no_padding "> 
                        <a class="agregarOferta btn btn-info"  type="button"  id="agregarOferta<?php echo $deals['clienteId']; ?>" >
                            <span ></span> Nueva Oferta
                            
                        </a>     

                </div>
                    <input class="form-control clienteId" id="clienteId<?php echo $deals['clienteId']; ?>"  name="clienteId<?php echo $deals['clienteId']; ?>" type="text" value="<?php echo $deals['clienteId']; ?>" hidden>

                    <input class="form-control clienteNombre" id="clienteNombre<?php echo $deals['clienteId']; ?>"  
                            name="clienteNombre<?php echo $deals['clienteId']; ?>" 
                            type="text" value="<?php echo $cliente; ?>" hidden>

                    <input class="form-control activo" id="activo<?php echo $deals['clienteId']; ?>"  
                            name="activo<?php echo $deals['clienteId']; ?>" 
                            type="text" value="<?php echo $deals['activo']; ?>" hidden>
            </div>
            
        </div>
        <div id="collapse-<?php echo str_replace(' ', '', $cliente); ?>" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Estado</th>
                            <th>Paso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deals['deals'] as $deal): 
                            if ($deal['ofertaId'] > 0) {
                                
                        ?>

                            
                            <tr>
                                <td><?php echo $deal['fol']; ?></td>
                                <td><?php echo $deal['estado']; ?></td>
                                <td><?php echo $deal['paso']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-lg btn-default"
                                        onclick="viewDeal(<?php echo $deal['ofertaId']; ?>)">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-default"
                                        onclick="removeDeal(<?php echo $deal['ofertaId']; ?>)">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                            </tr>
                        <?php 
                            };
                            endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endforeach; 
    ?>
    <?php if ($total_pages > 1): ?>
    <nav aria-label="Navegación de paginación">
        <ul class="pagination justify-content-center">
            <?php if ($total_pages > 1): ?>
            <li class="page-item">
                <?php if ($page > 1): ?>
                <a class="page-link" href="?page=<?php echo $page - 1; echo $filtro?>">Anterior</a>
                <?php endif; ?>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i === $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; echo $filtro?>"><?php echo $i; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item">
                <?php if ($page < $total_pages): ?>
                <a class="page-link" href="?page=<?php echo $page + 1; echo $filtro?>">Siguiente</a>
                <?php endif; ?>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>

<div class="modal fade" id="nuevaOferta" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Oferta</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form>
                        <div class="form-group">
                            <label for="selCliente" class="form-label">Cliente:</label>
                            <select class="form-control custom-select-lg" id="selCliente" name="selCliente"
                                style="width:100%">
                                <?php foreach ($clientsSelects as $cs) {
                                    echo "<option value='" . $cs["clienteId"] . "'>" . $cs["nombre"] . "</option>";
                                } ?>
                            </select>
                            <label for="selTipoOferta" class="form-label">Tipo de Oferta:</label>
                            <select class="form-control custom-select-lg" id="selTipoOferta" name="selTipoOferta"
                                style="width:100%">
                                <option value="SC">Suministro Calificado</option>
                                <option value="CE">Compra de Energía</option>
                                <option value="VE">Venta de Energía</option>
                                <option value="VCEL">Venta de CEL</option>
                                <option value="CCEL">Compra de CEL</option>
                            </select>
                            <label for="selFormatoOferta" class="form-label">Formato de Oferta:</label>
                            <select class="form-control custom-select-lg" id="selFormatoOferta" name="selFormatoOferta"
                                style="width:100%">
                                <option value="F">Formal</option>
                                <option value="X">Excel</option>
                                <option value="P">Presentación</option>
                            </select>
                        </div>
                        <button type="button" id="btnGuardaOferta" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODALS -->
<div class="modal fade" id="nuevaTarifa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevas Tarifas</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-primary btn-file">
                                Archivo <input accept=".xls,.xlsx,.csv" name="btarifas" type="file" class="hidden"
                                    id="btarifas" onchange="updateFileName(this)">
                            </span>
                        </label>
                        <input class="form-control" id="tarifas_captura" readonly="readonly" name="tarifas_captura"
                            type="text" value="">
                    </div>
                    <button type="button" id="subir" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- NUEVO CLIENTE-->
<?php 
    $this->load->view("deal/ofertas/clientes/modals/nuevo"); 
?>

</div>

