<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="" lang="en" xml:lang="en">
<head>
<title><?=_l('Invoice',$this);?></title>
<base href="<?php echo base_url(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/css/invoice.css" />
</head>
<body>
<?php if(isset($order) && $order!=null) { ?>
<div style="page-break-after: always;">
  <h1><?=_l('Invoice',$this);?></h1>
  <table class="store">
    <tr>
      <td><?php echo $setting['company']; ?><br />
       <?=_l('Address',$this);?>: <?php echo $setting['address1']!=""?$setting['address1']:$setting['address2']; ?>  <br />
        <?=_l('Phone',$this);?>: <?php echo $setting['phone']; ?>  <br />
         <?php echo $setting['email']; ?><br />
         <?php echo base_url();?><br />
       </td>
      <td align="right" valign="top"><table>
          <tr>
            <td><b><?=_l('Added Date',$this);?></b></td>
            <td><?php echo $order['created_date']; ?></td>
          </tr>
          <tr>
            <td><b><?=_l('Transaction Paypal',$this);?></b></td>
            <td><?php echo $order['transaction_paypal_id']; ?></td>
          </tr>
          <tr>
            <td><b><?=_l('Order Number',$this);?></b></td>
            <td><?php echo $order['order_id']; ?></td>
          </tr>
          <tr>
            <td><b><?=_l('Payment Method',$this);?></b></td>
            <td><?php echo $order['payment_type']==1?"Paypal":""; ?></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <table class="address">
    <tr class="heading">
      <?php if($address!=null) {?>
      <td width="33%"><b><?=_l('Seller',$this);?></b></td>
      <td width="33%"><b><?=_l('Buyer',$this);?></b></td>
      <td width="33%"><b><?=_l('Ship to',$this);?></b></td>
      <?php } else {?>
      <td width="50%"><b><?=_l('Seller',$this);?></b></td>
      <td width="50%"><b><?=_l('Buyer',$this);?></b></td>
      <?php }?>
      
    </tr>
    <tr>
     <?php if($address!=null) {?>
      <td width="33%">
      	<?php echo $seller['firstname']; ?> <?php echo $seller['lastname']; ?><br/>
        <?php echo $seller['address1']!=""?$seller['address1']:$seller['address2']; ?><br/>
        <?php echo $seller['email']; ?><br/>
        <?php echo $seller['phone']; ?><br/>
        <?php echo $seller['city_name']; ?><br/>
        <?php echo $seller['region_name']; ?><br/>
        <?php echo $seller['country_name']; ?><br/>
        <br/>
       </td>
      <td width="33%">
      <?php echo $buyer['firstname']; ?> <?php echo $buyer['lastname']; ?><br/>
        <?php echo $buyer['address1']!=""?$buyer['address1']:$buyer['address2']; ?><br/>
        <?php echo $buyer['email']; ?><br/>
        <?php echo $buyer['phone']; ?><br/>
        <?php echo $buyer['city_name']; ?><br/>
        <?php echo $buyer['region_name']; ?><br/>
        <?php echo $buyer['country_name']; ?><br/>
        </td>
       
        <td width="33%">
      <?php echo $address['name']; ?> <br/>
        <?php echo $address['address1']!=""?$address['address1']:$address['address2']; ?><br/>
        <?php echo $address['state']; ?><br/>
        <?php echo $address['postal']; ?><br/>
        <?php echo $address['city_name']; ?><br/>
        <?php echo $address['country_name']; ?><br/>
        </td>
        <?php } else {?>
         <td>
      	<?php echo $seller['firstname']; ?> <?php echo $seller['lastname']; ?><br/>
        <?php echo $seller['address1']!=""?$seller['address1']:$seller['address2']; ?><br/>
        <?php echo $seller['email']; ?><br/>
        <?php echo $seller['phone']; ?><br/>
        <?php echo $seller['city_name']; ?><br/>
        <?php echo $seller['region_name']; ?><br/>
        <?php echo $seller['country_name']; ?><br/>
        <br/>
       </td>
      <td>
      <?php echo $buyer['firstname']; ?> <?php echo $buyer['lastname']; ?><br/>
        <?php echo $buyer['address1']!=""?$buyer['address1']:$buyer['address2']; ?><br/>
        <?php echo $buyer['email']; ?><br/>
        <?php echo $buyer['phone']; ?><br/>
        <?php echo $buyer['city_name']; ?><br/>
        <?php echo $buyer['region_name']; ?><br/>
        <?php echo $buyer['country_name']; ?><br/>
        </td>
        <?php }?>
    </tr>
  </table>
  <table class="product">
    <tr class="heading">
      <td><b><?=_l('Product Name',$this);?></b></td>
      <td align="right"><b><?=_l('Quantity',$this);?></b></td>
      <td align="right"><b><?=_l('Price',$this);?></b></td>
      <td align="right"><b><?=_l('Total',$this);?></b></td>
    </tr>
    <tr>
      <td><?php echo $order['extension_name']; ?>
      </td>
      <td align="right"><?php echo $order['quantity']; ?></td>
      <td align="right"><?php echo $this->currency->format($order['price']);?></td>
      <td align="right"><?php echo $this->currency->format($order['total_price']);?></td>
    </tr>
    <tr>
      <td align="right" colspan="3"><b><?=_l('Total',$this);?>::</b></td>
      <td align="right"><?php echo $this->currency->format($order['total_price']);?></td>
    </tr>
  </table>
</div>
<?php } ?>
</body>
</html>