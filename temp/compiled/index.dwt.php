<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="Generator" content="ECSHOP v2.7.3" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php echo $this->_var['page_title']; ?>">
    <meta name="description" content="<?php echo $this->_var['page_title']; ?>">
    <title><?php echo $this->_var['page_title']; ?></title>

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
</head>
<body>


<div class="header clearfix">
    <div class="topInfo">
        <div class="content">
            <ul class="topInfo_content">

<!--                <li>昨日订单数：<span id="order_num"></span></li>-->
<!--                <li>昨日投放客户数：<span id="company_num"></span></li>-->
                <li>您好，欢迎访问<span id="account_num"><?php echo $this->_var['shop_name']; ?></span>！</li>
                <!--li>平台数：<span>6</span></li-->
                <li class="topInfo_content_contact"><img src="index_files/top_info_show01_v2.jpg"></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <a href="http://www.weiboyi.com/" class="logo">
            <img src="index_files/logo_v2.jpg" width="400">
        </a>
    </div>
    <div class="nav clearfix">
        <div class="content">
            <ul id="nav">
		<li class="iconMedia"><a class="nav_current" href="#">首页<span></span></a></li>
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
<!--div class="relative">
    <ul style="top: 637px; left: 36.5px;" class="web_link_box">
                    <li><a href="http://wdl.so/uQIMNAFb" target="_blank"> <img style="width: 115px;" src="index_files/web_link.jpg" alt="兔展"></a></li>
            <li class="side_close"><a href="javascript:;"></a></li></ul>
</div-->

<script>
    $(function() {
        initSignIn("qiye");
    });
</script>
<div class="loginBox">
    <div class="content">
        <div class="loginBox_show">
            <ul class="bannerHome_show bannerBoxContent">
		
<?php $this->assign('ads_id','2'); ?><?php $this->assign('ads_num','4'); ?><?php echo $this->fetch('library/ad_position.lbi'); ?>

            <div class="bannerHome_fixedContent">
                <span class="bannerHome_tabLeft"></span>
                <ul class="bannerBoxControl">
                    <li class="bannerHome_tabBtn bannerHome_tabCurrent"></li>
                    <li class="bannerHome_tabBtn"></li><li class="bannerHome_tabBtn"></li><li class="bannerHome_tabBtn"></li><li class="bannerHome_tabBtn"></li><li class="bannerHome_tabBtn"></li>                </ul>
                <span class="bannerHome_tabRight"></span>
            </div>

        </div>
        <div class="loginContent">
            

            <?php if ($_SESSION['user_id'] > 0): ?>
            <div class="login_welcome" id="login_tab_content_true">
                <p><span id="loginUserName"><?php echo $_SESSION['user_name']; ?></span>，您好！</p>

                <p><a href="/user.php" style="color:#5A91BA" id="loginUserUrl">我的<?php echo $this->_var['shop_name']; ?></a><span>|</span><a href="/user.php?act=logout">退出</a></p>
            </div>
	    <?php else: ?>
            
	    <ul class="loginContent_title">
                <li class="platform_A"><a class="platform_current" id="login_tab_link1" href="javascript:void(0);" onclick="change('qiye');return false;">客户登录<span></span></a></li>
                <li class="platform_C"><a href="javascript:void(0);" id="login_tab_link2" onclick="change('bozhu');return false;">媒体登录<span></span></a></li>
            </ul>
            <div class="clear"></div>
            <table class="loginContent_table" id="login_tab_content1">
<form name="formLogin" action="user.php" method="post" onSubmit="return userLogin()">
                <tbody><tr>
                    <th>用户名：</th>
                    <td>
                        <div class="loginContent_input">
                            <input name="username" tabindex="1" id="username_qiye" type="text">
                            <p class="errorMsgTips">
                                <span>请输入用户名！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>密&nbsp;&nbsp;码：</th>
                    <td>
                        <div class="loginContent_input">
                            <input name="password" tabindex="52" id="password_qiye" maxlength="22" type="password">
                            <p class="errorMsgTips">
                                <span>请输入密码！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>验证码：</th>
                    <td>
                        <div class="loginContent_input">
                            <input class="loginContent_input_Captcha" tabindex="53" id="captcha_qiye" maxlength="4">
                            <img src="index_files/486473bd91f9863317d952db75352664.png" id="captcha_img_qiye" class="captcha_img">
                            <a href="#" onclick="getCaptcha('qiye');return false;">换一张</a>
                            <p class="errorMsgTips">
                                <span>请输入验证码！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
			<?php if ($this->_var['enabled_captcha']): ?>
			<tr>
			<td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
			<td><input type="text" size="8" name="captcha" class="inputBg" />
			<img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
			</tr>
			<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <label><input name="remember" id="save_qiye" value="1" type="checkbox">记住用户名</label>
                        <span class="login_border"></span>
                        <a href="http://chuanbo.weiboyi.com/hwauth/lost/index/" target="_blank">忘记密码</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
			<input type="hidden" name="act" value="act_login" />
			<input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
			<input class="btnLogin01" type="submit" name="submit" value="" class="us_Submit" />
                        <!--a class="btnLogin01" href="#" onclick="crossDomainLogin('qiye');return false;"></a-->
                        <a class="btnLogin03" href="/user.php?act=register" target="_blank"></a>
                    </td>
                </tr>
            </tbody>
