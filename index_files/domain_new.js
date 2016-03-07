var errorMsgInputClass = "errorMsgInput";
var checkOther = true;

function initSignIn(loginShowType) {
    if (loginShowType === "qiye") {
        isDomainInfoA(loginShowType);
    } else {
        isDomainInfoC(loginShowType);
        checkOther = false;
    }
    //分析cookie值，显示上次的登陆信息
    var userNameValueQiye = W.util.getCookie("username_qiye");
    $("#username_qiye").val(userNameValueQiye);
    var saveValueQiye = W.util.getCookie("save_qiye");
    if (saveValueQiye == 1) {
        $("#save_qiye").prop('checked', true);
    } else {
        $("#save_qiye").prop('checked', false);
    }


    //分析cookie值，显示上次的登陆信息
    var userNameValueBozhu = W.util.getCookie("username_bozhu");
    $("#username_bozhu").val(userNameValueBozhu);
    var saveValueBozhu = W.util.getCookie("save_bozhu");
    if (saveValueBozhu == 1) {
        $("#save_bozhu").prop('checked', true);
    } else {
        $("#save_bozhu").prop('checked', false);
    }
    $('#captcha_img_qiye').bind('click', function () {
        getCaptcha('qiye');
    });
    $('#captcha_img_bozhu').bind('click', function () {
        getCaptcha('bozhu');
    });

    $("#login_tab_content1").live(
        "keydown",
        function (event) {
            if (event.keyCode == 13) {
                crossDomainLogin('qiye');
            }
        }
    );

    $("#login_tab_content2").live(
        "keydown",
        function (event) {
            if (event.keyCode == 13) {
                crossDomainLogin('bozhu');
            }
        }
    );
}

/** 获取验证码**/
var qiye_url = "http://chuanbo.weiboyi.com";
var bozhu_url = "http://qudao.weiboyi.com";
function getCaptcha(site) {
    var url = "";//captcha验证码地址
    var imgUrl = "";
    var tag = "";
    if (site == 'qiye') {
        url = qiye_url + "/hwauth/index/captchaajax";
        imgUrl = qiye_url;
        tag = "qiye";
    } else if (site == 'bozhu') {
        url = bozhu_url + "/auth/index/captchaajax";
        imgUrl = bozhu_url;
        tag = "bozhu";
    } else {
        alert('Error');
        return false;
    }
    $("#captcha_" + tag).val("");
    $.ajax({
        type    : 'GET',			//传递方式
        async   : false,			//使用同步请求
        url     : url,				//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert('captca Error');
            return false;
        },
        success : function (msg) {
            if ('' != msg) {
                imgUrl = imgUrl + msg.url;
                $("#captcha_img_" + tag).attr('src', imgUrl);
            } else {
                alert('获取验证码失败!');
            }
        }
    });
    return false;
}

