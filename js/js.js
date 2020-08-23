function checkMelliCode() {
    var meli_code;
    meli_code = document.getElementById('codemeli').value;
	if (meli_code.length < 10) {
	           alert("کد ملی صحیح نمی باشد");
           document.getElementById('codemeli').focus();
			//document.getElementById('ms').innerHTML="کد ملی صحیح نمی باشد"
            return false;	
	}
    if (meli_code.length == 10) {
        if (meli_code == '1111111111' ||
            meli_code == '0000000000' ||
            meli_code == '2222222222' ||
            meli_code == '3333333333' ||
            meli_code == '4444444444' ||
            meli_code == '5555555555' ||
            meli_code == '6666666666' ||
            meli_code == '7777777777' ||
            meli_code == '8888888888' ||
            meli_code == '9999999999') {
           alert("کد ملی صحیح نمی باشد");
           document.getElementById('codemeli').focus();
			//document.getElementById('ms').innerHTML="کد ملی صحیح نمی باشد"
            return false;
        }
        c = parseInt(meli_code.charAt(9));
        n = parseInt(meli_code.charAt(0)) * 10 +
            parseInt(meli_code.charAt(1)) * 9 +
            parseInt(meli_code.charAt(2)) * 8 +
            parseInt(meli_code.charAt(3)) * 7 +
            parseInt(meli_code.charAt(4)) * 6 +
            parseInt(meli_code.charAt(5)) * 5 +
            parseInt(meli_code.charAt(6)) * 4 +
            parseInt(meli_code.charAt(7)) * 3 +
            parseInt(meli_code.charAt(8)) * 2;
        r = n - parseInt(n / 11) * 11;
        if ((r == 0 && r == c) || (r == 1 && c == 1) || (r > 1 && c == 11 - r)) {
            return true;
        } else {
            alert("کد ملی صحیح نمی باشد");
            document.getElementById('codemeli').focus();
			//document.getElementById('ms').innerHTML="کد ملی صحیح نمی باشد"
            return true;
        }
    } else {
        return true;
    }
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

var xmlHttp = null;
function creatxmlhttprequest(){
if(window.ActiveXobject){
xmlHttp = new ActiveXobject('microsoft.XMLHTTP')
}else{
xmlHttp = new XMLHttpRequest();
}
return xmlHttp;
}
function proccess1(){
document.getElementById('Layer7').innerHTML ='<br/><br/><div align="center"><img src="../pic/ajax_loader.gif" width="100" height="100" /></div>';
creatxmlhttprequest();
xmlHttp.open('GET','sabt_zaman.php?insert=1',true);
xmlHttp.onreadystatechange = update1;
xmlHttp.setRequestHeader("charset","utf-8");
xmlHttp.send(null);
}
function update1(){
if(  xmlHttp.readyState != 4){
var message = '<br/><br/><div align="center"><img src="../pic/ajax_loader.gif" width="100" height="100" /></div>';
document.getElementById('Layer7').innerHTML = message;
}
if(xmlHttp.readyState == 4){
if(xmlHttp.status == 200){
var message = xmlHttp.responseText;
document.getElementById('Layer7').innerHTML = message;
}
}
if(xmlHttp.readyState == 3){
document.getElementById('Layer7').innerHTML = '<br/><br/><div align="center">اشکال در اتصال مجدد سعی نمایید</div>';	
}
}

function proccess2(){
document.getElementById('Layer7').innerHTML ='<br/><br/><div align="center"><img src="../pic/ajax_loader.gif" width="100" height="100" /></div>';
creatxmlhttprequest();
xmlHttp.open('GET','sabt_zaman.php?insert=2',true);
xmlHttp.onreadystatechange = update1;
xmlHttp.setRequestHeader("charset","utf-8");
xmlHttp.send(null);
}
function update2(){
if(  xmlHttp.readyState != 4){
var message = '<br/><br/><div align="center"><img src="../pic/ajax_loader.gif" width="100" height="100" /></div>';
document.getElementById('Layer7').innerHTML = message;
}
if(xmlHttp.readyState == 4){
if(xmlHttp.status == 200){
var message = xmlHttp.responseText;
document.getElementById('Layer7').innerHTML = message;
}
}
if(xmlHttp.readyState == 3){
document.getElementById('Layer7').innerHTML = '<br/><br/><div align="center">اشکال در اتصال مجدد سعی نمایید</div>';	
}
}

function show(x){
document.getElementById(x).style.visibility = "visible";	
}
function hide(x){
document.getElementById(x).style.visibility = "hidden";	
}
function clear(x){
document.getElementById(x).innerHTML = "";	
}
function select_noe(){
var v =document.getElementById('noe_darkhast').value;	
if(v=="13"){
	document.getElementById('trjaygozin').style.visibility = "visible"; 
	}else{
	document.getElementById('trjaygozin').style.visibility = "hidden"; 
		}
if(v=="1"|| v=="2" || v=="10" || v=="11" || v=="12" ){
	document.getElementById('trmodat').style.visibility = "hidden"; 
	document.getElementById('trsaat').style.visibility = "visible"; 
	document.getElementById('modat2').style.visibility = "hidden";
	document.getElementById('saat').innerHTML = "ساعت";
	document.getElementById('tarikh').innerHTML = "در تاریخ";
	}else if(v=="4" || v=="6"){
	document.getElementById('trmodat').style.visibility = "visible"; 
	document.getElementById('trsaat').style.visibility = "visible"; 
	document.getElementById('modat2').style.visibility = "hidden";
	document.getElementById('saat').innerHTML = "ساعت";
	document.getElementById('noe_zaman').innerHTML = "روز";
	document.getElementById('tarikh').innerHTML = "از تاریخ";
	}else{
	document.getElementById('trmodat').style.visibility = "visible"; 
	document.getElementById('trsaat').style.visibility = "visible"; 
	document.getElementById('modat2').style.visibility = "visible";	
	document.getElementById('saat').innerHTML = "از ساعت";
	document.getElementById('noe_zaman').innerHTML = "ساعت";
	document.getElementById('tarikh').innerHTML = "در تاریخ";
	}
}
function select_noe2(){
var v =document.getElementById('eslah').value;	
if(v=="1"){
	document.getElementById('eslah_saat').style.visibility = "visible"; 
	}
if(v=="2"){
	document.getElementById('eslah_saat').style.visibility = "hidden"; 
	}
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}