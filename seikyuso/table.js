
// JavaScript Document 
$(function(){ 
$("tr:even").css("background-color","#ffff99"); 
$("tr td:not(.id)").click(function(){ 
if($(this).children('input').length > 0) 
return; 
//取出表格中原有的内容 
var data=$(this).text(); 
//将内容?置?空 
$(this).html(''); 
var td=$(this); 
//?建一个表格 
var inp=$('<input type="text">'); 
inp.val(data); 
inp.css("background-color",$(this).css("background-color")); 
inp.css("border-width","0px"); 
inp.css("width",$(this).css("width")); 
//在表格中放一个input表? 
inp.appendTo($(this)); 
//表?放入表格后触?焦点事件 
inp.trigger('focus'); 
//全?内容 
inp.trigger('select'); 
//添加???? 
inp.keydown(function(event){ 
switch(event.keyCode){ 
case 13: 
td.html($(this).val()); 
//利用Ajax将数据??服?器 
//?取一行所有的列?象 
var tds=td.parent("tr").children("td"); 
var i=tds.eq(0).text(); 
var n=tds.eq(1).text(); 
var a=tds.eq(2).text(); 
var s=tds.eq(3).text(); 
var e=tds.eq(4).text(); 
//var user={id:i,name:n,age:a,sex:s,email:e} 
$.post("save.php",{id:i,name:n,age:a,sex:s,email:e},function(data){ 
alert(data); 
}); 
break; 
case 27: 
td.html(data); 
break; 
} 
}).blur(function(){ 
td.html($(this).val()); 
//利用Ajax将数据??服?器 
//?取一行所有的列?象 
var tds=td.parent("tr").children("td"); 
var i=tds.eq(0).text(); 
var n=tds.eq(1).text(); 
var a=tds.eq(2).text(); 
var s=tds.eq(3).text(); 
var e=tds.eq(4).text(); 
//var user={id:i,name:n,age:a,sex:s,email:e} 
$.post("save.php",{id:i,name:n,age:a,sex:s,email:e},function(data){ 
alert(data); 
}); 
}); 
}); 
}); 