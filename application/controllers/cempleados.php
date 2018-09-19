<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cempleados extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('empleado_model');
        $this->load->model('tiposempleados_model');
    }

    public function index()
    {
            $this->load->view('templates/header');
            $this->load->view('empleados/upload');
            $this->load->view('templates/footer');
    }

    public function add($access = TRUE)
    {
        if($access)
        {
            $data="";
            $errrovalidacion=$this->validar();
            
            if (count($errrovalidacion)>0) 
            {
                    foreach ($errrovalidacion as  $lineaE) 
                    {
                        $data.="Se presenta un error de correo o tipo de empleado en la linea ".$lineaE."<br>";    
                    }
                    $datos['data']= $data;
                    $this->load->view('templates/header');
                    $this->load->view('upload' );
                    $this->load->view('templates/footer',$datos);      
            } 
            else 
            {
                $data = file_get_contents($_FILES['carga']['tmp_name']); //read the file
                $convert = explode("\n", $data); //create array separate by new line
                for ($i=0;$i<count($convert);$i++)  
                {
    
                    $line=explode(",", $convert[$i]);
    
                    $this->empleado_model->add($line);
                }
    
                
                //LOOP for everytype 
                $info=array();
                foreach ($this->tiposempleados_model->get() as  $value)
                {
                    $info['tipos'][]=$value;
                    $info['empleados'][] = $this->empleado_model->get($value['id']);  
                }   
                
    
                $this->load->view('templates/header');
                $this->load->view('empleados/list',$info);
                $this->load->view('templates/footer');
                
            }      
        }
        else
        {
             //LOOP for everytype 
             $info=array();
             foreach ($this->tiposempleados_model->get() as  $value)
             {
                 $info['tipos'][]=$value;
                 $info['empleados'][] = $this->empleado_model->get($value['id']);  
             }   
             
 
             $this->load->view('templates/header');
             $this->load->view('empleados/list',$info);
             $this->load->view('templates/footer');    
        }
        
                
    }

    public function validar()
    {

       $data = file_get_contents($_FILES['carga']['tmp_name']); //read the file
       $convert = explode("\n", $data); //create array separate by new line
       $lineasError=array();
        for ($i=0;$i<count($convert);$i++)  
        {
            
            $line=explode(",", $convert[$i]);
            //get email and type of employe
            $email=trim($line[0]);
            $type=$this->empleado_model->search_type_employe(trim ($line[3]));
            if (filter_var($email, FILTER_VALIDATE_EMAIL) and $type)
            {
                //do something bro
            }
            else
            {
              $lineasError[]=$i;      
            }

        }

        return $lineasError;
        
    }

    public function edit()
    {
        
         
       

        //when end edition
        $nombres = $this->input->post('nombres');
        $apellidos = $this->input->post('apellidos');
        $correo = $this->input->post('correo');

        //
        

        if($nombres == NULL and $apellidos == NULL and $correo == NULL and $this->input->get('id'))
        {
             // Obtenemos el id de la editorial a editar
             $resultado = $this->empleado_model->get_empleado_by_id($this->input->get('id'));
            if(count($resultado) > 0)
            {
                
                $data['empleado'] = $resultado[0];
                $this->load->view('templates/header');
                $this->load->view('empleados/edit', $data);
                $this->load->view('templates/footer');
            }
            else
            {
                //never
                $data['mensaje'] = 'No existe esa editorial';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/error', $data);
                $this->load->view('templates/footer');
            }
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombres', 'Nombres', 'required');
            $this->form_validation->set_rules('apellidos', 'apellidos', 'required');
            $this->form_validation->set_rules('correo', 'correo', 'required');
            if ($this->form_validation->run() === FALSE)
            {
                $data['empleado'] ['id'] = $this->input->post('id') ;
                $data['empleado']['nombres'] = $nombres;
                $data['empleado']['apellidos'] = $apellidos;
                $data['empleado']['correo'] = $correo;
                $this->load->view('templates/header');
                $this->load->view('empleados/edit',$data);
                $this->load->view('templates/footer');

            }
            else
            {
                $id = $this->input->post('id');
                $this->empleado_model->update($id, $nombres, $apellidos,$correo);
                $this->add(false);
            }
        }
    }


    public function delete()
    {
       
            
            $outpu;
            if($this->input->post('id'))
            {
                $resultado = $this->empleado_model->get_empleado_by_id($this->input->post('id'));
                //$this->empleado_model->delete($id);
                $data['empleado'] = $resultado[0];
                $outpu[]="seguro que desea borrar el empleado ".$data['empleado']['nombres']." ".$data['empleado']['apellidos'];
                $outpu[]=$data['empleado'] ['id'];
                echo json_encode($outpu);
            }

            elseif($this->input->post('idend'))
            {
                
                $resultado = $this->empleado_model->get_empleado_by_id($this->input->post('idend'));
                if(count($resultado)>0)
                {
                    $this->empleado_model->delete($this->input->post('idend'));
                    $this->add(false);
                }
                else
                {
                    $this->add(false); 
                    
                }
                  
            }
            else
            {
                echo "error inesperado pero manejado";
                $this->add(false); 
            }
            
        

    }
    
}
