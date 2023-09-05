<div class="modal fade" id="cargarArchivoModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cargar Archivo</h4>
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