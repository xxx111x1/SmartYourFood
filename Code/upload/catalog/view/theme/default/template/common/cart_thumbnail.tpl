<div class="cart_dropdown" id="cart_dropdown">
    <?php if ($products) { ?>
      <div class="cart-thumbnail-head" >
      	<div class="cart-head " style="float:left;width:100px;">购物车</div>
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
      </table>
      <div class="cart-thumbnail-bottom">
        <table class="table table-bordered">
          <?php foreach ($totals as $total) { ?>
          <tr>
            <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
            <td class="text-right"><?php echo $total['text']; ?></td>
          </tr>
          <?php } ?>
        </table>
        <p class="text-right"><a href="<?php echo $cart; ?>"><strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $checkout; ?>"><strong><i class="fa fa-share"></i> <?php echo $text_checkout; ?></strong></a></p>
      </div>
    <?php } else { ?>
    <div class="empty-cart">购物车是空的  </div>
    <?php } ?>
  </div>