function trimAll(site) {

    if (site == "qiye" || site == "") {
        $("#username_qiye").val(trim($("#username_qiye").val()));
        $("#password_qiye").val(trim($("#password_qiye").val()));
        $("#captcha_qiye").val(trim($("#captcha_qiye").val()));
    }

    if (site == "bozhu" || site == "") {
        $("#username_bozhu").val(trim($("#username_bozhu").val()));
        $("#password_bozhu").val(trim($("#password_bozhu").val()));
        $("#captcha_bozhu").val(trim($("#captcha_bozhu").val()));
    }

}
/***获取用户提交的登录信息*/
function getLoginInfo(site) {
    var username = "";
    var password = "";
    var captcha = "";
    var sendData = "";
    trimAll(site);
    if (site == "qiye") {
        username = trim($("#username_qiye").val());
        password = trim($("#password_qiye").val());
        captcha = trim($("#captcha_qiye").val());
    } else if (site == 'bozhu') {
        username = trim($("#username_bozhu").val());
        password = trim($("#password_bozhu").val());
        captcha = trim($("#captcha_bozhu").val());
    }
    sendData = {'username': username, 'password': password, 'captcha': captcha};
    return sendData;
}
/**跨域登录*/
function crossDomainLogin(site) {
    var sendData = "";
    var loginUrl = "";
    var toUrl = "";
    clearInputError();
    if (!loginCheck(site)) {
        return false;
    }
    sendData = getLoginInfo(site);//整理要传输的数据
    createAndSaveCookie(site);//生成cookie
    if (site == 'qiye') {
        loginUrl = qiye_url + "/hwauth/index/domainlogin";
        toUrl = qiye_url;
    } else if (site == 'bozhu') {
        loginUrl = bozhu_url + "/auth/index/domainlogin";
        toUrl = bozhu_url + "/bgtask/index/weixinmp";
    } else {
        alert('switch Error');
        return false;
    }
    $.ajax({
        type    : 'GET',			//传递方式
        async   : false,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        data    : sendData,
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert('cross Error');
            return false;
        },
        success : function (msg) {
            if (msg.ones == true) {
                $("#captcha_" + site).val("");
                window.location.href = toUrl;
            } else {
                showInputError("", msg.message);
                getCaptcha(site);
            }
        }
    });
}
/*** 退出**/
function crossDomainLogout(site) {
    var loginUrl = "";
    var tag = "";
    var tagOther = "";
    if (site == 'qiye') {
        loginUrl = qiye_url + "/hwauth/index/crossdomainlogout";
        tag = "qiye";
        tagOther = "bozhu";
    } else if (site == 'bozhu') {
        loginUrl = bozhu_url + "/auth/index/crossdomainlogout";
        tag = "bozhu";
        tagOther = "qiye";
    } else {
        alert("logout Error");
        return false;
    }
    $.ajax({
        type    : 'GET',			//传递方式
        async   : false,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status) {
                getCaptcha(site);
                $("#login_tab_content_true").hide();
                $(tag == 'qiye' ? "#login_tab_content1" : "#login_tab_content2").show();
                $("#password_" + tag).val("");
                $("#captcha_" + tag).val("");
            } else {
                alert("退出失败");
            }
        },
        success : function (msg) {
            if (msg.ones == true) {
                getCaptcha(site);
                $("#login_tab_content_true").hide();
                $(tag == 'qiye' ? "#login_tab_content1" : "#login_tab_content2").show();
                $("#password_" + tag).val("");
                $("#captcha_" + tag).val("");
            } else {
                alert("退出失败");
            }
        }
    });
}
$("#loginUserOut").live("click", function () {
    var site = "bozhu";
    if ($("#login_tab_link1.platform_current").length > 0) {
        site = "qiye";
    }
    crossDomainLogout(site);
    return false;
});
/*** 判断A是否登录*/
function dump_obj(myObject) {
    var s = "";
    for (var property in myObject) {
        s = s + "\n " + property + ": " + myObject[property];
    }
    alert(s);
}
function isDomainInfoA(loginShowType) {
    var loginUrl = qiye_url + "/hwauth/index/iscrossdomain";
    var tag = "qiye";
    var tagOther = "bozhu";
    $.ajax({
        type    : 'GET',			//传递方式
        async   : true,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert("Error");
            return false;
        },
        success : function (msg) {
            if (msg.ones == true) {
                if (loginShowType != tag) {
                    change(tag, "unCheck");
                }
                if ($('#login_tab_link1').hasClass('platform_current')) {
                    getDomainInfo(tag);
                    $("#loginUserUrl").attr("href", qiye_url);
                    $("#loginUserHelp").attr("href", qiye_url + "/hwauth/index/help");
                    //$("#loginUserOut").attr("onclick", "crossDomainLogout('qiye');return false;");
                    $("#login_tab_content1").hide();
                    $("#login_tab_content_true").show();
                }
            } else {
                getCaptcha(tag);
                if (loginShowType == tag && checkOther) {
                    isDomainInfoC(loginShowType);
                } else {
                    return false;
                }
            }
        }
    });
}
/*** 判断B是否登录*/
function isDomainInfoC(loginShowType) {
    var loginUrl = bozhu_url + "/auth/index/iscrossdomain";
    var tag = "bozhu";
    var tagOther = "qiye";
    $.ajax({
        type    : 'GET',			//传递方式
        async   : true,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert("is c Error");
            return false;
        },
        success : function (msg) {
            if (msg.ones == true) {
                if (loginShowType != tag) {
                    change(tag, "unCheck");
                }
                if ($('#login_tab_link2').hasClass('platform_current')) {
                    getDomainInfo(tag);
                    $("#loginUserUrl").attr("href", bozhu_url);
                    $("#loginUserHelp").attr("href", bozhu_url + "/auth/index/help");
                    //$("#loginUserOut").attr("onclick", "crossDomainLogout('bozhu');return false;");
                    $("#login_tab_content2").hide();
                    $("#login_tab_content_true").show();
                }
            } else {
                getCaptcha(tag);
                if (loginShowType == tag && checkOther) {
                    isDomainInfoA(loginShowType);
                } else {
                    return false;
                }
            }
        }
    });
}
/***获取登录信息(用户名)**/
function getDomainInfo(site) {
    var loginUrl = "";
    var tag = "";
    var login_tab = '';
    if (site == 'qiye') {
        loginUrl = qiye_url + "/hwauth/index/getloginname";
        tag = "qiye";
        login_tab = '1';
    } else if (site == 'bozhu') {
        loginUrl = bozhu_url + "/auth/index/getloginname";
        tag = "bozhu";
        login_tab = '2';
    } else {
        //alert('Error');
        return false;
    }
    $.ajax({
        type    : 'GET',			//传递方式
        async   : false,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert("Error");
            return false;
        },
        success : function (msg) {
            if (msg.ones == true) {
                if ($('#login_tab_link' + login_tab).hasClass('platform_current')) {
                    $("#loginUserName").html(msg.name);
                } else {
                    $("#login_tab_content_true").hide();
                }
            } else {

            }
        }
    });
}

