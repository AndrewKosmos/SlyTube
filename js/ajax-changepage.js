function ChangePage(link){
    var content = document.getElementById("mainContent");
    var loading = document.getElementById("preloader");
    
    content.innerHTML = loading.innerHTML;
    
    var http  = createRequestObject();
    if(http)
        {
            http.open('get',link);
            http.onreadystatechange = function()
            {
                if(http.readyState == 4)
                    {
                        content.innerHTML = http.responseText;
                    }
            }
            http.send(null);
        }
    else
        {
            document.location = link;
        }
}

function createRequestObject()
{
    try{return new XMLHttpRequest()}
    catch(e)
        {
            try{return new ActiveXObject('Msxml2.XMLHTTP')}
            catch(e)
                {
                    try { return new ActiveXObject('Microsoft.XMLHTTP') }  
                    catch(e) { return null; } 
                }
        }
}