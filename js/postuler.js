document.addEventListener("DOMContentLoaded", function () {
   
    const serviceSelect = document.getElementById("services");
    const certificatContainer = document.getElementById("certificat-container");
    const menage = document.getElementById("services-menage");
    const avs = document.getElementById("services-avs");

    serviceSelect.addEventListener("change", function () {
        if (this.value == "auxiliaire"){
            certificatContainer.style.display = "block";
            avs.style.display = "block";
            menage.style.display = "none";
        }else if(this.value == "menage"){ 
            menage.style.display = "block";
            certificatContainer.style.display = "none";
            avs.style.display = "none";
        }
    });
})
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    if (message) {
        alert(message);
        window.history.replaceState(null, "", window.location.pathname); // Supprime le paramètre après l'affichage
    }
