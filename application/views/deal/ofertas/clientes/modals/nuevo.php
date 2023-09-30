<!-- Modal  cliente-->
<div class="modal fade" id="nuevoCliente" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form>
                        <div class="form-group">
                            <label for="textNombreCliente">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombreCliente" name="textNombreCliente">
                        </div>
                        <div class="form-group">
                            <label for="txtRazonSocial">Razon Social:</label>
                            <input type="text" class="form-control" id="txtRazonSocial" name="txtRazonSocial">
                        </div>
                        <button type="button" id="btnGuardaCliente" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>          
        </div>
    </div>
</div>
