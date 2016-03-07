<div style="display: block" class="accountCotent_left_content">
<?php $_from = $this->_var['cat_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_88288600_1457254177');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_88288600_1457254177']):
?>
    <div class="ft_index_list">
	<div class="ft_index_list_top">
		<div class="ft_index_list_top_right">
			<div>
				<a href="<?php echo $this->_var['goods_0_88288600_1457254177']['url']; ?>"><img src="<?php echo $this->_var['goods_0_88288600_1457254177']['thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods_0_88288600_1457254177']['name']); ?>" class="goodsimg" /></a>
			</div>
			<div>
				查看报价
			</div>
		</div>
		<div class="ft_index_list_top_left">
			<?php echo htmlspecialchars($this->_var['goods_0_88288600_1457254177']['name']); ?>
		</div>
	</div>
	<div class="ft_index_list_bottom">
		粉丝数：<?php echo $this->_var['goods_0_88288600_1457254177']['brief']; ?>
	</div>
    </div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</div>
<div class="blank"></div>
