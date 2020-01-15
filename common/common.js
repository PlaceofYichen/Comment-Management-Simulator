function alert_jump(msg, url) {
	layer.msg(msg, {
		icon: 1,
		shade: 0.3,
		time: 2000    //1秒关闭弹窗
	}, function(){
		window.location = url;
	});
}

function alert_msg(msg) {
	layer.msg(msg, {
	    title: false,
	    time: 1000,
	    shade: 0.3
	  });
}

function onlyNum() {
    if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
    if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
    event.returnValue=false;
}