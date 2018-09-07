$(function(){
   
    //预约挂号弹窗
    $('.tc-innner h3').click(function(){
    	$('.bg').hide();
    	$('.tc-innner').hide();
    })
    $('.bg').click(function(){
    	$('.bg').hide();
    	$('.tc-innner').hide();
    })

    //当日挂号弹窗
    $('.guakao').click(function(){
    	$('.bg').show();
    	$('.drgh').show();
    })
    $('.drgh h3').click(function(){
    	$('.bg').hide();
    	$('.drgh').hide();
    })
    $('.move_on a').click(function(){
    	$('.move_on a').removeClass('on');
    	$(this).addClass('on')
    })

    //医生主页
   $('.introTit span').toggle(function () {
       $(this).parent('.introTit').siblings('.wenzi').css({"height":"auto","overflow":"auto"});
    },
       function () {
           $(this).parent('.introTit').siblings('.wenzi').css({"height":"44px","overflow":"hidden"});
       }
    );
})