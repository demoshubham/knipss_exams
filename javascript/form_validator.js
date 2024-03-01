
function formvalidation(id,type,length,con) { 
	
  switch(type) {
		
	case 'int': {
		
						
	        var sch = "0123456789";
	        var len = sch.length;
	        var len1 = id.length;
	        var val=''
	        var value='';
			var msg = '';
	
	        for(var i=0;i<len1;i++) {
		       for(var j=0;j<len;j++) {
			      if(id.charAt(i) == sch.charAt(j) && len1<=length) {				
				     value='true';
				     val +=id.charAt(i);
					 break;
			      }
				  else if(len1>length) { 
				      value='false';
					  msg = 'Field Valid for "+length+" digit';
					  break;
				  }				     
			      else {
				     value='false';
					 msg ='Invalid Character';
			      }
		       }
	        }	
	        if(value=='false') {
			   if(msg!='') { alert(msg);}	
	           val = parseInt(val);
			   if(val) {document.getElementById(con).value=val;}
			   else {document.getElementById(con).value=0;}
	        }			
	  break;
	  }	  
	  case 'float': { 
		  
	        var sch = ".0123456789";
	        var len = sch.length;
	        var len1 = id.length;
	        var val=''
	        var value='';
			var msg = '';
	
	        for(var i=0;i<len1;i++) {
		       for(var j=0;j<len;j++) {
			      if(id.charAt(i) == sch.charAt(j) && len1<=length) {				
				     value='true';
				     val +=id.charAt(i);
					 break;
			      }
				  else if(len1>length) { 
				      value='false';
					  msg = 'Field Valid for "+length+" digit';
					  break;
				  }				     
			      else {
				     value='false';
					 msg ='Invalid Character';
			      }
		       }
	        }	
	        if(value=='false') {
			   if(msg!='') { alert(msg);}	
	           val = parseFloat(val);
			   if(val) {document.getElementById(con).value=val;}
			   else {document.getElementById(con).value=0;}
	        }			
			
	  break;
	  }
		case 'varchar': {		
					   
	        var sch = "0123456789.abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ -_+";
	        var len = sch.length;
	        var len1 = id.length;
	        var value='';
			var val=''
	
	        for(var i=0;i<len1;i++) {
		       for(var j=0;j<len;j++) {
			      if((id.charAt(i) == sch.charAt(j) && len1<=length)) {				
				     value='true';
					 val +=id.charAt(i);
				     break;
			      }
				  else if(len1>length) { 
				      value='false';
					  alert("Field Valid for "+length+" digit");
					  break;
				  }				     
			      else {
				     value='false';					
			      }
		       }
			   if(len1>length) {break;}
	        }	
	        if(value=='false') {	
	           alert("Invalid Character");			  
	           document.getElementById(con).value=val;
	        }			
			break;
		}
		
		case 'mobile': {
			break;
		}
	}
	
}
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to continue?");
if (agree){
	return true ;
}
else {
	alert("As You Wish!");
	return false ;
} }
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}
function changeoption(id) {
if(id=='cash') {
document.getElementById("info").style.display='none';		
}
else {
document.getElementById("info").style.display='block';
}	
}
function changereg(id) {
if(id=='chasis') {
document.getElementById("chasis").style.display='block';
document.getElementById("regis").style.display='none';
}
else if(id=='reg'){
document.getElementById("chasis").style.display='none';
document.getElementById("regis").style.display='block';
}	
}
function amc_status(id){
 
 var value1='',value2='';
 
 document.getElementById("new").style.display='block';
 len = id.length;
	
 for( i=0;i<len;i++) { 
   if(id.charAt(i)=='-') { break;}
	  value1+=id.charAt(i);
	  
   }
 for(var j=i+1;j<len;j++) { 
	   value2+=id.charAt(j);	  
 }
 document.getElementById("amc_price").value=value2;
}