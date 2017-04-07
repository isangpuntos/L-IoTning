<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*------------------------------
  Programmer: Steven Lai
------------------------------*/

class Cpanel extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $banner = @reset($this->general_model->get_website_info());
        if($banner['auto_currency']==1)
        {
        	$this->general_model->updateCurrencies();	
        }
        $this->data['settings'] = $banner;
    }
	
	function index()
	{
		
		$_data['elist']="";
		$_data['user_data'] = $this->general_model->get_recent_user(7);
		$_data['order_data'] = $this->general_model->get_recent_order(7);
		
		$earn_today =  $this->general_model->get_total_price_by_date(mktime(0,0,0,date("m"),date("d"),date("Y")),mktime(0,0,0,date("m"),date("d")+1,date("Y")));
		if(isset($earn_today[0]))
		{
		    $_data['earn_today'] = $earn_today[0]['total_price'];
		}
		else
		{
		    $_data['earn_today'] = 0;
		}
		
		$earn_month =  $this->general_model->get_total_price_by_date(mktime(0,0,0,date("m"),1,date("Y")),mktime(0,0,0,date("m")+1,1,date("Y")));
		if(isset($earn_month[0]))
		{
		    $_data['earn_month'] = $earn_month[0]['total_price'];
		}
		else
		{
		    $_data['earn_month'] = 0;
		}
		
		$earn_year =  $this->general_model->get_total_price_by_date(mktime(0,0,0,1,1,date("Y")),mktime(0,0,0,1,1,date("Y")+1));
		if(isset($earn_year[0]))
		{
		    $_data['earn_year'] = $earn_year[0]['total_price'];
		}
		else
		{
		    $_data['earn_year'] = 0;
		}
		
		$total_view = $this->general_model->get_total_view();
		if(isset($total_view[0]))
		{
		    $_data['total_view'] = $total_view[0]['views'];
		}
		else
		{
		    $_data['total_view'] = 0;
		}
		$user_data = $this->general_model->get_recent_user(0);
		$_data['total_member'] = count($user_data);
		$data['content']=$this->load->view('content/main',$_data,true);
		$data['title'] = "home";
		$data['page'] = "home";
		$this->load->view('template',$data);
	}
	
	function backup()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (is_uploaded_file($_FILES['import']['tmp_name'])) {
				$content = file_get_contents($_FILES['import']['tmp_name']);
			} else {
				$content = false;
			}
			
			if ($content) {
				$this->general_model->restore($content);
				$this->session->set_flashdata('success', 'Restore Success');
				
				redirect('/cpanel/backup');
			} else {
				$this->session->set_flashdata('warning', 'Please Choose File');
			}
		}
		$_data['restore'] = base_url().'backend.php/cpanel/backup';
		$_data['backup'] = base_url().'backend.php/cpanel/backup_tool';
		$_data['tables'] = $this->general_model->getTables();
		
		$data['content']=$this->load->view('content/backup',$_data,true);
		$data['title'] = "backup";
		$data['page'] = "backup";
		
		$this->load->view('template',$data);
	}
	function backup_tool()
	{
		if (!isset($_POST['backup'])) {
			$this->session->set_flashdata('error', 'Backup Error');
			redirect('/cpanel/backup');
		} else
		{
			$this->output->set_header('Pragma: public');
			$this->output->set_header('Expires: 0');
			$this->output->set_header('Content-Description: File Transfer');
			$this->output->set_header('Content-Type: application/octet-stream');
			$this->output->set_header('Content-Disposition: attachment; filename=' . date('Y-m-d_H-i-s', time()).'_backup.sql');
			$this->output->set_header('Content-Transfer-Encoding: binary');
			
			$this->output->set_output($this->general_model->backup($_POST['backup']));
		} 
	}
	function chart() {
		$data = array();
		
		$data['order'] = array();
		$data['customer'] = array();
		$data['xaxis'] = array();
		

		if (isset($_GET['range'])) {
			$range = $_GET['range'];
		} else {
			$range = 'month';
		}
		
		switch ($range) {
			case 'day':

				for ($i = 0; $i < 24; $i++) {
					$query = $this->db->query("SELECT COUNT(*) AS total FROM `order` WHERE (DATE(added_date) = DATE(NOW()) AND HOUR(added_date) = '" . (int)$i . "') GROUP BY HOUR(added_date) ORDER BY added_date ASC");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['order']['data'][]  = array($i, (int)$query_data[0]['total']);
					} else {
						$data['order']['data'][]  = array($i, 0);
					}
					
					$query = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE DATE(added_date) = DATE(NOW()) AND HOUR(added_date) = '" . (int)$i . "' GROUP BY HOUR(added_date) ORDER BY added_date ASC");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}
			
					$data['xaxis'][] = array($i, date('H', mktime($i, 0, 0, date('n'), date('j'), date('Y'))));
				}
							
				break;
			case 'week':
				$this->db->trans_start(); 
				
				$date_start = strtotime('-' . date('w') . ' days'); 
				
				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));

					$query = $this->db->query("SELECT COUNT(*) AS total FROM `order` WHERE DATE(added_date) = " . $this->db->escape($date) . " GROUP BY DATE(added_date)");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}
				
					$query = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE DATE(added_date) = " . $this->db->escape($date) . " GROUP BY DATE(added_date)");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}
		
					$data['xaxis'][] = array($i, date('D', strtotime($date)));
				}
				$this->db->trans_complete();	
				break;
			default:
			case 'month':
				$this->db->trans_start(); 
				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;
					
					$query = $this->db->query("SELECT COUNT(*) AS total FROM `order` WHERE DATE(added_date) = " . $this->db->escape($date) . " GROUP BY DAY(added_date)");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}	
				
					$query = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE DATE(added_date) = " . $this->db->escape($date) . " GROUP BY DAY(added_date)");
					$query_data = $query->result_array();
					if ($query->num_rows) {
						$data['customer']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}	
					
					$data['xaxis'][] = array($i, date('j', strtotime($date)));
				}
				$this->db->trans_complete();	
				break;
			case 'year':
				$this->db->trans_start(); 
				for ($i = 1; $i <= 12; $i++) {
					$query = $this->db->query("SELECT COUNT(*) AS total FROM `order` WHERE  YEAR(added_date) = \"" . date('Y') . "\" AND MONTH(added_date) = '" . $i . "' GROUP BY MONTH(added_date)");
					$query_data = $query->result_array();
					
					if ($query->num_rows) {
						$data['order']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['order']['data'][] = array($i, 0);
					}
					$query = $this->db->query("SELECT COUNT(*) AS total FROM users WHERE YEAR(added_date) = \"" . date('Y') . "\" AND MONTH(added_date) = '" . $i . "' GROUP BY MONTH(added_date)");
					$query_data = $query->result_array();
					if ($query->num_rows) { 
						$data['customer']['data'][] = array($i, (int)$query_data[0]['total']);
					} else {
						$data['customer']['data'][] = array($i, 0);
					}
					
					$data['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i, 1, date('Y'))));
				}		
				$this->db->trans_complete();		
				break;	
		} 
		
		echo(json_encode($data));
	}
