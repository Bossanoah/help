
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