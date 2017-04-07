<?php if($total_money==0){ ?><p style="background-color:#fff;width:100px;height:50px;line-height:50px; text-align: center;width: 250px;">No item in cart!</p><div style="clear:both;"></div><?php } else { ?>
<table class="s_cart_items" cellpadding="5" cellspacing="5" border="0" style="min-width: 350px;border:1px solid #ccc;">
    <?php foreach($info as $row){ ?>
    <tr>
      <td width="50">
          <img style="width:50px;height:50px;" src="<?php echo base_url(); ?><?php echo image($row['image'],$settings['default_image'],50,50); ?>">
     </td>
      <td style="font-weight: bold;"><?php echo $row['item']; ?></td>
      <td width="35" class="s_cart_number">
        x<strong><?php echo $this->currency->format($row['amount']); ?></strong> -
      </td>
      <td width="50" class="s_cart_price"><?php echo $this->currency->format($row['total']); ?></td>
      <td width="26">
        <span onclick="remove_cart(<?php echo $row['id']; ?>,$(this),<?php echo $row['total']; ?>,<?php echo $row['type_price']; ?>)" class="s_button_remove">&nbsp;</span>
      </td>
    </tr>
    <?php } ?>
     <tr>
        <td colspan="3" style="text-align:right;"><b>Total:</b></td>
        <td colspan="2" id="cart_total_price"> <?php echo $this->currency->format($total_money); ?> </td>
     </tr>
     <tr>
        <td colspan="3" style="text-align:right;">
            <a style="float:left" class="btn-checkout-cart" href="<?php echo base_url() ?>cart">
                View Cart
            </a>
        </td>
        <td colspan="2" id="cart_total_price">
            <a style="float:left" class="btn-checkout-cart" href="<?php echo base_url() ?>checkout">
                Checkout
            </a>
        </td>
     </tr>
</table>
<?php } ?>

<style type="text/css">
.s_button_remove {
    position: absolute;
    display: block;
    width: 11px;
    height: 11px;
    background-image: url(<?php echo base_url(); ?>assets/frontend/img/sprite.png);
    background-position: 0 -498px;
    background-repeat: no-repeat;
    background-color: #ccc;
    cursor: pointer;
    margin-top: -5px;
}
.btn-checkout-cart, .btn-checkout-cart:hover{
    background: none !important;
    background-color: #C00 !important;
    padding: 10px !important;
    color: #ffffff !important;
    text-align: center !important;
    width: 100px !important;
    -moz-border-radius: 7px !important;
    -webkit-border-radius: 7px !important;
    border-radius: 7px !important;
}
</style>