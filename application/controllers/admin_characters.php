<?php
class Admin_characters extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('characters_model');
        $this->load->model('manufacturers_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $manufacture_id = $this->input->post('manufacture_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 30;
        $config['base_url'] = base_url().'admin/characters';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($manufacture_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($manufacture_id !== 0){
                $filter_session_data['manufacture_selected'] = $manufacture_id;
            }else{
                $manufacture_id = $this->session->userdata('manufacture_selected');
            }
            $data['manufacture_selected'] = $manufacture_id;

            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch manufacturers data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['count_characters']= $this->characters_model->count_characters($manufacture_id, $search_string, $order);
            $config['total_rows'] = $data['count_characters'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['manufacture_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
            $data['count_characters']= $this->characters_model->count_characters();
            $data['characters'] = $this->characters_model->get_characters('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_characters'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/characters/list';
        $this->load->view('includes/template', $data);  

    }//index
    public function list_compare()
    {
    
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 50;
        $config['base_url'] = base_url().'admin/characters';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        
        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 

            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            $data['count_characters']= $this->characters_model->count_characters($manufacture_id, $search_string, $order);
            $config['total_rows'] = $data['count_characters'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['characters'] = $this->characters_model->get_characters($manufacture_id, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            $data['count_characters']= $this->characters_model->count_characters();
            $data['characters'] = $this->characters_model->get_characters('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_characters'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/characters/list_compare';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'image' => $this->input->post('image'),
                    'info' => $this->input->post('info'),
                    'status' => $this->input->post('status'),
                    'hp_1' => $this->input->post('hp_1'),
                    'hp_2' => $this->input->post('hp_2'),
                    'hp_3' => $this->input->post('hp_3'),
                    'hp_4' => $this->input->post('hp_4'),
                    'hp_5' => $this->input->post('hp_5'),
                    'atk_1' => $this->input->post('atk_1'),
                    'atk_2' => $this->input->post('atk_2'),
                    'atk_3' => $this->input->post('atk_3'),
                    'atk_4' => $this->input->post('atk_4'),
                    'atk_5' => $this->input->post('atk_5'),
                    'def_1' => $this->input->post('def_1'),
                    'def_2' => $this->input->post('def_2'),
                    'def_3' => $this->input->post('def_3'),
                    'def_4' => $this->input->post('def_4'),
                    'def_5' => $this->input->post('def_5'),
                );
                //if the insert has returned true then we show the flash message
                if($this->characters_model->store_character($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch manufactures data to populate the select field
//        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/characters/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //character id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'image' => $this->input->post('image'),
                    'info' => $this->input->post('info'),
                    'status' => $this->input->post('status'),
                    'hp_1' => $this->input->post('hp_1'),
                    'hp_2' => $this->input->post('hp_2'),
                    'hp_3' => $this->input->post('hp_3'),
                    'hp_4' => $this->input->post('hp_4'),
                    'hp_5' => $this->input->post('hp_5'),
                    'atk_1' => $this->input->post('atk_1'),
                    'atk_2' => $this->input->post('atk_2'),
                    'atk_3' => $this->input->post('atk_3'),
                    'atk_4' => $this->input->post('atk_4'),
                    'atk_5' => $this->input->post('atk_5'),
                    'def_1' => $this->input->post('def_1'),
                    'def_2' => $this->input->post('def_2'),
                    'def_3' => $this->input->post('def_3'),
                    'def_4' => $this->input->post('def_4'),
                    'def_5' => $this->input->post('def_5'),
                );
                //if the insert has returned true then we show the flash message
                if($this->characters_model->update_character($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/characters/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //character data 
        $data['character'] = $this->characters_model->get_character_by_id($id);
        //fetch manufactures data to populate the select field
        //$data['manufactures'] = $this->manufacturers_model->get_manufacturers();
        //load the view
        $data['main_content'] = 'admin/characters/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete character by his id
    * @return void
    */
    public function delete()
    {
        //character id 
        $id = $this->uri->segment(4);
        $this->characters_model->delete_character($id);
        redirect('admin/characters');
    }//edit
	
	function get_team($data=array(), $filter='5'){
		$team = array();
		//$data = " | 1 2 3 4 5 ";
		$id = $name = $image = $total = $hp_1 = $hp_2 = $hp_3 = $hp_4 = $hp_5 = $atk_1 = $atk_2 = $atk_3 = $atk_4 = $atk_5 = $def_1 = $def_2 = $def_3 = $def_4 = $def_5 = '';
		$array_data = explode(" ", $data);
		foreach($array_data as $i=>$value){
			if($i>=1 && $i<=5){
				$data_value = $this->characters_model->get_character_by_id($value);
				$id .= $data_value[0]['id'].',';
				$name .= $data_value[0]['name'].',';
				$image .= $data_value[0]['image'].',';
				$hp_1 = $hp_1 + $data_value[0]['hp_1'];
				$hp_2 = $hp_2 + $data_value[0]['hp_2'];
				$hp_3 = $hp_3 + $data_value[0]['hp_3'];
				$hp_4 = $hp_4 + $data_value[0]['hp_4'];
				$hp_5 = $hp_5 + $data_value[0]['hp_5'];
				$atk_1 = $atk_1 + $data_value[0]['atk_1'];
				$atk_2 = $atk_2 + $data_value[0]['atk_2'];
				$atk_3 = $atk_3 + $data_value[0]['atk_3'];
				$atk_4 = $atk_4 + $data_value[0]['atk_4'];
				$atk_5 = $atk_5 + $data_value[0]['atk_5'];
				$def_1 = $def_1 + $data_value[0]['def_1'];
				$def_2 = $def_2 + $data_value[0]['def_2'];
				$def_3 = $def_3 + $data_value[0]['def_3'];
				$def_4 = $def_4 + $data_value[0]['def_4'];
				$def_5 = $def_5 + $data_value[0]['def_5'];
			}
		}
		$team['id'] = $id;
		$team['name'] = $name;
		$team['image'] = $image;
		if($hp_1 > 2){
			$team['hp_1'] = $hp_1;
			$total = $total + 1;
			if($hp_1 > 5){
				$total = $total + 1;
			}
		}
		if($hp_2 > 2){
			$team['hp_2'] = $hp_2;
			$total = $total + 1;
			if($hp_2 > 5){
				$total = $total + 1;
			}}
		if($hp_3 > 2){
			$team['hp_3'] = $hp_3;
			$total = $total + 1;
			if($hp_3 > 5){
				$total = $total + 1;
			}}
		if($hp_4 > 2){
			$team['hp_4'] = $hp_4;
			$total = $total + 1;
			if($hp_4 > 5){
				$total = $total + 1;
			}}
		if($hp_5 > 2){
			$team['hp_5'] = $hp_5;
			$total = $total + 1;
			if($hp_5 > 5){
				$total = $total + 1;
			}}
		
		if($atk_1 > 2){
			$team['atk_1'] = $atk_1;
			$total = $total + 1;
			if($atk_1 > 5){
				$total = $total + 1;
			}}
		if($atk_2 > 2){
			$team['atk_2'] = $atk_2;
			$total = $total + 1;
			if($atk_2 > 5){
				$total = $total + 1;
			}}
		if($atk_3 > 2){
			$team['atk_3'] = $atk_3;
			$total = $total + 1;
			if($atk_3 > 5){
				$total = $total + 1;
			}}
		if($atk_4 > 2){
			$team['atk_4'] = $atk_4;
			$total = $total + 1;
			if($atk_4 > 5){
				$total = $total + 1;
			}}
		if($atk_5 > 2){
			$team['atk_5'] = $atk_5;
			$total = $total + 1;
			if($atk_5 > 5){
				$total = $total + 1;
			}}
		
		if($def_1 > 2){
			$team['def_1'] = $def_1;
			$total = $total + 1;
			if($def_1 > 5){
				$total = $total + 1;
			}}
		if($def_2 > 2){
			$team['def_2'] = $def_2;
			$total = $total + 1;
			if($def_2 > 5){
				$total = $total + 1;
			}}
		if($def_3 > 2){
			$team['def_3'] = $def_3;
			$total = $total + 1;
			if($def_3 > 5){
				$total = $total + 1;
			}}
		if($def_4 > 2){
			$team['def_4'] = $def_4;
			$total = $total + 1;
			if($def_4 > 5){
				$total = $total + 1;
			}}
		if($def_5 > 2){
			$team['def_5'] = $def_5;
			$total = $total + 1;
			if($def_5 > 5){
				$total = $total + 1;
			}}
		$team['total'] = $total;
		$final_team = '';
		if($total >= $filter){
			$final_team = $team;
		}
		return $final_team;
	}
	
	public function compare(){
		$data_characters = $this->characters_model->get_all_characters();
		$auto_array = array();
		foreach ($data_characters as $k=>$v){
			$auto_array[] = $v['id'];
		}
		
		$auto_array = array (1,2,3,4,5,6,7,8,9,10);
		$data_tohop = $this->tohopchapkcuan($auto_array);
		// echo '<pre>';
		// print_r($data_tohop);
		// echo '</pre>';exit;
		$data_ghepteam = array();
		foreach ($data_tohop as $k=>$v){
			$array_team = $this->get_team($v, 5);
			if(isset($array_team) && $array_team != ''){
				$data_ghepteam[] = $array_team;
			}
			
		}
		echo '<pre>';
		print_r($data_ghepteam);
		echo '</pre>';
	}
	
	public function list_compare_kq(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('list_compare', 'list_compare', 'required');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = $this->input->post('list_compare');
				echo '<pre>';
				print_r($data_to_store);
				echo '</pre>';
				exit;
                //if the insert has returned true then we show the flash message
                // if($this->characters_model->store_character($data_to_store)){
                    // $data['flash_message'] = TRUE; 
                // }else{
                    // $data['flash_message'] = FALSE; 
                // }
            }

        }
        $data['main_content'] = 'admin/characters/list_compare_kq';
        $this->load->view('includes/template', $data);  
	}
	
	function tohopchapkcuan($auto_array = array()){
		$na=$auto_array;
		$kqa=array();
		$na1=$na;
		$na2=$na; 
		$na3=$na; 
		$na4=$na; 
		$na5=$na; 
		$x2=1; 

		foreach ($na1 as $n1) {
			foreach ($na2 as $n2) {
				foreach ($na3 as $n3) {
					foreach ($na4 as $n4) {
						foreach ($na5 as $n5) {
							if($n1!=$n2 && $n1!=$n3 & $n1!=$n4 & $n1!=$n5 & $n2!=$n3 & $n2!=$n4 & $n2!=$n5 & $n3!=$n4 & $n3!=$n5 & $n4!=$n5) {
							$loai=0;
							foreach($kqa as $kq){
								if(strpos($kq," ".$n1." ")!=0 && strpos($kq," ".$n2." ")!=0 && strpos($kq," ".$n3." ")!=0 && strpos($kq," ".$n4." ")!=0 && strpos($kq," ".$n5." ")!=0) {$loai=1; break;}
							}
							if($loai!=1) {
								$kqa[$x2]="| $n1 $n2 $n3 $n4 $n5 "; $x2++;}
							}
						}
					}
				}
			}
		}
		return $kqa;
	}
	function giaithua($num)
	{
		$giaithua=1;
		for($i=2;$i<$num+1;$i++)
		{
			$giaithua=$giaithua*$i;
		}
		return $giaithua;
	}
	function tohop(){
		$k=3;
		$n=13; //13 x3 //10 x5
		$c=($this->giaithua($n))/($this->giaithua($k)*$this->giaithua($n-$k));
		echo '<br/>'.$c;
	}
}