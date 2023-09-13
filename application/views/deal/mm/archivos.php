<div class="container px-4 text-left">
    <div class="row gx-5">
        <div class="col">
            <div class="p-3">
                
                <input class="form-check-input" type="checkbox" value="" id="chktarifas">
                
                <label class="form-check-label" for="chktarifas">
                    Tarifas
                </label>
                <div class="input-group">
                    
                    <label class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                                name="btarifas" type="file" id="btarifas">
                        </span>
                    </label>
                    
                    <input class="form-control" id="tarifa_captura" readonly="readonly"
                        name="tarifa_captura" type="text" value="">
                </div>
            </div>
        </div>                
    </div>
</div>

<div class="row gx-5">
    <div class="col">
        <div class="p-3">
            
            <input class="form-check-input" type="checkbox" value="" id="chkdatoshorarios">
            
            <label class="form-check-label" for="chkdatoshorarios">
                Datos Horarios
            </label>
            <div class="input-group">
                
            <label class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                        name="bdatoshorarios" type="file" id="bdatoshorarios">
                </span>
            </label>
                
            <input class="form-control" id="datoshorarios_captura" readonly="readonly"
                    name="datoshorarios_captura" type="text" value="">
            </div>
        </div>
    </div>
</div>
<div class="row gx-5">
    <div class="col">
        <div class="p-3">
            
            <input class="form-check-input" type="checkbox" value=""
                id="chkgeneradosbloques">
            
            <label class="form-check-label" for="chkgeneradosbloques">
                Generador de bloques
            </label>
            <div class="input-group">
                
                <label class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                            name="bgenerador" type="file" id="bgenerador">
                    </span>
                </label>
                
                <input class="form-control" id="generador_captura" readonly="readonly"
                    name="generador_captura" type="text" value="">
            </div>
        </div>
    </div>
</div>