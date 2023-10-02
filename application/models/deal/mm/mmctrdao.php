<?php

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

        switch ($data['catalogoId']) {
            case 1:
                $this->db->insert('of_zonas_carga', $data);
                break;
            case 2:
                $this->db->insert('of_zonas_carga', $data);
                break;
            case 3:
                $this->db->insert('of_tarifa_distribucion', $data);
                break;
            case 4:
                $this->db->insert('of_tarifa_transmision', $data);
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
                $this->db->insert('of_tarifa_scnmem', $data);
                break;
            case 11:
                $this->db->insert('of_tarifa_operacion_sb', $data);
                break;

            default:
                // code...
                break;
        }//Fin Switch
        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);


        log_message('debug', __FILE__." ".__LINE__." ".__FUNCTION__);
    }
}
?>