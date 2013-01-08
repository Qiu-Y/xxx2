
function room(id,_top,_left){
	var me=id.charAt?document.getElementById(id):id, d1=document.body, d2=document.documentElement;
	d1.style.height=d2.style.height='100%';me.style.top=_top?_top+'px':0;me.style.left=_left+"px";//[(_left>0?'left':'left')]=_left?Math.abs(_left)+'px':0;
	me.style.position='absolute';
	setInterval(function (){me.style.top=parseInt(me.style.top)+(Math.max(d1.scrollTop,d2.scrollTop)+_top-parseInt(me.style.top))*0.1+'px';},10+parseInt(Math.random()*20));
	return arguments.callee;
};