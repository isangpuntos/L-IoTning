<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class General_Model extends CI_Model 
{    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function send_email_signup($data, $html, $config)
    {
        $to = $data['email'];
        $from = 'info@buysell.com';
        $subject = 'Successfully Register from buysell';
        $body = $html;
    
        /*
         * Send mail
        */
        $this->load->library('email');
        $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $config['smtp_host'],
                'smtp_port' => $config['smtp_port'],
                'smtp_user' => $config['smtp_username'],
                'smtp_pass' => $config['smtp_password'],
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n",
                'charset'   => 'utf-8'
        );
    
        $this->email->initialize($config);
        try {
            $this->email->clear();
            $this->email->to($to);
            $this->email->from($from);
            $this->email->subject($subject);
            $this->email->message($body);
            $this->email->send();
        }catch (Exception $e){
        }
    }
    
    function insert_user($data=null,$custom = null){
        $this->db->insert('users', $data);
        $id = $this->db->insert_id();
    	if($custom!=null)
		{
			foreach($custom as $key=>$value)
			{
				$this->db->set('user_id',$id);
				$this->db->set('value_id',$key);
				$this->db->set('property_value',$value);
				$this->db->insert('user_property'); 
			}
		}
        return $id;
    }
    
	function insert_comment($data=null){
        $this->db->insert('comments', $data);
        return $this->db->insert_id();
    }
    
	function insert_order($data=null){
        $this->db->insert('order', $data);
        return 1;
    }
    
	function insert_user_buy($data=null){
        $this->db->insert('users_buy_extensions', $data);
        return 1;
    }
	function insert_user_download($data=null){
        $this->db->insert('download_user', $data);
        return 1;
    }
    
	function insert_user_buy_extension($data=null){
        $this->db->insert('users_buy_extensions', $data);
        return 1;
    }
    function get_download_user($download_id,$user_id)
    {
    	$this->db->select('*');
    	$this->db->from('download_user');
        $this->db->where('user_id',$user_id);
        $this->db->where('download_id',$download_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
	function get_user_like($user_id,$ex_id)
    {
    	$this->db->select('*');
    	$this->db->from('user_like');
        $this->db->where('user_id',$user_id);
        $this->db->where('extension_id',$ex_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
	function update_user_download($user_id,$download_id,$data=null){
       $this->db->where('user_id', $user_id);
       $this->db->where('download_id', $download_id);
       $this->db->update('download_user', $data);
       return true;
    }

    function update_order($order_id,$data=null){
       $this->db->where('order_id', $order_id);
       $this->db->update('order', $data);
       return true;
    }
    
    
	function update_user_buy($user_id,$extension_id,$data=null){
       $this->db->where('user_id', $user_id);
       $this->db->where('extension_id', $extension_id);
       $this->db->update('users_buy_extensions', $data);
       return true;
    }
    
	function insert_notify($data=null){
        $this->db->insert('notifications', $data);
        return true;
    }
    
	function insert_user_like($data=null){
        $this->db->insert('user_like', $data);
	
        return true;
    }
    
	function edit_user($id,$data=null,$custom=null){
		
		$image = $this->upload_image('image','users','2408000');
		if($image!=null)
		$this->db->set('avatar', $image);
		$this->db->where('user_id', $id);
        $this->db->update('users', $data);
        if($custom!=null)
				{
					$this->db->delete('user_property', array('user_id' => $id));
					foreach($custom as $key=>$value)
					{
						$this->db->set('user_id',$id);
						$this->db->set('value_id',$key);
						$this->db->set('property_value',$value);
						$this->db->insert('user_property'); 
					}
				}
        return true;
    }
    
    function edit_pass($id,$data=null){
    
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        return true;
    }
    
	function update_extension($id,$data){
		
		$this->db->where('extension_id', $id);
        $this->db->update('extensions', $data);
        return true;
    }
    
 	function update_total_extension_category($id,$data){
    	$this->db->where('category_id', $id);
        $this->db->update('category', $data);
        return true;
    }
    

    function edit_notify($id,$data=null){
		
		$this->db->where('user_id', $id);
        $this->db->update('notifications', $data);
        return true;
    }
    
	function update_total_download($id,$total){
		
		$this->db->where('download_id', $id);
        $this->db->update('downloads', array("downloads"=>$total));
        return true;
    }
    
	function update_total_download_extension($id,$total){
		
		$this->db->where('extension_id', $id);
        $this->db->update('extensions', array("download"=>$total));
        return true;
    }

	function get_user_by_user_id($id)
    {
    	//$this->db->select('users.company,users.address1,users.address2,users.post_code,users.website,users.avatar,users.phone,users.paypal,users.payment_id,users.username,users.firstname,users.lastname,users.email,city.city_id,city.city_name,region.region_id,region.region_name,country.country_id,country.country_name');
        $this->db->select('*');
    	$this->db->from('users');
        $this->db->where('user_id',$id);
        $result = $this->db->get();
        return $result->result_array();

    }
    
    function get_user_by_user_id_invoice($id)
    {
    	//$this->db->select('users.company,users.address1,users.address2,users.post_code,users.website,users.avatar,users.phone,users.paypal,users.payment_id,users.username,users.firstname,users.lastname,users.email,city.city_id,city.city_name,region.region_id,region.region_name,country.country_id,country.country_name');
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->join('city', 'users.city_id = city.city_id','left');
    	$this->db->join('region', 'region.region_id = city.region_id','left');
    	$this->db->join('country', 'country.country_id = region.region_id','left');
    	$this->db->where('user_id',$id);
    	$result = $this->db->get();
    	return $result->result_array();
    
    }	function get_all_edit_extension_by_user_id($id,$limit,$offset)    {        $this->db->select('extensions.extension_id,extensions.public,extensions.status,extensions.created_date,extensions.download,extensions.image,extensions.description,extensions.price,extensions.name,extensions.views,extensions.like,extensions.dislike,users.username,category.category_name');    	$this->db->from('extensions');    	$this->db->join('users', 'extensions.user_id = users.user_id');    	$this->db->join('category', 'category.category_id = extensions.category_id');		$this->db->where('users.active',1);        $this->db->where('extensions.user_id',$id);        if($limit!=null) $this->db->limit($limit,$offset);        $result = $this->db->get();        return $result->result_array();    }	
	function get_all_extension_by_user_id($id,$limit,$offset)
    {
        $this->db->select('extensions.extension_id,extensions.public,extensions.status,extensions.created_date,extensions.download,extensions.image,extensions.description,extensions.price,extensions.name,extensions.views,extensions.like,extensions.dislike,users.username,category.category_name');
    	$this->db->from('extensions');
    	$this->db->join('users', 'extensions.user_id = users.user_id');
    	$this->db->join('category', 'category.category_id = extensions.category_id');
    	$this->db->where('extensions.status',1);
    	$this->db->where('extensions.public',1);
		$this->db->where('users.active',1);
        $this->db->where('extensions.user_id',$id);
        if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();

    }
    
    function get_all_address_by_user_id($id,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from('address');
        $this->db->join('country', 'country.country_id = address.country_id');
        $this->db->where('user_id',$id);
        if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();
    
    }
    
	function get_all_extension($limit,$offset,$sort,$order)
    {
    	//$this->db->select('users.company,users.address1,users.address2,users.post_code,users.website,users.avatar,users.phone,users.paypal,users.payment_id,users.username,users.firstname,users.lastname,users.email,city.city_id,city.city_name,region.region_id,region.region_name,country.country_id,country.country_name');
        $this->db->select('extensions.extension_id,extensions.image,extensions.description,extensions.price,extensions.name,extensions.views,extensions.like,extensions.dislike,users.username,category.category_name');
    	$this->db->from('extensions');
    	$this->db->join('users', 'extensions.user_id = users.user_id');
    	$this->db->join('category', 'category.category_id = extensions.category_id');
    	$this->db->where('extensions.status',1);
    	$this->db->where('extensions.public',1);
        if($limit!=null) $this->db->limit($limit,$offset);

        if($sort!=null && $sort!="")$this->db->order_by('extensions.'.$sort, $order); 
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_all_extension_by_search($data,$limit,$offset,$sort,$order)
    {		
    	$this->db->distinct();
    	$this->db->select('downloads.list_com,extensions.extension_id,extensions.image,extensions.description,extensions.price,extensions.name,extensions.views,extensions.like,extensions.dislike,users.username,category.category_id,category.category_name');
    	$this->db->from('extensions');
    	$this->db->join('users', 'extensions.user_id = users.user_id');
    	$this->db->join('category', 'category.category_id = extensions.category_id');
    	$this->db->join('downloads', 'downloads.extension_id = extensions.extension_id');
    	$this->db->where('extensions.status',1);
    	$this->db->where('extensions.public',1);
    	$this->db->where('category.public',1);
    	$this->db->where('users.active',1);
    	if($data!=null && isset($data['license']))
    		$this->db->where('extensions.license_id',$data['license']);
    	if($data!=null && isset($data['category']))
    		$this->db->where('extensions.category_id',$data['category']);
    	if($data!=null && isset($data['search']))
    	{
    		$where = "( extensions.name LIKE '%".$data['search']."%' OR extensions.description LIKE '%".$data['search']."%' OR extensions.document LIKE '%".$data['search']."%' OR extensions.price LIKE '%".$data['search']."%' OR users.username LIKE '%".$data['search']."%' )";
    		$this->db->where($where);
    	}
    	
        if($limit!=null) $this->db->limit($limit,$offset);

        if($sort!=null && $sort!="")$this->db->order_by('extensions.'.$sort, $order); 
        $result = $this->db->get();
        return $result->result_array();
    }
    
	function get_all_relate_extension($extension_id,$category_id,$limit,$offset,$sort,$order)
    {
        $this->db->select('extensions.extension_id,extensions.image,extensions.description,extensions.price,extensions.name,extensions.views,extensions.like,extensions.dislike,users.username,category.category_name');
    	$this->db->from('extensions');
    	$this->db->join('users', 'extensions.user_id = users.user_id');
    	$this->db->join('category', 'category.category_id = extensions.category_id');
    	$this->db->where('extensions.extension_id !=',$extension_id);
    	$this->db->where('category.category_id',$category_id);
    	$this->db->where('extensions.status',1);
    	$this->db->where('extensions.public',1);
        if($limit!=null) $this->db->limit($limit,$offset);
        if($sort!=null && $sort!="")$this->db->order_by('extensions.'.$sort, $order); 
        $result = $this->db->get();
        return $result->result_array();
    }
    
    function get_extension_by_extension_id($id)
    {
    	$this->db->select('extensions.shipping,extensions.weight,extensions.priceperweight,extensions.image,extensions.extension_id,extensions.link_preview,extensions.name,extensions.description,extensions.category_id,extensions.document,extensions.created_date,extensions.updated_date,extensions.price,extensions.votes,extensions.views,license.license_name,users.username,extensions.user_id,extensions.comment,extensions.download,extensions.views,extensions.votes,extensions.like,extensions.dislike');
    	$this->db->from('extensions');
    	$this->db->join('users', 'extensions.user_id = users.user_id',"left");
    	$this->db->join('license', 'license.license_id = extensions.license_id','left');
    	$this->db->where('license.public',1);
    	$this->db->where('users.active',1);
    	$this->db->where('extensions.status',1);
    	$this->db->where('extensions.public',1);
    	$this->db->where('extensions.extension_id',$id);
    	$result = $this->db->get();
        return $result->result_array();
    }
    
	
    
    
	function get_all_download_by_user_id($id,$limit,$offset)
    {
    	//$this->db->select('users.company,users.address1,users.address2,users.post_code,users.website,users.avatar,users.phone,users.paypal,users.payment_id,users.username,users.firstname,users.lastname,users.email,city.city_id,city.city_name,region.region_id,region.region_name,country.country_id,country.country_name');
        $this->db->distinct();
    	$this->db->select('downloads.download_id,extensions.extension_id,extensions.name,extensions.description,extensions.image,extensions.price,extensions.votes,extensions.comment');
    	$this->db->from('extensions');
    	$this->db->join('downloads', 'downloads.extension_id = extensions.extension_id','left');
    	$this->db->join('download_user', 'downloads.download_id = download_user.download_id','left');
    	$this->db->join('users_buy_extensions', 'users_buy_extensions.extension_id = extensions.extension_id','left');
        $this->db->where('users_buy_extensions.user_id',$id);
        if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();

    }
    
	function get_all_download_by_extension_id($id)
    {
    	$this->db->select('*');
    	$this->db->from('downloads');
        $this->db->where('downloads.extension_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
	function get_download_by_id($id)
    {
    	$this->db->select('*');
    	$this->db->from('downloads');
        $this->db->where('downloads.download_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    
	function get_all_image_by_extension_id($id)
    {
    	$this->db->select('*');
    	$this->db->from('gallery');
        $this->db->where('reference_id',$id);
        $this->db->where('type',1);
        $result = $this->db->get();
        return $result->result_array();

    }

    function get_all_image($id,$type)
    {
        $this->db->select('*');
        $this->db->from('gallery');
        $this->db->where('reference_id',$id);
        $this->db->where('type',$type);
        $result = $this->db->get();
        return $result->result_array();

    }
    
	function get_all_order_by_user_id($id,$limit,$offset)
    {
    	$this->db->select('*');
    	$this->db->from('order');
        $this->db->where('order.user_id',$id);
        $this->db->order_by('order.created_date DESC');
        if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();

    }
    function get_all_sale_by_user_id($id,$limit,$offset)
    {
       $this->db->select('order.total_balance,order.order_id,order.quantity,order.created_date,order.total_price,order.extension_name,extensions.user_id as owner_id,order.user_id,order.status');
        $this->db->from('order');
        $this->db->join('extensions', 'extensions.extension_id = order.extension_id');
        $this->db->where('extensions.user_id',$id);
        $this->db->order_by('order.created_date DESC');
        if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();

    }
    
    function get_all_sale_by_seller_user_id($id,$limit,$offset)
    {
    	$this->db->select('*');
    	$this->db->from('order');
    	$this->db->where('user_id =', $id);
        $this->db->order_by('order.created_date DESC');
    	if($limit!=null) $this->db->limit($limit,$offset);
    	$result = $this->db->get();
    	return $result->result_array();
    
    }
    
    
    function get_all_category()
    {
    	 $this->db->select('*');
    	$this->db->from('category');
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_user_buy($user_id,$exten_id)
    {
    	$this->db->select('*');
    	$this->db->from('users_buy_extensions');
    	$this->db->where('user_id',$user_id);
    	$this->db->where('extension_id',$exten_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
	function get_category_by_category_id($id)
    {
    	 $this->db->select('*');
    	$this->db->from('category');
    	$this->db->where('category_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }
    
 	function get_all_license()
    {
    	 $this->db->select('*');
    	$this->db->from('license');
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_extension_option_by_extension_id($id)
    {
    	$this->db->select("extension_property.value_id,category_property.property_name,extension_property.property_value");
    	$this->db->from('extension_property');
    	$this->db->join('category_property',"category_property.value_id = extension_property.value_id");
    	$this->db->where('extension_property.extension_id',$id);
    	$result = $this->db->get();
        return $result->result_array();
    }
    
	function get_category_property_by_category_id($id,$ex_id)
	{
		$this->db->select("extension_property.value_id,category_property.property_name,extension_property.property_value");
		$this->db->from('extension_property');
		$this->db->join('category_property',"category_property.value_id = extension_property.value_id");
		$this->db->where('category_property.category_id',$id);
		if($ex_id!=null)
		$this->db->where('extension_property.extension_id',$ex_id);
		$this->db->order_by('extension_property.value_id ASC');
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
	function get_user_property_default_by_category_id()
	{
		$this->db->select("*");
		$this->db->from('category_property');
		$this->db->where('category_property.category_id',-1);
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
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_user_property_by_value_id($id,$ex_id)
	{
		$this->db->select("*");
		$this->db->from('user_property');
		$this->db->where('value_id',$id);
		$this->db->where('user_id',$ex_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
    function get_user_download($ex_id,$u_id)
    {
    	$this->db->select('*');
    	$this->db->from('users_buy_extensions');
    	$this->db->where('extension_id',$ex_id);
    	$this->db->where('user_id',$u_id);
        $result = $this->db->get();
        return $result->result_array();
    }	
    
	function get_all_compatibility()
    {
    	 $this->db->select('*');
    	$this->db->from('compatibility');
    	$this->db->where('public', 1);
        $result = $this->db->get();
        return $result->result_array();
    }	
    
    function get_all_compatibility_in_array($array)
    {
    	$this->db->select('*');
    	$this->db->from('compatibility');
    	$this->db->where('public', 1);
    	$this->db->where_in('compatibility_id', $array);
        $result = $this->db->get();
        return $result->result_array();
    }	
    
    function get_all_comment_by_extension_id($id,$limit,$offset)
    {
    	$this->db->select('comments.content,comments.created_date,users.avatar,users.username');
    	$this->db->from('comments');
    	$this->db->join('users', 'users.user_id = comments.user_id');
    	$this->db->where_in('extension_id', $id);
    	if($limit!=null) $this->db->limit($limit,$offset);
        $result = $this->db->get();
        return $result->result_array();
    }	
    
    
	function get_notification_by_user_id($id)
    {
    	//$this->db->select('users.company,users.address1,users.address2,users.post_code,users.website,users.avatar,users.phone,users.paypal,users.payment_id,users.username,users.firstname,users.lastname,users.email,city.city_id,city.city_name,region.region_id,region.region_name,country.country_id,country.country_name');
        $this->db->select('*');
    	$this->db->from('notifications');
        $this->db->where('user_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_all_user_buy_extension($id)
    {
    	$this->db->select('order.extension_name,order.user_id');
    	$this->db->from('order');
        $this->db->where('extension_id',$id);
        $this->db->where('status',1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    function get_user_by_username($username)
    {
        $this->db->from('users');
        $this->db->select('*');
        $this->db->where('username',$username);
        $result = $this->db->get();
        return $result->result_array();

    }
    function get_user_by_id($id)
    {
        $this->db->from('users');
        $this->db->select('*');
        $this->db->where('user_id',$id);
        $result = $this->db->get();
        return $result->result_array();
    
    }
    
    function get_user_by_email($email)
    {
        $this->db->from('users');
        $this->db->select('*');
        $this->db->where('email',$email);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    function get_user_by_login($username,$password)
    {
        $this->db->from('users');
        $this->db->select('*');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $result = $this->db->get();
        return $result->result_array();

    }

    function insert_subscribers($data=null){
        $this->db->insert('subscribers', $data);
        return true;
        
    }
    
	function get_country_detail($id)
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_id', $id);
		$this->db->where('public', 1);
		$query = $this->db->get();		
		return $query->result_array();
	}
	function get_all_country()
	{
		$this->db->select("*");
		$this->db->from('country');
		$this->db->where('public', 1);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_city_detail($id)
	{
		$this->db->select('city.public,city.city_id,city.city_name,city.created_date, country.country_name,country.country_id');
		$this->db->from('city');
		$this->db->join('country', 'country.country_id = city.country_id');
		$this->db->where('city.city_id', $id);
		$this->db->where('city.public', 1);
		$query = $this->db->get();		
		return $query->result_array();
	}
	function get_list_city_by_region($id)
	{
		$this->db->select('*');
		$this->db->from('city');
		$this->db->join('region', 'region.region_id = city.region_id');
		$this->db->where('region.region_id', $id);
		$this->db->where('city.public', 1);
		$this->db->where('region.public', 1);
		$query = $this->db->get();		
		return $query;
	}
	function get_list_region_by_country($id)
	{
		$this->db->select('*');
		$this->db->from('region');
		$this->db->join('country', 'region.country_id = country.country_id');
		$this->db->where('country.country_id', $id);
		$this->db->where('region.public', 1);
		$this->db->where('country.public', 1);
		$query = $this->db->get();		
		return $query;
	}
	function get_all_city()
	{
		$this->db->select("*");
		$this->db->from('city');
		$this->db->join('region', 'region.region_id = city.region_id');
		$this->db->join('country', 'country.country_id = region.country_id');
		$this->db->where('city.public', 1);
		$this->db->where('region.public', 1);
		$this->db->where('country.public', 1);
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
		$this->db->select("*");
		$this->db->from('region');
		$this->db->join('country', 'country.country_id = region.country_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
 	function insert_extension($data=null,$custom=null){
//        $image = $this->upload_image('image','extension','2408000');
//		if($image!=null)
//		$this->db->set('image', $image);
//		$banner = $this->upload_image('banner','extension','2408000');
//		if($banner!=null)
//		$this->db->set('banner', $image);
 		$this->db->insert('extensions', $data);
        $id = $this->db->insert_id();
 	
		if($custom!=null)
				{
					foreach($custom as $key=>$value)
					{
						$data_property = $this->get_category_property_by_property_id($key);
						$this->db->set('extension_id',$id);
						$this->db->set('value_id',$key);
						$this->db->set('property_value',$value);
						$this->db->insert('extension_property'); 
					}
		}
		return $id;
    }
    
    function insert_address($data=null){
        $this->db->insert('address', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    
	function get_extension_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('extensions');
		$this->db->where('extension_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	function get_address_by_id($id)
	{
	    $this->db->select('*');
	    $this->db->from('address');
	    $this->db->join('country', 'country.country_id = address.country_id');
	    $this->db->where('address_id', $id);
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	
	function get_extension_download_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('downloads');
		$this->db->where('extension_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}	
	
	function get_extension_image_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('reference_id', $id);
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
	function edit_extension($id,$data=null,$custom=null){
		
		
		$this->db->where('extension_id', $id);
        $this->db->update('extensions', $data);
        
		if($custom!=null)
				{
					$this->db->delete('extension_property', array('extension_id' => $id));
					foreach($custom as $key=>$value)
					{
						$this->db->set('extension_id',$id);
						$this->db->set('value_id',$key);
						$this->db->set('property_value',$value);
						$this->db->insert('extension_property'); 
					}
				}
        return true;
    }
    
    function edit_address($id,$data=null){
    
    
        $this->db->where('address_id', $id);
        $this->db->update('address', $data);
    }
    
	function insert_extension_download($data=null){
        $this->db->insert('downloads', $data);
        $id =  $this->db->insert_id();
		return $id;
    }
	function insert_extension_image($data=null){
        $this->db->insert('gallery', $data);
        return $this->db->insert_id();
    }
    
	function get_email_from_setting()
	{
		$this->db->select('*');
		$this->db->from('setting');
		$query = $this->db->get();		
		return $query->result_array();
	}
	
 	function get_website_info()
    {
    	$this->db->select('*');
 		$this->db->from('setting');
		$query = $this->db->get();		
		return $query->result_array();
    }
	
	function get_article_by_type($type)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('type', $type);
		$this->db->order_by('order ASC');
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	function get_all_parent_page()
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('parent', 0);
		$this->db->order_by('order ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_all_child_page_by_parent($id)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('parent',$id);
		$this->db->order_by('order ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_all_category_by_parent($id)
	{
	    $this->db->select('*');
	    $this->db->from('category');
	    $this->db->where('parent_id',$id);
	    $this->db->order_by('order ASC');
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	function get_article_detail($id)
	{
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('article_id', $id);
		$query = $this->db->get();		
		return $query->result_array();
	}
	
	function get_all_purchase_order($user_id,$limit,$offset)
 	{
 		$this->db->select('order.payment_release,order.transaction_paypal_id,order.extension_price as price,order.quantity,order.commission,order.total_balance,order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id'); 		
 		$this->db->from('order');
		$this->db->join('users',"users.user_id=order.user_id");
		$this->db->where('order.status', 1);
		$this->db->where('order.user_id', $user_id);
		if($limit!=null) $this->db->limit($limit,$offset);
		$query = $this->db->get();		
		return $query->result_array();
 	}	
 	
 	function get_all_purchase_order_by_owner_id($user_id,$limit,$offset)
 	{
 		$this->db->select('order.payment_release,order.transaction_paypal_id,order.extension_price as price,order.quantity,order.commission,order.total_balance,order.order_id,order.extension_name,order.total_price,order.created_date,order.status,users.username,users.user_id');
 		$this->db->from('order');
 		$this->db->join('extensions',"extensions.extension_id=order.extension_id");
 		$this->db->join('users',"users.user_id=extensions.user_id");
 		$this->db->where('order.status', 1);
 		$this->db->where('order.payment_release', 1);
 		$this->db->where('extensions.user_id', $user_id);
 		if($limit!=null) $this->db->limit($limit,$offset);
 		$query = $this->db->get();
 		return $query->result_array();
 	}
   
 	function get_language_by_code($code)
 	{
 		$this->db->select('*');
		$this->db->from('languages');
		$this->db->where('code', $code);
		$query = $this->db->get();		
		return $query->result_array();
 	}
 	
	function get_language_default()
 	{
 		$this->db->select('*');
		$this->db->from('languages');
		$this->db->where('default', 1);
		$query = $this->db->get();		
		return $query->result_array();
 	}
	function get_all_language()
 	{
 		$this->db->select('*');
		$this->db->from('languages');
		$this->db->order_by('sort_order','ASC');
		$query = $this->db->get();		
		return $query->result_array();
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
				print_r($_FILES[$name]);
				print_r($configi);
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
		$this->upload->initialize($configq);
		
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
 	
	public function getCurrencyByCode($currency) {
		$query = $this->db->query("SELECT DISTINCT * FROM currency WHERE code = '" . $this->db->escape($currency) . "'");
	
		return $query->row;
	}
	
	public function getCurrencies() {
		//$currency_data = $this->cache->get('currency');

		//if (!$currency_data) {
			$currency_data = array();
			
			$query = $this->db->query("SELECT * FROM currency ORDER BY title ASC");
	
			foreach ($query->result_array() as $result) {
      			$currency_data[$result['code']] = array(
        			'currency_id'   => $result['currency_id'],
        			'title'         => $result['title'],
        			'code'          => $result['code'],
					'symbol_left'   => $result['symbol_left'],
					'symbol_right'  => $result['symbol_right'],
					'decimal_place' => $result['decimal_place'],
					'value'         => $result['value'],
					'status'        => $result['status'],
					'date_modified' => $result['last_updated']
      			);
//    		}	
//			
//			$this->cache->set('currency', $currency_data);
		}
			
		return $currency_data;	
	}
	
	function get_order_detail($id)
	{
		$this->db->select('*','extensions.image');
		$this->db->from('order');
		$this->db->join('extensions', 'extensions.extension_id = order.extension_id');
		$this->db->join('users',"users.user_id=order.user_id");
		$this->db->where('order.order_id', $id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_order_invoice($id)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order.order_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	

	function check_exist_user($username){
	    $this->db->from('users');
	    $this->db->where('username',$username);
	    $this->db->select('*');
	    $result = $this->db->get();
	    return $result->result_array();
	}
	
	function check_login_fb($username, $email){
	    $this->db->from('users');
	    $this->db->where('username',$email);
	    $this->db->or_where('facebookAccount',$username);
	    $this->db->select('*');
	    $result = $this->db->get();
	    return $result->result_array();
	}
	
}