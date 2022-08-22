function calculate(a) {
	if (ayear.value==0&&a>1) {alert("Select assesment year");ayear.focus();return;}
	if (tpayer.value==0&&a>2) {alert("Select tax payer");tpayer.focus();return;}
	if (schm.value==0&&a>3) {alert("Select New scheme or old scheme");schm.focus();return;}
	if (gender.value==0&&a>4) {alert("Select Male/ Female / Senior");gender.focus();return;}
	if (rsstat.value==0&&a>5) {alert("Select residential status");rsstat.focus();return;}
	if (dob.value==""&&a>6) {alert("Select/ Enter Date of birth");dob.focus();return;}
	if (ayear.value==0||tpayer.value==0||schm.value==0||gender.value==0||rsstat.value==0||dob.value=="") return;
	if (dob.value<"1900-01-01") return;
	var e=document.getElementById("ayear");
var a=e.options[e.selectedIndex].text;
var f1=a.substring(0,4) - 1;
var fyear="01.04."+ f1 +" to 31.03." + a.substring(0,4);
	document.getElementById("tdet").innerHTML="Tax Details for the Financial year " + fyear;
var lastday=new Date(a.substring(0,4) + "-03-31");
var db=new Date(dob.value);
var diff=(lastday.getTime() - db.getTime())/1000;
	diff/=(60*60*24);
var age = Math.abs(Math.floor(diff/365.25));

if (age >= 80&&gender.value!=4) {
	alert("As per DOB you are Super Senior Citizen");
	document.getElementById("gender").selectedIndex=4;
} else if (age >= 60&&age<80&&gender.value!=3) {
	alert("As per DOB you are Senior Citizen");
	document.getElementById("gender").selectedIndex=3;
} else if (gender.value>2&&age<60){
	alert("As per DOB you have to select Male or Female");return;
}
var data=ayear.value+"#"+tpayer.value+"#"+schm.value+"#"+gender.value+"#"+rsstat.value+"#"+dob.value+"#"+sal.value+"#"+hinc.innerHTML+"#"+oincome.value+"#"+profit.value+"#"+agri.value+"#"+c80.value+"#"+d80.innerHTML+"#"+cap1.value+"#"+cap2.value+"#"+cap3.value+"#"+cap4.value+"#"+ltincome.value;
	data=data.replaceAll(",","");
if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
         }
        xmlhttp.onreadystatechange = function() {
			 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				 var r=xmlhttp.responseText;
				 var r1=r.split("#"); 
				if (r1.length==8)
				{document.getElementById("netinc").innerHTML=indformat1(r1[0]);
				 document.getElementById("ctax").innerHTML=indformat1(r1[1]);
				 document.getElementById("ptax").innerHTML=indformat1(r1[2]);
				 document.getElementById("edu").innerHTML=indformat1(r1[3]);
				 document.getElementById("tot").innerHTML=indformat1(r1[4]);
				 document.getElementById("spinc").innerHTML=indformat1(r1[5]);
				 document.getElementById("sptax").innerHTML=indformat1(r1[6]);
				 document.getElementById("surc").innerHTML=indformat1(r1[7]);
				 } else {alert(r);}
             }
        }			
        xmlhttp.open("POST","index.php",true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlhttp.send("cal="+data);
  }

function display(a) {
	if (a==1)  {
		document.getElementById("capital").style.display="none";
		document.getElementById("ded80").style.display="none";
		document.getElementById("house").style.display="inline";
		document.getElementById("ipself").focus();
	} else if (a==2)  {
		document.getElementById("house").style.display="none";
		document.getElementById("ded80").style.display="none";
		document.getElementById("capital").style.display="inline";
		document.getElementById("cap1").focus();
	} else if (a==3)  {
		document.getElementById("capital").style.display="none";
		document.getElementById("house").style.display="none";
		document.getElementById("ded80").style.display="inline";
		document.getElementById("d2").focus();
	}
			}

function hide(a) {
	if (a==1)  {
		document.getElementById("house").style.display="none";
	} else if (a==2)  {
		document.getElementById("capital").style.display="none";
	} else if (a==3)  {
		document.getElementById("ded80").style.display="none";
	}
				}