/*-----------------------------------------------------------------------*/
	function members()
	{
		if(isset($_GET['type']) && $_GET['type']=="approve")
			$result=$this->general_model->get_all_inactive_user($this->session->userdata['user_id']);	
		else
			$result=$this->general_model->get_all_active_user($this->session->userdata['user_id']);
				
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;	
		$data['content']=$this->load->view('content/usermanager',$data,true);
		$data['title'] = "members";
		$data['page'] = "members";
		$this->load->view('template',$data);	
	}
	function deleteuser($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('users', array('user_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() == FALSE)
		{
			$this->session->set_flashdata('message_error', 'Deleted Member error. Please try later');
		}
		else
		{
			$this->session->set_flashdata('message', 'Deleted Member');
		} 
		}
		redirect("/cpanel/members/");
	}

	function edituser($id='')
	{
		
		if(isset($_POST['username']) && $_POST['username'] )
		{
			if ($this->session->userdata['group']==1) {
			$error = 0;
			if($this->general_model->check_exist_username($_POST['username'],$_POST['currentid'])==true)
			{
				$data['user_error'] = 'Username is already taken';
				$error = 1;
				
			}
			if($this->general_model->check_exist_email($_POST['email'],$_POST['currentid'])==true)
			{
				$data['email_error'] = 'Email is already taken';
				$error = 1;
				
			}
			if($error==0)
			{
				if ($this->general_model->user_manipulate($_POST))
				{
					$this->session->set_flashdata('message', 'Updated User');	  	
				}
				else
				{ 
					$this->session->set_flashdata('message', 'Updated User error. Please try later');
				}
				redirect("/cpanel/members/");
			}
			else
			{
				$data['banners'] = $_POST;
				$data['id']=$_POST['currentid'];
				
				
				
				$data['city_data'] = $this->general_model->get_city_by_region_id($_POST['region_id']);
				$data['region_data'] = $this->general_model->get_region_by_country_id($_POST['country_id']);
	 			$data['country_data'] = $this->general_model->get_all_country();	
			}
			}
		}
		else
		{
			if($id!='')
			{
				$data['id']=$id; // update
				$result=$this->general_model->get_user_by_user_id($id);
					
				$_data=array();
				if($result->num_rows()>0)
				{
					$_data=$result->result_array();
				}
				if($_data!=null)
					$data['banners']=$_data[0];	
				if(isset($_data[0]['city_id']))
				$country_region =  $this->general_model->get_city_detail($_data[0]['city_id']);
				if(isset($country_region[0]['region_id']))
				$data['city_data'] = $this->general_model->get_city_by_region_id($country_region[0]['region_id']);
				if(isset($country_region[0]['country_id']))
				$data['region_data'] = $this->general_model->get_region_by_country_id($country_region[0]['country_id']);
				
	 			$data['country_data'] = $this->general_model->get_all_country();
			}
			else
			{
				$data['id']=''; // add new
				$data['city_data'] = $this->general_model->get_all_city();
				$data['region_data'] = $this->general_model->get_all_region();
	 			$data['country_data'] = $this->general_model->get_all_country();	
				
			}
		}
	 	
		$_data=array();
		$result=$this->general_model->get_allgroup();	
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['category']=$_data;	
	 	
	 	$data['payment_method'] = $this->general_model->get_all_payment();
		$data['action'] = base_url()."backend.php/cpanel/edituser/".$id;
		$data['title'] = "edituser";
		$data['page'] = "members";
		$data['content']=$this->load->view('content/edituser',$data,true);
		$this->load->view('template',$data);
	}
/*-----------------------------------------------------------------------*/
	
	function getcity()
	{
    	$name = $this->input->post('name');
    	if( $name ) {
        $data = $this->general_model->get_list_city_by_country_public($name);
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

/*-------------------------------------------------------------------------*/
	
	function editcategory($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_category_detail($id);	

			$data['banners']=$result[0];
			
		}
		else
		{
			$data['id']='';
		}
		
		$data['title'] = "category";
		$data['page'] = "category";
		$data['content']=$this->load->view('content/editcategory',$data,true);
		$this->load->view('template',$data);
	}

	function editcategoryproperty($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_category_property_by_category_id($id,null);	
			$data['banners']=$result;
		}
		else
		{
			redirect("/cpanel/category/");
		}
		$data['title'] = "category";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editcategoryproperty',$data,true);
		$this->load->view('template',$data);
	}
	
	function extensionsetting()
	{
		$result=$this->general_model->get_category_property_extension();	
		$data['banners']=$result;
		$data['title'] = "extensionsetting";
		$data['page'] = "formsetting";
		$data['content']=$this->load->view('content/extensionsetting',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function category_manipulate()
	{
		if ($this->session->userdata['group']==1) {
			if(isset($_POST['type']) && $_POST['type']=="property")
			{
				if ($this->general_model->category_property_manipulate($_POST))
				{
					if($_POST['currentid'] ==0)
						$this->session->set_flashdata('message', 'Updated Extension Form');
					else
						$this->session->set_flashdata('message', 'Updated Category');
				}
				else
				{
					if($_POST['currentid'] ==0)
						$this->session->set_flashdata('message', 'Updated Extension Form error. Please try later');
					else
						$this->session->set_flashdata('message', 'Updated Category error. Please try later');
				}
			}
			else if (isset($_POST['type']) && $_POST['type']=="signup")
			{
				if ($this->general_model->category_property_manipulate($_POST))
				{
					$this->session->set_flashdata('message', 'Updated Signup Form');
				}
				else
				{
					$this->session->set_flashdata('message', 'Updated Signup Form error. Please try later');
				}	
			
			}
			else
			{
				if($this->general_model->check_exist_category($_POST['category_name'],$_POST['currentid'])==true)
				{
					$this->session->set_flashdata('message_error', 'Category Name is already taken');
					redirect("/cpanel/editcategory/".$_POST['currentid']);
				}
				
				if ($this->general_model->category_manipulate($_POST))
				{
					if($_POST['currentid'] ==0)
						$this->session->set_flashdata('message', 'Updated Extension Form');
					else
						$this->session->set_flashdata('message', 'Updated Category');
				}
				else
				{
					if($_POST['currentid'] ==0)
						$this->session->set_flashdata('message', 'Updated Extension Form error. Please try later');
					else
						$this->session->set_flashdata('message', 'Updated Category error. Please try later');
				}
			}
		}
		if(isset($_POST['type']) && $_POST['type'] =="signup")
		{
			redirect("/cpanel/signup_setting/");
		}
		else 
		{
			
			if($_POST['currentid']=="0")
			{
				redirect("/cpanel/extensionsetting/");
			}
			else
			{
				redirect("/cpanel/category/");
			}
		}
	}
	
	function category()
	{
		$result=$this->general_model->get_all_category();	
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/category',$data,true);
		$data['title'] = "category";
		$data['page'] = "category";
		$this->load->view('template',$data);	
	}
	
	function deletecategory($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('category', array('category_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Category');
		}
		redirect("/cpanel/category/");
		
	}
	
/*--------------------- Start Country Management ---------------------------*/
	function editcountry($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_country_detail($id);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			if(isset($_data[0]) && $_data[0] !="")
				$data['banners']=$_data[0];
			else
				$data['banners']=null;
		}
		else
		{
			$data['id']='';
		}
		$data['title'] = "country";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editcountry',$data,true);
		$this->load->view('template',$data);
	}
	// ADD or UPDATE ACTION
	function country_manipulate()
	{
		if ($this->session->userdata['group']==1 && $_POST['country_name']) {
			if($this->general_model->check_exist_country($_POST['country_name'],$_POST['currentid'])==true)
			{
				$this->session->set_flashdata('message_error', 'Country Name is already taken');
				redirect("/cpanel/editcountry/".$_POST['currentid']);
			}
			
			if ($this->general_model->country_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated Country');	    	
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Updated Country error. Please try later');
			}
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Updated Country error. Please try again');
		}
		redirect("/cpanel/country/");
	}
	
	function country()
	{
		$result=$this->general_model->get_all_country();	
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/countrymanager',$data,true);
		$data['title'] = "country";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function deletecountry($id=0)
	{
		if ($this->session->userdata['group']==1) {
			$this->db->trans_start(); 
			$this->db->delete('country', array('country_id' => $id));
			$this->db->trans_complete();
			$this->session->set_flashdata('message', 'Deleted Country');
		}
			redirect("/cpanel/country/");
		
	}
/*--------------------- End Country Management ---------------------------*/


/*--------------------- Start Region Management ---------------------------*/
	
	function editregion($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_region_detail($id);	
			if(isset($result[0]) && $result[0] != null)
				$data['banners']=$result[0];
			else
				$data['banners']=null;
		}
		else
		{
			$data['id']='';
		}
		
		$category = $this->general_model->get_all_country_by_public();	
		$_data=array();
		if($category->num_rows()>0)
		{
			$_data=$category->result_array();
		}
		$data['country']=$_data;
		$data['title'] = "region";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editregion',$data,true);
		$this->load->view('template',$data);
	}
	// ADD or UPDATE ACTION
	function region_manipulate()
	{
		if ($this->session->userdata['group']==1 && $_POST['region_name']!="" && $_POST['country_id'] !="") {
			if($this->general_model->check_exist_region($_POST['region_name'],$_POST['currentid'],$_POST['country_id'])==true)
			{
				$this->session->set_flashdata('message_error', 'Region Name is already taken');
				redirect("/cpanel/editregion/".$_POST['currentid']);
			}
			
			if ($this->general_model->region_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated Region');	    	
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Updated Region error. Please try later');
			}
		}
		else
		{
				$this->session->set_flashdata('message_error', 'Updated Region error. Please try again');
		}
		redirect("/cpanel/region/");
	}
	
	function region()
	{
		$result=$this->general_model->get_all_region();	
			
		$data['banners']=$result;

		$data['content']=$this->load->view('content/regionmanager',$data,true);
		$data['title'] = "region";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function deleteregion($id=0)
	{
		if ($this->session->userdata['group']==1) {
			$this->db->trans_start(); 
			$this->db->delete('region', array('region_id' => $id));
			$this->db->trans_complete();
			$this->session->set_flashdata('message', 'Deleted City');
		}
		redirect("/cpanel/region/");
	}
	
/*--------------------- End Region Management ---------------------------*/	
	
/*--------------------- Start City Management ---------------------------*/
	
	function editcity($id='')
	{
		notAdminRedirect($this->session->userdata);
		
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_city_detail($id);	
			if(isset($result[0]) && $result[0] != null)
			{
				$data['banners'] = $result[0];
				$data['region'] = $this->general_model->get_region_by_country_id($result[0]['country_id']);
			}
			else
			{
				$data['banners'] = null;
				$data['region'] = null;
			}
		}
		else
		{
			$data['id']='';
			$data['region'] = $this->general_model->get_all_region();
		}
		$data['country'] = $this->general_model->get_all_country();	
		$category = $this->general_model->get_all_country_by_public();	
		$_data=array();
		if($category->num_rows()>0)
		{
			$_data=$category->result_array();
		}
		$data['country']=$_data;
		
		$data['title'] = "city";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editcity',$data,true);
		$this->load->view('template',$data);
	}
	// ADD or UPDATE ACTION
	function city_manipulate()
	{
		if ($this->session->userdata['group']==1 && $_POST['city_name']!="" && $_POST['region_id']!="" && $_POST['country_id']!="") {
			if($this->general_model->check_exist_city($_POST['city_name'],$_POST['currentid'],$_POST['region_id'])==true)
			{
				$this->session->set_flashdata('message_error', 'City Name is already taken');
				redirect("/cpanel/editcity/".$_POST['currentid']);
			}
			
			if ($this->general_model->city_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated City');	    	
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Updated City error. Please try later');
			}
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Updated City error. Please try again');
		}
		redirect("/cpanel/city/");
	}
	
	function city()
	{

		$result=$this->general_model->get_all_city();	
		$data['banners']=$result;

		$data['content']=$this->load->view('content/citymanager',$data,true);
		$data['title'] = "city";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function deletecity($id=0)
	{
		if ($this->session->userdata['group']==1) {
			$this->db->trans_start(); 
			$this->db->delete('city', array('city_id' => $id));
			$this->db->trans_complete();
			$this->session->set_flashdata('message', 'Deleted City');
		}
		redirect("/cpanel/city/");
	}
	
/*--------------------- End City Management ---------------------------*/	

/*-------------------------------------------------------------------------*/
	
	function editcompatibility($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_compatibility_detail($id);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			if(isset($_data[0]) && $_data[0] !="")
				$data['banners']=$_data[0];
			else
				$data['banners']=null;
		}
		else
		{
			$data['id']='';
		}
		
		$data['title'] = "compatibility";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editcompatibility',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function compatibility_manipulate()
	{
		if ($this->session->userdata['group']==1) {
			if($this->general_model->check_exist_compatibility($_POST['compatibility_name'],$_POST['currentid'])==true)
			{
				$this->session->set_flashdata('message_error', 'Compatibility Name is already taken');
				redirect("/cpanel/editcompatibility/".$_POST['currentid']);
			}
			
			if ($this->general_model->compatibility_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated Compatibility');	    	
			}
			else
			{
				$this->session->set_flashdata('message', 'Updated Compatibility error. Please try later');
			}
		}
		redirect("/cpanel/compatibility/");
	}
	
	function compatibility()
	{
		$result=$this->general_model->get_all_compatibility();	
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/compatibility',$data,true);
		$data['title'] = "compatibility";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function deletecompatibility($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('compatibility', array('compatibility_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Compatibility');
		}
		redirect("/cpanel/compatibility/");
	}
	
/*----------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------*/
	
	function editextension($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_extension_detail($id);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			if(isset($_data[0]) && $_data[0] !="")
				$data['banners']=$_data[0];
			else
				$data['banners']=null;

				$property_data = $this->general_model->get_category_property_by_category_id($_data[0]['category_id'],$id);
				if(count($property_data)>0)
				{
					$data['property_data'] = $property_data;
				}
				else
				{
					$data['property_data'] = $this->general_model->get_category_property_by_category_id($_data[0]['category_id'],null);
				}
				
				$data['property_data_default'] = $this->general_model->get_category_property_default_by_category_id();
				foreach($data['property_data_default'] as &$da)
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
			$data['id']='';
			$data['property_data'] = $this->general_model->get_category_property_by_category_id(1,null);
			$data['property_data_default'] = $this->general_model->get_category_property_default_by_category_id();	
		}
		$banner = @reset($this->general_model->get_website_info());
		$data['settings'] = $banner;
		$data['extension_category'] =  $this->general_model->get_all_category();
        $data['license'] =  $this->general_model->get_all_license();
        $result =  $this->general_model->get_all_active_user(null);
        $_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['user_data']=$_data;	
		
		
		$data['title'] = "extension";
		$data['page'] = "extension";
		$data['content']=$this->load->view('content/editextension',$data,true);
		$this->load->view('template',$data);
	}
	
	function editextensionImage($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			if($this->general_model->check_exist_id_extension($id)==true)
			{
				$result=$this->general_model->get_photo_extension($id);	
				$_data1=array();
				if($result->num_rows()>0)
				{
					$_data1=$result->result_array();
				}
				if(isset($_data1) && $_data1 !=null)
				{
					$data['allIMG'] = $_data1;
					$data['totalIMG'] = count($_data1);
				}	
				else
				{
					$data['allIMG'] = null;
					$data['totalIMG'] = 0;
				}
				$banner = @reset($this->general_model->get_website_info());
				$data['settings'] = $banner;
			}	
			else
			{
				$this->session->set_flashdata('message_error', 'Extension not exist. Please try later');
				redirect("/cpanel/extensions/");
			}
			
			
		}
		else
		{
			redirect("/cpanel/extensions/");
		}
		
		$data['title'] = "editextensionImage";
		$data['page'] = "extension";
		$data['content']=$this->load->view('content/editextensionImage',$data,true);
		$this->load->view('template',$data);
	}
	
	function slideshow()
	{
			
				$result=$this->general_model->get_photo_slideshow(9999);	
				$_data1=array();
				if($result->num_rows()>0)
				{
					$_data1=$result->result_array();
				}
				if(isset($_data1) && $_data1 !=null)
				{
					$data['allIMG'] = $_data1;
					$data['totalIMG'] = count($_data1);
				}	
				else
				{
					$data['allIMG'] = null;
					$data['totalIMG'] = 0;
				}
				$banner = @reset($this->general_model->get_website_info());
				$data['settings'] = $banner;

		$data['title'] = "slideshow";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/slideshow',$data,true);
		$this->load->view('template',$data);
	}
	

	function editextensionDownload($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			if($this->general_model->check_exist_id_extension($id)==true)
			{
				 $extension_download =  $this->general_model->get_extension_download_by_id($id);
 				 foreach($extension_download as &$download)
 				 {
 				 	$download['list_com'] = unserialize($download['list_com']);
 				 }
 				$data['extension_download'] = $extension_download;
 				$data['compatibility'] =  $this->general_model->get_all_compatibility();
 				
			}	
			else
			{
				$this->session->set_flashdata('message_error', 'Extension not exist. Please try later');
				redirect("/cpanel/extensions/");
			}
			
			
		}
		else
		{
			redirect("/cpanel/extensions/");
		}
		
		$data['title'] = "editdownload";
		$data['page'] = "extension";
		$data['content']=$this->load->view('content/editextensionDownload',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function extension_manipulate()
	{
//			if($this->general_model->check_exist_extension($_POST['extension_name'],$_POST['currentid'])==true)
//			{
//				$this->session->set_flashdata('message_error', 'Extension Name is already taken');
//				redirect("/cpanel/editextension/".$_POST['currentid']);
//			}
		if ($this->session->userdata['group']==1) {
			if(isset($_POST['type']) && $_POST['type']=="images")
			{
				if(isset($_POST['extension_image'])){
	        		$image = $_POST['extension_image'];
	        		$reference_id = $_POST['currentid'];
	        		if(isset($_POST['currentid']) && $_POST['currentid']!=0)
	        		{
	        			$this->db->trans_start(); 
						$this->db->delete('gallery', array('reference_id' => $_POST['currentid'],'type'=>1));
						$this->db->trans_complete();	
						
						foreach($image as $key=>&$img)
						{
							$img['reference_id'] = $reference_id;
							$img['type'] = 1;
							$this->general_model->insert_extension_image($img);
						}
	
	        		}
					
					$this->session->set_flashdata('message', 'Updated Image Extension');	    	
				}
				else
				{
					$this->session->set_flashdata('message_error', 'Updated Image Extension error. Please try later');
				}
			}
			else if(isset($_POST['type']) && $_POST['type']=="slideshow")
			{
				if(isset($_POST['extension_image'])){
	        		$image = $_POST['extension_image'];
	        		$reference_id = $_POST['currentid'];
	        		if(isset($_POST['currentid']) && $_POST['currentid']!=0)
	        		{
	        			$this->db->trans_start(); 
						$this->db->delete('gallery', array('reference_id' => $_POST['currentid'],'type'=>2));
						$this->db->trans_complete();	
						
						foreach($image as $key=>&$img)
						{
							$img['reference_id'] = $reference_id;
							$img['type'] = 2;
							$this->general_model->insert_extension_image($img);
						}
	
	        		}
					
					$this->session->set_flashdata('message', 'Updated Image Slideshow');	    	
				}
				else
				{
					$this->session->set_flashdata('message_error', 'Updated Image Slideshow error. Please try later');
				}
				redirect("/cpanel/slideshow/");
			}
			else if (isset($_POST['type']) && $_POST['type']=="download")
			{
				if(isset($_POST['extension_download'])){
	        		$download = $_POST['extension_download'];
	        		if(isset($_POST['currentid']) && $_POST['currentid']!=0)
	        		{
	        			$this->db->trans_start(); 
						$this->db->delete('downloads', array('extension_id' => $_POST['currentid']));
						$this->db->trans_complete();	
	        			$extension_id = $_POST['currentid'];
	        			
		        		foreach($download as $key=>&$load)
		        		{
		        			$load['downloads'] = 0;
		        			$load['extension_id'] = $extension_id;
		        			$load['created_date'] = time();
		        			if(isset($load['list_com']))
		        				$load['list_com'] = serialize($load['list_com']);
		        			 
		        			$this->general_model->insert_extension_download($load);
		        		}
	        		}
	        		 
					$this->session->set_flashdata('message', 'Updated Download of Extension');	   
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Updated Download of Extension error. Please try later');
	        	}
			}

			else
			{
			
				if ($this->general_model->extension_manipulate($_POST))
				{
					$this->session->set_flashdata('message', 'Updated Extension');	    	
				}
				else
				{
					$this->session->set_flashdata('message', 'Updated Extension error. Please try later');
				}
			}
		}
		redirect("/cpanel/extensions/");
	}
	
	function extensions()
	{
		$result=$this->general_model->get_all_extension();		
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;	
		$data['content']=$this->load->view('content/extensions',$data,true);
		$data['title'] = "extension";
		$data['page'] = "extension";
		$this->load->view('template',$data);	
	}
	
	
	
	function deleteextension($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$result=$this->general_model->get_extension_detail($id);	
		if($result->num_rows()>0)
		{
			$_data1=$result->result_array();
		}
		$this->db->delete('extensions', array('extension_id' => $id));
		$this->db->delete('extension_property', array('extension_id' => $id));
		$this->db->delete('gallery', array('reference_id' => $id,'type'=>1));
		$this->db->delete('downloads', array('extension_id' => $id));
		
		if(isset($_data1[0]['category_id']))
		{
			$category = $this->general_model->get_category_by_category_id($_data1[0]['category_id']);
			$_data['total_extension'] = $category[0]['total_extension']-1;
			$this->general_model->update_total_extension_category($_data1[0]['category_id'],$_data);
		}
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Extension');
		}
		redirect("/cpanel/extensions/");
	}
	
	/*-------------------------------------------------------------------------*/
	
	function editlicense($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_license_detail($id);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			if(isset($_data[0]) && $_data[0] !="")
				$data['banners']=$_data[0];
			else
				$data['banners']=null;
		}
		else
		{
			$data['id']='';
		}
		
		$data['title'] = "license";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editlicense',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function license_manipulate()
	{
		if ($this->session->userdata['group']==1) {
			if($this->general_model->check_exist_license($_POST['license_name'],$_POST['currentid'])==true)
			{
				$this->session->set_flashdata('message_error', 'Compatibility Name is already taken');
				redirect("/cpanel/editlicense/".$_POST['currentid']);
			}
			
			if ($this->general_model->license_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated License');	    	
			}
			else
			{
				$this->session->set_flashdata('message', 'Updated License error. Please try later');
			}
		}
		redirect("/cpanel/license/");
	}
	
	function license()
	{
		$result=$this->general_model->get_all_license();
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/license',$data,true);
		$data['title'] = "license";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function deletelicense($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('license', array('license_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted License');
		}
		redirect("/cpanel/license/");
	}
	
/*----------------------------------------------------------------------------------*/
	
/*-------------------------------------------------------------------------*/
	

	
	function order()
	{
		$result=$this->general_model->get_all_order(null,null);
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/order',$data,true);
		$data['title'] = "order";
		$data['page'] = "order";
		$this->load->view('template',$data);	
	}
	function order_total_earn()
	{
		$result=$this->general_model->get_total_earning();
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/order_total_earn',$data,true);
		$data['title'] = "order";
		$data['page'] = "order";
		$this->load->view('template',$data);	
	}
	
	function deleteorder($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('order', array('order_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted order');
		}
		redirect("/cpanel/order/");
	}
	
/*----------------------------------------------------------------------------------*/
	function admin_profile()
	{
		$id =  $this->session->userdata('user_id');
		if(isset($_POST['username']) && $_POST['username'] )
		{
			if ($this->session->userdata['group']==1) {
			$error = 0;
			if($this->general_model->check_exist_username($_POST['username'],$_POST['currentid'])==true)
			{
				$data['user_error'] = 'Username is already taken';
				$error = 1;
				
			}
			if($this->general_model->check_exist_email($_POST['email'],$_POST['currentid'])==true)
			{
				$data['email_error'] = 'Email is already taken';
				$error = 1;
				
			}
			if($error==0)
			{
				if ($this->general_model->user_manipulate($_POST))
				{
					$this->session->set_flashdata('message', 'Updated User');	  	
				}
				else
				{ 
					$this->session->set_flashdata('message', 'Updated User error. Please try later');
				}
				if(isset($_POST['type']) && $_POST['type']=="profile")
				{
					$this->session->set_flashdata('message', 'Updated Profile');
					redirect("cpanel/admin_profile/".$this->session->userdata('user_id'));
				}
				else
					redirect("/cpanel/members/");
			}
			else
			{
				$data['banners'] = $_POST;
				$data['id']=$_POST['currentid'];
				
				$data['city_data'] = $this->general_model->get_city_by_region_id($_POST['region_id']);
				$data['region_data'] = $this->general_model->get_region_by_country_id($_POST['country_id']);
	 			$data['country_data'] = $this->general_model->get_all_country();	
			}
			}
			
		}
		else
		{
			if($id!='')
			{
				$data['id']=$id; // update
				$result=$this->general_model->get_user_by_user_id($id);
				$_data=array();
				if($result->num_rows()>0)
				{
					$_data=$result->result_array();
				}
				if($_data!=null)
					$data['banners']=$_data[0];	
					
				if(isset($_data[0]['city_id']))
				$country_region =  $this->general_model->get_city_detail($_data[0]['city_id']);
				if(isset($country_region[0]['region_id']))
				$data['city_data'] = $this->general_model->get_city_by_region_id($country_region[0]['region_id']);
				if(isset($country_region[0]['country_id']))
				$data['region_data'] = $this->general_model->get_region_by_country_id($country_region[0]['country_id']);
				
	 			$data['country_data'] = $this->general_model->get_all_country();
			}
			else
			{
				$data['id']=''; // add new
				$data['city_data'] = $this->general_model->get_all_city();
				$data['region_data'] = $this->general_model->get_all_region();
	 			$data['country_data'] = $this->general_model->get_all_country();	
				
			}
		}
		
		$banner = @reset($this->general_model->get_website_info());
		$data['settings'] = $banner;
	 	$data['payment_method'] = $this->general_model->get_all_payment();
		$data['action'] = base_url()."backend.php/cpanel/admin_profile/".$id;
		$data['title'] = "profile";
		$data['page'] = "setting";
		$data['content']=$this->load->view('content/admin_profile',$data,true);
		$this->load->view('template',$data);
	}	
	
	function admin_password(){
 		if($this->session->userdata('logged_in_status'))
 		{
 			if(isset($_POST['data'])){
 				if ($this->session->userdata['group']==1) {
	            $data = $_POST['data'];
	            $data['password'] = md5($data['password']);
	            $this->session->set_flashdata('message', "Your password has been updated successfully!");
	            unset($data['confirm']);
	            $this->general_model->edit_user($this->session->userdata('user_id'),$data);
 				}
	            redirect('cpanel/admin_password', 'refresh');
        	}
	 		$this->data['title']='Change password';
	 		$this->data['page']='setting';
			$this->data['content']=$this->load->view('content/admin_password',$this->data,true);
			$this->load->view('template',$this->data,'');
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function admin_setting(){
 		if($this->session->userdata('logged_in_status'))
 		{
 			if(isset($_POST['data'])){
 				if ($this->session->userdata['group']==1) {
	            $data = $_POST['data'];
	            $this->session->set_flashdata('message', "Your Setting has been updated successfully!");
	            $this->general_model->edit_setting($this->session->userdata('user_id'),$data);
 				}
	            redirect('cpanel/admin_setting', 'refresh');
        	}
        	$banner = $this->general_model->get_website_info();
        	$this->data['banners'] = $banner[0];	
        	$this->data['country_data'] = $this->general_model->get_all_country();	
	 		$this->data['title']='setting';
	 		$this->data['page']='setting';
			$this->data['content']=$this->load->view('content/admin_setting',$this->data,true);
			$this->load->view('template',$this->data,'');
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function email_setting(){
		if($this->session->userdata('logged_in_status'))
		{
			if(isset($_POST['data'])){
				if ($this->session->userdata['group']==1) {
				$data = $_POST['data'];
				$this->session->set_flashdata('message', "Your Email Setting has been updated successfully!");
				$this->general_model->edit_setting($this->session->userdata('user_id'),$data);
				}
				redirect('cpanel/email_setting', 'refresh');
			}
			$banner = $this->general_model->get_website_info();
			$this->data['banners'] = $banner[0];
			$this->data['title']='setting';
			$this->data['page']='setting';
			$this->data['content']=$this->load->view('content/email_setting',$this->data,true);
			$this->load->view('template',$this->data,'');
		}
		else
		{
			redirect('/admin', 'refresh');
		}
	}
	
	function paypal_setting(){
 		if($this->session->userdata('logged_in_status'))
 		{
 			if(isset($_POST['data'])){
 				if ($this->session->userdata['group']==1) {
	            $data = $_POST['data'];
	            $this->session->set_flashdata('message', "Your Paypal Setting has been updated successfully!");
	            $this->general_model->edit_setting($this->session->userdata('user_id'),$data);
 				}
	            redirect('cpanel/paypal_setting', 'refresh');
        	}
        	$banner = $this->general_model->get_website_info();
        	$this->data['banners'] = $banner[0];	
	 		$this->data['title']='paypalsetting';
	 		$this->data['page']='paymentgateway';
			$this->data['content']=$this->load->view('content/paypal_setting',$this->data,true);
			$this->load->view('template',$this->data,'');
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function signup_setting(){

 		if($this->session->userdata('logged_in_status'))
 		{
 			if(isset($_POST['data'])){
 				if ($this->session->userdata['group']==1) {
	            $data = $_POST['data'];
	            $this->session->set_flashdata('message', "Your Signup Form Setting has been updated successfully!");
	            $this->general_model->edit_setting($this->session->userdata('user_id'),$data);
 				}
	            redirect('cpanel/signup_setting', 'refresh');
        	}
        	
        	$result=$this->general_model->get_category_property_by_category_id(-1,null);	
			$this->data['banners']=$result;
	 		$this->data['title']='signupsetting';
	 		$this->data['page']='formsetting';
			$this->data['content']=$this->load->view('content/signup_setting',$this->data,true);
			$this->load->view('template',$this->data,'');
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function download_setting(){
 		if($this->session->userdata('logged_in_status'))
 		{
 			if(isset($_POST['data'])){
 				if ($this->session->userdata['group']==1) {
	            $data = $_POST['data'];
	            $this->session->set_flashdata('message', "Your Download Setting has been updated successfully!");
	            $this->general_model->edit_setting($this->session->userdata('user_id'),$data);
 				}
	            redirect('cpanel/download_setting', 'refresh');
        	}
        	$banner = $this->general_model->get_website_info();
        	$this->data['banners'] = $banner[0];	
	 		$this->data['title']='downloadsetting';
	 		$this->data['page']='downloadsetting';
			$this->data['content']=$this->load->view('content/download_setting',$this->data,true);
			$this->load->view('template',$this->data,'');
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function admin_commission()
	{
		if($this->session->userdata('logged_in_status'))
 		{
	 		if(isset($_POST['commission_to_all'])){
	 			if ($this->session->userdata['group']==1) {
		       $commission_to_all = $_POST['commission_to_all'];
		      
		        if(is_numeric($commission_to_all))
		        {
			       $result=$this->general_model->get_all_not_commission(null,null);
			       $data['commission'] = $commission_to_all;	
			       $this->general_model->edit_setting_setting(1,$data);
			       foreach($result as $re)
			       {
			       	   $data = null;
			       	   
				       $data['total_balance'] = $re['total_price'] - ($re['total_price']*$commission_to_all/100);
				       $data['commission'] = $commission_to_all;		
			       	   $this->general_model->edit_commission_setting($re['order_id'],$data);
			       }
			       $this->session->set_flashdata('message', "Your Commission Setting has been updated successfully!");
			       redirect('cpanel/admin_commission', 'refresh');
		       }
		       else
		       {
		       		$this->session->set_flashdata('message_error', "Commission must be numberic, please!");
				    redirect('cpanel/commission_setting', 'refresh');
		       }
	 		  }
	 		  redirect('cpanel/admin_commission', 'refresh');
	        }
        	$result=$this->general_model->get_all_purchase_order(null,null);
        	$website_info=$this->general_model->get_website_info();
        	if(count($website_info) > 0)
        	$this->data['commission'] = $website_info[0]['commission'];
			$this->data['banners']=$result;	
	 		$this->data['title']='commission';
	 		$this->data['page']='setting';
			$this->data['content']=$this->load->view('content/admin_commission',$this->data,true);
			$this->load->view('template',$this->data,'');
			
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function editcommission($id='')
	{
		if(isset($_POST['commission'])){
			if ($this->session->userdata['group']==1) {
	       $data['commission'] = $_POST['commission'];
	       if(is_numeric($_POST['commission']))
	       $data['total_balance'] = $_POST['total_price'] - ($_POST['total_price']*$_POST['commission']/100);
	       else
	       {
	       	  $this->session->set_flashdata('message_error', "Updating error. Please try again later!");
	       	  redirect('cpanel/admin_setting', 'refresh');
	       }
	       $this->general_model->edit_commission_setting($_POST['currentid'],$data);
	        $this->session->set_flashdata('message', "Your Commission Setting has been updated successfully!");
			}
	       redirect('cpanel/admin_commission', 'refresh');
        }
		if($id!='')
		{
			$data['id']=$id; // update
			$data['banners']= @reset($this->general_model->get_order_detail($id));	
		}
		else
		{
			$data['id']='';
		}
		
		$data['title'] = "commission";
		$data['page'] = "setting";
		$data['content']=$this->load->view('content/editcommission',$data,true);
		$this->load->view('template',$data);
	}
	
	function payment_release()
	{
		if($this->session->userdata('logged_in_status'))
 		{
			$SandboxFlag = false;
        	$result=$this->general_model->get_all_purchase_release();
        	
	 		if ($SandboxFlag == true) {
	    		$this->data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
	  		} else {
				$this->data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}
			$this->data['banners']=$result;	
	 		$this->data['title']='commission';
	 		$this->data['page']='paymentrelease';
			$this->data['content']=$this->load->view('content/payment_release',$this->data,true);
			$this->load->view('template',$this->data,'');
			
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	function release($id)
	{
		if($this->session->userdata('logged_in_status'))
 		{
 		if($id!=""){
	      
	       $result=$this->general_model->get_all_purchase_release_user_id($id);
	       foreach($result as $res)
	       {
	       		$data['payment_release'] = 1;
	       		$this->general_model->edit_commission_setting($res['order_id'],$data);
	       }
	       $this->session->set_flashdata('message', "Your Payment release has been updated successfully!");
	       redirect('cpanel/payment_release', 'refresh');
        }
        else
        {
        	 $this->session->set_flashdata('message_error', "Updating error. Please try again later!");
	       	 redirect('cpanel/payment_release', 'refresh');
        }
			
 		}
 		else
 		{
 			 redirect('/admin', 'refresh');
 		}
	}
	
	
/*---------------------------------------------------------------------------*/	
	// Newsletter ===================	
	function newslettermanager()
	{
		
		$result=$this->general_model->get_newsletter_manager('');
		$temp=array();
			if($result->num_rows()>0)
			{
				$temp=$result->result_array();
			}
		foreach($temp as &$te)
		{
			if($te['type']==1)
			{
				$te['template'] = "Register";
			}
			else if($te['type']==2)
			{
				$te['template'] = "Update Extension";
			}
			else if($te['type']==3)
			{
				$te['template'] = "Purchase Extension";
			}
			else if($te['type']==4)
			{
				$te['template'] = "Comment";
			}
			else if($te['type']==5)
			{
				$te['template'] = "Create Extension";
			}
			else
			{
				$te['template'] = "Newsletter";
			}
			
		}	
		$alldata['banners']=$temp;	
		$data['content']=$this->load->view('content/newslettermanager',$alldata,true);
		$data['title'] = "noticfication";
		$data['page'] = "noticfication";
		$this->load->view('template',$data);
	
	}
	function editnewsletter($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_newsletter_detail($id);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			$data['banners']=$_data;	
		}
		else
		{
			$data['id']=''; // add new
		}

		$data['content']=$this->load->view('content/editnewsletter',$data,true);
		$data['title'] = "noticfication";
		$data['page'] = "noticfication";
		$this->load->view('template',$data);
	}
	
	// ADD or UPDATE ACTION
	function newsletter_manipulate()
	{
		if ($this->session->userdata['group']==1) {
		if ($this->general_model->newsletter_manipulate($_POST))
		{
			$this->session->set_flashdata('message', "Updated Newsletter");	    	
		}
		else
		{
			$this->session->set_flashdata('message', 'Updated Newsletter error. Please try later');
		}
		}
		redirect("/cpanel/newslettermanager/");
	}
	
	function deletenewsletter($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('newsletters', array('id' => $id,'type'=>6));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Newsletter');
		}
		redirect("/cpanel/newslettermanager/");
	}
	
	
/*--------------------- Start subscribers--------------------------------*/
	function contactmanager()
	{
		if ($this->session->userdata['group']!=1) {
			redirect("/cpanel/index/");
		}
		$result=$this->general_model->get_allsubscribers();	
				
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		
		$data['banners']=$_data;
		$data['content']=$this->load->view('content/contactmanager',$data,true);
		$data['title'] = "subscribe";
		$data['page'] = "content";
		$this->load->view('template',$data);				
	}
	
	function deletesubscriber($id=0)
	{
		if ($this->session->userdata['group']==1) {
		
		$this->db->trans_start(); 
		$this->db->delete('subscribers', array('id' => $id));		
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Subscriber');
		}
		redirect("/cpanel/contactmanager/");
	}
	
	
	function selectsubscribers($id='')
	{

		$result=$this->general_model->get_allsubscribers();	
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$i=0;
		foreach($result->result_array() as $row)
		{
				$_data[$i]['group'] = "Subscriber";
				$i++;
		}
		$result1=$this->general_model->get_alluserbytype(2);	
		$_data1=array();
		if($result1->num_rows()>0)
		{
			$i=0;
			foreach($result1->result_array() as $row)
			{
				$_data1 = null;
				$_data1['id'] = $row['user_id'];
				$_data1['email'] = $row['email'];
				$_data1['date'] = $row['created_date'];
				$_data1['group'] = "Editor";
				array_push($_data,$_data1);
			}
		}
		
		$result2=$this->general_model->get_alluserbytype(3);	
		
		$_data2=array();
		if($result2->num_rows()>0)
		{
			$i=0;
			foreach($result2->result_array() as $row)
			{
				$_data2 = null;
				$_data2['id'] = $row['user_id'];
				$_data2['email'] = $row['email'];
				$_data2['date'] = $row['created_date'];
				$_data2['group'] = "Member";
				array_push($_data,$_data2);
			}
		}
		
		$data['banners']=$_data;
		$data['id']=$id;
		$data['content']=$this->load->view('content/selectsubscribers',$data,true);
		$data['title'] = "noticfication";
		$data['page'] = "noticfication";
		$this->load->view('template',$data);				
	}
/*-----------------------------------------*/
	function action_sendmailtemplate()
	{
		if ($this->session->userdata['group']==1) {
		$templateID=$_POST['currentid'];
		$sql ="SELECT title,content,id,date_created from newsletters where id=".$templateID;
		$query = $this->db->query($sql);
		
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
		$idlist='';
		if(isset($_POST['check']))
		{
			$n=count($_POST['check']);
			$i=1;
			foreach($_POST['check'] as $m)
			{
				if($i==$n)
				{
					$idlist.= $m;
				}
				else
				{
					$idlist.= $m.",";
				}
				$i++;
			}
		}
		
		$idlist_u='';
		if(isset($_POST['check_u']))
		{
			$n1=count($_POST['check_u']);
			$j=1;
			foreach($_POST['check_u'] as $m1)
			{
				if($j==$n1)
				{
					$idlist_u.= $m1;
				}
				else
				{
					$idlist_u.= $m1.",";
				}
				$j++;
			}
		}
		$setting =  @reset($this->general_model->get_website_info());
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
		$date_send = null;
		$data1= null;
		if($idlist!='')
		{
			$sql ="SELECT name,email,id from subscribers where id IN (".$idlist.")";
			$query = $this->db->query($sql);
			$i=0;
		
			foreach ($query->result() as $row)
				{
					$data1[$i]['name']=$row->name;
					$data1[$i]['email']=$row->email;
					$i++;
				}
		}
		$data2=null;
		if($idlist_u!='')
		{
			$sql1 ="SELECT firstname,lastname,email,user_id from users where user_id IN (".$idlist_u.")";
			$query1 = $this->db->query($sql1);
				
				$i=0;
				foreach ($query1->result() as $row)
				{
					$data2[$i]['name']=$row->lastname." ".$row->firstname;
					$data2[$i]['email']=$row->email;
					$i++;
				}
		}
		if($data1!=null && $data2!=null)
			$data_send = array_merge($data1,$data2);
		else if ($data1!=null && $data2==null)
		{
			$data_send = $data1;
		}
		else if ($data1==null && $data2!=null)
		{
			$data_send = $data2;
		}
		else
		{
			$data_send =null;
		}
			
		if($data_send!= null)
		{
			foreach ($data_send as $row)
			{
				$data['name']=$row['name'];
				$data['email']=$row['email'];
				$this->email->clear();
				$this->email->from('', 'Buy & Sell Newsletter');
				$this->email->to($data['email']);
				$this->email->subject($title);
				
				ob_start();
		
				$this->load->view('content/email-template',$data);
				$body2 = ob_get_contents();
				ob_end_clean();
				$this->email->message($body2);			
				$this->email->send();
			}
		}
		
		//session_start(); 
		$_SESSION['message']='<div id="flashmessage">Mail has been sent succesfully to all subscribers</div>';
		$this->session->set_flashdata('message', 'Mail has been sent succesfully to all subscribers');
		}
		redirect("/cpanel/newslettermanager/");
	}

	function sendEmail($emails, $subject,$content, $from = null, $mailType = 'html')
	{
		/*
	     * Send mail
	     */
		if ($this->session->userdata['group']==1) {
		$this->load->library('email');
	   	$config = array(
			  'protocol' => 'smtp',
			    'smtp_host' => 'mail.yucai.com.au',
			    'smtp_port' => 25,
			    'smtp_user' => 'info@yucai.com.au',
			    'smtp_pass' => '=)+9))-zr8U8',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
		);
		
		$this->email->initialize($config);
	    try {
            $this->email->clear();
            $this->email->to($emails);
            
            if($from == NULL )
			{
				$this->email->from('maildev@tempbox.com.au');
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
	    }
		}
	}
/*-----------------------------------------------------------------------*/
/*--------------------------- START CURRENCY ----------------------------*/
	
	function editcurrency($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_currency_detail($id);	
			$data['banners']=$result[0];
			
		}
		else
		{
			$data['id']='';
		}
		
		$data['title'] = "currency";
		$data['page'] = "currency";
		$data['content']=$this->load->view('content/editcurrency',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function currency_manipulate()
	{
		if ($this->session->userdata['group']==1) {
			if($this->general_model->check_exist_currency($_POST['title'],$_POST['currentid'])==true)
			{
				$this->session->set_flashdata('message_error', 'Title is already taken');
				redirect("/cpanel/editcurrency/".$_POST['currentid']);
			}
			
			if ($this->general_model->currency_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated Currency');	    	
			}
			else
			{
				$this->session->set_flashdata('message', 'Updated Currency error. Please try later');
			}
		}
		redirect("/cpanel/currency/");
	}
	
	function currency()
	{
		$result=$this->general_model->get_all_currency();	
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/currency',$data,true);
		$data['title'] = "currency";
		$data['page'] = "currency";
		$this->load->view('template',$data);	
	}
	
	function deletecurrency($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('currency', array('currency_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Currency');
		}
		redirect("/cpanel/currency/");
	}
/*--------------------------- END CURRENCY ----------------------------*
/*--------------------------- START LANGUAGE ----------------------------*/
	
	function editlanguage($id='')
	{
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_language_detail($id);	
			$data['banners']=$result[0];
			
		}
		else
		{
			$data['id']='';
		}
		$banner = @reset($this->general_model->get_website_info());
		$data['settings'] = $banner;
		$data['title'] = "language";
		$data['page'] = "language";
		$data['content']=$this->load->view('content/editlanguage',$data,true);
		$this->load->view('template',$data);
	}

	// ADD or UPDATE ACTION
	function language_manipulate()
	{
		if ($this->session->userdata['group']==1) {
			if($this->general_model->check_exist_language($_POST['language_name'],$_POST['currentid'])==true)
			{
				$this->session->set_flashdata('message_error', 'Language Name is already taken');
				redirect("/cpanel/editlanguage/".$_POST['currentid']);
			}
			
			if ($this->general_model->language_manipulate($_POST))
			{
				$this->session->set_flashdata('message', 'Updated Language');	    	
			}
			else
			{
				$this->session->set_flashdata('message', 'Updated Language error. Please try later');
			}
		}

		redirect("/cpanel/language/");
	}
	
	function language()
	{
		$result=$this->general_model->get_all_language();	
		$data['banners']=$result;	
		$data['content']=$this->load->view('content/language',$data,true);
		$data['title'] = "language";
		$data['page'] = "language";
		$this->load->view('template',$data);	
	}
	
	function deletelanguage($id=0)
	{
		if ($this->session->userdata['group']==1) {
		$this->db->trans_start(); 
		$this->db->delete('languages', array('language_id' => $id));
		$this->db->trans_complete();
		$this->session->set_flashdata('message', 'Deleted Language');
		}
		redirect("/cpanel/language/");
	}
	
/*--------------------- Start Country Management ---------------------------*/
	
	function report()
	{

			if(isset($_GET['filter_date_start']))
			{

				$data['start_date'] = $_GET['filter_date_start'];
				$temp_date = explode("/",$_GET['filter_date_start']);
				$start = mktime(0, 0, 0, $temp_date[0], $temp_date[1], $temp_date[2])+7*3600;
			}
			else
			{
				$start = null;
			}
			
			if(isset($_GET['filter_date_end']))
			{
				$data['end_date'] = $_GET['filter_date_end'];
				$temp_date = explode("/",$_GET['filter_date_end']);
				$end = mktime(0, 0, 0, $temp_date[0], $temp_date[1], $temp_date[2])+7*3600;
			}
			else
			{
				$end = null;
			}
			
		
			$result=$this->general_model->get_all_order($start,$end);
			
		$data['banners']=$result;	
		$data['report_link'] = base_url()."backend.php/cpanel/report?show=true";
		$data['content']=$this->load->view('content/report',$data,true);
		
		$data['title'] = "report";
		$data['page'] = "report";
		$this->load->view('template',$data);	
	}

/*-----------------------------------------------------------------------*/
	function editarticle($id='')
	{
		if($_GET['page']!='')
		{
			if($id!='')
			{
				$data['id']=$id; // update
				$result=$this->general_model->get_article($id);	
					
				$_data=array();
				if($result->num_rows()>0)
				{
					$_data=$result->result_array();
				}
				$data['banners'] = $_data;
				$data['parent']=$_data[0]['parent']; // add new
				
			}
			else
			{
				$data['id']=''; // add new
				$data['parent']=$_GET['page']; // add new
			}
			
			$data['title'] = "content";
			$data['back_link'] = base_url()."backend.php/cpanel/editchildpage/".$_GET['page'];
			$data['page'] = "content";
			$data['content']=$this->load->view('content/editarticle',$data,true);
			$this->load->view('template',$data);
		}
		else
		{
			if($id!='')
			{
				$this->session->set_flashdata('message_error', 'Edit Page error');
			}
			else
			{
				$this->session->set_flashdata('message_error', 'Add Page error');
			}
			redirect('/cpanel/staticmanager');
		}
	}
	
	function editpage($id='')
	{
	
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_article($id);
	
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			$data['banners'] = $_data;
				
		}
		else
		{
			$data['id']=''; // add new
		}
	

		$data['title'] = "content";
		$data['back_link'] = base_url()."backend.php/cpanel/staticmanager";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/editpage',$data,true);
		$this->load->view('template',$data);
	}
	
	function editchildpage($id='')
	{
	
		if($id!='')
		{
			$data['id']=$id; // update
			$result=$this->general_model->get_all_article_by_parent($id);
	
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			$data['banners'] = $_data;
			$data['parent']=$id; // add new
	
			$data['title'] = "content";
			$data['back_link'] = base_url()."backend.php/cpanel/staticmanager";
			$data['page'] = "content";
			$data['content']=$this->load->view('content/editchildpage',$data,true);
			$this->load->view('template',$data);
		}
		else 
		{
			$this->session->set_flashdata('message_error', 'Page error');
			redirect('backend.php/cpanel/staticmanager');
		}
	}

	// ADD or UPDATE ACTION
	function article_manipulate()
	{
		if ($this->session->userdata['group']==1) {
		if ($this->general_model->article_manipulate($_POST))
		{
			$this->session->set_flashdata('message', 'Updated Page');	    	
		}
		else
		{
			$this->session->set_flashdata('message', 'Updated Page error. Please try later');
		}
		}
		if ($_POST['parent']==0) {
			redirect("/cpanel/staticmanager/");
		}
		else
		{
			redirect("/cpanel/editchildpage/".$_POST['parent']);
		}

	}

	function staticmanager()
	{
		$result=$this->general_model->get_parent_page();
	
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;
		$data['content']=$this->load->view('content/staticmanager',$data,true);
		$data['title'] = "content";
		$data['page'] = "content";
		$this->load->view('template',$data);
	}
	
	function featuremanager()
	{
		$result=$this->general_model->get_all_article(1);	
				
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;	
		$data['content']=$this->load->view('content/featuremanager',$data,true);
		$data['title'] = "featuremanager";
		$data['page'] = "content";
		$this->load->view('template',$data);	
	}
	
	function documentationmanager()
	{
		
		$result=$this->general_model->get_all_article(4);	
				
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;	
		$data['content']=$this->load->view('content/documentationmanager',$data,true);
		$data['title'] = "documentationmanager";
		$data['page'] = "content";
		$this->load->view('template',$data);
	}
	
	function demo()
	{
			$result=$this->general_model->get_article_by_type(2);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			$data['banners'] = $_data;
			
			$data['title'] = "demo";
			$data['page'] = "content";
			$data['content']=$this->load->view('content/demo',$data,true);
			$this->load->view('template',$data);
	}
	
	function download()
	{
			$result=$this->general_model->get_article_by_type(3);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
			$data['banners'] = $_data;
		$data['title'] = "download";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/download',$data,true);
		$this->load->view('template',$data);
	}
	
	function partner()
	{
			$result=$this->general_model->get_article_by_type(6);	
				
			$_data=array();
			if($result->num_rows()>0)
			{
				$_data=$result->result_array();
			}
		$data['banners'] = $_data;
		$data['title'] = "partner";
		$data['page'] = "content";
		$data['content']=$this->load->view('content/partner',$data,true);
		$this->load->view('template',$data);
	}
	
	function supportmanager()
	{
		
		$result=$this->general_model->get_all_article(5);	
				
		$_data=array();
		if($result->num_rows()>0)
		{
			$_data=$result->result_array();
		}
		$data['banners']=$_data;	
		$data['content']=$this->load->view('content/supportmanager',$data,true);
		$data['title'] = "supportmanager";
		$data['page'] = "content";
		$this->load->view('template',$data);;	
	}

	function deletearticle($id=0)
	{
		if ($this->session->userdata['group']==1) {
		if(isset($_GET['page']))
		{
			$this->db->trans_start(); 
			$this->db->delete('article', array('article_id' => $id));
			$this->db->trans_complete();
			$this->session->set_flashdata('message', 'Deleted Page');		
			redirect("/cpanel/editchildpage/".$_GET['page']);
		}
		}
		redirect("/cpanel/editchildpage/".$_GET['page']);
		
		
	}
	
	function deletepage($id=0)
	{
		if ($this->session->userdata['group']==1) {
			$this->db->trans_start();
			$this->db->delete('article', array('article_id' => $id));
			$this->db->delete('article', array('parent' => $id));
			$this->db->trans_complete();
			$this->session->set_flashdata('message', 'Deleted Page');
		}
			redirect("/cpanel/staticmanager/");

	}
	
/*-----------------------------------------------------------------------*/
}