</form>
	    </table>
            <table class="loginContent_table" id="login_tab_content2" style="display:none">

<form name="formLogin" action="user.php" method="post" onSubmit="return userLogin()">
                <tbody><tr>
                    <th>用户名：</th>
                    <td>
                        <div class="loginContent_input">
                            <input name="username" tabindex="1" id="username_qiye" type="text">
                            <p class="errorMsgTips">
                                <span>请输入用户名！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>密&nbsp;&nbsp;码：</th>
                    <td>
                        <div class="loginContent_input">
                            <input name="password" tabindex="52" id="password_qiye" maxlength="22" type="password">
                            <p class="errorMsgTips">
                                <span>请输入密码！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>验证码：</th>
                    <td>
                        <div class="loginContent_input">
                            <input class="loginContent_input_Captcha" tabindex="53" id="captcha_qiye" maxlength="4">
                            <img src="index_files/486473bd91f9863317d952db75352664.png" id="captcha_img_qiye" class="captcha_img">
                            <a href="#" onclick="getCaptcha('qiye');return false;">换一张</a>
                            <p class="errorMsgTips">
                                <span>请输入验证码！</span>
                                <a href="javascript:void(0);" tabindex="-1"></a>
                            </p>
                        </div>
			<?php if ($this->_var['enabled_captcha']): ?>
			<tr>
			<td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
			<td><input type="text" size="8" name="captcha" class="inputBg" />
			<img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
			</tr>
			<?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <label><input name="remember" id="save_qiye" value="1" type="checkbox">记住用户名</label>
                        <span class="login_border"></span>
                        <a href="http://chuanbo.weiboyi.com/hwauth/lost/index/" target="_blank">忘记密码</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
			<input type="hidden" name="act" value="act_login" />
			<input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
			<input class="btnLogin01" type="submit" name="submit" value="" class="us_Submit" />
                        <!--a class="btnLogin01" href="#" onclick="crossDomainLogin('qiye');return false;"></a-->
                        <a class="btnLogin03" href="/user.php?act=register" target="_blank"></a>
                    </td>
                </tr>
            </tbody>
</form>
            </table>
	    <?php endif; ?>
        </div>
    </div>
</div>
<div class="mainContent content">
    <div class="accountCotent">
    <div class="accountCotent_left accountCotent_media_left ">
    <ul class="accountCotent_left_title">
        <?php $_from = $this->_var['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('catkey', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['catkey'] => $this->_var['cat']):
?>
            <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'child');$this->_foreach['catname'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['catname']['total'] > 0):
    foreach ($_from AS $this->_var['key'] => $this->_var['child']):
        $this->_foreach['catname']['iteration']++;
?>
                <li class="<?php if (($this->_foreach['catname']['iteration'] - 1) == 0): ?>accountCotent_title_current<?php endif; ?>">
                    <a href="javascript:void(0);">
                        <span><?php echo htmlspecialchars($this->_var['child']['name']); ?><b></b></span>
                        <!--em>(300+)</em-->
                    </a>
                </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


	    <div class="accountCotent_left_list">
	      <?php if ($this->_var['catkey'] == 1): ?>
		
<?php $this->assign('cat_goods',$this->_var['cat_goods_10']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_10']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_11']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_11']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_12']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_12']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_13']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_13']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_14']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_14']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

              <?php else: ?>
		
<?php $this->assign('cat_goods',$this->_var['cat_goods_3']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_3']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_4']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_4']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_8']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_8']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>
<?php $this->assign('cat_goods',$this->_var['cat_goods_9']); ?><?php $this->assign('goods_cat',$this->_var['goods_cat_9']); ?><?php echo $this->fetch('library/cat_goods.lbi'); ?>

	      <?php endif; ?>    
		<p class="seeMore_folkAccount"><a href="http://chuanbo.weiboyi.com/" target="_blank">查看更多媒体/自媒体<img src="index_files/icon_jump_to.jpg"></a></p>
	    </div>

        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
