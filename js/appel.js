
var call= document.getElementById("callLink");
  var info = document.getElementById("info");
  var close = document.getElementById("close-info");
 
      /*  if(info.innerHTML.trim() == ""){
            info.style.display = 'none';
        }else{
            info.style.display = 'block';
        }*/
      
       
        close.addEventListener('click',function(){
            info.style.display = 'none';
        })
       
        call.addEventListener("click", function(event) {
            event.preventDefault(); // Empêche l'appel immédiat
          
                window.location.href = this.href; // Redirige vers l'appel
           
        });
       
        document.getElementById("omenu").addEventListener("click", function(){
            document.getElementById("menu").style.right = "0px";
            document.getElementById("cmenu").style.display = "block";
            document.getElementById("omenu").style.display = "none";
        });
        document.getElementById("cmenu").addEventListener("click", function(){
            document.getElementById("menu").style.right = "-280px";
            document.getElementById("cmenu").style.display = "none";
            document.getElementById("omenu").style.display = "block";
        });
    