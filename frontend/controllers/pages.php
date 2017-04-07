<?php
class Pages extends CI_Controller {
	private $data;
	function __construct(){
        parent::__construct();
        session_start();
        
        $_SERVER['DOCUMENT_ROOT'] = dirname(dirname(dirname(__FILE__)));
        //$this->data['fb_api_id'] = '370672979703477';
        if(isset($_POST['s'])){
            $data = array(
                'email' => $_POST['s'],
                'date' => time()
                );
            $this->general_model->insert_subscribers($data);
            $this->data['success'] = true;
        }
        
        $default_language =  $this->general_model->get_language_default();  
        $this->data['language'] =  $this->general_model->get_all_language();   
        $this->data['lang_url'] = $_SERVER["REQUEST_URI"]; 
        if(isset($default_language[0]['code']))
        {
	        if(!isset($_SESSION['lang'])) $_SESSION['lang'] = $default_language[0]['code']; 
	        if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
        }
        else
        {
        	 if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en'; 
	        if(isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];
        }
        
        $this->load->helper('language_translate');
         $detail_language =  $this->general_model->get_language_by_code($_SESSION['lang']);   
        if($_SESSION['lang'] !=null)
        	$this->lang->load($_SESSION['lang'], $detail_language[0]['language_name']);
        else
        	$this->lang->load('en', 'English');
        
		if (isset($_POST['currency_code'])) {
      		$this->currency->set($_POST['currency_code']);
		
			
//			if (isset($_POST['redirect'])) {
//				redirect($_POST['redirect']);
//			} else {
//				redirect('');
//			}
   		}	
      
        $this->data['currency_code'] = $this->currency->getCode(); 	
		$results = $this->general_model->getCurrencies();	
		
		foreach ($results as $result) {
			if ($result['status']) {
   				$this->data['currencies'][] = array(
					'title'        => $result['title'],
					'code'         => $result['code'],
					'symbol_left'  => $result['symbol_left'],
					'symbol_right' => $result['symbol_right']				
				);
			}
		}
		
		$this->data['action'] = $_SERVER["REQUEST_URI"];
		$this->data['redirect'] = $_SERVER["REQUEST_URI"];
		
        $this->data['setting'] =  $this->general_model->get_email_from_setting();   
         
        $data_menu = array();
        $menu = $this->general_model->get_all_parent_page();
        $i=0;
		foreach($menu as $menu)
		{
			$child = $this->general_model->get_all_child_page_by_parent($menu['article_id']);
			$data_child= null;
			$j=0;
			foreach($child as $chi)
			{
				$data_child[$j] = array(
						'article_id'	=> $chi['article_id'],
						'name' =>$chi['name'],
						'url_title' =>$chi['name'],
				);
				$j++;
			}
			$data_menu[$i] = array(
					'article_id'	=> $menu['article_id'],
					'name' =>$menu['name'],
					'url_title' =>$menu['name'],
					'child' =>$data_child,
			); 
			$i++;
		}
		$this->data['data_menu'] = $data_menu;
		$this->data['link_contact'] = base_url()."contact";
		$data_category_menu = $this->general_model->get_all_category();
		foreach($data_category_menu as &$data)
		{
		    $data['url_title'] = $data['category_name'];
		}
		$this->data['data_category_menu'] = $data_category_menu;
		
		$banner = @reset($this->general_model->get_website_info());
		$this->data['settings'] = $banner;

		$url1 = $_SERVER['HTTP_HOST'];
		$params = explode('.', $url1);

		// facebook login API ID

		$this->data['fb_api_id'] = isset($banner['fb_api'])?$banner['fb_api']:""; 

		
    }

 
    function ajax_login(){
       $result = $this->general_model->check_login_fb($_POST['username'],$_POST['username']);
       $user = @reset($result);
       if($user['password'] == md5($_POST['password'])){
            $this->general_model->update_last_login($user['id']);
           if($_POST['remember']){
                $cookie = array(
                    'name'   => 'remember_me',
                    'value'  => serialize($user),
                    'expire' => 86400*365,
                );
                set_cookie($cookie);
            }
            //$this->session->set_userdata(array('user'=>$user));
            $_SESSION['user'] = $user;
           
            echo 'success';

       }
    }

    function ajax_signup(){
        $user = $this->general_model->check_exist_user($_POST['email']);
        if(count($user)>0){ // exist user => auto login
           $_SESSION['user'] = @reset($user);
            $user_data = @reset($user);
            echo 'success';
            exit;
        }
        $password = md5(time());
        $data = array(
                'username' => $_POST['email'],
                'password' => $password,
                'email' => $_POST['email'],
                'firstname' => $_POST['name'],
                'created_date' => time(),
                'group_id' => 3,
                'active' => 1,
                'address1' => isset($_POST['location']['name'])?$_POST['location']['name']:'',
                'facebookAccount' => $_POST['username'],
        );
        $result =    $id = $this->general_model->insert_user($data,null);
        if($result) {
            $user = $this->general_model->check_exist_user($_POST['email']);
            $_SESSION['user'] = @reset($user);
            $data['password'] = $password;
            ob_start();
            $this->load->view('templatemail/signup',$data);
            $body = ob_get_contents();
            ob_end_clean();
            $config =  @reset($this->general_model->get_website_info());
            $this->general_model->send_email_signup($data, $body,$config);
            echo 'success|0|'.$_POST['level'];
    
        }
        else echo 'failed';
    }

     function ajax_shipping(){
    
	    if(isset($_GET['id']) && $_GET['id'] !="" && isset($_GET['type']) && $_GET['type'] !="")
	    {
	        $data = array(
	            'status' =>$_GET['type'],
	        );
	        $result = $this->general_model->update_order($_GET['id'],$data);
	        if($result) {
	        	if($_GET['type']==3)
					echo 'success|Shipped';
				else if($_GET['type']==1)
					echo 'success|Completed';
				else
					echo 'success|Canceled';
	        }
	        else echo 'failed';

	    }
	    else echo 'failed';
    }
    