/**切换**/
function change(site, doCheck) {
    doCheck = doCheck || "check";
    $('#login_tab_content_true').hide();
    if (site == "qiye") {
        clearInputError('bozhu');
        $("#login_tab_link1").addClass('platform_current');
        $('#login_tab_link2').removeClass('platform_current');
        $('#login_tab_content2').hide();
        $('#login_tab_content1').show();
        $("#password_qiye").val("");
        $('#captcha_qiye').val("");
    } else if (site == "bozhu") {
        clearInputError('qiye');
        $("#login_tab_link2").addClass('platform_current');
        $('#login_tab_link1').removeClass('platform_current');
        $('#login_tab_content1').hide();
        $('#login_tab_content2').show();
        $("#password_bozhu").val("");
        $('#captcha_bozhu').val("");
    }
    if (doCheck == "check" && site) {
        isDomainInfoOther(site);
    }
}
/*切换页面调用获取判断是否登录**/
function isDomainInfoOther(site) {
    var loginUrl = "";
    var tag = "";
    var tagOther = "";
    if (site == 'qiye') {
        loginUrl = qiye_url + "/hwauth/index/iscrossdomain";
        myUrl = {
            url : qiye_url,
            help: qiye_url + "/hwauth/index/help"
        };
        tag = "qiye";
        tagOther = "bozhu";
    } else if (site == 'bozhu') {
        loginUrl = bozhu_url + "/auth/index/iscrossdomain";
        myUrl = {
            url : bozhu_url,
            help: bozhu_url + "/auth/index/help"
        };
        tag = "bozhu";
        tagOther = "qiye";
    } else {
        //alert('Error');
        return false;
    }
    $.ajax({
        type    : 'GET',			//传递方式
        async   : false,			//使用同步请求
        url     : loginUrl,			//请求url
        dataType: "jsonp",		//选择返回值类型
        jsonp   : "callback",		//规定发送/接收参数，默认为callback
        timeout : 30000,			//设置请求超时时间
        error   : function (jqXHR, textStatus, errorThrown) {
            //alert("Error");
            return false;
        },
        success : function (msg) {
            if (msg.ones == true) {
                getDomainInfo(site);
                $("#loginUserUrl").attr("href", myUrl.url);
                $("#loginUserHelp").attr("href", myUrl.help);
                //$("#loginUserOut").attr("onclick", "crossDomainLogout('"+site+"');return false;");
                $(site == 'qiye' ? "#login_tab_content1" : "#login_tab_content2").hide();
                $("#login_tab_content_true").show();
            } else {
                var captcha_img = $("#captcha_img_" + site).attr("src");
                if (captcha_img == "" ) {
                    getCaptcha(site);
                }
                return false;
            }
        }
    });
}

