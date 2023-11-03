 <div class="x_panel">
    <div class="x_title">
        <h2>
            <p>Resumen de Centros de Costos </p>
        </h2>
        <div class="clearfix"></div>
    </div>
	<div class="x_content">
		<table id="" class="table table-striped table-bordered dt-responsive nowrap hover cursor-picker" cellspacing="0" width="100%">
		    <thead>
		        <tr class="titulo">
		        	<th colspan="2" style="text-align:center">Resumen CC</th>
		            <th></th>
		            <th colspan="6" style="text-align:center">Resultados total</th>
		         
		        </tr>
		        <tr>
		        	<th colspan="2" style="text-align:center"></th>
		            <th></th>
		            <th colspan="2" style="text-align:center">Ahorro</th>
		            <th></th>
		            <th colspan="3" style="text-align:center">Utilidades</th>
		        </tr>
		        <tr>
		    		<th>No de CC</th>
		    		<th>Demanda <p>promedio MW</th>
		    		<th></th>
		    		<th>Ahorro (MXN)</th>
		    		<th>Ahorro (%)</th>
		    		<th></th>
		    		<th>Total Utilidad (MXN/MWh)</th>
		    		<th>% Utilidad Fenix</th>
		    		<th>Utilidad (MXN)</th>
		    	</tr>
		    </thead>
		    <tbody>
		    	<tr>
		    		<td ><?php echo $resumenCC['no_cc_conteo']; ?></td>
		    		<td><?php echo $resumenCC['demanda_contratada_sum']; ?></td>
		    		<td></td>
		    		<td>8,653,925</td>
		    		<td>19%</td>
		    		<td></td>
		    		<td>194</td>
		    		<td>14%</td>
		    		<td>4,046,623</td>
		    	</tr>
		    </tbody>
		</table>
	</div>
	<div class="x_content">
		<?php
            $this->load->view("deal/ofertas/paso2/tablaCCPaso2AhorrosResumen");
        ?>
	</div>
</div>