<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
/**
 * Description of mainctrDao
 *
 * 
 */
class Mmctrdao extends VX_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->library("session");
    }


    /**
     * Description of mainctrDao
     *
     * @param array con los datos 
     */
    public function saveCatalogoAchivo() {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        $data = $this->input->post();
        log_message('debug', print_r($_FILES,true));
        $filePath = $_FILES['archivo']['tmp_name'];
        // Carga el archivo de Excel usando PhpSpreadsheet
        $objPHPExcel = IOFactory::load($filePath);      
        // Selecciona la primera hoja
        $sheet = $objPHPExcel->getActiveSheet(); 
        $rows = $sheet->toArray();
        //log_message("debug", print_r($rows ,true));
        //Quitar Cabeceras
        unset($rows[0]);
        switch ($data['catalogoId']) {
            case 1:
                $this->saveZonascarga($rows);
                //$this->db->insert('of_zonas_carga', $data);
                break;
            case 2:
                $this->db->insert('', $data);
                break;
            case 3:
                $this->db->insert('of_tarifa_distribucion', $data);
                break;
            case 4:
                $this->saveCatalogoTransmision($rows);
                
                break;
            case 5:
                $this->db->insert('', $data);
                break;
            case 6:
                $this->db->insert('', $data);
                break;
            case 7:
                $this->db->insert('of_tarifa_energia', $data);
                break;
            case 8:
                $this->db->insert('', $data);
                break;
            case 9:
                $this->db->insert('', $data);
                break;
            case 10:
                $this->saveCatalogoScnmen($rows);
                break;
            case 11:
                $this->db->insert('of_tarifa_operacion_sb', $data);
                break;
            case 12:
                
                break;
            case 13:
                
                break;
            case 14:
                $this->saveCatalogoTipoCambio($rows);
                break;


            default:
                // code...
                break;
        }//Fin Switch
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);


        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }

    /**
     * Description of mainctrDao
     *
     * @param array con los datos 
     */
    public function getCatalogos() {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);

        $catalogos=$this->db->query('select omcc.nombre, omcc.catalogoId 
            from of_mm_cfg_catalogos omcc
            where omcc.activo = 1
            order by nombre ASC
            ;');
        return $catalogos->result_array();

        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }

    /**
     * Se inserta valores para la tabla of_tarifa_transmision
     *
     * @param array con los datos
     * @return void 
     */
    private function saveCatalogoTransmision($rows ) {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
   
        $insert = array();
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        foreach ($rows as $key => $row) {
            //log_message('debug',print_r($row,true) );
            $data['anio'] = $row[0];
            $data['tarifa'] = $row[1];
            $data['tarifaPrecio'] = $row[2];
            $this->db->insert('of_tarifa_transmision', $data);

        }

        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }


    /**
     * Se inserta valores para la tabla of_tarifa_tc
     *
     * @param array con los datos
     * @return void 
     */
    private function saveCatalogoTipoCambio($rows ) {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
   
        $insert = array();
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        foreach ($rows as $key => $row) {
            //log_message('debug',print_r($row,true) );
            $data['anio'] = $row[0];
            $data['mes'] = $row[1];
            $data['mxn/kwh'] = $row[2];
            $this->db->insert('of_tarifa_tc', $data);

        }

        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }

    /**
     * Se inserta valores para la tabla of_tarifa_scnmem
     *
     * @param array con los datos
     * @return void 
     */
    private function saveCatalogoScnmen($rows ) {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
   
        $insert = array();
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        foreach ($rows as $key => $row) {
            //log_message('debug',print_r($row,true) );
            $data['anio'] = $row[0];
            $data['tarifa'] = $row[1];
            
            $this->db->insert('of_tarifa_scnmem', $data);

        }

        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }


    /**
     * Se inserta valores para la tabla of_zonas_carga
     *
     * @param array con los datos
     * @return void 
     */
    private function saveZonascarga($rows ) {
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        
        //log_message('debug',print_r($rows,true) );
        $insert = array();
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
        
        foreach ($rows as $key => $row) {
            //log_message('debug',print_r($row,true) );
            
            $query = sprintf("select of_divisiones_id from of_divisiones where activo=1 and division='%s';", $row[0]);
            //log_message('debug',print_r($query,true) );

            $zonaCarga=$this->db->query($query)->result_array();
            
            
            $data['division_id'] = $zonaCarga[0]['of_divisiones_id'];
            $data['zona_carga'] = $row[1];
            $data['activo'] = 1;
            $data['GDMTH_PT'] = $row[2];
            $data['GDMTH_P_NO_T'] = $row[3];
            $data['DIST_PT'] = $row[4];
            $data['DIST_P_NO_T'] = $row[5];
            $data['DIT_PT'] = $row[6];
            $data['DIT_P_NO_T'] = $row[7];
            
            
            $this->db->insert('of_zonas_carga', $data);

        }
        

        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }


    
    
}
?>