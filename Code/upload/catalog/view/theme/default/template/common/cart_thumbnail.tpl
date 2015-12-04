<div class="cart_dropdown" id="cart_dropdown">
	<input type='hidden' id="purchaseRest" value="<?php echo $rest_id;?>" />
    <?php if ($products) { ?>
      <div class="cart-thumbnail-head" >
      	<div class="cart-head " style="float:left;width:60px;"><?php echo $Cart;?></div>
      	<div class="cart-head claer-all" style="float:right;width:100px;margin-right:0px;"><?php echo $Clear;?></div>
      </div>
      <table class="cart-thumbnail-table">
      	<tr>
      		<td class="food-name table-head"><?php echo $Food;?></td>
      		<td class="food-number table-head"><?php echo $Number;?></td>
      		<td class="food-price table-head" ><?php echo $Price;?></td>
      		<td></td>
      	</tr>
        <?php foreach ($products as $product) { ?>
        <tr class="food-row">
          <td class="cart-food-name" ><div class="food-name-detail" title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></div></td>
          <td class="food-number" foodId ="<?php echo $product['product_id']; ?>" ><div class="remove-food"></div><div class="purchase-number"><?php echo $product['quantity']; ?></div><div class="add-food"></div></td>
          <td class="food-price"><?php echo $product['total']; ?></td>
          <td class="food-remove" >
          	<div class="cart-remove unvisible" key="<?php echo $product['key']; ?>" id="<?php echo $product['product_id']; ?>"></div>
          </td>
        </tr>
        <?php } ?>
        <!--
        <tr>
          <td class="food-name table-head" >运费</td>
          <td></td>
          <td class="food-price">$<?php echo $total_transffer; ?></td>
          <td></td>
        </tr>
        <tr>
          <td class="food-name table-head" >税(12%):</td>
          <td></td>
          <td class="food-price">$<?php echo $total_taxes; ?></td>
          <td></td>
        </tr>
        <tr>
          <td class="food-name table-head" >小费(10%):</td>
          <td></td>
          <td class="food-price">$<?php echo $total_fees; ?></td>
          <td ></td>
        </tr>
        -->
      </table>
      <div class="cart-thumbnail-bottom">
        <div class="sum-all"><?php echo $Sum;?>$<?php echo $total_sum; ?></div>
        <div class="cart-checkout">
        	<a href="<?php echo $checkout; ?>">
        		<?php echo $Pay;?>
        	</a>
        </div>

      </div>
    <?php } else { ?>
    <div class="empty-cart"><?php echo $Empty;?> </div>
    <?php } ?>
  </div>