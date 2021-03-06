<?php if (shopp('product','found')): ?>

	<?php shopp('product','gallery'); ?>

	<h3 class="product-title"><?php shopp('product','name'); ?></h3>
	<p class="headline"><big><?php shopp('product','summary'); ?></big></p>

	<?php if (shopp('product','onsale')): ?>
		<h3 class="original price"><?php shopp('product','price'); ?></h3>
		<h3 class="sale price"><?php shopp('product','saleprice'); ?></h3>
		<?php if (shopp('product','has-savings')): ?>
			<p class="savings">You save <?php shopp('product','savings'); ?> (<?php shopp('product','savings','show=%'); ?>)!</p>
		<?php endif; ?>
	<?php else: ?>
		<h3 class="price"><?php shopp('product','price'); ?></h3>
	<?php endif; ?>
	
	<?php if (shopp('product','freeshipping')): ?>
	<p class="freeshipping">Free Shipping!</p>
	<?php endif; ?>
	
	<form action="<?php shopp('cart','url'); ?>" method="post" class="shopp product validate" style="display: inline;">
		<?php if(shopp('product','has-variations')): ?>
		<ul class="variations">
			<?php shopp('product','variations','mode=multiple&label=true&defaults=Select an option&before_menu=<li>&after_menu=</li>'); ?>
		</ul>
		<?php endif; ?>
		<?php if(shopp('product','has-addons')): ?>
			<ul class="addons">
				<?php shopp('product','addons','mode=menu&label=true&defaults=Select an add-on&before_menu=<li>&after_menu=</li>'); ?>
			</ul>
		<?php endif; ?>
				
		<?php shopp('product','quantity','class=selectall&input=menu'); ?>
		<div><?php shopp('product','addtocart'); ?></div>

	</form>
	
	<div class="clear" style="margin-top: 1em;">
		<?php shopp('product','description'); ?>
	</div>
	
	<?php if(shopp('product','has-specs')): ?>
	<dl class="details">
		<?php while(shopp('product','specs')): ?>
		<dt><?php shopp('product','spec','name'); ?>:</dt><dd><?php shopp('product','spec','content'); ?></dd>
		<?php endwhile; ?>
	</dl>
	<?php endif; ?>

<?php else: ?>
<h3>Product Not Found</h3>
<p>Sorry! The product you requested is not found in our catalog!</p>
<?php endif; ?>