</div>
</div>
    <div class="clear"></div>
<div class="platformAccount_user_channel">
    <h2 class="platformAccount_title">
        <b>合作关系</b>
    </h2>
    <table class="platformAccount_user_list" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td>
                    <a class="platformAccount_user_link" href="javascript:void(0)">
                        <img src="index_files/c1.jpg">
                        <span>卡车之家</span>
                    </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c2.jpg">
                    <span>米其林</span>
                </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c3.jpg">
                    <span>名字</span>
                </a>
            </td>
	    <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c4.jpg">
                    <span>名字</span>
                </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c5.jpg">
                    <span>名字</span>
                </a>
            </td>
        </tr>
     
        <tr>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c6.jpg">
                    <span>名字</span>
                </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c7.jpg">
                    <span>名字</span>
                </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c8.jpg">
                    <span>名字</span>
                </a>
            </td>
	    <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c9.jpg">
                    <span>名字</span>
                </a>
            </td>
            <td>
                <a class="platformAccount_user_link" href="javascript:void(0)">
                    <img src="index_files/c10.jpg">
                    <span>名字</span>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

    <div class="clear"></div>

</div>


<!--<div class="dropzone">-->
<!--    <a class="dropzone_link" target="_blank" href="http://gov.163.com/special/sdaqr/">-->
<!--        <img src="resources/images/cyber_security_day.gif" />-->
<!--    </a>-->
<!--    <a id="dropzone_button" class="dropzone_button" href="javascript:void(0)"><img src="resources/images/icon/btn_closed.gif" /></a>-->
<!--</div>-->



<div class="footer">
    <div class="content">
        <p>
<!--            <a href="short_link.php">微博短链分析</a><span>|</span>-->
            <a href="#">加入我们</a><span>|</span>
            <a href="#">联系我们</a><span>|</span>
            <a href="#">法律/免责声明</a><span>|</span>
            <a href="#">邮箱白名单设置</a>
        </p>
        <p>版权所有 © 北京豆芽奥特信息技术有限公司 2011-2016.</p>
        <p>
            <a href="http://www.itrust.org.cn/yz/pjwx.asp?wm=168437474x" target="_blank">
                <img src="index_files/elect_ident.jpg">
            </a>
            <a id="___szfw_logo___" href="https://credit.szfw.org/CX20151112012217000583.html" target="_blank">
                <img src="index_files/chengxinlongtou.png" border="0">
            </a>
        </p>
    </div>
</div>





<div class="contact_suspension_frame">
    <div class="suspension_frame_box" id="suspensionFrame">
        <h2><b></b>&nbsp;<span>立即咨询价格和流程</span></h2>

        <div id="contactContent" class="contactContent">
            <table>
                <tbody><tr>
                    <th valign="middle"><img src="index_files/suspension_frame_icon03_v2.jpg" alt="电话"></th>
                    <td>400-0000-000</td>
                </tr>
                <tr>
                    <th valign="middle"><img src="index_files/suspension_frame_icon02_v2.jpg" alt="QQ"></th>
                    <td>00000000</td>
                </tr>
                <tr>
                    <th valign="middle"><img src="index_files/suspension_frame_icon01_v2.jpg" alt="微信"></th>
                    <td><img src="index_files/two_dimensional_code.jpg" alt="二维码"></td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=00000000&amp;site=qq&amp;menu=yes">
                            <img src="index_files/pa.gif" alt="点击这里给我发消息" title="点击这里给我发消息">
                        </a>
                    </td>
                </tr>
            </tbody></table>
        </div>
    </div>
</div>

<script type="text/javascript">(function(){document.getElementById('___szfw_logo___').oncontextmenu = function(){return false;}})();</script>

<script type="text/javascript">
    (function () {
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = (location.protocol == 'https:' ? 'https://ssl.' : 'http://static.') + 'gridsumdissector.com/js/Clients/GWD-002319-76AA56/gs.js';
        var firstScript = document.getElementsByTagName('script')[0];
        firstScript.parentNode.insertBefore(s, firstScript);
    })();
</script>


<script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F29d7c655e7d1db886d67d7b9b3846aca' type='text/javascript'%3E%3C/script%3E"));
</script><script src="index_files/h.js" type="text/javascript"></script>


</body></html>
