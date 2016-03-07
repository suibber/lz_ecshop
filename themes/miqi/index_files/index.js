$(document).ready(function(){
//    导航切换
    function tabChange(tabBox,tabCurEle,tabCurClass){
        tabBox.on("click", tabCurEle, function(){
            $(this).addClass(tabCurClass);
            $(this).parent().siblings().children().removeClass(tabCurClass);
        })
    }
    tabChange($("#nav"),"a","nav_current");

//内容隐藏显示
    function tabToggle(toggleNav,toggleCurEle,toggleCurClass){
        toggleNav.on("click", toggleCurEle, function(){
            var index = $(this).parent().index();
            $(this).parent().addClass(toggleCurClass)
                .siblings().removeClass(toggleCurClass);
            contentToggle(index,toggleNav);
        })
    }
    function contentToggle(index,toggleNav){
        var toggleEle = toggleNav.next(".accountCotent_left_list").children(".accountCotent_left_content");
        toggleEle.eq(index).show().siblings().hide();
    }
    tabToggle($(".accountCotent_left_title"),"a","accountCotent_title_current");

    function autoChange($el, interval) {
        var $imgHeight=$el.find("li").height();
        if($el.find("li").length>1){
            function scrollAuto(){
                var $firstLi=$el.find("li").eq(0);
                $firstLi.animate({
                        marginTop: -$imgHeight
                    },
                    "slow",
                    function(){
                        $firstLi.appendTo($el).css("marginTop","0");
                    }
                )
            }
            setInterval(scrollAuto,interval);
        }
    }
    autoChange($("#banner_trend_left"),6000);
    //左侧广告轮换开始

    //左侧广告轮换结束

});
//轮播图
$(function() {
    weiboyiIndex('loginBox_show')
});

function weiboyiIndex(box){
    var $box = $('.'+box),
        count = $box.find('img').length,
        timer = null;

    var current = -1;
    function setActive(index) {
        if (current === index) {
            return false;
        }
        current = index;
        $box.find(".bannerHome_tabBtn")
            .removeClass("bannerHome_tabCurrent")
            .eq(index).addClass("bannerHome_tabCurrent");

        $box.find(".bannerBoxContent").find('li').fadeOut().eq(index).fadeIn();
    }
    function process(index) {
        if (typeof index == "undefined") { index = 0; }
        setActive(index)
        clearTimeout(timer);
        timer = setTimeout(function() {
            index++;
            index = index >= count ? 0 : index;
            process(index);
        }, count*1500);
    }

    function initSuspensionSlide() {
        $("#suspensionFrame").hover(function () {
            $("#contactContent").show();
            $("#contactContent").stop().animate({
                "height":"195px"
            }, "normal", function () {
            });
        }, function () {
            $("#contactContent").stop().animate({
                "height":0
            }, "normal", function () {
                $("#contactContent").hide();
            });
        });
    }

//    function dropzoneHidden(){
//        $("#dropzone_button").on("click",function(){
//            $(this).parent(".dropzone").hide();
//            return false;
//        })
//    }

    function initImageSwitcher() {
        var zIndex = 0;
        function show(index, evt) {
            var descList = [
                "公司环境",
                "公司福利",
                "团队活动",
                "欧式别墅办公区",
                "隔岸观虎逗",
                "户外会议室",
                "登上顶峰，留下倩影一张"
            ];

            if (evt) {
                animating = true;
                var offset = $("#imageSwitcher").offset();
                $(".switcherImage").stop(true, true).eq(index).hide().css({
                    position: "absolute",
                    left: evt.pageX - offset.left,
                    top: evt.pageY - offset.top,
                    width: 80,
                    opacity: 0.4,
                    "z-index": zIndex++,
                    filter: 'alpha(opacity=20)'
                }).show().animate({
                        left: 282,
                        top: 7,
                        width: 437,
                        opacity: 1
                    }, 500, function() {
                        $(this).fadeTo(1);
                    });
            }
            else {
                $(".switcherImage").eq(index).show();
            }
            $("#imageDesc").text(descList[index]);
        }
        $(".imageSwitcher_link").click(function(e) {
            var index = $(this).index(".imageSwitcher_link");
            show(index, e);
        });

        show(0);
    }
    function start() {
        process();
        initImageSwitcher();
        initSuspensionSlide();
        //dropzoneHidden();
        $box.on("mouseup", ".bannerHome_tabBtn", function() {
            var index = $box.find(".bannerHome_tabBtn").index(this);
            process(index);
        });

    }
    start();


}
$(document).ready(function(){
    //左侧外链兔展
    var elemWrap = $('.web_link_box');
    var insert_elem = $('<li class="side_close"><a href="javascript:;"></a></li>');
    insert_elem.appendTo(elemWrap);
    insert_elem.click(function(){
        elemWrap.hide();
    });
    $(elemWrap).css({'top':$(window).height()-138+10});
    if(($(window).width()-1100)/2 < 115){
        $('.web_link_box img').css({'width':($(window).width()-1100)/2-5});
    }else{
        $('.web_link_box img').css({'width':'115px'});
        $('.web_link_box').css({'left':($(window).width()-1100)/2-125})
    }

});