/** A端注册页面*/
function gotoUrl() {
    var url = qiye_url + "/hwauth/register";
    window.open(url);
}
/**C端注册页面*/
function gotoCUrl() {
    var url =bozhu_url+"/auth/register";
    window.open(url);
}
/** 登录验证*/
function loginCheck(site) {
    trimAll(site);
    if (site == "qiye") {
        var username_qiye = $("#username_qiye").val();
        var password_qiye = $("#password_qiye").val();
        var captcha_qiye = $("#captcha_qiye").val();
        if (username_qiye == "") {
            showInputError($("#username_qiye"), "请输入用户名!");
            return false;
        }
        if (!checkSpecicalCharacter(username_qiye)) {
            showInputError($("#username_qiye"), "用户名格式不合法!");
            return false;
        }
        if (username_qiye.length < 2) {
            showInputError($("#username_qiye"), "用户名或密码不正确!");
            return false;
        }
        clearInputError($("#username_qiye"));

        if (password_qiye == "") {
            showInputError($("#password_qiye"), "请输入密码!");
            return false;
        }
        if (password_qiye.length < 6) {
            showInputError($("#username_qiye"), "用户名或密码不正确!");
            return false;
        }
        clearInputError($("#password_qiye"));

        if (captcha_qiye == "") {
            $("#captcha_" + site).val("");
            showInputError($("#captcha_qiye"), "请输入验证码!");
            return false;
        }

        if (!checkSpecicalCharacter(captcha_qiye) || captcha_qiye.length != 4) {
            $("#captcha_" + site).val("");
            showInputError($("#captcha_qiye"), "验证码不正确!");
            return false;
        }
        clearInputError($("#captcha_qiye"));
    } else if (site == "bozhu") {
        var username_bozhu = $("#username_bozhu").val();
        var password_bozhu = $("#password_bozhu").val();
        var captcha_bozhu = $("#captcha_bozhu").val();
        if (username_bozhu == "") {
            showInputError($("#username_bozhu"), "请输入用户名!");
            return false;
        }
        if (username_bozhu.length < 2) {
            showInputError($("#username_bozhu"), "用户名或密码不正确!");
            return false;
        }
        if (!checkSpecicalCharacter(username_bozhu)) {
            showInputError($("#username_bozhu"), "用户名格式不合法!");
            return false;
        }
        clearInputError($("#username_bozhu"));

        if (password_bozhu == "") {
            showInputError($("#password_bozhu"), "请输入密码!");
            return false;
        }
        if (password_bozhu.length < 6) {
            showInputError($("#username_bozhu"), "用户名或密码不正确!");
            return false;
        }
        clearInputError($("#password_bozhu"));

        if (captcha_bozhu == "") {
            $("#captcha_" + site).val("");
            showInputError($("#captcha_bozhu"), "请输入验证码!");
            return false;
        }
        if (!checkSpecicalCharacter(captcha_bozhu) || captcha_bozhu.length != 4) {
            $("#captcha_" + site).val("");
            showInputError($("#captcha_bozhu"), "验证码不正确!");
            return false;
        }
        clearInputError($("#captcha_bozhu"));
    } else {
        //alert("Error");
        return false;
    }
    return true;
}
/**验证特殊符号*/
function checkSpecicalCharacter(str) {
    var regExp = /^[0-9A-Za-z-_]+$/i;
    if (regExp.test(str)) {
        return true;
    } else {
        return false;
    }
}
/**保留cookie***/
function createAndSaveCookie(site) {
    if (site == "qiye") {
        if ($("#save_qiye").prop("checked")) {
            W.util.setCookie("username_qiye", $("#username_qiye").val(), 1, "/");
            W.util.setCookie("password_qiye", $("#password_qiye").val(), 1, "/");
            W.util.setCookie("save_qiye", 1, 1, "/");
        } else {
            W.util.deleteCookie('username_qiye', "/");
            W.util.deleteCookie('password_qiye', "/");
            W.util.deleteCookie('save_qiye', "/");
        }
    } else if (site == "bozhu") {
        if ($("#save_bozhu").prop("checked")) {
            W.util.setCookie("username_bozhu", $("#username_bozhu").val(), 1, "/");
            W.util.setCookie("save_bozhu", 1, 1, "/");
        } else {

            W.util.deleteCookie('username_bozhu', "/");
            W.util.deleteCookie('save_bozhu', "/");
        }
    }
}

function trim(str) {
    if (typeof str != "string") {
        throw "Parameter must be a string.";
    }
    return str.replace(/^ *(.*?) *$/, "$1");
}

function showInputError(obj, msg) {
    if (typeof obj == "object") {
        $(obj).addClass(errorMsgInputClass);
        //$(obj).attr("title", msg);
        $(obj).nextAll("p").find("span").text(msg);
        $(obj).nextAll("p").show().find("a").bind('click', function () {
            $(obj).nextAll("p").hide();
            obj.focus();
        });
    } else if (msg != "") {
        var boxType = ("广告主" == $(".platform_current").text() ? "qiye" : "bozhu");
        if (msg.indexOf("验证码") != -1) {
            showInputError($("#captcha_" + boxType), msg);
        } else if (msg.indexOf("用户名") != -1) {
            showInputError($("#username_" + boxType), msg);
        } else if (msg.indexOf("密码") != -1) {
            showInputError($("#password_" + boxType), msg);
        } else {
            alert(msg);
        }
    }
}

function clearInputError(cls) {
    cls = cls || "";
    if (typeof cls != "object") {
        switch (cls) {
            case "qiye" :
                cls = $("#login_tab_content1 input[type!='checkbox']");
                break;
            case "bozhu" :
                cls = $("#login_tab_content2 input[type!='checkbox']");
                break;
            default :
                cls = $(".login_tab_content input").filter("[type!='checkbox']");
                break;
        }
    }
    cls.removeClass(errorMsgInputClass);
    //cls.removeAttr("title");
    cls.nextAll("span").text("");
    cls.nextAll("p").hide();
    return true;
}

/**
 * 处理页面顶部统计信息
 */
function processStatInfo() {
    var url = "/auto_infor/source.json";
    $.getJSON(url, function(data) {
        $('#account_num').text(data.account_num);
        $('#company_num').text(data.company_num);
        $('#reservation_order_num').text(data.reservation_order_num);
        $('#order_num').text(data.order_num);
    });
}

$(function () {
    processStatInfo();
});