function housing(a) {
		indformat(a);
var net=hrent.value.replaceAll(",","") - htax.value.replaceAll(",","")  - rpend.value.replaceAll(",","") ;
		document.getElementById("hnet").innerHTML=indformat1(net);
var std=net * .3;
		document.getElementById("hstd").innerHTML=indformat1(std);
var ilet = net - std - iplet.value.replaceAll(",","");
		document.getElementById("inclet").innerHTML=indformat1(ilet);
var ipsel=ipself.value.replaceAll(",","");
	if (ipsel > 200000) {ipsel = 200000;}
var ip = ilet - ipsel;
	if (ip < -200000) {ip = -200000;}
		document.getElementById("hinc").innerHTML=indformat1(ip);
	}
function capital(a) {
		indformat(a);
var capt = 0;
	if (!isNaN(parseInt(cap1.value))&& cap1.value!="") {
		capt = capt + parseInt(cap1.value.replaceAll(",",""));
	}
	if (!isNaN(parseInt(cap2.value))&& cap2.value!="") {
		capt = capt + parseInt(cap2.value.replaceAll(",",""));
	}
	if (!isNaN(parseInt(cap3.value))&& cap3.value!="") {
		capt = capt + parseInt(cap3.value.replaceAll(",",""));
	}
	if (!isNaN(parseInt(cap4.value))&& cap4.value!="") {
		capt = capt + parseInt(cap4.value.replaceAll(",",""));
	}	
		document.getElementById("captot").innerHTML=indformat1(capt);
			}

function indformat(a) {	
var neg=false;
var ab=document.getElementById(a).value;
	if (ab.includes("-")) {ab = ab.replaceAll("-","");neg = true;}
		ab=ab.replaceAll(",","");
	if (isNaN(ab)) {
		alert("Only Numeric allowed");document.getElementById(a).value="";
	} else {	
	if (ab=="") ab=0;
		ab=parseFloat(ab);
		ab=ab.toFixed(0);
var n=ab.length;
	if (n > 3) {
		for (i=2;i < n;i++) {
	if (i %2 ==1) ab = ab.substr(0,n - i) + "," + ab.substr(n - i,20);
	}
		}
		ab=ab+".00";
	if (neg) {ab="-"+ab;}
		document.getElementById(a).value=ab;
	}
		//calculate();
		}

function indformat1(a) {
var neg=false;
var ab = a + "";
	if (ab.includes("-")) {ab = ab.replaceAll("-","");neg = true;}
		ab=ab.replaceAll(",","");
	if (isNaN(ab)) {
		ab = "";
	} else {	
	if (ab=="") ab=0;
		ab=parseFloat(ab);
		ab=ab.toFixed(0);
var n=ab.length;
	if (n > 3) {
		for (i=2;i < n;i++) {
	if (i %2 ==1) ab = ab.substr(0,n - i) + "," + ab.substr(n - i,20);
	}
		}
		ab=ab+".00";
	if (neg) {ab="-"+ab;}
		return ab;
	}	}

function ded80(a,b) {
var aa;
		aa=document.getElementById(a).value;
		aa=parseInt(aa.replaceAll(",",""));
	if (aa > b){alert("Maximum amount allowed here is " + b);aa=b;}
		aa=indformat1(aa);
		document.getElementById(a).value=aa;
var tot=0;
		for (i=2;i<14;i++){
		aa=document.getElementById("d"+i).value;
	if (!isNaN(parseInt(aa))&& aa!="") {
		tot = tot + parseInt(aa.replaceAll(",",""));
	}
		}
		document.getElementById("d80").innerHTML=indformat1(tot);
			}

function newschemopt() {
if (schm.value==2)
{document.getElementById("ipsel").style.display="inline";
document.getElementById("ded80_1").style.display="inline";
} else if (schm.value==1) {

document.getElementById("ipself").value=0;
document.getElementById("ipsel").style.display="none";;
document.getElementById("ded80_1").style.display="none";;
}

}

// When the user clicks on div, open the popup
function myPopup(a) {
var popup = document.getElementById("myPopup"+a);
 popup.classList.toggle("show");
}