
// JavaScript Document 
$(function(){ 
$("tr:even").css("background-color","#ffff99"); 
$("tr td:not(.id)").click(function(){ 
if($(this).children('input').length > 0) 
return; 
//��o�\�i�����L�I���e 
var data=$(this).text(); 
//�����e?�u?�� 
$(this).html(''); 
var td=$(this); 
//?���꘢�\�i 
var inp=$('<input type="text">'); 
inp.val(data); 
inp.css("background-color",$(this).css("background-color")); 
inp.css("border-width","0px"); 
inp.css("width",$(this).css("width")); 
//�ݕ\�i�����꘢input�\? 
inp.appendTo($(this)); 
//�\?�����\�i�@�G?�œ_���� 
inp.trigger('focus'); 
//�S?���e 
inp.trigger('select'); 
//�Y��???? 
inp.keydown(function(event){ 
switch(event.keyCode){ 
case 13: 
td.html($(this).val()); 
//���pAjax������??��?�� 
//?���s���L�I��?�� 
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
//���pAjax������??��?�� 
//?���s���L�I��?�� 
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