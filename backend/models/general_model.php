<?php  
/**********************************
	Programmer: Nguyen Dang Khoa
**********************************/
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class General_Model extends CI_Model 
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_gallery($id,$type)
	{
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('reference_id', $id);
		$this->db->where('type', $type);
		$query = $this->db->get();		
		return $query;
	}
	
/*-------------------------- Banner-----------------------*/
	function logo_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['image0']!="")
			$this->db->set('image_banner',$data['image0']);
		if($data['image1']!="")
			$this->db->set('image_logo',$data['image1']);
		$this->db->set('about_us',$data['about_us']);
		$this->db->set('footer',$data['footer']);
		
			
		$this->db->update('system'); 
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}

	
	function banner_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				$this->db->where('banner_id',$data['currentid']);
				$this->db->set('title',$data['title']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('sorting',$data['sorting']);
				$this->db->set('url',$data['txtBannerURL']);
				$this->db->set('position',$data['txtBannerType']);
				$this->db->set('created_date',time());
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->update('banner'); 
		}
		else	//add
		{
				$this->db->set('title',$data['title']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('sorting',$data['sorting']);
				$this->db->set('url',$data['txtBannerURL']);
				$this->db->set('position',$data['txtBannerType']);
				$this->db->set('created_date',time());
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->insert('banner'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function get_all_slideshow($id='')
	{
		$this->db->select('*');
		$this->db->from('banner');
		if($id!=null) $this->db->where('banner_id',$id);
		$this->db->order_by('sorting','asc');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();		
		return $query;
	}
	
	function get_all_system()
	{
		$this->db->select('*');
		$this->db->from('system');
		$query = $this->db->get();		
		return $query;
	}
	
	
	/*----------------------------------------------------------*/
	function get_all_active_user($id)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("users.active", 1);
			if($id!=null)
				$this->db->where("users.user_id != ", $id);
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;

	}
	
	function get_recent_user($limit)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("users.active", 1);
			$this->db->where("users.group_id !=",1);
			$this->db->order_by("users.created_date", "desc");
			if($limit!=0)
				$this->db->limit($limit);
			$query = $this->db->get();
			return $query->result_array();

	}
	
	function get_all_inactive_user($id)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("users.active", 0);
			$this->db->where("users.user_id != ", $id);
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;

	}
	
	function get_alluserbytype($type)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("users.group_id", $type);
			$this->db->order_by("users.created_date", "desc");
			$query = $this->db->get();
			return $query;

	}
	
	
	function get_user_by_user_id($id)
	{
			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id',"left");
			$this->db->join('city', 'users.city_id = city.city_id',"left");
			$this->db->join('region', 'region.region_id = city.region_id',"left");
			$this->db->join('country', 'country.country_id = region.country_id',"left");
			$this->db->where("user_id", $id);
			$query = $this->db->get();
			return $query;
	}
	
	function get_allgroup()
	{
			$this->db->select("*");
			$this->db->from('groups');
			$query = $this->db->get();
			return $query;
	}
	
	function check_exist_email($email,$id)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("email", $email);
			$query = $this->db->get();
			
			if($query->num_rows()>0)
			{
				$data = $query->result_array();
				if($data[0]['user_id']!=$id)
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}
	}
	
	function check_exist_username($username,$id)
	{

			$this->db->select("*");
			$this->db->from('users');
			$this->db->join('groups', 'users.group_id = groups.group_id');
			$this->db->where("username", $username);
			$query = $this->db->get();
			
			if($query->num_rows()>0)
			{
				$data = $query->result_array();
				if($data[0]['user_id']!=$id)
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}
	}
	
	function get_all_city()
	{
		$this->db->select("city.city_id,city.city_name,city.public,city.created_date,city.region_id,country.country_id,region.region_name,country.country_name");
		$this->db->from('city');
		$this->db->join('region', 'region.region_id = city.region_id');
		$this->db->join('country', 'country.country_id = region.country_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_all_payment()
	{
		$this->db->select("*");
		$this->db->from('payment_method');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_all_region()
	{
		$this->db->select("region.region_id,region.region_name,region.created_date,region.public,country.country_name");
		$this->db->from('region');
		$this->db->join('country', 'country.country_id = region.country_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function user_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
				$this->db->where('user_id',$data['currentid']);
				$this->db->set('username',$data['username']);
				if($data['password']!="")
					$this->db->set('password',md5($data['password']));
				if($data['payment_id']!="")
					$this->db->set('payment_id',$data['payment_id']);
				$this->db->set('firstname',$data['firstname']);
				$this->db->set('lastname',$data['lastname']);
				$this->db->set('email',$data['email']);
				$this->db->set('phone',$data['phone']);
				$this->db->set('website',$data['website']);
				$this->db->set('group_id',$data['group_id']);
				if(isset($data['paypal']))
				$this->db->set('paypal',$data['paypal']);
				$this->db->set('avatar', $data['avatar']);
					
				$this->db->set('company',$data['company']);
				$this->db->set('address1',$data['address1']);
				$this->db->set('address2',$data['address2']);
				$this->db->set('post_code',$data['post_code']);
				$this->db->set('city_id',$data['city_id']);
				if(isset($data['active']))
					$this->db->set('active',$data['active']);
				$this->db->update('users'); 
		}
		else	//add
		{
				$this->db->set('username',$data['username']);
				if($data['password']!="")
					$this->db->set('password',md5($data['password']));
				if($data['payment_id']!="")
					$this->db->set('payment_id',$data['payment_id']);
				$this->db->set('firstname',$data['firstname']);
				$this->db->set('lastname',$data['lastname']);
				$this->db->set('email',$data['email']);
				$this->db->set('phone',$data['phone']);
				$this->db->set('website',$data['website']);
				if(isset($data['paypal']))
				$this->db->set('paypal',$data['paypal']);
				$this->db->set('avatar', $data['avatar']);
					
				$this->db->set('company',$data['company']);
				$this->db->set('address1',$data['address1']);
				$this->db->set('address2',$data['address2']);
				$this->db->set('post_code',$data['post_code']);
				$this->db->set('city_id',$data['city_id']);
				$this->db->set('group_id',$data['group_id']);
				if(isset($data['active']))
					$this->db->set('active',$data['active']);
				$this->db->set('group_id',3);
				$this->db->set('created_date',time());
				$this->db->insert('users'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	/*---------------------------------------------------------*/
	function get_all_news_gallery()
	{
			$this->db->select("*");
			$this->db->from('news');
			$this->db->where('type','2');
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;
	}
	
	function get_news_gallery_by_id($id)
	{
			$this->db->select("*");
			$this->db->from('news');
			$this->db->where('type','2');
			$this->db->where("news_id", $id);
			$query = $this->db->get();
			return $query;

	}
	
	function gallery_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
			$image = $data['data'];
			$description = $data['desimg'];
			
			$id=$data['currentid']; 
			$this->db->where('news_id',$id);
			$this->db->set('title',$data['title']);
			$this->db->set('type',2);
			if($image[0]!="")
				$this->db->set('image',$image[0]);
			$this->db->set('description',$data['description']);
			$this->db->set('content',$data['content']);
			$this->db->set('updated_date',time());
			if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
			$this->db->update('news'); 
				
			$this->db->delete('gallery', array('reference_id' => $id,'type'=>1));
			for($i=0;$i<count($image);$i++)
			{
				$this->db->set('reference_id',$id);
				$this->db->set('type',1);
				$this->db->set('image',$image[$i]);
				$this->db->set('description',$description[$i]);
				$this->db->insert('gallery');
			}
		}
		else	//add
		{
			$image = $data['data'];
			$description = $data['desimg'];
			
			$this->db->set('title',$data['title']);
			$this->db->set('type',2);
			if(isset($image[0]) && $image[0] !="")
				$this->db->set('image',$image[0]);
			$this->db->set('description',$data['description']);
			$this->db->set('content',$data['content']);
			$this->db->set('created_date',time());
			if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
			}
			$this->db->insert('news'); 
			$id=$this->db->insert_id();
				
			$this->db->delete('gallery', array('reference_id' => $id,'type'=>1));
			
			if(count($image)>0)
			{
				for($i=0;$i<count($image);$i++)
				{
					
					$this->db->set('reference_id',$id);
					$this->db->set('type',1);
					$this->db->set('image',$image[$i]);
					$this->db->set('description',$description[$i]);
					$this->db->insert('gallery');
				}
			}
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
/*---------------------------------------------------------*/
	function get_all_news()
	{
			$this->db->select("*");
			$this->db->from('news');
			$this->db->where('type',1);
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;
	}
	
	function get_news($id)
	{
			$this->db->select("*");
			$this->db->from('news');
			$this->db->where("news_id", $id);
			$query = $this->db->get();
			return $query;

	}
	
	function news_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
				

				$id=$data['currentid']; 
				$this->db->where('news_id',$id);
				$this->db->set('title',$data['title']);
				$this->db->set('type',1);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->set('description',$data['description']);
				$this->db->set('content',$data['content']);
				$this->db->set('updated_date',time());
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->update('news'); 
		}
		else	//add
		{
				$this->db->set('title',$data['title']);
				$this->db->set('type',1);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->set('description',$data['description']);
				$this->db->set('content',$data['content']);
				$this->db->set('created_date',time());
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->insert('news'); 
			
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
/*---------------------------------------------------------*/
	
/*---------------------------------------------------------*/
	function get_all_about()
	{
			$this->db->select("*");
			$this->db->from('news');
			$this->db->where('type',3);
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;
	}
	

	
	function about_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
				

				$id=$data['currentid']; 
				$this->db->where('news_id',$id);
				$this->db->set('title',$data['title']);
				$this->db->set('type',3);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->set('description',$data['description']);
				$this->db->set('content',$data['content']);
				$this->db->set('updated_date',time());
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->update('news'); 
		}
		else	//add
		{
				$this->db->set('title',$data['title']);
				$this->db->set('type',3);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
				$this->db->set('description',$data['description']);
				$this->db->set('content',$data['content']);
				$this->db->set('created_date',time());
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->insert('news'); 
			
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
/*---------------------------------------------------------*/
	
/*---------------------------------------------------------*/
	
	function get_competition_detail($id)
	{
		$this->db->select('*');
		$this->db->from('competition');
		$this->db->where('competition_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_competition()
	{
		$this->db->select("*");
		$this->db->from('competition');
		$query = $this->db->get();
		return $query;
	}
	function get_all_competition_player_notinlist($list)
	{
		$this->db->select("*");
		$this->db->from('competition');
		$this->db->where_not_in('competition_id', $list);
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function check_exist_competition($name,$id)
	{

			$this->db->select("*");
			$this->db->from('competition');
			$this->db->where("competition_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['competition_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function competition_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('competition_id',$id);
				$this->db->set('competition_name',$data['competition_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('competition'); 
		}
		else	//add
		{
				$this->db->set('competition_name',$data['competition_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('competition'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
/*-------------------------------------------------------------------------------*/
	
	function get_club_detail($id)
	{
		$this->db->select('*');
		$this->db->from('club');
		$this->db->where('club_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_club()
	{
		$this->db->select("*");
		$this->db->from('club');
		$query = $this->db->get();
		return $query;
	}
	function get_all_club_by_public()
	{
		$this->db->select("*");
		$this->db->from('club');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function get_all_club_player_notinlist($list)
	{
		$this->db->select("*");
		$this->db->from('club');
		$this->db->where_not_in('club_id', $list);
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
	function check_exist_club($name,$id)
	{

			$this->db->select("*");
			$this->db->from('club');
			$this->db->where("club_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['club_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function club_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('club_id',$id);
				$this->db->set('club_name',$data['club_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('club'); 
		}
		else	//add
		{
				$this->db->set('club_name',$data['club_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('club'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
/*-------------------------------------------------------------------------------*/
	
	function get_nationteam_detail($id)
	{
		$this->db->select('*');
		$this->db->from('nation_team');
		$this->db->where('national_team_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_nationteam()
	{
		$this->db->select("*");
		$this->db->from('nation_team');
		$query = $this->db->get();
		return $query;
	}
	
	
	function get_all_nationteam_player()
	{
		$this->db->select("*");
		$this->db->from('nation_team');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
	function get_all_nationteam_player_notinlist($list)
	{
		$this->db->select("*");
		$this->db->from('nation_team');
		$this->db->where_not_in('national_team_id', $list);
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
	function check_exist_nationteam($name,$id)
	{

			$this->db->select("*");
			$this->db->from('nation_team');
			$this->db->where("national_team_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['national_team_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function nationteam_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('national_team_id',$id);
				$this->db->set('national_team_name',$data['national_team_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('nation_team'); 
		}
		else	//add
		{
				$this->db->set('national_team_name',$data['national_team_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('nation_team'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
/*----------------------------------- START CATEGORY --------------------------------------------*/
	
	function get_category_detail($id)
	{
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('category_id', $id);
		$query = $this->db->get();		
		return $query->result_array();;
	}
	function get_all_category()
	{
		$this->db->select("*");
		$this->db->from('category');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_category_property()
	{
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->order_by('value_id ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_category_property_extension()
	{
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->where('category_id',0);
		$this->db->order_by('value_id ASC');
		
		$query = $this->db->get();
		return $query->result_array();
	}

	
	function get_category_property_by_category_id($id,$ex_id)
	{
		$this->db->distinct();
		$this->db->select("category_property.property_name,category_property.value_id,extension_property.property_value,extension_property.extension_id");
		$this->db->from('category_property');
		$this->db->join('extensions',"extensions.category_id = category_property.category_id","left");
		$this->db->join('extension_property',"category_property.value_id = extension_property.value_id","left");
		$this->db->where('category_property.category_id',$id);
		if($ex_id!=null)
		$this->db->where('extension_property.extension_id',$ex_id);
		$this->db->order_by('category_property.value_id ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_category_property_default_by_category_id()
	{
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->where('category_property.category_id',0);
		$this->db->order_by('category_property.value_id ASC');
		$query = $this->db->get();
	
		return $query->result_array();
	}
	function get_extension_property_by_value_id($id,$ex_id)
	{
		$this->db->select("*");
		$this->db->from('extension_property');
		$this->db->where('value_id',$id);
		$this->db->where('extension_id',$ex_id);
		$this->db->order_by('extension_property.value_id ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_category_property_by_property_id($id)
	{
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->where('value_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_all_category_by_public()
	{
		$this->db->select("*");
		$this->db->from('category');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
 	function get_all_license()
    {
    	 $this->db->select('*');
    	$this->db->from('license');
        $result = $this->db->get();
        return $result->result_array();
    }
	function check_exist_category($name,$id)
	{

			$this->db->select("*");
			$this->db->from('category');
			$this->db->where("category_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['category_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function category_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('category_id',$id);
				$this->db->set('category_name',$data['category_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->update('category'); 
		}
		else	//add
		{
				$this->db->set('category_name',$data['category_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('category'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function category_property_manipulate($data)
	{
		$this->db->trans_start(); 
		//$this->db->delete('category_property', array('category_id' => $data['currentid']));
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->where('category_id',0);
		$query = $this->db->get();
		$datas = $query->result_array();
		if(isset($data['property']))
		{
			foreach($data['property'] as $key=>$pro)
			{
				$check =false;
				foreach($datas as &$da)
				{
					if($da['value_id'] ==$key)
					{
						$this->db->where('value_id',$key);
						$this->db->set('category_id',$data['currentid']);
						$this->db->set('property_name',$pro);
						$this->db->update('category_property');
						$da['check']=1;
						$check =true;
						break;
						
					}
				}
				if($check==false)
				{
					$this->db->set('category_id',$data['currentid']);
					$this->db->set('property_name',$pro);
					$this->db->insert('category_property');
				}
			}
			foreach($datas as $da)
			{
				if(!isset($da['check']))
					$this->db->delete('category_property', array('value_id' => $da['value_id']));
			}
		} 
		else
		{
			if(count($datas)>0)
			{
				foreach($datas as $da)
				{
						$this->db->delete('category_property', array('value_id' => $da['value_id']));
				}
			}
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	/*--------------------------------- END CATEGORY ------------------------------------*/

/*----------------------------------- START COMPATIBILITY --------------------------------------------*/
	
	function get_compatibility_detail($id)
	{
		$this->db->select('*');
		$this->db->from('compatibility');
		$this->db->where('compatibility_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_compatibility()
	{
		$this->db->select("*");
		$this->db->from('compatibility');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function insert_extension_image($data=null){
        $this->db->insert('gallery', $data);
        return $this->db->insert_id();
    }
	function insert_extension_download($data=null){
        $this->db->insert('downloads', $data);
        return $this->db->insert_id();
    }
    
	function get_all_compatibility_by_public()
	{
		$this->db->select("*");
		$this->db->from('compatibility');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function check_exist_compatibility($name,$id)
	{

			$this->db->select("*");
			$this->db->from('compatibility');
			$this->db->where("compatibility_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['compatibility_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function compatibility_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('compatibility_id',$id);
				$this->db->set('compatibility_name',$data['compatibility_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->update('compatibility'); 
		}
		else	//add
		{
				$this->db->set('compatibility_name',$data['compatibility_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('compatibility'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	
	/*--------------------------------- END COMPATIBILITY ------------------------------------*/
	
	/*----------------------------------- START LICENSE --------------------------------------------*/
	
	function get_license_detail($id)
	{
		$this->db->select('*');
		$this->db->from('license');
		$this->db->where('license_id', $id);
		$query = $this->db->get();		
		return $query;
	}

	function get_all_license_by_public()
	{
		$this->db->select("*");
		$this->db->from('license');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function check_exist_license($name,$id)
	{

			$this->db->select("*");
			$this->db->from('license');
			$this->db->where("license_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['license_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function license_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('license_id',$id);
				$this->db->set('license_name',$data['license_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->update('license'); 
		}
		else	//add
		{
				$this->db->set('license_name',$data['license_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('license'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	
	/*--------------------------------- END LICENSE ------------------------------------*/

	/*----------------------------------- START EXTENSION --------------------------------------------*/
	
	function get_extension_detail($id)
	{
		$this->db->select('*');
		$this->db->from('extensions');
		$this->db->where('extension_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_extension()
	{
		$this->db->select("extensions.extension_id,extensions.name,extensions.created_date,extensions.status,extensions.download,extensions.price,users.username,users.user_id");
		$this->db->from('extensions');
		$this->db->join('users', 'users.user_id = extensions.user_id');
		$query = $this->db->get();
		return $query;
	}
    
	function get_all_extension_by_public()
	{
		$this->db->select("*");
		$this->db->from('extensions');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function check_exist_extension($name,$id)
	{

			$this->db->select("*");
			$this->db->from('extensions');
			$this->db->where("extension_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['extension_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function check_exist_id_extension($id)
	{

			$this->db->select("*");
			$this->db->from('extensions');
			$this->db->where("extension_id", $id);
			$query = $this->db->get();
			
			if($query->num_rows()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	
	function extension_image_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
			$image = $data['data'];

			$name = $data['nameimg'];
			
			$id=$data['currentid']; 
				
			$this->db->delete('gallery', array('reference_id' => $id,"type"=>1));
			for($i=0;$i<count($image);$i++)
			{
				$this->db->set('reference_id',$id);
				$this->db->set('image',$image[$i]);
				$this->db->set('name',$name[$i]);
				$this->db->set('type',1);
				$this->db->insert('gallery');
			}
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function extension_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				$id=$data['currentid']; 
				$this->db->where('extension_id',$id);
				$this->db->set('user_id',$data['user_id']);
				$this->db->set('name',$data['name']);
				$this->db->set('category_id',$data['category_id']);
				if(isset($data['image']))
					$this->db->set('image', $data['image']);
				
				if(isset($data['banner']))
					$this->db->set('banner', $data['banner']);
					
				$this->db->set('license_id',$data['license_id']);
				$this->db->set('price',$data['price']);
				$this->db->set('description',$data['description']);
				$this->db->set('document',$data['document']);
				$this->db->set('link_preview',$data['link_preview']);
				$this->db->set('public',$data['public']);
				$this->db->set('send_to_purchase',$data['send_to_purchase']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->update('extensions'); 
				if(isset($data['custom']))
				{
					//$this->db->delete('extension_property', array('extension_id' => $id));
					foreach($data['custom'] as $key=>$value)
					{
						
						$data_property = $this->get_category_property_by_property_id($key);
						$check_data = $this->get_extension_property_by_value_id($key,$id);
						if(count($check_data) > 0)
						{
							$this->db->where('extension_id',$id);
							$this->db->where('value_id',$key);
							//$this->db->set('property_name',$data_property[0]['property_name']);
							$this->db->set('property_value',$value);
							$this->db->update('extension_property'); 
						}
						else
						{
							$this->db->set('extension_id',$id);
							$this->db->set('value_id',$key);
							//$this->db->set('property_name',$data_property[0]['property_name']);
							$this->db->set('property_value',$value);
							$this->db->insert('extension_property'); 
						}
					}
				}
				
		}
		else	//add
		{
				$this->db->set('user_id',$data['user_id']);
				$this->db->set('name',$data['name']);
				$this->db->set('category_id',$data['category_id']);
				$this->db->set('image', $data['image']);
				$this->db->set('banner', $data['banner']);
				$this->db->set('license_id',$data['license_id']);
				$this->db->set('price',$data['price']);
				$this->db->set('description',$data['description']);
				$this->db->set('document',$data['document']);
				$this->db->set('link_preview',$data['link_preview']);
				$this->db->set('public',$data['public']);
				$this->db->set('send_to_purchase',$data['send_to_purchase']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('extensions'); 
				$id = $this->db->insert_id();
				if(isset($data['custom']))
				{
					foreach($data['custom'] as $key=>$value)
					{
						$data_property = $this->get_category_property_by_property_id($key);
						$this->db->set('extension_id',$id);
						$this->db->set('value_id',$key);
						$this->db->set('property_value',$value);
						$this->db->insert('extension_property'); 
					}
				}
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	
	
	function get_photo_extension($id)
	{
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('reference_id', $id);
		$this->db->where('type', 1);
		$query = $this->db->get();		
		return $query;
	}

	function get_photo_slideshow($id)
	{
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('reference_id', $id);
		$this->db->where('type', 2);
		$query = $this->db->get();		
		return $query;
	}
	
	
	/*--------------------------------- END EXTENSION ------------------------------------*/
	
	/*---------------------------------------------------------*/
	
	function get_all_player()
	{
			$this->db->select("players.player_id,players.image,players.name,players.position,position.position_name,country.country_name,players.created_date,players.rating,players.date_of_birth,players.status,players.type");
			$this->db->from('players');
			$this->db->join('position', 'position.position_id = players.position','left');
			$this->db->join('country', 'country.country_id = players.national','left');
			$this->db->order_by("players.type", "desc");
			$this->db->order_by("players.created_date", "desc");
			$query = $this->db->get();
			return $query;
	}
	function check_exist_player($id)
	{

			$this->db->select("*");
			$this->db->from('players');
			$this->db->where("player_id", $id);
			$query = $this->db->get();
			
			if($query->num_rows()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	
	
	function get_photo_player($id)
	{
		$this->db->select('*');
		$this->db->from('photos');
		$this->db->where('player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_video_player($id)
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_archievement_player($id)
	{
		$this->db->select('archievements.archievement_id,archievements.public,archievements.created_date,archievements.updated_date,archievements.title,archievements.description,archievements.year,archievements.player_id,players.name');
		$this->db->from('archievements');
		$this->db->join('players', 'players.player_id = archievements.player_id','left');
		$this->db->where('archievements.player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_nationcareer_player($id)
	{
		$this->db->select('international_career.international_career_id,international_career.matches,international_career.goals,international_career.assists,international_career.yellow_card,international_career.red_card,international_career.created_date, international_career.public,nation_team.national_team_id,nation_team.national_team_name,players.name,players.player_id');
		$this->db->from('international_career');
		$this->db->join('players', 'players.player_id = international_career.player_id','left');
		$this->db->join('nation_team', 'nation_team.national_team_id = international_career.national_id','left');
		$this->db->where('international_career.player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_nationcareer_player_notin($pid,$id)
	{
		$this->db->select('*');
		$this->db->from('international_career');
		$this->db->join('players', 'players.player_id = international_career.player_id','left');
		$this->db->join('nation_team', 'nation_team.national_team_id = international_career.national_id','left');
		$this->db->where('international_career.player_id', $pid);
		$this->db->where('international_career.international_career_id !=', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	
	function get_nationcareer_player_detail($id)
	{
		$this->db->select('*');
		$this->db->from('international_career');
		$this->db->join('nation_team', 'nation_team.national_team_id = international_career.national_id','left');
		$this->db->where('international_career.international_career_id', $id);
		$query = $this->db->get();		
		return $query;
	}	
	/*----------------- Club Career ------------------*/
	function get_clubcareer_player($id)
	{
		$this->db->select('club_career.club_career_id,club_career.matches,club_career.goals,club_career.assists,club_career.yellow_card,club_career.red_card,club_career.created_date, club_career.public,club.club_name,club.club_id,players.name,players.player_id');
		$this->db->from('club_career');
		$this->db->join('players', 'players.player_id = club_career.player_id','left');
		$this->db->join('club', 'club.club_id = club_career.club_id','left');
		$this->db->where('club_career.player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_clubcareer_player_notin($pid,$id)
	{
		$this->db->select('*');
		$this->db->from('club_career');
		$this->db->join('players', 'players.player_id = club_career.player_id','left');
		$this->db->join('club', 'club.club_id = club_career.club_id','left');
		$this->db->where('club_career.player_id', $pid);
		$this->db->where('club_career.club_career_id !=', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_clubcareer_player_detail($id)
	{
		$this->db->select('club_career.from_date,club_career.to_date,club_career.club_career_id,club_career.matches,club_career.goals,club_career.assists,club_career.yellow_card,club_career.red_card,club_career.created_date,club_career.updated_date,club_career.public,club.club_name,club.club_id');
		$this->db->from('club_career');
		$this->db->join('club', 'club.club_id = club_career.club_id','left');
		$this->db->where('club_career.club_career_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	/*------------------------------------------------*/
	
	/*----------------- Competition Career ------------------*/
	function get_competitioncareer_player($id)
	{
		$this->db->select('competition_career.competition_career_id,competition_career.matches,competition_career.goals,competition_career.assists,competition_career.yellow_card,competition_career.red_card,competition_career.created_date, competition_career.public,competition.competition_name,competition.competition_id,players.name,players.player_id');
		$this->db->from('competition_career');
		$this->db->join('players', 'players.player_id = competition_career.player_id','left');
		$this->db->join('competition', 'competition.competition_id = competition_career.competition_id','left');
		$this->db->where('competition_career.player_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_competitioncareer_player_notin($pid,$id)
	{
		$this->db->select('competition_career.competition_career_id,competition_career.matches,competition_career.goals,competition_career.assists,competition_career.yellow_card,competition_career.red_card,competition_career.created_date, competition_career.public,competition.competition_name,competition.competition_id,players.name,players.player_id');
		$this->db->from('competition_career');
		$this->db->join('players', 'players.player_id = competition_career.player_id','left');
		$this->db->join('competition', 'competition.competition_id = competition_career.competition_id','left');
		$this->db->where('competition_career.player_id', $pid);
		$this->db->where('competition_career.competition_career_id !=', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	
	function get_competitioncareer_player_detail($id)
	{
		$this->db->select('competition_career.from_date,competition_career.to_date,competition_career.competition_career_id,competition_career.matches,competition_career.goals,competition_career.assists,competition_career.yellow_card,competition_career.red_card,competition_career.created_date, competition_career.public,competition.competition_name,competition.competition_id,competition.competition_name,competition.competition_id');
		$this->db->from('competition_career');
		$this->db->join('competition', 'competition.competition_id = competition_career.competition_id','left');
		$this->db->where('competition_career.competition_career_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	/*------------------------------------------------*/
	
	function get_archievement_player_detail($id)
	{
		$this->db->select('*');
		$this->db->from('archievements');
		$this->db->join('players', 'players.player_id = archievements.player_id','left');
		$this->db->where('archievements.archievement_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_player_detail($id)
	{
			$this->db->select("*");
			$this->db->from('players');
			$this->db->where("players.player_id", $id);
			$query = $this->db->get();
			return $query;

	}
	
	function get_player($id)
	{
			$this->db->select("*, players.image as image");
			$this->db->from('players');
			$this->db->join('position', 'position.position_id = players.position','left');
			$this->db->join('country', 'country.country_id = players.national','left');
			$this->db->join('city', 'city.city_id = players.place_of_birth','left');
			$this->db->where("players.player_id", $id);
			$query = $this->db->get();
			return $query;

	}
	
	function get_name_player($id)
	{
			$this->db->select("*");
			$this->db->from('players');
			$this->db->where("players.player_id", $id);
			$query = $this->db->get();
			$_data = null;
			if($query->num_rows()>0)
			{
				$_data=$query->result_array();
			}
			if(isset($_data[0]))
				return $_data[0]['name'];
			else
				return ""; 
	}
	
	function player_photo_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
			$image = $data['data'];
			$description = $data['desimg'];
			$name = $data['nameimg'];
			
			$id=$data['currentid']; 
				
			$this->db->delete('photos', array('player_id' => $id));
			for($i=0;$i<count($image);$i++)
			{
				$this->db->set('player_id',$id);
				$this->db->set('image',$image[$i]);
				$this->db->set('photo_name',$name[$i]);
				$this->db->set('description',$description[$i]);
				$this->db->insert('photos');
			}
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function player_video_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['currentid']!='') // update
		{
			$id=$data['currentid']; 
			if($data['update']==1)
			{
				$this->db->where('player_id',$id);
				$this->db->set('video_name',$data['video_name']);
				$this->db->set('video_link',$data['video_link']);
				$this->db->update('videos'); 
			}
			else
			{
				$this->db->set('player_id',$id);
				$this->db->set('video_name',$data['video_name']);
				$this->db->set('video_link',$data['video_link']);
				$this->db->insert('videos'); 
			}
		}

		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function player_archievement_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['player_id']!='') 
		{
			$id=$data['currentid']; 
			if($id!='')// update
			{
				$this->db->where('archievement_id',$id);
				$this->db->set('title',$data['title']);
				$this->db->set('description',$data['description']);
				$this->db->set('year',$data['year']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('archievements'); 
			}
			else
			{
				$this->db->set('player_id',$data['player_id']);
				$this->db->set('title',$data['title']);
				$this->db->set('description',$data['description']);
				$this->db->set('year',$data['year']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('archievements'); 
			}
		}

		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function player_nation_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['player_id']!='') 
		{
			$id=$data['currentid']; 
			if($id!='')// update
			{
				$this->db->where('international_career_id',$id);
				$this->db->set('national_id',$data['national']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('international_career'); 
			}
			else
			{
				$this->db->set('player_id',$data['player_id']);
				$this->db->set('national_id',$data['national']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('international_career'); 
			}
		}

		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function player_club_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['player_id']!='') 
		{
			$id=$data['currentid']; 
			if($id!='')// update
			{
				$this->db->where('club_career_id',$id);
				$this->db->set('club_id',$data['club']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('club_career'); 
			}
			else
			{
				$this->db->set('player_id',$data['player_id']);
				$this->db->set('club_id',$data['club']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('club_career'); 
			}
		}

		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function player_competition_manipulate($data)
	{
		$this->db->trans_start(); 
		if($data['player_id']!='') 
		{
			$id=$data['currentid']; 
			if($id!='')// update
			{
				$this->db->where('competition_career_id',$id);
				$this->db->set('competition_id',$data['competition']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('competition_career'); 
			}
			else
			{
				$this->db->set('player_id',$data['player_id']);
				$this->db->set('competition_id',$data['competition']);
				$this->db->set('matches',$data['matches']);
				$this->db->set('goals',$data['goals']);
				$this->db->set('from_date',strtotime($data['from_date']));
				$this->db->set('to_date',strtotime($data['to_date']));
				$this->db->set('assists',$data['assists']);
				$this->db->set('yellow_card',$data['yellow_card']);
				$this->db->set('red_card',$data['red_card']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('competition_career'); 
			}
		}

		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function player_manipulate($data)
	{
		$this->db->trans_start(); 

		if($data['currentid']!='') // update
		{
				$id=$data['currentid']; 
				$this->db->where('player_id',$id);
				$this->db->set('name',$data['name']);
				$this->db->set('date_of_birth',strtotime($data['birthday']));
				if(isset($data['city']))
                                   $city = $data['city'];
                                else
                                   $city = 0;
			        $this->db->set('place_of_birth',$city );
                                if(isset($data['country']))
                                   $country= $data['country'];
                                else
                                   $country = 0;
                                $this->db->set('country_of_birth',$country);
				$this->db->set('national',$data['national']);
				$this->db->set('position',$data['position']);
				$this->db->set('height',$data['height']);
				$this->db->set('weight',$data['weight']);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
					
				$this->db->set('foot',$data['foot']);
				$this->db->set('current_club_id',$data['club']);
				$this->db->set('rating',$data['rating']);
				$this->db->set('player_agent',$data['player_agent']);
				$this->db->set('type',$data['vip']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('players'); 
		}
		else	//add
		{
				$this->db->set('name',$data['name']);
				$this->db->set('date_of_birth',strtotime($data['birthday']));
				if(isset($data['city']))
                                   $city = $data['city'];
                                else
                                   $city = 0;
			        $this->db->set('place_of_birth',$city );
                                if(isset($data['country']))
                                   $country= $data['country'];
                                else
                                   $country = 0;
                                $this->db->set('country_of_birth',$country);
				$this->db->set('national',$data['national']);
				$this->db->set('position',$data['position']);
				$this->db->set('height',$data['height']);
				$this->db->set('weight',$data['weight']);
				if($data['image']!="")
					$this->db->set('image',$data['image']);
					
				$this->db->set('foot',$data['foot']);
				$this->db->set('current_club_id',$data['club']);
				$this->db->set('rating',$data['rating']);
				$this->db->set('player_agent',$data['player_agent']);
				$this->db->set('type',$data['vip']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('players'); 
			
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
/*-------------------------------------------------------------------------------*/
	
	function get_country_detail($id)
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_id', $id);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_country()
	{
		$this->db->select("*");
		$this->db->from('country');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_all_country_by_public()
	{
		$this->db->select("*");
		$this->db->from('country');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	function check_exist_country($name,$id)
	{

			$this->db->select("*");
			$this->db->from('country');
			$this->db->where("country_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['country_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function country_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('country_id',$id);
				$this->db->set('country_name',$data['country_name']);
				$this->db->set('country_code',$data['country_code']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('country'); 
		}
		else	//add
		{
				$this->db->set('country_name',$data['country_name']);
				$this->db->set('country_code',$data['country_code']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}	
				$this->db->set('created_date',time());
				$this->db->insert('country'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
/*-------------------------------------------------------------------------------*/
	
/*-------------------------------------------------------------------------------*/
	
	function get_city_detail($id)
	{
		$this->db->select('country.country_id,region.region_id,city.city_id,city.city_name,city.public,region.region_name,country.country_name');
		$this->db->from('city');
		$this->db->join('region', 'region.region_id = city.region_id');
		$this->db->join('country', 'country.country_id = region.country_id');
		$this->db->where('city.city_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	function get_city_by_region_id($id)
	{
		$this->db->select("city.city_id,city_name");
		$this->db->from('city');
		$this->db->join('region', 'region.region_id = city.region_id');
		$this->db->join('country', 'country.country_id = region.country_id');
		$this->db->where('city.region_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_region_by_country_id($id)
	{
		$this->db->select("region.region_id,region.region_name");
		$this->db->from('region');
		$this->db->join('country', 'country.country_id = region.country_id');
		$this->db->where('region.country_id',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_region_detail($id)
	{
		$this->db->select('region.region_id,region.region_name,country.country_name,region.created_date,region.public,region.country_id');
		$this->db->from('region');
		$this->db->join('country', 'country.country_id = region.country_id');
		$this->db->where('region.region_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	
	function get_list_city_by_country_public($id)
	{
		$this->db->select('city.public,city.city_id,city.city_name,city.created_date, country.country_name,country.country_id');
		$this->db->from('city');
		$this->db->join('country', 'country.country_id = city.country_id');
		$this->db->where('country.country_id', $id);
		$this->db->where('city.public',1);
		$query = $this->db->get();		
		return $query;
	}
	
	function check_exist_city($name,$id,$region_id)
	{

			$this->db->select("*");
			$this->db->from('city');
			$this->db->where("city_name", $name);
			$this->db->where("region_id", $region_id);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['city_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	function check_exist_region($name,$id,$country_id)
	{

			$this->db->select("*");
			$this->db->from('region');
			$this->db->where("region_name", $name);
			$this->db->where("country_id", $country_id);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['region_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function city_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				$id=$data['currentid']; 
				$this->db->where('city_id',$id);
				$this->db->set('city_name',$data['city_name']);
				$this->db->set('region_id',$data['region_id']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('updated_date',time());
				$this->db->update('city'); 
		}
		else	//add
		{
				$this->db->set('region_id',$data['region_id']);
				$this->db->set('city_name',$data['city_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('city'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	function get_extension_download_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('downloads');
		$this->db->where('extension_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}	
	function region_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				$id=$data['currentid']; 
				$this->db->where('region_id',$id);
				$this->db->set('region_name',$data['region_name']);
				$this->db->set('country_id',$data['country_id']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->update('region'); 
		}
		else	//add
		{
				$this->db->set('country_id',$data['country_id']);
				$this->db->set('region_name',$data['region_name']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('region'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	/*-------------------------------------------------------------------------------*/
 	function get_all_order($start,$end)
 	{
 		$this->db->select('order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 		
 		$this->db->from('order');
		$this->db->join('users',"users.user_id=order.user_id");
		if($start!=null)
			$this->db->where('order.created_date >=', $start);
		if($end!=null)
			$this->db->where('order.created_date <=', $end);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
	function get_order_detail($id)
 	{
 		$this->db->select('*'); 		
 		$this->db->from('order');
		$this->db->where('order.order_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
 	
 	
	function get_all_purchase_order()
 	{
 		$this->db->select('order.commission,order.total_balance,order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 		
 		$this->db->from('order');
		$this->db->join('users',"users.user_id=order.user_id");
		$this->db->where('order.status', 1);
		$this->db->where('order.payment_release',0);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
	function get_all_not_commission()
 	{
 		$this->db->select('order.commission,order.total_balance,order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 		
 		$this->db->from('order');
		$this->db->join('users',"users.user_id=order.user_id");
		$this->db->where('order.status', 1);
		$this->db->where('order.payment_release',0);
		$this->db->where('order.commission',0);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
 	
 	
	function get_all_purchase_release()
 	{
 		$this->db->select('order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id,users.paypal'); 		
 		$this->db->select_sum('order.total_balance');
 		$this->db->from('order');
 		$this->db->join('extensions',"order.extension_id=extensions.extension_id");
		$this->db->join('users',"users.user_id=extensions.user_id");
		$this->db->where('order.status', 1);
		$this->db->where('order.payment_release',0);
		$this->db->group_by('extensions.user_id');
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
	function get_all_purchase_release_user_id($id)
 	{
 		$this->db->select('order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 
 		$this->db->from('order');
 		$this->db->join('extensions',"order.extension_id=extensions.extension_id");
		$this->db->join('users',"users.user_id=extensions.user_id");
		$this->db->where('order.status', 1);
		$this->db->where('order.payment_release',0);
		$this->db->where('extensions.user_id',$id);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
 	
	function get_recent_order($limit)
 	{
 		$this->db->select('order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 		
 		$this->db->from('order');
		$this->db->join('users',"users.user_id=order.user_id");
		$this->db->order_by("order.created_date", "desc");
		$this->db->limit($limit);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
 	
	function get_total_earning()
 	{
 		$this->db->select('*');
		$this->db->select_sum('order.total_price', 'total_price');
 		$this->db->from('order');
 		$this->db->join('extensions',"order.extension_id=extensions.extension_id");
		$this->db->join('users',"users.user_id=extensions.user_id");
		$this->db->where('order.payment_release',1);
		$this->db->where('order.status',1);
		$this->db->group_by('extensions.user_id');
		$query = $this->db->get();		
		return $query->result_array();
 	}
	function edit_user($id,$data=null){
		
		$this->db->where('user_id', $id);
        $this->db->update('users', $data);
        return true;
    }
    
	function edit_setting($id,$data=null){
		$this->db->where('id', 1);
        $this->db->update('setting', $data);
        return true;
    }
    
    function get_website_info()
    {
    	$this->db->select('*');
 		$this->db->from('setting');
		$query = $this->db->get();		
		return $query->result_array();
    }
	
    /*----------------------------- Start Newsletter block---------------------------------*/
	
	function get_newsletter_manager($totalrow='')
	{
		if ($totalrow=="totalrows")
		{
			
			$sql ="SELECT count(*) as result from newsletter";
			$query = $this->db->query($sql);
			foreach ($query->result() as $row)
				return $row->result;
		}
		else
		{
				$this->db->select("*");
				$this->db->from('newsletters');
			$query = $this->db->get();
			return $query;
		}
	}
	function newsletter_manipulate($data)
	{
		$this->db->trans_start(); 
		
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 	
				$this->db->where('id',$id);
				$this->db->set('title',$data['title']);
				$this->db->set('content',$data['content']);
				$this->db->set('type',$data['type']);
				$this->db->set('date_created',time());
				$this->db->update('newsletters'); 
		}
		else	//add
		{
				$this->db->set('title',$data['title']);
				$this->db->set('content',$data['content']);
				$this->db->set('sent',0);
				$this->db->set('type',$data['type']);
				$this->db->set('date_created',time());
				$this->db->insert('newsletters'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	function get_newsletter_detail($id)
	{
		$this->db->select('*');
		$this->db->from('newsletters');
		$this->db->where('id', $id);
		$query = $this->db->get();		
		return $query;
	}
	
	function get_allsubscribers()
	{

			$this->db->select("*");
			$this->db->from('subscribers');
			$this->db->order_by("date", "desc");
			$query = $this->db->get();
			return $query;

	}
	/*----------------------------- End Newsletter block---------------------------------*/
 	/*----------------------------------- START CATEGORY --------------------------------------------*/
	
	function get_language_detail($id)
	{
		$this->db->select('*');
		$this->db->from('languages');
		$this->db->where('language_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	function get_all_language()
	{
		$this->db->select("*");
		$this->db->from('languages');
		$this->db->order_by('default','DESC');
		$this->db->order_by('sort_order','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	
	function get_all_language_by_public()
	{
		$this->db->select("*");
		$this->db->from('languages');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
	function check_exist_language($name,$id)
	{

			$this->db->select("*");
			$this->db->from('languages');
			$this->db->where("language_name", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['language_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function language_manipulate($data)
	{
		$this->db->trans_start(); 
		if(isset($data['default']))
		{
			$this->db->select("*");
			$this->db->from('languages');
			$query = $this->db->get();
			$datas =  $query->result_array();
			if($datas !=null)
			{
				foreach($datas as $da)
				{
					$this->db->where('language_id',$da['language_id']);
					$this->db->set('default',0);
					$this->db->update('languages'); 
				}
			}
		}
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('language_id',$id);
				$this->db->set('language_name',$data['language_name']);
				$this->db->set('code',$data['code']);
				$this->db->set('sort_order',$data['sort_order']);
				
				$this->db->set('image', $data['image']);
				if(isset($data['default']))
					$this->db->set('default',$data['default']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->update('languages'); 
		}
		else	//add
		{
				$this->db->set('language_name',$data['language_name']);
				$this->db->set('code',$data['code']);
				$this->db->set('sort_order',$data['sort_order']);
				$this->db->set('image', $data['image']);
				if(isset($data['default']))
					$this->db->set('default',$data['default']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('public',$data['active']);
				}
				$this->db->set('created_date',time());
				$this->db->insert('languages'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	/*--------------------------------- END CATEGORY ------------------------------------*/
	
	/*----------------------------------- START CATEGORY --------------------------------------------*/
	
	function get_currency_detail($id)
	{
		$this->db->select('*');
		$this->db->from('currency');
		$this->db->where('currency_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	function get_all_currency()
	{
		$this->db->select("*");
		$this->db->from('currency');
		$this->db->order_by('default','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	
	function get_all_currency_by_public()
	{
		$this->db->select("*");
		$this->db->from('currency');
		$this->db->where('public',1);
		$query = $this->db->get();
		return $query;
	}
	
	function check_exist_currency($name,$id)
	{

			$this->db->select("*");
			$this->db->from('currency');
			$this->db->where("title", $name);
			$query = $this->db->get();
			
				if($query->num_rows()>0)
				{
					$data = $query->result_array();
					if($data[0]['currency_id']!=$id)
						return true;
					else
						return false;
				}
				else
				{
					return false;
				}
	}
	
	function currency_manipulate($data)
	{
		$this->db->trans_start(); 
		if(isset($data['default']))
		{
			$this->db->select("*");
			$this->db->from('currency');
			$query = $this->db->get();
			$datas =  $query->result_array();
			if($datas !=null)
			{
				foreach($datas as $da)
				{
					$this->db->where('currency_id',$da['currency_id']);
					$this->db->set('default',0);
					$this->db->update('currency'); 
				}
			}
		}
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				
				$this->db->where('currency_id',$id);
				$this->db->set('title',$data['title']);
				$this->db->set('code',$data['code']);
				$this->db->set('symbol_left',$data['symbol_left']);
				$this->db->set('symbol_right',$data['symbol_right']);
				$this->db->set('decimal_place',$data['decimal_place']);
				$this->db->set('value',$data['value']);
				$this->db->set('last_updated',time());
			
				if(isset($data['default']))
					$this->db->set('default',$data['default']);
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->update('currency'); 
		}
		else	//add
		{
				$this->db->set('title',$data['title']);
				$this->db->set('code',$data['code']);
				$this->db->set('symbol_left',$data['symbol_left']);
				$this->db->set('symbol_right',$data['symbol_right']);
				$this->db->set('decimal_place',$data['decimal_place']);
				$this->db->set('value',$data['value']);
				$this->db->set('last_updated',time());
			
				if(isset($data['default']))
					$this->db->set('default',$data['default']);
				else
					$this->db->set('default',0);
					
				if ($this->session->userdata('group') == 1) {
				$this->db->set('status',$data['active']);
				}
				$this->db->insert('currency'); 
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
	/*--------------------------------- END CATEGORY ------------------------------------*/
 	function update_total_extension_category($id,$data){
    	$this->db->where('category_id', $id);
        $this->db->update('category', $data);
        return true;
    }
    
	function get_category_by_category_id($id)
    {
    	 $this->db->select('*');
    	$this->db->from('category');
    	$this->db->where('category_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }

/*---------------------------------------------------------*/
	function get_all_article($type='')
	{
			$this->db->select("*");
			$this->db->from('article');
			if($type!=null)
			$this->db->where("type", $type);
			$this->db->order_by("order", "asc");
			$this->db->order_by("created_date", "desc");
			$query = $this->db->get();
			return $query;
	}
	
	function get_all_article_by_parent($parent='')
	{
		$this->db->select("*");
		$this->db->from('article');
		$this->db->where("parent", $parent);
		$this->db->order_by("order", "asc");
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		return $query;
	}
	
	
	function get_parent_page()
	{
		$this->db->select("*");
		$this->db->from('article');
		$this->db->where("parent", 0);
		$this->db->order_by("order", "asc");
		$this->db->order_by("created_date", "desc");
		$query = $this->db->get();
		return $query;
	}
	
	function get_article($id)
	{
			$this->db->select("*");
			$this->db->from('article');
			$this->db->where("article_id", $id);
			$query = $this->db->get();
			return $query;

	}
	
	function get_article_by_type($id)
	{
			$this->db->select("*");
			$this->db->from('article');
			$this->db->where("type", $id);
			$query = $this->db->get();
			return $query;

	}
	
	
	function article_manipulate($data)
	{
		$this->db->trans_start(); 
	
		if($data['currentid']!='') // update
		{
				
				$id=$data['currentid']; 
				$this->db->where('article_id',$id);
				$this->db->set('created_date',time());
				$this->db->set('public',$data['active']);
				$this->db->set('order',$data['order']);
				$this->db->set('name',$data['name']);
				$this->db->set('parent',$data['parent']);
				$this->db->set('content',$data['content']);
				$this->db->update('article'); 
				
		}
		else	//add
		{
				$this->db->set('created_date',time());
				$this->db->set('public',$data['active']);
				$this->db->set('order',$data['order']);
				$this->db->set('name',$data['name']);
				$this->db->set('parent',$data['parent']);
				$this->db->set('content',$data['content']); 
				$this->db->insert('article'); 
			
		}
		$this->db->trans_complete();
		// end TRANSACTION			
		if ($this->db->trans_status() == FALSE)
		{
			return 0;
		} 
		else
		{
			return 1;
		}
	}
	
/*---------------------------------------------------------*/
	function edit_commission_setting($order_id,$data=null){
       $this->db->where('order_id', $order_id);
       $this->db->update('order', $data);
       return true;
    }
    
	function edit_setting_setting($id,$data=null){
       $this->db->where('id', $id);
       $this->db->update('setting', $data);
       return true;
    }
    
	function get_total_view()
	{
			$this->db->select("*");
			$this->db->select_sum("views");
			$this->db->from('extensions');
			$this->db->group_by('extensions.extension_id');
			$query = $this->db->get();
			return  $query->result_array();

	}
	
	function get_total_price_by_date($start_date,$end_date)
	{
			$this->db->select_sum("total_price");
			$this->db->from('order');
			$this->db->where('created_date >=',$start_date);
			$this->db->where('created_date <',$end_date);
			$query = $this->db->get();
			return  $query->result_array();

	}
	
	public function restore($sql) {
		foreach (explode(";\n", $sql) as $sql) {
    		$sql = trim($sql);
    		
			if ($sql) {
      			$this->db->query($sql);
    		}
  		}
	}
	
	public function getTables() {
		$table_data = array();
		
		$query = $this->db->query("SHOW TABLES FROM ci_buysellscript");
		
		foreach ($query->result_array() as $result) {
				if (isset($result['Tables_in_ci_buysellscript'])) {
					$table_data[] = $result['Tables_in_ci_buysellscript'];
				}
		}
		return $table_data;
	}
	
	public function backup($tables) {
		$output = '';
		foreach ($tables as $table) {

				$status = true;
			
			if ($status) {
				$output .= 'TRUNCATE TABLE `' . $table . '`;' . "\n\n";
			
				$query = $this->db->query("SELECT * FROM `" . $table . "`");
				foreach ($query->result_array() as $result) {
					$fields = '';
					
					foreach (array_keys($result) as $value) {
						$fields .= '`' . $value . '`, ';
					}
					
					$values = '';
					
					foreach (array_values($result) as $value) {
						$value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
						$value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
						$value = str_replace('\\', '\\\\',	$value);
						$value = str_replace('\'', '\\\'',	$value);
						$value = str_replace('\\\n', '\n',	$value);
						$value = str_replace('\\\r', '\r',	$value);
						$value = str_replace('\\\t', '\t',	$value);			
						
						$values .= '\'' . $value . '\', ';
					}
					
					$output .= 'INSERT INTO `' . $table . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ');' . "\n";
				}
				
				$output .= "\n\n";
			}
		}

		return $output;	
	}
	
	function upload_image($name,$type,$size)
 	{
 		
 		$configi['upload_path'] = './upload_file/'.$type.'/';
		$configi['allowed_types'] = 'gif|jpg|jpeg|png';
		$configi['max_size']	= $size;//'2408000';
		$this->load->library('upload', $configi);
		$this->upload->initialize($configi);
 		if($_FILES[$name]['name'])
		{
			if ( $this->upload->do_upload($name))
			{	
				$datax1=$this->upload->data();
				$datax1['file_name'] = $configi['upload_path'].$datax1['file_name'];
			}
			else
			{
				echo $this->upload->display_errors('<p>', '</p>');
					//return -1;
				die();
			}
		}
		else
		{
			$datax1['file_name']=NULL;				
		}
		return  $datax1['file_name'];
 	}
 	
	function upload_file($name,$type,$size)
 	{
 		
 		$configq['upload_path'] = './upload_file/'.$type.'/';
		$configq['allowed_types'] = 'zip|rar';
		$configq['max_size']	= $size;//'2408000';
		$this->load->library('upload', $configq);
		
			if($_FILES[$name]['name'])
			{
				if ( $this->upload->do_upload($name))
				{	
					$datax1=$this->upload->data();
					$datax1['file_name'] = $configq['upload_path'].$datax1['file_name'];
				}
				else
				{
					echo $this->upload->display_errors('<p>', '</p>');
						//return -1;
					die();
				}
			}
			else
			{
				$datax1['file_name']=NULL;				
			}
			
		return  $datax1['file_name'];
 	}
 	public function updateCurrencies($force = false) {

			$data = array();
			
			if ($force) {
				$query = $this->db->query("SELECT * FROM currency WHERE code != 'USD'");
			} else {
				$query = $this->db->query("SELECT * FROM currency WHERE code != 'USD' AND last_updated < '" .  $this->db->escape(time()-60*60*24) . "'");
			}
			
			foreach ($query->result_array() as $result) {
				$data[] = 'USD' . $result['code'] . '=X';
			}	
			
			$curl = curl_init();
			
			curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data) . '&f=sl1&e=.csv');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			$content = curl_exec($curl);
			
			curl_close($curl);
			
			$lines = explode("\n", trim($content));
				
			foreach ($lines as $line) {
				$currency = utf8_substr($line, 4, 3);
				$value = utf8_substr($line, 11, 6);
				
				if ((float)$value) {
					$this->db->query("UPDATE currency SET value = '" . (float)$value . "', last_updated = '" . time() . "' WHERE code = " . $this->db->escape($currency) . "");
				}
			}
			
			$this->db->query("UPDATE currency SET value = '1.00000', last_updated = '" .  time() . "' WHERE code = " . $this->db->escape('USD') . "");
			


	}
	
}