
<link href="index_files/base.css" rel="stylesheet" type="text/css">
<link href="index_files/pages_002.css" rel="stylesheet" type="text/css">
<link href="index_files/style_list.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="index_files/cmp_all.css">
<link rel="stylesheet" href="index_files/pages.css">

<script src="index_files/gs.js" async="" type="text/javascript"></script><script src="index_files/jquery-1.js"></script>
<script src="index_files/jquery.js"></script>
<script src="index_files/cookie.js"></script>
<script src="index_files/base.js"></script>
<script src="index_files/weiboyi.js"></script>
<script src="index_files/domain_new.js"></script>
<script src="index_files/index.js"></script>



<div class="header clearfix">
    <div class="topInfo">
        <div class="content">
            <ul class="topInfo_content">

<!--                <li>昨日订单数：<span id="order_num"></span></li>-->
<!--                <li>昨日投放客户数：<span id="company_num"></span></li>-->
                <li>您好<?php if ($_SESSION['user_id'] > 0): ?><a href="/user.php"><?php echo $_SESSION['user_name']; ?></a><?php endif; ?>，欢迎访问<span id="account_num">Foton</span>！<?php if ($_SESSION['user_id'] > 0): ?> | <a href="/user.php?act=logout">退出</a><?php endif; ?></li>
                <!--li>平台数：<span>6</span></li-->
                <li class="topInfo_content_contact"><img src="index_files/top_info_show01_v2.jpg"></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <a href="/" class="logo">
            <img src="index_files/logo_v2.jpg" width="400">
        </a>
    </div>
    <div class="nav clearfix">
        <div class="content">
            <ul id="nav">
		<li class="iconMedia"><a class="nav_current" href="/">首页<span></span></a></li>
		<?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('catkey', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['catkey'] => $this->_var['cat']):
?>
			<li class="iconMedia"><a class="" href="<?php echo $this->_var['cat']['url']; ?>"><?php echo $this->_var['cat']['name']; ?><span></span></a></li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<li class="iconGrassroots"><a href="#">关于我们<span></span></a></li>
                <!--
                <li class="iconFamous"><a href="http://www.weiboyi.com/famous.php">名人/意见领袖预约<span></span></a></li>
                <li class="iconPengyouquan"><a href="http://www.weiboyi.com/pengyouquan.php">高端朋友圈<span></span></a></li>
                <li class="iconGrassroots"><a href="http://www.weiboyi.com/grassroot.php">草根帐号<span></span></a></li>
                <li class="iconAbout"><a href="http://www.weiboyi.com/weiboyi_about.php">关于微播易<span></span></a></li>
		<li class="iconRebate"><a href="/weiboyi_rebate.php">返利邀请</a></li>
		-->
            </ul>
        </div>
    </div>
</div>


<div class="block clearfix">

<div id="search"  class="clearfix">
  <div class="keys f_l">
   <script type="text/javascript">
    
    <!--
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
            alert("<?php echo $this->_var['lang']['no_keywords']; ?>");
            return false;
        }
    }
    -->
    
    </script>
    <?php if ($this->_var['searchkeywords']): ?>
   <?php echo $this->_var['lang']['hot_search']; ?> ：
   <?php $_from = $this->_var['searchkeywords']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
   <a href="search.php?keywords=<?php echo urlencode($this->_var['val']); ?>"><?php echo $this->_var['val']; ?></a>
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   <?php endif; ?>
  </div>
  <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" class="f_r"  style="_position:relative; top:5px;">
   <select name="category" id="category" class="B_input">
      <option value="0"><?php echo $this->_var['lang']['all_category']; ?></option>
      <?php echo $this->_var['category_list']; ?>
    </select>
   <input name="keywords" type="text" id="keyword" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>" class="B_input" style="width:110px;"/>
   <input name="imageField" type="submit" value="" class="go" style="cursor:pointer;" />
   <a href="search.php?act=advanced_search"><?php echo $this->_var['lang']['advanced_search']; ?></a>
   </form>
</div>
