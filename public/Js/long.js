lastScrollY=0; 
var InterTime = 1;
var maxWidth=-1;
var minWidth=-156;
var numInter = 8;

var BigInter ;
var SmallInter ;

var o =  document.getElementById("xixi");
	var i = parseInt(o.style.left);
	function Big()
	{
		if(parseInt(o.style.left)<maxWidth)
		{
			i = parseInt(o.style.left);
			i += numInter;	
			o.style.left=i+"px";	
			if(i==maxWidth)
				clearInterval(BigInter);
		}
	}
	function toBig()
	{
		clearInterval(SmallInter);
		clearInterval(BigInter);
			BigInter = setInterval(Big,InterTime);
	}
	function Small()
	{
		if(parseInt(o.style.left)>minWidth)
		{
			i = parseInt(o.style.left);
			i -= numInter;
			o.style.left=i+"px";
			
			if(i==minWidth)
				clearInterval(SmallInter);
		}
	}
	function toSmall()
	{
		clearInterval(SmallInter);
		clearInterval(BigInter);
		SmallInter = setInterval(Small,InterTime);
		
	}
	
function dyniframesize(down) 
{ 
	var pTar = null; 
	if (document.getElementById)
	{ 
		pTar = document.getElementById(down); 
	} 
	else
	{ 
		eval('pTar = ' + down + ';'); 
	} 
	if (pTar && !window.opera)
	{ 
		//begin resizing iframe 
		pTar.style.display="block" 
		if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight)
		{ 
			//ns6 syntax 
			pTar.height = pTar.contentDocument.body.offsetHeight +20; 
			//pTar.width = pTar.contentDocument.body.scrollWidth; 
			//pTar.width = pTar.contentDocument.body.scrollWidth+20; 
		} 
		else if (pTar.Document && pTar.Document.body.scrollHeight)
		{ 
			//ie5+ syntax 
			pTar.height = pTar.Document.body.scrollHeight; 
			//pTar.width = pTar.Document.body.scrollWidth; 
		} 
	} 
} 