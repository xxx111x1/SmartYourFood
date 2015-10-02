<div class="cart_dropdown" id="cart_dropdown">
    <?php if ($products) { ?>
      <div class="cart-thumbnail-head" >
      	<div class="cart-head " style="float:left;width:80px;">购物车</div>
      	<div class="cart-head claer-all" style="float:right;width:100px;margin-right:0px;">清空</div>
      </div>
      <table class="cart-thumbnail-table">
      	<tr>
      		<td class="food-name table-head">菜品</td>
      		<td class="food-number table-head">份数</td>
      		<td class="food-price table-head" >单价</td>
      		<td></td>
      	</tr>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="food-name" ><div class="food-name-detail" title="<?php echo $product['name']; ?>" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></div></td>
          <td class="food-number" foodId ="<?php echo $product['product_id']; ?>" ><div class="remove-food"></div><div class="purchase-number"><?php echo $product['quantity']; ?></div><div class="add-food"></div></td>
          <td class="food-price"><?php echo $product['total']; ?></td>
          <td class="food-remove" key="<?php echo $product['key']; ?>" id="<?php echo $product['product_id']; ?>"><div onclick="cart.remove('','');" ></div></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="food-name" >运费</td>
          <td></td>
          <td class="food-price">$<?php echo $total_transffer; ?></td>
          <td></td>
        </tr>
        <tr>
          <td class="food-name" >税(12%):</td>
          <td></td>
          <td class="food-price">$<?php echo $total_taxes; ?></td>
          <td></td>
        </tr>
        <tr>
          <td class="food-name" >小费(10%):</td>
          <td></td>
          <td class="food-price">$<?php echo $total_fees; ?></td>
          <td ></td>
        </tr>
      </table>
      <div class="cart-thumbnail-bottom">
        <div class="sum-all">共 $<?php echo $total_sum; ?></div>
        <div class="cart-checkout">
        	<a href="<?php echo $checkout; ?>">
        		结算
        	</a>
        </div>

      </div>
    <?php } else { ?>
    <div class="empty-cart">购物车是空的  </div>
    <?php } ?>
  </div>