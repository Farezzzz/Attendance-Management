<?php defined('BASEPATH') OR exit('No direct script access allowed');
use App\Models\AbsenModel;
 
class total extends CI_Controller
{
    public function index()
    {
        //load modelnya dulu
        $this->load->model('Berita_model');
        $this->data['total'] =  $this->Berita_model->total_rows();
 
        //load viewnya
        $this->load->view('guru.home',$this->data);
    }
}
?>