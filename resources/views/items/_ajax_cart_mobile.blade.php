<a href="#" class="contains-sub-menu cart">Cart <span class="cart-indication"><span class="badge background-aqua"><?php echo $data->totalCount;?></span></span></a>
<ul class="sub-menu custom-content cart-overview">
    <?php foreach($data as $dat){?>
        <li class="cart-item">
            <a href="/items/<?php echo $dat->id?>" class="product-thumbnail">
                <?php if(isset($dat->itemImages[0])){?><img src="<?php echo $dat->itemImages[0]['image']?>" alt="<?php echo $dat->itemImages[0]['title']?>" />  <?php } ?>
            </a>
            <div class="product-details">
                <a href="/items/<?php echo $dat->id?>" class="product-title">
                    <?php echo $dat->title?>
                </a>
                <span class="product-quantity"><?php echo $dat->quantity?> x</span>
                <span class="product-price"><span class="currency">£</span><?php echo ($dat->quantity * $dat->price)?></span>
                <a href="#" class="product-remove icon-cancel"></a>
            </div>
        </li>
    <?php } ?>
    <li class="cart-subtotal">
        Sub Total
        <span class="amount"><span class="currency">£</span><?php echo $data->totalPrice ?></span>
    </li>
    <li class="cart-actions">
        <a href="cart.html" class="view-cart">View Cart</a>
        <a href="checkout.html" class="checkout"><span class="icon-check"></span> Checkout</a>
    </li>
</ul>