    function ajax_login_fb(){
        $user = $this->general_model->check_login_fb($_POST['username'],$_POST['email']);
        if(count($user)>0){ // exist user => auto login
            $_SESSION['user'] = @reset($user);
            $userdetail = @reset($user);
              echo 'success';
        }
    }
	function index(){
		$link = base_url()."index";	
		$link_type = "";
		if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
	        if(!isset($_GET['type']))
	        {
	        	$type = 'thumb';
	        	$link.="?type=thumb";
	        }
	        else
	        {
	        	$type = $_GET['type'];
	        	$link.="?type=".$_GET['type'];
	        }	
	        $this->data['type'] = $type;

 			$extension_data = $this->general_model->get_all_extension(null,null,null,null);
	        $link_sort = $link;
	        $link_limit = $link;
	        if(isset($_GET['limit']) && $_GET['limit']!='')
	        {
	        	$limit = $_GET['limit'];
	        	$link_sort.="&limit=".$_GET['limit'];
	        	$link_type.="&limit=".$_GET['limit'];
	        }
	        else
	        	$limit = 15;
	        	
	        $this->data['limit'] = $limit;
	        
	         if(isset($_GET['sort']) && $_GET['sort']!='')
	         {
	        	$sort = $_GET['sort'];
	        	$link_limit.="&sort=".$_GET['sort'];
	        	$link_type.="&sort=".$_GET['sort'];
	         }
	        else
	        	$sort = "";

	        if(isset($_GET['order']) && $_GET['order']!='')
	        {
	        	$order = $_GET['order'];
	        	$link_limit.="&order=".$_GET['order'];
	        	$link_type.="&order=".$_GET['order'];
	        }
	        else
	        	$order = "";
	        	
	       	$this->data['sortorder'] = $sort.$order;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'?type='.$type;
	        $config['total_rows'] = count($extension_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $extension_data = $this->general_model->get_all_extension($limit,$offset,$sort,$order);
	        foreach($extension_data as &$ex_da)
	        {
	            $ex_da['price_orgi'] = $ex_da['price'];
	        	$ex_da['price'] = $this->currency->format($ex_da['price']);
	        }
	        $this->data['extension_data'] = $extension_data;
	        
	        $extension_data_popular = $this->general_model->get_all_extension($limit,$offset,"views","desc");
	        foreach($extension_data_popular as &$ex_da)
	        {
	            $ex_da['price_orgi'] = $ex_da['price'];
	            $ex_da['price'] = $this->currency->format($ex_da['price']);
	        }
	        $this->data['extension_data_popular'] = $extension_data_popular;
	        
	        $banner = @reset($this->general_model->get_website_info());
	        $this->data['settings'] = $banner;
 			$this->data['pagination'] = $this->pagination->create_links();
			$this->data['link_sort']=$link_sort;
			$this->data['link_limit']=$link_limit;
			$this->data['link_type']=$link_type;
			
			$this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
			$total_extension = 0;
			foreach($extension_category as $compa)
			{
				$total_extension += $compa['total_extension'];
			}

			$this->data['extension_image'] = $this->general_model->get_all_image(9999,2);
			$this->data['total_extension'] = $total_extension;
			$this->data['link_category']= base_url()."category?type=thumb";
			$this->data['title']='Home';
			$this->data['content']='home';
			$this->load->view('templates',$this->data,'');
			
	}
 	private function createPath($path) {
        if (is_dir($path)) return true;
        $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
        $return = $this->createPath($prev_path);
        return ($return && is_writable($prev_path)) ? mkdir($path) : false;
    }
    function login($logout=false){
        if($logout){
            unset($_SESSION['user']);
            unset($_COOKIE['remember_me']);
        }
        $ok = false;
        if(isset($_COOKIE['remember_me']) && !isset($_SESSION['user']))
        {
			$error_login = $this->general_model->get_user_by_username($_COOKIE['remember_me']);
			if(count($error_login) > 0)
			{
				$_SESSION['user'] = @reset($error_login);	
				redirect('/index', 'refresh');
			}
			else 
			{
				unset($_COOKIE['remember_me']);
				$ok = true;
			}
			
        }
        if(!isset($_COOKIE['remember_me']) || $ok==true)
        {
	        if(isset($_POST['username'])){
	
	        	$error_login = $this->general_model->get_user_by_login($_POST['username'],md5($_POST['password']));
	            if(count($error_login)==0){
	                $this->data['error_login'] = true;
	            } else {
	                $_SESSION['user'] = @reset($error_login);
	            }
		        if(isset($_POST['remember']) && $_POST['remember']==1) {
		        $year = time() + 31536000;
				setcookie('remember_me', $_POST['username'], $year);
				}
				elseif(!isset($_POST['remember'])) {
					if(isset($_COOKIE['remember_me'])) {
						$past = time() - 100;
						setcookie(remember_me, gone, $past);
					}
				}
	        }
	        if(isset($_SESSION['user'])){
				if(isset($_SESSION['redirect_page']))
					redirect($_SESSION['redirect_page'], 'refresh');
				else
					redirect('/profile', 'refresh');
	        }
	        $this->data['title']='Login';
	        $this->data['content']='login';
	        $this->load->view('templates',$this->data,'');
        }
    }
	function register(){
		
		$this->data['property_data_default'] = $this->general_model->get_user_property_default_by_category_id();
	 	if(isset($_POST['data'])){
            $data = $_POST['data'];
             $error_username = $this->general_model->get_user_by_username($data['username']);
            if(count($error_username)!=0){
                $this->data['error_username'] = true;
            } 
            $error_email = $this->general_model->get_user_by_email($data['email']);
            if(count($error_email)!=0){
                $this->data['error_email'] = true;
            } 
            if(count($error_email)==0 && count($error_username)==0){
                $data['group_id'] = 3;
                $data['created_date'] = time();
                $data['active'] = 1;
                $data['password'] = md5($data['password']);
                $data['added_date'] = date('Y-m-d H:i:s',time());
                unset($data['confirm']);
				if(isset($data['custom']))
				{	
					$custom = $data['custom'];
					unset($data['custom']);
				}
				else
				{
					$custom = null;
				}
				
                $id = $this->general_model->insert_user($data,$custom);
                
                $notify = array(
                	"user_id" => $id,
                	"notify_extension" => 0,
                	"notify_purchase" => 0,
                	"notify_comment" => 0,
                );
                $this->general_model->insert_notify($notify);
                $data = $this->general_model->get_user_by_user_id($id);
                $_SESSION['user'] = $data[0];
                $setting = $this->general_model->get_email_from_setting();
				$sql ="SELECT title,content,id,date_created from newsletters where type=1";
				$query = $this->db->query($sql);
				unset($data);
				foreach ($query->result() as $row)
				{
					$body=$row->content;
					$title=$row->title;
					$date=$row->date_created;
				}
				//echo $body;
				
				$data['body']=$body;
				$data['title']=$title;
				$data['date']=$date;
				$data['check_title']=1;
				
                $data['name']=$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'];
                $data['username']=$_SESSION['user']['username'];
				$data['email']=$_SESSION['user']['email'];
				ob_start();
				$this->load->view('content/email-template-register',$data);
				$body2 = ob_get_contents();
				ob_end_clean();
				$data['email'] = $_SESSION['user']['email'];
				$data['subject'] = $title;
				$data['content'] = $body2;
				$data['from'] = $setting[0]['email'];
				$this->sendEmailAutomatic($data['email'],$data['subject'],$data['content'],$data['from'],"html");
            } else {
                $this->data['data'] = $data;
				if(isset($data['custom']))
				{
					foreach($this->data['property_data_default'] as &$da)
					{
						$da['property_value'] = $data['custom'][$da['value_id']];
					}
				}
            }
        }
		if(isset($_SESSION['user'])){
			$this->session->set_flashdata('message_signup', "You have register successfully! Welcome to Buy&Sell Script.");
            redirect('/profile', 'refresh');
        }
		$this->data['title']='Register';
		$this->data['content']='register';
		$this->load->view('templates',$this->data,'');
	}
    function profile(){
		$this->data['title']='Profile';
		$this->data['content']='profile';
		$this->load->view('templates',$this->data,'');
	}
    function profile_list($id,$url_title=""){
            if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
	        if(!isset($_GET['type']))
	        {
	        	$type = 'thumb';
	        }
	        else
	        {
	        	$type = $_GET['type'];
	        }	
	        $this->data['type'] = $type;

	        $this->data['offset'] = $offset;
 			$extension_data = $this->general_model->get_all_extension_by_user_id($id,null,null);
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile-list/'.$id;
	        $config['total_rows'] = count($extension_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $extension_data = $this->general_model->get_all_extension_by_user_id($id,$limit,$offset);
	        foreach($extension_data as &$ex_da)
	        {
	            $ex_da['price_orgi'] = $ex_da['price'];
	            $ex_da['price'] = $this->currency->format($ex_da['price']);
	        }
	        $this->data['extension_data'] = $extension_data;
	        $detail = @reset($this->general_model->get_user_by_user_id($id));
	        $this->data['user_info'] = $detail;
 			$this->data['pagination'] = $this->pagination->create_links();
 			
 			$this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
 			$this->data['title']='Profile List';
			$this->data['content']='profile_list';
			$this->load->view('templates',$this->data,'');

	}

 	function profile_detail(){
 		if(isset($_SESSION['user']))
 		{
 			$this->data['property_data_default'] = $this->general_model->get_user_property_default_by_category_id();
			foreach($this->data['property_data_default'] as &$da)
			{
					$p_data = $this->general_model->get_user_property_by_value_id($da['value_id'],$_SESSION['user']['user_id']);
					if(count($p_data)>0)
					{
						$da['property_value'] = $p_data[0]['property_value'];
						$da['user_id'] = $_SESSION['user']['user_id'];
					}
			}
 			if(isset($_POST) && $_POST != null )
 			{
	 			if(isset($_POST['data'])){
		            $data = $_POST['data'];
		             $error_username = $this->general_model->get_user_by_username($data['username']);
		            if(count($error_username)!=0 && $error_username[0]['user_id'] != $_SESSION['user']['user_id']){
		                $this->data['error_username'] = true;
		                $error_username = true;
		            }
		            $error_email = $this->general_model->get_user_by_email($data['email']);
		            if(count($error_email)!=0 && $error_email[0]['user_id'] != $_SESSION['user']['user_id']){
		                $this->data['error_email'] = true;
		                $error_email = true;
		            } 
		            unset($data["country"]);
		            unset($data["region"]);
					if(isset($data['custom']))
					{
						$custom = $data["custom"];
						unset($data["custom"]);
					}
					else
					{
						$custom = null;
					}
		            if(isset($error_username) && $error_username ==true && isset($error_email) && $error_email ==true){
		                $this->session->set_flashdata('message', "account details");
		            	$this->general_model->edit_user($_SESSION['user']['user_id'],$data,$custom);
		            	
		               
		            } else {
		                $this->data['data'] = $data;
						if(isset($data['custom']))
						{
							foreach($this->data['property_data_default'] as &$da)
							{
								$da['property_value'] = $data['custom'][$da['value_id']];
							}
						}
		            }
	        	}
	        	
	 			if(isset($_POST['notify'])){
	        		$notify = $_POST['notify'];
	        		$this->general_model->edit_notify($_SESSION['user']['user_id'],$notify);
	        	}
	        	redirect('/profile', 'refresh');
 			}
        	
 			$detail = $this->general_model->get_user_by_user_id($_SESSION['user']['user_id']);
	 		if(count($detail) > 0) 
 				$this->data['banners'] = $detail[0];
 			else
 				$this->data['banners'] = null;
 			$this->data['country_data'] = $this->general_model->get_all_country();
 			
	 		$this->data['region_data'] = $this->general_model->get_all_region();
	 		$this->data['city_data'] = $this->general_model->get_all_city();
	 		$this->data['payment_method'] = $this->general_model->get_all_payment();
	 		
 			
	 		
	 		$notify = $this->general_model->get_notification_by_user_id($_SESSION['user']['user_id']);
			if(count($notify) > 0)
	 			$this->data['notification'] = $notify[0];
	 		else
	 			$this->data['notification'] = null;
	 		$this->data['title']='Edit Detail';
			$this->data['content']='profiledetail';
			$this->load->view('templates',$this->data,'');
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile-detail";
 			redirect('/login', 'refresh');
 		}
	}
	
	function profile_password(){
 		if(isset($_SESSION['user']))
 		{
 			if(isset($_POST['data'])){
	            $data = $_POST['data'];
	            $data['password'] = md5($data['password']);
	            $this->session->set_flashdata('message', "password");
	            unset($data['confirm']);
	            $this->general_model->edit_pass($_SESSION['user']['user_id'],$data);
	            redirect('/profile', 'refresh');
        	}
	 		$this->data['title']='Change password';
			$this->data['content']='profilepassword';
			$this->load->view('templates',$this->data,'');
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile-password";
 			 redirect('/login', 'refresh');
 		}
	}
	
	function profile_address(){
	    if(isset($_SESSION['user']))
	    {
	        if(!isset($_GET['offset'])|| empty($_GET['offset']))
	            $offset = 0;
	        else
	            $offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
	        $extension_data = $this->general_model->get_all_address_by_user_id($_SESSION['user']['user_id'],null,null);
	        $limit=15;
	        $this->load->library('pagination');
	        $config['total_rows'] = count($extension_data);
	        $config['per_page'] = $limit;
	        $this->pagination->initialize($config);
	        $extension_data = $this->general_model->get_all_address_by_user_id($_SESSION['user']['user_id'],$limit,$offset);
	        $this->data['extension_data'] = $extension_data;
	        $this->data['pagination'] = $this->pagination->create_links();
	
	        $this->data['title']='Address';
	        $this->data['content']='profileaddress';
	        $this->load->view('templates',$this->data,'');
	        	
	    }
	    else
	    {	$_SESSION['redirect_page'] = "profile/address";
	    redirect('/login', 'refresh');
	    }
	}
	
	function profile_extension(){
 		if(isset($_SESSION['user']))
 		{
 			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
 			$extension_data = $this->general_model->get_all_edit_extension_by_user_id($_SESSION['user']['user_id'],null,null);
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile-category?type=extension';
	        $config['total_rows'] = count($extension_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $extension_data = $this->general_model->get_all_edit_extension_by_user_id($_SESSION['user']['user_id'],$limit,$offset);
	       
			$this->data['extension_data'] = $extension_data;
 			$this->data['pagination'] = $this->pagination->create_links();
 			
 			$this->data['title']='Edit Extension';
			$this->data['content']='profileextension';
			$this->load->view('templates',$this->data,'');
			
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile-extension";
 			 redirect('/login', 'refresh');
 		}
	}
	
	function profile_editextension($id='',$url_title=""){
 		if(isset($_SESSION['user']))
 		{
 			if(isset($id) && $id!="")
 			{
 				$extension = $this->general_model->get_extension_by_id($id);
 				if(count($extension) > 0)
 					$this->data['extension']  = $extension[0];
 				else
 					$this->data['extension']  = null;
 				
 				 $extension_download =  $this->general_model->get_extension_download_by_id($id);
 				 foreach($extension_download as &$download)
 				 {
 				 	$download['list_com'] = unserialize($download['list_com']);
 				 }
 				$this->data['extension_download'] = $extension_download;
 				$this->data['extension_image'] = $this->general_model->get_extension_image_by_id($id);
        		$this->data['current_id'] = $id ;
        		$this->data['property_data'] = $this->general_model->get_category_property_by_category_id($extension[0]['category_id'],$id);
 				$this->data['property_data_default'] = $this->general_model->get_category_property_default_by_category_id();
				foreach($this->data['property_data_default'] as &$da)
				{
					$p_data = $this->general_model->get_extension_property_by_value_id($da['value_id'],$id);
					if(count($p_data)>0)
					{
						$da['property_value'] = $p_data[0]['property_value'];
						$da['extension_id'] = $id;
					}
				}
 			}
        	else
        	{
        		$this->data['current_id'] = 0 ;
        		$this->data['extension'] = null;
 				$this->data['extension_download'] =  null;
 				$this->data['extension_image'] = null;
 				$this->data['property_data'] = $this->general_model->get_category_property_by_category_id(1,null);
 				$this->data['property_data_default'] = $this->general_model->get_category_property_default_by_category_id();
        	}
 			$check=0;
 			if(isset($_POST['data']['captcha']) && $_POST['data']['captcha']!="")
 			{
 				if(strtolower($_POST['data']['captcha']) == strtolower($_SESSION['cap_word1']))
 				{
 					$check = 1;
 					
 					// load codeigniter captcha helper
	                $vals = array(
	                'img_path'     => 'upload_file/captcha/',
	                'img_url'     => base_url().'upload_file/captcha/',
	                'img_width'     => '200',
	                'img_height' => 30,
	                'border' => 0,
	                'expiration' => 7200
	                );
	                
	    
	                 // create captcha image
	                $cap = create_captcha($vals);
	              
	                // store image html code in a variable
	                $this->data['cap_image'] = $cap['image'];
	                $_SESSION['image'] = $cap['image'];
	              
	               // store the captcha word in a session
	                $_SESSION['cap_word1'] = $cap['word']; 
 					
 				}
 				else
 				{
 					$this->data['message_error'] = "Captcha not match!";
 					if(isset($_POST['data']))
 					{
 						$data =  $_POST['data'];

						$this->data['extension'] = $data;
						
						if(isset($data['custom']))
						{
							foreach($this->data['property_data'] as &$da)
							{
								$da['property_value'] = $data['custom'][$da['value_id']];
							}
							
							foreach($this->data['property_data_default'] as &$da)
							{
								$da['property_value'] = $data['custom'][$da['value_id']];
							}
						}
						
 					}
 						
 					if(isset($_POST['extension_download']))
 					{
 						$download_data = $_POST['extension_download'];
 						$this->data['extension_download'] =  $download_data;
 					}
					
 					if(isset($_POST['extension_image']))
 					{
 						$image_data = $_POST['extension_image'];
 						$this->data['extension_image'] =  $image_data;
 					}
 					
 					
// 					print_r($this->data['extension_download']);
// 					print_r($this->data['extension_image']);
// 					die;
 				}
 			}
 			// load codeigniter captcha helper
                if(!isset($_SESSION['cap_word1']))
                {
	 				$vals = array(
	                'img_path'     => 'upload_file/captcha/',
	                'img_url'     => base_url().'upload_file/captcha/',
	                'img_width'     => '200',
	                'img_height' => 30,
	                'border' => 0,
	                'expiration' => 7200
	                );
	                
	    
	                 // create captcha image
	                $cap = create_captcha($vals);
	              
	                // store image html code in a variable
	                $this->data['cap_image'] = $cap['image'];
	              	$_SESSION['image'] = $cap['image'];
	               // store the captcha word in a session
	                $_SESSION['cap_word1'] = $cap['word']; 
                }
                else
                {
                	$this->data['cap_image'] = $_SESSION['image'];
                }
 			if($check==1)
 			{
	 			if(isset($_POST['data'])){
	 				
		            $data = $_POST['data'];
					if(isset($data['current_id']) && $data['current_id']!=0)
					{
						$data['updated_date'] = time();
						unset($data['captcha']);
						$id= $data['current_id'];
						unset($data['current_id']);
						if(isset($data['custom']))
						{
							$custom = $data['custom'];
							unset($data['custom']);
						}
						else
							$custom = null;
		            	$this->general_model->edit_extension($id,$data,$custom);	
					}
		            else
		            {
		            	$data['user_id'] = $_SESSION['user']['user_id'];
						$data['download'] = 0;
						$data['status'] = 0;
						$data['created_date'] = time();
						unset($data['captcha']);
						unset($data['current_id']);
						if(isset($data['custom']))
						{
							$custom = $data['custom'];
							unset($data['custom']);
						}
						else
							$custom = null;
		             	$insert_id = $this->general_model->insert_extension($data,$custom);
		             	$category = $this->general_model->get_category_by_category_id($data['category_id']);
		             	$_data['total_extension'] = $category[0]['total_extension']+1;
		             	$this->general_model->update_total_extension_category($data['category_id'],$_data);
		            }
		            
		           
	        	}
	        	
	        	if(isset($_POST['extension_download'])){
	        		$download = $_POST['extension_download'];
	        		if(isset($_POST['data']['current_id']) && $_POST['data']['current_id']!=0)
	        		{
	        			$this->db->trans_start(); 
						$this->db->delete('downloads', array('extension_id' => $_POST['data']['current_id']));
						$this->db->trans_complete();	
	        			$extension_id = $_POST['data']['current_id'];
	        		}
		            foreach($download as $key=>&$load)
	        		{
	        			$load['downloads'] = 0;
	        			if(isset($extension_id))
							$load['extension_id'] = $extension_id;
						else
							$load['extension_id'] = $insert_id;
	        			$load['created_date'] = time();
	        			if(isset($load['list_com']))
	        				$load['list_com'] = serialize($load['list_com']);
	        				
		            	$this->general_model->insert_extension_download($load);
	        		}

	        	}
	 			if(isset($_POST['extension_image'])){
	        		$image = $_POST['extension_image'];
	        		
	        		if(isset($_POST['data']['current_id']) && $_POST['data']['current_id']!=0)
	        		{
	        			$this->db->trans_start(); 
						$this->db->delete('gallery', array('reference_id' => $_POST['data']['current_id'],'type'=>1));
						$this->db->trans_complete();	
						$reference_id = $_POST['data']['current_id'];
	        		}
		            foreach($image as $key=>&$img)
					{
						if(isset($reference_id))
							$img['reference_id'] = $reference_id;
						else
							$img['reference_id'] = $insert_id;
						
						$img['type'] = 1;
		            	$this->general_model->insert_extension_image($img);
					}

	 			}
	 			
	 			if(isset($_POST['data']['send_to_purchase']) && $_POST['data']['send_to_purchase'] ==1 ){
 					
	 				$all_user_notic = $this->general_model->get_all_user_buy_extension($id);
		            foreach($all_user_notic as $all)
		            {
		            	$notification_user = $this->general_model->get_notification_by_user_id($all['user_id']);
		            	if($all['user_id'] != $_SESSION['user']['user_id'])
		            	{
			            	if(isset($notification_user[0]))
							{	
									if($notification_user[0]['notify_extension'] ==1)
									{
										$user_owner = $this->general_model->get_user_by_user_id($all['user_id']);
										$setting = $this->general_model->get_email_from_setting();
										$sql ="SELECT title,content,id,date_created from newsletters where type=2";
										$query = $this->db->query($sql);
										$result = $query->result_array();
										
										$data['body']=$result[0]['content'];
										$title = $data['title']=$result[0]['title'];
										$data['date']=$result[0]['date_created'];
										//echo $body;
										$data['name'] = $all['extension_name'];
										$data['link'] = base_url()."extension/".$id."/".url_title($all['extension_name']).".html";
										
										ob_start();
										$data['body'] = preg_replace('/{extension_name}/', $all['extension_name'],$data['body']);
										$this->load->view('content/email-template-extension',$data);
										$body2 = ob_get_contents();
										ob_end_clean();
										
										$data['email'] = $user_owner[0]['email'];
										$title = preg_replace('/{name}/', $all['extension_name'],$title);
										$data['subject'] = $title;
										$data['content'] = $body2;
										$data['from'] = $setting[0]['email'];
										$this->sendEmailAutomatic($data['email'],$data['subject'],$data['content'],$data['from'],"html");
									}
								}
			            	}
		            	}
	 			}
	 		 	$this->session->set_flashdata('message', "You have modified your extensions!");
	 			redirect('/profile-extension', 'refresh');
 			}
 			else 
 			{
 			
 			$banner = @reset($this->general_model->get_website_info());
 			$this->data['settings'] = $banner;
        	$this->data['noimage'] =$banner['default_image'];
 			
        	
        		
        	$this->data['extension_category'] =  $this->general_model->get_all_category();
        	$this->data['license'] =  $this->general_model->get_all_license();
        	$this->data['compatibility'] =  $this->general_model->get_all_compatibility();
        	
	 		$this->data['title']='Edit Extension';
			$this->data['content']='profileeditextension';
			$this->load->view('templates',$this->data,'');
 			}
 		}
 		else
 		{	
 			 $_SESSION['redirect_page'] = "profile-update-extension/".$id;
 			 redirect('/profile', 'refresh');
 		}
	}
	
	function profile_editaddress($id='',$url_title=""){
	    if(isset($_SESSION['user']))
	    {
	        if(isset($id) && $id!="")
	        {
	            $extension = $this->general_model->get_address_by_id($id);
	            if(count($extension) > 0)
	                $this->data['extension']  = $extension[0];
	            else
	                $this->data['extension']  = null;
	            $this->data['current_id'] = $id ;
	          
	        }
	        else
	        {
	            $this->data['current_id'] = 0 ;
	            $this->data['extension'] = null;
	        }

	        if(isset($_POST['data']))
	        {

	                $data = $_POST['data'];
	                if(isset($data['current_id']) && $data['current_id']!=0)
	                {
	                    $data['updated_date'] = time();
	                    $id= $data['current_id'];
	                    unset($data['current_id']);

	                    $this->general_model->edit_address($id,$data);
	                }
	                else
	                {
	                    $data['user_id'] = $_SESSION['user']['user_id'];
	                    $data['created_date'] = time();
	                    unset($data['current_id']);
	                    $insert_id = $this->general_model->insert_address($data);
	                }
	                 

	
	            $this->session->set_flashdata('message', "You have modified your Address!");
	            redirect('/profile/address', 'refresh');
	        }
	        else
	        {
	
	            $banner = @reset($this->general_model->get_website_info());
	            $this->data['settings'] = $banner;
	
	            $this->data['country'] =  $this->general_model->get_all_country();
	             
	            $this->data['title']='Edit Extension';
	            $this->data['content']='profileeditaddress';
	            $this->load->view('templates',$this->data,'');
	        }
	    }
	    else
	    {
	        $_SESSION['redirect_page'] = "profile/address/edit/".$id;
	        redirect('/profile', 'refresh');
	    }
	}
	
	function profile_deleteaddress($id='',$url_title=""){
	    $this->db->trans_start();
	    $this->db->delete('address', array('address_id' => $id));
	    $this->db->trans_complete();
	     redirect('/profile/address', 'refresh');
	}
	
	function profile_download(){
 		if(isset($_SESSION['user']))
 		{
 			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
 			$download_data = $this->general_model->get_all_download_by_user_id($_SESSION['user']['user_id'],null,null);
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile-download?type=download';
	        $config['total_rows'] = count($download_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $download_data = $this->general_model->get_all_download_by_user_id($_SESSION['user']['user_id'],$limit,$offset);
	        $this->data['download_data'] = $download_data;
	      
 			$this->data['pagination'] = $this->pagination->create_links();
 			$banner = @reset($this->general_model->get_website_info());
 			$this->data['settings'] = $banner;
 			
 			$this->data['title']='Your download';
			$this->data['content']='profiledownload';
			$this->load->view('templates',$this->data,'');
			
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile-download";
 			 redirect('/login', 'refresh');
 		}
	}
	
	function profile_order(){
 		if(isset($_SESSION['user']))
 		{
 			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
 			$order_data = $this->general_model->get_all_order_by_user_id($_SESSION['user']['user_id'],null,null);
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile-history?type=order';
	        $config['total_rows'] = count($order_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $order_data = $this->general_model->get_all_order_by_user_id($_SESSION['user']['user_id'],$limit,$offset);
	        
	        $this->data['order_data'] = $order_data;
	      	
 			$this->data['pagination'] = $this->pagination->create_links();
 			$this->data['title']='Order History';
			$this->data['content']='profileorder';
			$this->load->view('templates',$this->data,'');

 		}
 		else
 		{
 			$_SESSION['redirect_page'] = "profile/order";
 			 redirect('/login', 'refresh');
 		}
	}
	
	function profile_order_detail($id='',$url_title=""){
		
		if(isset($_SESSION['user']))
		{
			
			$order_data = $this->general_model->get_order_detail($id);
			$this->data['order_data'] = $order_data;
			$this->data['title']='Order History Detail';
			$this->data['content']='profileorderdetail';
			$this->load->view('templates',$this->data,'');
				
		}
		else
		{
			$_SESSION['redirect_page'] = "profile/order";
			redirect('/login', 'refresh');
		}
	}
	
	function profile_order_invoice($id='',$url_title=""){
	
		if(isset($_SESSION['user']))
		{
			$order_data = @reset($this->general_model->get_order_detail($id));
			$extension_data = @reset($this->general_model->get_extension_by_extension_id($order_data['extension_id']));
			$order_data_temp = @reset($this->general_model->get_order_invoice($id));

			if($extension_data['user_id'] != $order_data_temp['user_id'] )
			{
				$seller_data = @reset($this->general_model->get_user_by_user_id_invoice($extension_data['user_id']));
				$buyer_data = @reset($this->general_model->get_user_by_user_id_invoice($order_data_temp['user_id']));
				$address_data = @reset($this->general_model->get_address_by_id($order_data_temp['address_id']));
				$setting =  @reset($this->general_model->get_website_info());
				$this->data['setting']  = $setting;
				$this->data['order']  = $order_data;
				$this->data['seller'] = $seller_data;
				$this->data['buyer']  = $buyer_data;
				if($extension_data['shipping']==1)
				{
				    $this->data['address']  = $address_data;
				}
				else 
				{
				    $this->data['address']  = null;
				}
				
			}
			else 
			{
				redirect('profile/order', 'refresh');
			}
			$this->data['title']='Invoice';
			$this->data['content']='profileorderinvoice';
			$this->load->view('invoice',$this->data,'');
	
		}
		else
		{
			$_SESSION['redirect_page'] = "profile/order";
			redirect('/login', 'refresh');
		}
	}
	
	function profile_sale(){
 		if(isset($_SESSION['user']))
 		{
 			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
 			$sale_data = $this->general_model->get_all_sale_by_user_id($_SESSION['user']['user_id'],null,null);
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile/sale?type=sale';
	        $config['total_rows'] = count($sale_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $sale_data = $this->general_model->get_all_sale_by_user_id($_SESSION['user']['user_id'],$limit,$offset);
	        
	        foreach($sale_data as &$sale)
	        {
	        	$user_data = @reset($this->general_model->get_user_by_user_id($sale['user_id']));
	        	$sale['username'] = $user_data['username'];
	        	if($_SESSION['user']['user_id'] == $sale['owner_id'])
	        		$sale['owner'] = 1;
	        	else
	        		$sale['owner'] = 0;
	        }
	        $this->data['sale_data'] = $sale_data;
 			$this->data['pagination'] = $this->pagination->create_links();
 			$this->data['title']='Order History';
			$this->data['content']='profilesale';
			$this->load->view('templates',$this->data,'');
			
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile/sale";
 			 redirect('/login', 'refresh');
 		}
	}
	function profile_transaction(){
	if(isset($_SESSION['user']))
 		{
 			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
 			$sale_data = $this->general_model->get_all_purchase_order($_SESSION['user']['user_id'],null,null);
 			$sale_data2 = $this->general_model->get_all_purchase_order_by_owner_id($_SESSION['user']['user_id'],null,null);
 			
 			$limit=15;
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'profile/sale?type=transaction';
	        $config['total_rows'] = count($sale_data) + count($sale_data2);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);
	        $sale_data = $this->general_model->get_all_purchase_order($_SESSION['user']['user_id'],$limit,$offset);
	        $sale_data2 = $this->general_model->get_all_purchase_order_by_owner_id($_SESSION['user']['user_id'],null,null);
	        $sale_datas = array_merge($sale_data,$sale_data2);
	        $this->data['banners'] = $sale_datas;
 			$this->data['pagination'] = $this->pagination->create_links();
 			$this->data['title']='Transaction';
 			
			$this->data['content']='transaction';
			$this->load->view('templates',$this->data,'');
			
 		}
 		else
 		{	$_SESSION['redirect_page'] = "profile/sale";
 			 redirect('/login', 'refresh');
 		}
    }
	
	function getcity()
	{
    	$name = $this->input->post('name');
    	if( $name ) {
        $data = $this->general_model->get_list_city_by_region($name);
    	}
		$_data=array();
		if($data->num_rows()>0)
		{
			$_data=$data->result_array();
		}
		$ajax = "";
		foreach($_data as $da)
		{
			echo "<option value='".$da['city_id']."'>".$da['city_name']."</option>";
		}
	}
	function getregion()
	{
    	$name = $this->input->post('name');

    	if( $name ) {
        $data = $this->general_model->get_list_region_by_country($name);
    	}
		$_data=array();
		if($data->num_rows()>0)
		{
			$_data=$data->result_array();
		}
		$ajax = "";
		foreach($_data as $da)
		{
			echo "<option value='".$da['region_id']."'>".$da['region_name']."</option>";
		}
	}
	
	function getproperty()
	{
    	$name = $this->input->post('name');

    	if( $name ) {
        $data = $this->general_model->get_category_property_by_category_id($name,null);
    	}
    	if(isset($data))
    	{	
    		$_data = $data;
			$html = "";
			foreach($_data as $da)
			{
				$html = "";
				 $html .= '<div class="st-form-line" style="z-index: 680;">	';
	             $html .= '<span class="st-labeltext">'.$da['property_name'].'</span>	';
	             $html .= '<input type="text" value="" style="width:510px" id="custom_'.$da['value_id'].'" class="st-forminput" name="custom['.$da['value_id'].']">'; 
	             $html .= '<div class="clear" style="z-index: 670;"></div>';
	             $html .= '</div>';
	             echo  $html;
			}
    	}
	}
	
	function getproperty_frontend()
	{
    	$name = $this->input->post('name');

    	if( $name ) {
        $data = $this->general_model->get_category_property_by_category_id($name,null);
    	}
    	if(isset($data))
    	{	
    		$_data = $data;
			$html = "";
			foreach($_data as $da)
			{
				$html = "";
				 $html .= '<div class="control-group">';
		         $html .= '<label class="control-label" for="Advanced multiple Forms">'.$da['property_name'].'</label>';
		         $html .= '<div class="controls" style="margin-left:319px;">';
		         $html .= '<input type="text" class="require" name="data[custom]['.$da['value_id'].']" value="" id="custom_'.$da['value_id'].'" placeholder="">';
		         $html .= '</div>';
		         $html .= '</div>';

	             echo  $html;
			}
    	}
	}
	 
    public function uploadimage() {  
    	$banner = @reset($this->general_model->get_website_info());
        $folder = isset($_GET['folder'])?$_GET['folder']:'others';        
        $targetFolder = "/upload_file/{$folder}";              
        $prefix = time();               
        if(!empty($_FILES)){            
            $tempFile = $_FILES["Filedata"]["tmp_name"];                        
            $targetPath = $_SERVER["DOCUMENT_ROOT"] . $targetFolder;             
            $targetFile = rtrim($targetPath,"/") . "/" . $prefix."_".$_FILES["Filedata"]["name"];                       
            $fileTypes = array("jpg","jpeg","gif","png","bmp");                     
            $fileParts = pathinfo($prefix."_".$_FILES["Filedata"]["name"]);                     
            if (in_array($fileParts["extension"],$fileTypes)) {                         
                move_uploaded_file($tempFile,$targetFile);
                if(isset($_GET['w']))
                	$w =  $_GET['w'];
                else
                	$w = 100;    
                if(isset($_GET['h']))
                	$h =  $_GET['h'];
                else
                	$h = 100;                           
                echo json_encode(array('thumb'=>base_url().image("upload_file/{$folder}/" . $prefix."_".$_FILES["Filedata"]["name"],$banner['default_image'],$w,$h),"source"=>"upload_file/{$folder}/" . $prefix."_".$_FILES["Filedata"]["name"]));             
            } else {                            
                echo "1";                          
            }                   
        }           
    }
    
	public function uploadfile() {  
        $folder = isset($_GET['folder'])?$_GET['folder']:'others';        
        $targetFolder = "/upload_file/{$folder}";              
        $prefix = time();   
        $setting = $this->general_model->get_email_from_setting();            
        $type = explode(",",$setting[0]['download_type']);

        if(!empty($_FILES)){            
            $tempFile = $_FILES["Filedata"]["tmp_name"];                        
            $targetPath = $_SERVER["DOCUMENT_ROOT"] . $targetFolder;             
            $targetFile = rtrim($targetPath,"/") . "/" . $prefix."_".$_FILES["Filedata"]["name"];                       
            $fileTypes = $type;//array("zip","rar");                     
            $fileParts = pathinfo($prefix."_".$_FILES["Filedata"]["name"]);                     
            if (in_array($fileParts["extension"],$fileTypes)) {                         
                move_uploaded_file($tempFile,$targetFile);
                if(isset($_GET['w']))
                	$w =  $_GET['w'];
                else
                	$w = 100;    
                if(isset($_GET['h']))
                	$h =  $_GET['h'];
                else
                	$h = 100;                           
                echo "upload_file/{$folder}/" . $prefix."_".$_FILES["Filedata"]["name"];             
            } else {                            
                echo "1";                          
            }                   
        }           
    }
    
	function extension_detail($id,$url_title=""){
	    
		$extension = $this->general_model->get_extension_by_extension_id($id);
		if($extension!=null && count($extension)>0)
		{
			$this->data['extension'] = $extension[0];
			$data['views'] = $extension[0]['views']+1;
			$this->general_model->update_extension($id,$data);
			$this->data['extension_relate'] = $this->general_model->get_all_relate_extension($id,$extension[0]['category_id'],16,0,"created_date","DESC");
		}
		else
		{ 
			$this->data['extension'] = null;
			 redirect('/index', 'refresh');
		}
		$this->data['extension_option'] = $this->general_model->get_extension_option_by_extension_id($id);
		$extension_download = $this->general_model->get_all_download_by_extension_id($id);
		$compatibility = $this->general_model->get_all_download_by_extension_id($id);
		
		
		foreach($extension_download as &$download)
		{
			$download['compatibility'] = "";
			$download['list_com'] = unserialize($download['list_com']);
			$compatibility=  $this->general_model->get_all_compatibility_in_array($download['list_com']);
			foreach($compatibility as $compa)
			{
				$download['compatibility'].=$compa['compatibility_name'].", ";
			}
			$download['compatibility']=substr($download['compatibility'],0,-2);
		}
		
		$this->data['extension_download'] = $extension_download;
		if(isset($_SESSION['user']['user_id']))
		{
			$check_user_like = $this->general_model->get_user_like($_SESSION['user']['user_id'],$id);
			if(count($check_user_like) > 0)
			{
				$this->data['check_user_like'] = 0;
				$this->data['user_like_img'] = $check_user_like[0]['type'];
			}
			else
			{
				$this->data['check_user_like'] = 1;
			
			}
		}
		$this->data['extension_image'] = $this->general_model->get_all_image_by_extension_id($id);
		$this->data['extension_comment'] = $this->general_model->get_all_comment_by_extension_id($id,null,null);
		
		$this->data['extension_relate'] = $this->general_model->get_all_relate_extension($id,$extension[0]['category_id'],16,0,"created_date","DESC");
		
		$this->data['current_id'] = $id;
		$banner = @reset($this->general_model->get_website_info());
		$this->data['settings'] = $banner;
	
		$banner = @reset($this->general_model->get_website_info());
		$this->data['settings'] = $banner;
		
		$this->data['title']=$extension[0]['name'];
		$this->data['content']='extension_detail';
		$this->load->view('templates',$this->data,'');
	}

	function extension_addcomment(){
		
					$flag=true;
					$comment = $_POST['comment'];
						$data = array(
						'user_id' 	=> $_POST['uid'],// mac dinh
						'content' 	=> $comment,
						'created_date' 	=> time(),
						'extension_id' 	=> $_POST['id']
					);
						$new_comment_id = $this->general_model->insert_comment($data);
						$extension = $this->general_model->get_extension_by_extension_id($_POST['id']);
						if(isset($extension[0]))
						{
							$_data['comment'] = $extension[0]['comment']+1;
							$this->general_model->update_extension($_POST['id'],$_data);
						}
						else
							redirect("/error","refesh") ;
						$user = $this->general_model->get_user_by_user_id($data['user_id']);
						if($extension[0]['user_id']!=$_POST['uid'])
						{
							$user_owner = $this->general_model->get_user_by_user_id($extension[0]['user_id']);
							$notification_user = $this->general_model->get_notification_by_user_id($extension[0]['user_id']);
							if(isset($notification_user[0]))
							{
								if($notification_user[0]['notify_comment'] ==1)
								{
									$setting = $this->general_model->get_email_from_setting();
									$sql ="SELECT title,content,id,date_created from newsletters where type=4";
									$query = $this->db->query($sql);
									$result = $query->result_array();
									
									$data['username'] = $extension[0]['username'];
									$data['content'] = $comment;
									$data['extension_name'] = $extension[0]['name'];
									$data['link'] = base_url()."extension/".$_POST['id']."/".url_title($extension[0]['name']).".html";
									$data['body'] = $result[0]['content'];
									$title = $data['title'] = $result[0]['title'];
									$data['date'] = $result[0]['date_created'];
									
									ob_start();
									$this->load->view('content/email-template-comment',$data);
									$body2 = ob_get_contents();
									ob_end_clean();
									
									$data['email'] = $user_owner[0]['email'];
									$data['subject'] = $title;
									$data['content'] = $body2;
									$data['from'] = $setting[0]["email"];
									$this->sendEmailAutomatic($data['email'],$data['subject'],$data['content'],$data['from'],"html");
								}
							}
							else
								redirect("/error","refesh") ;
						}
						if($user[0]['avatar']!="")
							$avatar = $user[0]['avatar'];
						else
							$avatar = "assets/frontend/img/noimage.jpg";
						$html = '<div id ="comnew'.$new_comment_id.'">';
	                    $html .=       '<div class="man-img"><img src="'.base_url().$avatar.'" height="84" width="84"></div>';
	                    $html .=       '<div class="Comments-text">';
	                    $html .=       '	<div class="name">'.$user[0]['username'].' - '.my_int_date(time()).'</div>';
	                    $html .=       ' <div class="comment_border"></div>';
	                    $html .=        '<div class="comment_text">'.$comment.'</div>';
	                    $html .=        '<div class="reply"><a href="#post_comment">reply</a></div>';
	                    $html .=       '</div>';
	                    $html .=       '<div class="clear"></div>';
	                    $html .=       '<div class="border"></div>';
                        $html .=   '</div>';
						echo json_encode(array('id'=>$new_comment_id,'status'=>1,'html'=>$html,'success'=>'Success: post comment ! '));
    }
    
	function extension_download(){
		if(isset($_GET['extension_download_id']))	
		{
			$extension_download = $this->general_model->get_download_by_id($_GET['extension_download_id']);
			$extension= $this->general_model->get_extension_by_id($extension_download[0]['extension_id']);
			if(isset($_SESSION['user']['user_id']))
			{
				$setting = $this->general_model->get_email_from_setting();  
				$check_download = $this->general_model->get_user_download($extension[0]['extension_id'],$_SESSION['user']['user_id']);
				if($extension[0]['price'] == 0 || ($extension[0]['price'] !=0 && isset($check_download[0]['download']) && $check_download[0]['download'] > 0 && $check_download[0]['expire_time'] >= time()))
				{
					$total_download_extension = $extension[0]['download']+1;
					$this->general_model->update_total_download_extension($extension_download[0]['extension_id'],$total_download_extension);
					$check = $this->general_model->update_total_download($_GET['extension_download_id'],($extension_download[0]['downloads']+1));
					
					$_data1 =null;
					
					if(isset($check_download[0]['download']) && $check_download[0]['download'] > 0)
					{
						$_data1['download'] = $check_download[0]['download']-1;
						$this->general_model->update_user_buy($_SESSION['user']['user_id'],$extension[0]['extension_id'],$_data1);
					}
					
					$_data= null;
					$check_download_user = $this->general_model->get_download_user($extension_download[0]['download_id'],$_SESSION['user']['user_id']);
					if(count($check_download_user) > 0)
					{
						$_data['download'] = $check_download_user[0]['download']+1;
						$this->general_model->update_user_download($_SESSION['user']['user_id'],$extension_download[0]['download_id'],$_data);
					}
					else
					{	$_data['download'] = 1;
						$_data['user_id'] = $_SESSION['user']['user_id'];
						$_data['download_id'] = $extension_download[0]['download_id'];
						$this->general_model->insert_user_download($_data);
					}
					
//					$this->load->helper('download');
//					$data = file_get_contents(base_url().$extension_download[0]['item_file']); // Read the file's contents
//					$this->set_download($extension_download[0]['item_name'].".zip",$data); 
					redirect("set_download?id=".$_GET['extension_download_id'], 'refresh');

				}
				else
				{
					$this->session->set_flashdata('checkout_warning','Download out expire time or limit times. Please purchase extension to download');
	 			 	redirect("checkout/".$extension[0]['extension_id']."/".url_title($extension[0]['name']).".html", 'refresh');
				}
				
			}
			else
			{
				$_SESSION['redirect_page'] = base_url()."extension/".$extension_download[0]['extension_id']."/".url_title($extension_download[0]['name']).".html";
 			 	redirect('/login', 'refresh');			
			}

		}
		else
		{
			redirect('/index', 'refresh');
		}
    }
    function set_download()
    {
    	$extension_download = $this->general_model->get_download_by_id($_GET['id']);
    	$this->load->helper('download');
		$data = file_get_contents(base_url().$extension_download[0]['item_file']); // Read the file's contents
    	force_download($extension_download[0]['item_name'].".zip",$data); 
    }
    
	function extension_checkout($id,$url_title=""){
	    if(isset($id) && $id!="")
	    {
	        $cart = $this->session->userdata('cart');
	        $ex_data = @reset($this->general_model->get_extension_by_extension_id($id));
	        if(!isset($cart[$id."-0"]))
	            $cart[$id."-0"] = $ex_data['price'] ;
	        $this->session->set_userdata(array('cart'=>$cart));
	    }
		if(isset($_SESSION['user']))
 		{
			$user_detail = $this->general_model->get_user_by_user_id($_SESSION['user']['user_id']);
			if($user_detail!=null)
				$this->data['user_detail'] = $user_detail[0] ;
			else
			{
				$_SESSION['redirect_page'] = "checkout";
 			 	redirect('/login', 'refresh');
			}
			if(isset($_POST['term']))
			{
				$this->data['term'] = 1;
			}
			$setting = $this->general_model->get_email_from_setting();
			$this->data['des'] = $setting[0]['checkout_description'];
			$this->data['payment_method'] = $this->general_model->get_all_payment();
			
			$_SESSION['checkout']['cancel_url'] = $this->data['link_back'] = base_url();
			$_SESSION['checkout']['return_url'] = base_url()."review.php";

			
			$this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
        	$this->data['license'] =  $this->general_model->get_all_license();
        	$this->data['compatibility'] =  $this->general_model->get_all_compatibility();
        	$total_extension = 0;
        	foreach($extension_category as $compa)
        	{
        		$total_extension += $compa['total_extension'];
        	}
        	$this->data['total_extension'] = $total_extension;
        	
			$this->data['link_category']= base_url()."category?type=thumb";
			$this->data['link_license']= base_url()."category?type=thumb";
			$this->data['link_compatibility']= base_url()."category?type=thumb";
			$this->data['link_search']= base_url()."category?type=thumb";
			$_SESSION['checkout']['link_payment'] = base_url()."payment";
			
			
			if(isset($_POST['quantity']))
			{
			    $cart = $this->session->userdata('cart');
			    foreach($_POST['quantity'] as $key=>$quanti)
			    {
			        $cart[$key."-0"] = $quanti*$_POST['price'][$key] ;
			    }
			
			    $this->session->set_userdata(array('cart'=>$cart));
			}
			
			$setting = $this->general_model->get_email_from_setting();
			$this->data['des'] = $setting[0]['checkout_description'];
			$this->data['payment_method'] = $this->general_model->get_all_payment();
			$this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
			$this->data['license'] =  $this->general_model->get_all_license();
			$this->data['compatibility'] =  $this->general_model->get_all_compatibility();
			$total_extension = 0;
			foreach($extension_category as $compa)
			{
			    $total_extension += $compa['total_extension'];
			}
			$this->data['total_extension'] = $total_extension;
			 
			$this->data['link_category']= base_url()."category?type=thumb";
			$this->data['link_license']= base_url()."category?type=thumb";
			$this->data['link_compatibility']= base_url()."category?type=thumb";
			$this->data['link_search']= base_url()."category?type=thumb";
			$this->data['link_back'] = base_url();
			
			$data = array();
			$cart = $this->session->userdata('cart');
			$i = 0;
			$check_shipping= 0;
			if(!empty($cart)){
			    foreach($cart as $key=>$row){
			        $key = explode("-", $key);
			        $meal = @reset($this->general_model->get_extension_by_extension_id($key[0]));
			        if(empty($meal)) continue;
			        if($meal['shipping']==1)
			        {
			            $check_shipping = 1;
			        }
			        $data['meals'][$i]['data'] = $meal;
			        if($key[1]==1) $data['meals'][$i]['data']['price'] = $data['meals'][$i]['data']['price_mini'];
			        $data['meals'][$i]['price_type'] = $key[1];
			        $data['meals'][$i]['amount'] = $row/$meal['price'];
			        $data['meals'][$i]['id'] =$meal['extension_id'];
			        $data['meals'][$i]['price_mini'] = $meal['price'];
			       
			        $i++;
			    }
			    $this->data['meals'] = $data['meals'];
			    $this->data['shipping'] = $check_shipping;
			}
			$extension_data = $this->general_model->get_all_address_by_user_id($_SESSION['user']['user_id'],null,null);
			foreach($extension_data as &$row)
			{
			    if($row['address1']!="")
			        $add = $row['address1'];
			    else
			        $add = $row['address2'];
			    $row['address'] = $add.", ".$row['state'].", ".$row['postal'].", ".$row['country_name'];
			}
			
			$this->data['shipping_data'] = $extension_data;
			$this->data['country'] =  $this->general_model->get_all_country();
 			$this->data['title']='Extension Checkout';
			$this->data['content']='extension_checkout';
			$this->load->view('templates',$this->data,'');
			
 		}
 		else
 		{
 			 $_SESSION['redirect_page'] = "checkout/".$id."/".url_title($ex_data['name']).".html";
 			 redirect('/login', 'refresh');
 		}
        
	}
    
	function extension_payment(){
        if(isset($_SESSION['order']) && isset($_SESSION['checkout']))
        {

        	if($_SESSION['checkout']['payment_status']=="Completed")
        	{
        		if(isset($_SESSION['address_id']) && $_SESSION['address_id']!="" && $_SESSION['address_id']!=0 )
        		{
        			$status = 2;
        		}
        		else
        		{
        			$status = 1;
        		}
        	}
        	else
        		$status = 0;
        		
        	$commission = $this->general_model->get_website_info();	
        	if(count($commission) >0)
        		$commission_default = $commission[0]['commission'];
        	else
        		$commission_default = 0;
        		
        	$cart = $this->session->userdata('cart');
        	if(!empty($cart)){
        	    $total_money = 0;
        	    foreach($cart as $key=>$row){
        	
        	        $key = explode("-", $key);
        	        $meal = @reset($this->general_model->get_extension_by_extension_id($key[0]));
        	        $user_info = @reset($this->general_model->get_user_by_id($_SESSION['user']['user_id']));
        	           if($meal['shipping'] == 0)
        	           {
        	               $shipping_fee=0;
        	           }
        	           else
        	           {
        	               $shipping_fee = $meal['weight'] * $meal['priceperweight']*$row/$meal['price'];
        	           }
            	    $data = array(
            	            "user_id" => $_SESSION['user']['user_id'],
            	            "extension_id" =>$meal['extension_id'],
            	            "extension_name" => $meal['name'],
            	            "extension_price" => $meal['price'],
            	            "quantity" => $row/$meal['price'],
            	            "total_price" => $row,
            	            "shipping_fee" => $shipping_fee,
            	            "transaction_paypal_id"	=>$_SESSION['checkout']['transactionId'],
            	            "commission" => $commission_default,
            	            "total_balance" => ($row+$shipping_fee) - (($shipping_fee+$row)*$commission_default/100),
            	            "created_date" => time(),
            	            'added_date' =>  date('Y-m-d H:i:s',time()),
            	            "status" => $status,
            	            "payment_type" => 1,
            	            "address_id" => isset($_SESSION['address_id'])?$_SESSION['address_id']:"0",
            	    );
            	    $check = $this->general_model->insert_order($data);
        	    
        	    if($check==1)
        	    {
        	    
        	        if($status == 1 || $status == 2)
        	        {
        	            $setting = $this->general_model->get_email_from_setting();
        	            $user_buy_data = $this->general_model->get_user_buy($_SESSION['user']['user_id'],$meal['extension_id']);
        	            if(count($user_buy_data) > 0)
        	            {
        	    
        	            				//$_data['download'] = $user_buy_data[0]["download"] + $_SESSION['checkout']['quantity'];
        	                            $_data = null;
        	            				$_data['download'] = $user_buy_data[0]["download"] + ($setting[0]['download_times']);
        	            				if($user_buy_data[0]["expire_time"]>time())
        	            				    $_data['expire_time'] = $user_buy_data[0]["expire_time"]+$setting[0]['download_expire'];
        	            				else
        	            				    $_data['expire_time'] = time()+$setting[0]['download_expire'];
        	            				
        	            				$this->general_model->update_user_buy($_SESSION['user']['user_id'],$meal['extension_id'],$_data);
        	    
        	            }
        	            else
        	            {
        	                            $_data = null;
        	            				$_data['user_id'] = $_SESSION['user']['user_id'];
        	            				$_data['extension_id'] = $meal['extension_id'];
        	            				//$_data['download'] = $_SESSION['checkout']['quantity'];
        	            				$_data['download'] = $setting[0]['download_times'];
        	            				$_data['expire_time'] = time()+$setting[0]['download_expire'];
        	            				$this->general_model->insert_user_buy($_data);
        	            }
        	    
        	    
        	            $extension = $this->general_model->get_extension_by_extension_id($meal['extension_id']);
        	            if(isset($extension[0]['user_id']))
        	            {
        	                $notification_user = $this->general_model->get_notification_by_user_id($extension[0]['user_id']);
        	                $user_owner = $this->general_model->get_user_by_user_id($extension[0]['user_id']);
        	            }
        	             
        	            $user_buy = $this->general_model->get_user_by_user_id($_SESSION['user']['user_id']);
        	    
        	            if(isset($notification_user[0]))
        	            {
        	                if($notification_user[0]['notify_purchase']==1)
        	                {
        	                    	
        	                    $setting=$this->general_model->get_email_from_setting();
        	                    $sql="SELECT title,content,id,date_created from newsletters where type=3";
        	                    $query=$this->db->query($sql);
        	                    $result=$query->result_array();
        	                    	
        	                    $data['username']=$user_buy[0]['username'];
        	                    $data['extension_name']=$extension[0]['name'];
        	                    $data['quantity']=$row/$meal['price'];
        	                    $data['total']=$row;
        	                    $data['link']=base_url()."profile-history";
        	                    	
        	                    $data['body']=$result[0]['content'];
        	                    $title=$data['title']=$result[0]['title'];
        	                    $data['date']=$result[0]['date_created'];
        	                    	
        	                    ob_start();
        	                    $this->load->view('content/email-template-purchase',$data);
        	                    $body2=ob_get_contents();
        	                    ob_end_clean();
        	                    	
        	                    $data['email']=$user_owner[0]['email'];
        	                    $title = preg_replace('/{name}/', $extension[0]['name'],$title);
        	                    $data['subject']=$title;
        	                    $data['content']=$body2;
        	                    $data['from']=$setting[0]["email"];
        	                    $this->sendEmailAutomatic($data['email'],$data['subject'],$data['content'],$data['from'],"html");
        	    
        	                }
        	            }
        	        }
        	        else
        	        {
        	            $this->session->set_flashdata('message_checkout_error', "checkout  pending. Please try again.");
        	            redirect('/profile', 'refresh');
        	        }
        	     }
        	     else
        	     {
        	            $this->session->set_flashdata('message_checkout_error', "checkout  pending. Please try again.");
        	            redirect('/profile', 'refresh');
        	     }
        	    }
        	    
        	    
        	}
        	else
        	{
        	    $this->session->set_flashdata('message_checkout_error', "checkout  pending. Please try again.");
        	    redirect('/profile', 'refresh');
        	}
        }
        else 
        {
        	$this->session->set_flashdata('message_checkout_error', "checkout pending. Please try again.");
	 		redirect('/profile', 'refresh');
        }
       
        unset($_SESSION['order']);
        unset($_SESSION['orders']);
        unset($_SESSION['checkout']);
        unset($_SESSION['address_id']);
        unset($_SESSION['shipping_status']);
        unset($_SESSION['total_money']);
        $this->session->set_userdata(array('cart'=>null));
        $this->session->set_flashdata('message_checkout', "order");
        redirect('/profile', 'refresh');
	}
	
	function extension_category($id="",$url_title=""){
		
	       $link = base_url()."category";	

	       if($id!="")
	       {
	       		$category = @reset($this->general_model->get_category_by_category_id($id));
	       		$this->data['category_name'] = $category['category_name'];
	       		if(isset($category[0]['category_name']))
	       			$link .="/".$id."/".url_title($category['category_name']).".html";
	       }
			$link_type = "";
			if(!isset($_GET['offset'])|| empty($_GET['offset']))
 				$offset = 0;
	        else 
	       		$offset = $_GET['offset'];
	        $this->data['offset'] = $offset;
	        if(!isset($_GET['type']))
	        {
	        	$type = 'list';
	        	$link.="?type=list";
	        }
	        else
	        {
	        	$type = $_GET['type'];
	        	$link.="?type=".$_GET['type'];
	        }	
	        $this->data['type'] = $type;
	        
	        $link_search = $link_compatibility = $link_license = $link_category = $link_limit = $link_sort = $link;

	        if(isset($_GET['filter_search']))
	        {
	        	$link_type .= "&filter_search=".$_GET['filter_search'];
	        	$link_limit .= "&filter_search=".$_GET['filter_search'];
	        	$link_sort .= "&filter_search=".$_GET['filter_search'];
	        	$link_category .= "&filter_search=".$_GET['filter_search'];
	        	$link_compatibility .= "&filter_search=".$_GET['filter_search'];
	        	$link_license .= "&filter_search=".$_GET['filter_search'];	
	        	$data['search'] = $_GET['filter_search'];
	        }
	        if(isset($id) && $id !="")
	        {
	        	if(isset($_GET['filter_license']))
	        	{
	        		 $link_search .= "&filter_license=".$_GET['filter_license'];
	        		 $link_type .= "&filter_license=".$_GET['filter_license'];
	        		 $link_limit .= "&filter_license=".$_GET['filter_license'];
	        		 $link_sort .= "&filter_license=".$_GET['filter_license'];
	        		 $link_category .= "&filter_license=".$_GET['filter_license'];
	        		 $link_compatibility .= "&filter_license=".$_GET['filter_license'];
	        		$data['license'] = $_GET['filter_license'];
	        	}
	        	$data['category'] = $id;
	        }
	        else 
	        {
	        	if(isset($_GET['filter_license']))
	        	{
	        		$link_search .= "&filter_license=".$_GET['filter_license'];
	        		$link_type .= "&filter_license=".$_GET['filter_license'];
	        		$link_limit .= "&filter_license=".$_GET['filter_license'];
	        		$link_sort .= "&filter_license=".$_GET['filter_license'];
	        		$link_category .= "&filter_license=".$_GET['filter_license'];
	        		$link_compatibility .= "&filter_license=".$_GET['filter_license'];
	        		$data['license'] = $_GET['filter_license'];
	        	}
	        }
	        if(isset($data))
	        	$extension_data = $this->general_model->get_all_extension_by_search($data,null,null,null,null);
	       	else
	       		$extension_data = $this->general_model->get_all_extension_by_search(null,null,null,null,null);
	       		
			if(isset($_GET['filter_download_id']))
	        {
	        	$link_search .= "&filter_download_id=".$_GET['filter_download_id'];
	        	$link_type .= "&filter_download_id=".$_GET['filter_download_id'];
	        	$link_limit .= "&filter_download_ide=".$_GET['filter_download_id'];
	        	$link_sort .= "&filter_download_id=".$_GET['filter_download_id'];
	        	$link_category .= "&filter_download_id=".$_GET['filter_download_id'];
	        	$link_license .= "&filter_download_id=".$_GET['filter_download_id'];
	        	$i=0;
	        	foreach($extension_data as &$exten)
		       	{
		       		
		       		if(isset($exten['list_com']) && $exten['list_com']!=null)
		       		{
		       			$exten['list_com'] = unserialize($exten['list_com']);
			       		if(!in_array($_GET['filter_download_id'], $exten['list_com']))
			       		{
			       			unset($extension_data[$i]);
			       		}
		       		}
		       		else
		       		{
		       			unset($extension_data[$i]);
		       		}
		       		$i++;
		       		
		       	}
	        }
	        
	        if(isset($_GET['limit']) && $_GET['limit']!='')
	        {
	        	$limit = $_GET['limit'];
	        	
	        	$link_search .= "&limit=".$_GET['limit'];
	        	$link_compatibility .= "&limit=".$_GET['limit'];
	        	$link_license .= "&limit=".$_GET['limit'];
	        	$link_category .= "&limit=".$_GET['limit'];
	        	$link_type .= "&limit=".$_GET['limit'];
	        	$link_sort.="&limit=".$_GET['limit'];
	        }
	        else
	        	$limit = 15;
	        	
	        $this->data['limit'] = $limit;
	        
	         if(isset($_GET['sort']) && $_GET['sort']!='')
	         {
	        	$sort = $_GET['sort'];
	        	
	        	$link_search .= "&sort=".$_GET['sort'];
	        	$link_compatibility .= "&sort=".$_GET['sort'];
	        	$link_license .= "&sort=".$_GET['sort'];
	        	$link_category .= "&sort=".$_GET['sort'];
	        	$link_type .= "&sort=".$_GET['sort'];
	        	$link_limit.= "&sort=".$_GET['sort'];
	         }
	        else
	        {
	        		$sort = "";
	        }
	        if(isset($_GET['order']) && $_GET['order']!='')
	        {
	        	$order = $_GET['order'];
	        	
	        	$link_search .= "&order=".$_GET['order'];
	        	$link_compatibility .= "&order=".$_GET['order'];
	        	$link_license .= "&order=".$_GET['order'];
	        	$link_category .= "&order=".$_GET['order'];
	        	$link_type .= "&order=".$_GET['order'];
	        	$link_limit.= "&order=".$_GET['order'];
	        }
	        else
	        {
	        	$order = "";
	        }	
	        	
	       	$this->data['sortorder'] = $sort.$order;
	       	
	       	
 			$this->load->library('pagination');
	        $config['base_url'] = base_url().'?type='.$type;
	        $config['total_rows'] = count($extension_data);
	        $config['per_page'] = $limit; 
	        $this->pagination->initialize($config);

	        if(isset($data))
	        	$extension_data = $this->general_model->get_all_extension_by_search($data,$limit,$offset,$sort,$order);
	       	else
	       		$extension_data = $this->general_model->get_all_extension_by_search(null,$limit,$offset,$sort,$order);
			if(isset($_GET['filter_download_id']))
	        {
	        	$i=0;
	        	foreach($extension_data as &$exten)
		       	{
		       		
		       		if(isset($exten['list_com']) && $exten['list_com']!=null)
		       		{
		       			$exten['list_com'] = unserialize($exten['list_com']);
			       		if(!in_array($_GET['filter_download_id'], $exten['list_com']))
			       		{
			       			unset($extension_data[$i]);
			       		}
		       		}
		       		else
		       		{
		       			unset($extension_data[$i]);
		       		}
		       		$i++;
		       		
		       	}
	        }
	        foreach($extension_data as &$ex_da)
	        {
	            $ex_da['price_orgi'] = $ex_da['price'];
	            $ex_da['price'] = $this->currency->format($ex_da['price']);
	        }
	        $this->data['extension_data'] = $extension_data;
 			$this->data['pagination'] = $this->pagination->create_links();
			$this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
        	$this->data['license'] =  $this->general_model->get_all_license();
        	$this->data['compatibility'] =  $this->general_model->get_all_compatibility();
        	$total_extension = 0;
        	foreach($extension_category as $compa)
        	{
        		$total_extension += $compa['total_extension'];
        	}
        	$this->data['total_extension'] = $total_extension;
 			$this->data['link_sort']=$link_sort;
			$this->data['link_limit']=$link_limit;
			$this->data['link_category']=$link_category;
			$this->data['link_search']=$link_search;
			
			$banner = @reset($this->general_model->get_website_info());
			$this->data['settings'] = $banner;
			$this->data['link_license']=$link_license;
			$this->data['link_compatibility']=$link_compatibility;
			$this->data['link_type']=$link_type;
			$this->data['title']='Extension Category';
			$this->data['content']='extension_category';
			$this->load->view('templates',$this->data,'');
	}
    
   

    function success_(){
        
        $this->data['title']='Success';
		$this->data['content']='success';
		$this->load->view('templates',$this->data,'');
	}
    
    function error(){
        
        $this->data['title']='Error';
		$this->data['content']='error';
		$this->load->view('templates',$this->data,'');
	}
	function contact(){
        $this->data['title']='Contact to admin';
		$this->data['content']='contact';
		$this->load->view('templates',$this->data,'');
    }
    
    function contact_seller($id,$url_title=""){
        if($id!=null)
        {
            $detail = @reset($this->general_model->get_user_by_user_id($id));
            $this->data['user_info'] = $detail;
            $this->data['title']='Contact to '.$detail['username'];
            $this->data['content']='contact_seller';
            
            $this->load->view('templates',$this->data,'');
        }
        else
        {	
            redirect('/index', 'refresh');
        }
    }
    
	function features(){
        $this->data['title']='Features';
		$this->data['content']='Features';
		$this->load->view('templates',$this->data,'');
    }
    
	function demo(){
		$news =  @reset($this->general_model->get_article_by_type(2));
		$this->data['news'] = $news;
        $this->data['title']='Demo';
		$this->data['content']='demo';
		$this->load->view('templates',$this->data,'');
    }
    
	function download(){
		$news =  @reset($this->general_model->get_article_by_type(3));
		$this->data['news'] = $news;
        $this->data['title']='Download';
		$this->data['content']='download';
		$this->load->view('templates',$this->data,'');
    }
    
	function documentation(){
        $this->data['title']='Documentation';
		$this->data['content']='documentation';
		$this->load->view('templates',$this->data,'');
    }
    
	function support(){
        $this->data['title']='Support';
		$this->data['content']='support';
		$this->load->view('templates',$this->data,'');
    }
    
	function partner(){
		$news =  @reset($this->general_model->get_article_by_type(6));
		$this->data['news'] = $news;
        $this->data['title']='Partner';
		$this->data['content']='partner';
		$this->load->view('templates',$this->data,'');
    }
    
   function article($id=null,$url_title=""){
	$news =  @reset($this->general_model->get_article_detail($id));
	$this->data['news'] = $news;
    $this->data['title']=$news['name'];
    $this->data['content']='article';
		
	$this->load->view('templates',$this->data,'');
    }
    
    function sendemail()
    {
		$result =  @reset($this->general_model->get_email_from_setting());
        $contact_form_version='HTML';
        if(isset($_POST['emailto']))
            $my_email_address=$_POST['emailto'];
        else 
            $my_email_address=$result['email'];
        $cc='';
        $bcc='';
        $contact_form_version=strtolower($contact_form_version);
        if(empty($my_email_address) || empty($contact_form_version) || ($contact_form_version!='php' && $contact_form_version!='html')) {
            die('Error: The contact form has not been setup correctly.');
        } else {
            $formLocation='/contact';
        }
        if(!empty($_POST['isAjax']) && $_POST['isAjax']=='1') {
            $ajax=true;
        } else {
            $ajax=false;
        }
        if(empty($_POST['contactName']) || empty($_POST['contactEmail']) || empty($_POST['contactMessage'])) {
            if($ajax || $contact_form_version=='html') {
                die('Error: Missing variables');
            } else {
                header("Location: $formLocation?msg=missing-variables");
                exit;
            }
        }
        if (!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,8})$/", $_POST['contactEmail'])) {
            if($ajax || $contact_form_version=='html') {
                die('Error: Invalid email address');
            } else {
                header("Location: $formLocation?msg=invalid-email-address");
                exit;
            }
        }
        $name=$_POST['contactName'];
        $email=$_POST['contactEmail'];
        $subject=$_POST['contactSubject'];
        $message=$_POST['contactMessage'];
        ob_start();
        $this->load->view('content/email-template',$_POST);
        $body = ob_get_contents();
        ob_end_clean();
        $to=$my_email_address;
        $subject = 'Enquiry: '.$subject;
    
        /*
         * Send mail
        */
		$this->sendEmailAutomatic($result['email'],$subject,$body,$email,'html');
		$this->session->set_flashdata('message_success', "Email");
	 	redirect('/contact', 'refresh');
    }
    
	function sendEmailAutomatic($emails, $subject,$content, $from = null, $mailType = 'html')
	{
		/*
	     * Send mail
	     */
		$setting =  @reset($this->general_model->get_email_from_setting());
	
	   	$config = array(
			  	'protocol' => 'smtp',
			    'smtp_host' => $setting['smtp_host'],
			    'smtp_port' => $setting['smtp_port'],
			    'smtp_user' => $setting['smtp_username'],
			    'smtp_pass' => $setting['smtp_password'],
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1',
	   			'starttls'  => true,
            	'newline'   => "\r\n"
		);
	   	$this->load->library('email',$config);
	   	//$this->email->initialize($config);
	    try {
            $this->email->clear();
            $this->email->to($emails);
            
            if($from == NULL )
			{
				$this->email->from($setting['email']);
			}
			else
			{
				$this->email->from($from);
			}
            $this->email->subject($subject);
            $this->email->message($content);
            $this->email->send();
	    }catch (Exception $e){
	        //Do nothing
	        print_r($e);die;
	    }
	} 
	function like($id,$uid){
		

						$extension = $this->general_model->get_extension_by_extension_id($id);
						if(isset($extension[0]))
						{
							$_data['like'] = $extension[0]['like']+1;
							$this->general_model->update_extension($id,$_data);
						}
						$user_like = $this->general_model->get_user_like($uid,$id);
						
						if(count($user_like)==0)
						{
							$data = array(
							'user_id' 	=> $uid,// mac dinh
							'type' 	=> 1,
							'created_date' 	=> time(),
							'extension_id' 	=> $id
							);
							$this->general_model->insert_user_like($data);
						}
						else
						{
							redirect("/error","refesh") ;
						}

						echo json_encode(array('status'=>1));
    }
    
	function dislike($id,$uid){
		

						$extension = $this->general_model->get_extension_by_extension_id($id);
						if(isset($extension[0]))
						{
							$_data['dislike'] = $extension[0]['dislike']+1;
							$this->general_model->update_extension($id,$_data);
						}
						$user_like = $this->general_model->get_user_like($uid,$id);
						
						if(count($user_like)==0)
						{
							$data = array(
							'user_id' 	=> $uid,// mac dinh
							'type' 	=> 0,
							'created_date' 	=> time(),
							'extension_id' 	=> $id
							);
							$this->general_model->insert_user_like($data);
						}
						else
						{
							redirect("/error","refesh") ;
						}

						echo json_encode(array('status'=>1));
    }
	function admin(){
        redirect(base_url(). 'backend.php');
    }
    /*-------------------------------------------------------------------------------------*/
    
    public function add_cart() {
        $fid = $_GET['id'];
        $amount = $_GET['price'];
        $update= $_GET['update'];
        $price_type=$_GET['type'];
        
        if($fid!=0&&$amount!=0&&$update==0){ // Add
            $cart = $this->session->userdata('cart');
            if(isset($cart[$fid."-".$price_type])) $cart[$fid."-".$price_type] = $cart[$fid."-".$price_type] + $amount;
            else $cart[$fid."-".$price_type] = $amount;
            $this->session->set_userdata(array('cart'=>$cart));
        }else if($fid!=0&&$amount!=0&&$update==1){ // Update
            $cart = $this->session->userdata('cart');
            $cart[$fid."-".$price_type] = $amount;
            $this->session->set_userdata(array('cart'=>$cart));
        }else if($fid!=0&&$amount!=0&&$update==2){ // Delete
            $cart = $this->session->userdata('cart');
            unset($cart[$fid."-".$price_type]);
            $this->session->set_userdata(array('cart'=>$cart));
        }
    }
    
    public function cart() {
        
       if(isset($_POST['quantity']))
        {
            $cart = $this->session->userdata('cart');
            foreach($_POST['quantity'] as $key=>$quanti)
            {
                $cart[$key."-0"] = $quanti*$_POST['price'][$key] ;
            }
          
            $this->session->set_userdata(array('cart'=>$cart));
        }
        
        $setting = $this->general_model->get_email_from_setting();
        $this->data['des'] = $setting[0]['checkout_description'];
        $this->data['payment_method'] = $this->general_model->get_all_payment();
        $this->data['extension_category'] = $extension_category = $this->general_model->get_all_category();
        $this->data['license'] =  $this->general_model->get_all_license();
        $this->data['compatibility'] =  $this->general_model->get_all_compatibility();
        $total_extension = 0;
        foreach($extension_category as $compa)
        {
            $total_extension += $compa['total_extension'];
        }
        $this->data['total_extension'] = $total_extension;
         
        $this->data['link_category']= base_url()."category?type=thumb";
        $this->data['link_license']= base_url()."category?type=thumb";
        $this->data['link_compatibility']= base_url()."category?type=thumb";
        $this->data['link_search']= base_url()."category?type=thumb";
        $this->data['link_back'] = base_url();
        
            $data = array();
            $cart = $this->session->userdata('cart');
            $i = 0;
            if(!empty($cart)){
                foreach($cart as $key=>$row){
                    $key = explode("-", $key);
                    $meal = @reset($this->general_model->get_extension_by_extension_id($key[0]));
                    if(empty($meal)) continue;
                    $data['meals'][$i]['data'] = $meal;
                    if($key[1]==1) $data['meals'][$i]['data']['price'] = $data['meals'][$i]['data']['price_mini'];
                    $data['meals'][$i]['price_type'] = $key[1];
                    $data['meals'][$i]['amount'] = $row/$meal['price'];
                    $data['meals'][$i]['id'] =$meal['extension_id'];
                    $data['meals'][$i]['price_mini'] = $meal['price'];
                    $i++;
                }
                $this->data['meals'] = $data['meals'];
            }
           // $value['data'] = $this->autocomplete();
          //  $data['delivery'] = $this->load->view('payment/delivery',$value,true);
            $this->data['title']='Cart';
            $this->data['content']='cart';
            $this->load->view('templates',$this->data,'');
    }
    
    public function delivery() {

        if(isset($_POST['shipping_address']))
        {
            if( $_POST['shipping_address']==0)
            {
                $data = $_POST['data'];
                $data['user_id'] = $_SESSION['user']['user_id'];
                $data['created_date'] = time();
                $shipping_id = $this->general_model->insert_address($data);
            }   
            else
            {
                $shipping_id = $_POST['shipping_address'];
            } 
        }
        $shipping = null;
        if(isset($shipping_id))
        {
            $_SESSION['address_id'] = $shipping_id;
            $shipping = @reset($this->general_model->get_address_by_id($shipping_id));
        }
        $cart = $this->session->userdata('cart');
        $data = null;
        $_SESSION['orders'] = null;
        $_SESSION['order'] = null;
        $_SESSION['total_money'] = null;
        if($cart!=null){
            $order_id = time().$_SESSION['user']['user_id'];
            $total_money = 0;
            $_SESSION['orders'] = array();
            foreach($cart as $key=>$row){
                $key = explode("-", $key);
                $meal = @reset($this->general_model->get_extension_by_extension_id($key[0]));
                if($meal['shipping']==0)
                {
                    $shipping_fee = 0;
                }
                else 
                {
                    $shipping_fee = $meal['weight']*$meal['priceperweight']*$row/$meal['price'];
                }
                if(empty($meal)) continue;
                if($key[1]==1) $meal['price'] = $meal['price'];
                $data['type_price'] = $key[1];
                $data['order_date'] = date("Y-m-d",time());
                $data['client_id'] = $_SESSION['user']['user_id'];
                $data['name'] = $_SESSION['user']['username'];
                $data['phone'] = $_SESSION['user']['phone'];
                $data['amount'] = $row/$meal['price'];
                $data['cost'] = $meal['price'];
                $data['shipping_fee'] = $shipping_fee;
                $data['total'] = ($row+($meal['weight']*$meal['priceperweight']*($row/$meal['price'])));
                $data['item'] = $meal['name'];
                $data['status'] = 0;
                $data['address_id'] = isset($shipping_id)?$shipping_id:0;
                $data['order_id'] = $order_id;

                $_SESSION['orders'][] = $data;
                $_SESSION['order'] = $data;
                $total_money += $data['total'];
            }
            $_SESSION['total_money'] = $total_money;
            if(isset($shipping))
            {
                $_SESSION['shipping'] = $shipping;
            }
            if(isset($_POST['shipping']))
            {
                $_SESSION['shipping_status'] = isset($_POST['shipping'])?$_POST['shipping']:"0";
            }
            redirect(base_url()."expresscheckout.php","refesh") ;
        }
        redirect(base_url(),"refesh") ;
    }
    
    public function item(){
        $cart = $this->session->userdata('cart');
        $banner = @reset($this->general_model->get_website_info());
        $value['settings'] = $banner;
        if(!empty($cart)){
            $total_money = 0;
            foreach($cart as $key=>$row){
                
                $key = explode("-", $key);
                $meal = @reset($this->general_model->get_extension_by_extension_id($key[0]));
                if(empty($meal)) continue;
                $data['type_price'] = $key[1];
                if($key[1]==1) $meal['price'] = $meal['price'];
                $data['id'] = $key[0];
                $data['amount'] = $row/$meal['price'];
                $data['image'] = $meal['image'];
                $data['total'] = $row;
                $data['item'] = $meal['name'];
                $data['price'] = $meal['price'];
                $data['price_mini'] = $meal['price'];
                $value['info'][] = $data;
                $total_money += $data['total'];
            }
            $value['total_money'] = $total_money;
           
        }
        else{
            $value['total_money'] = 0;
            $value['info'] = array();
        }

        ob_start();
        $this->load->view('payment/item',$value);
        $body = ob_get_contents();
        ob_end_clean();
        echo $body;
        exit();
    }
    /*-------------------------------------------------------------------------------------*/
  
}


/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */