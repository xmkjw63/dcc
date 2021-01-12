//去掉头尾空格
function trim(str){
	return str.replace(/(^\s*)|(\s*$)/g, "");
}

//封装好的弹窗
function Daen_confirm(type,title,content,jump,url){
	if(type==""){
		type="success"
	}
	if(type=="success"){
		$.confirm({
        title: title,
        content: content,
        type: 'green',
        buttons: {
            omg: {
                text: '确定',
                btnClass: 'btn-green',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            },
            close: {
                text: '取消',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            }
        }
	});
	}
	if(type=="error"){
		$.confirm({
        title: title,
        content: content,
        type: 'red',
        buttons: {
            omg: {
                text: '确定',
                btnClass: 'btn-red',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            },
            close: {
                text: '取消',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            }
        }
	});
	}
	if(type=="warning"){
		$.confirm({
        title: title,
        content: content,
        type: 'orange',
        buttons: {
            omg: {
                text: '确定',
                btnClass: 'btn-orange',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            },
            close: {
                text: '取消',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            }
        }
	});
	}
	if(type=="info"){
		$.confirm({
        title: title,
        content: content,
        type: 'sky',
        buttons: {
            omg: {
                text: '确定',
                btnClass: 'btn-sky',
				action: function(){
					if(jump==true){
						if(url==null){
							window.history.back(-1);
						}else{
							window.location.href=url;
						}
					}
					
                }
            },
            close: {
                text: '取消',
            }
        }
	});
	}
	
}

//封装好的提示
function Daen_notify(type,content){
	if(type==""){
		type="success"
	}
	if(type=="success"){
		lightyear.notify(content, 'success', 3000, 'mdi mdi-emoticon-happy', 'top', 'center');
	}
	if(type=="error"){
		lightyear.notify(content, 'danger', 3000, 'mdi mdi-emoticon-sad', 'top', 'center');
	}
	if(type=="warning"){
		lightyear.notify(content, 'warning', 3000, 'mdi mdi-emoticon-neutral', 'top', 'center');
	}
	if(type=="info"){
		lightyear.notify(content, 'info', 3000, 'mdi mdi-emoticon-neutral', 'top', 'center');
	}
	
}

//封装好的跳转
function Daen_jump_notify(url){
	window.location.href=url;
}


