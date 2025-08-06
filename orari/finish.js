let tabHeaders = document.querySelectorAll(".tabs .tab-header > div");
let tabContents = document.querySelectorAll(".tabs .tab-content > div");

for(let i=0;i<tabHeaders.length;i++){
  tabHeaders[i].addEventListener("click",function(){
    document.querySelector(".tabs .tab-header > .active").classList.remove("active");
    tabHeaders[i].classList.add("active");
    document.querySelector(".tabs .tab-content > .active").classList.remove("active");
    tabContents[i].classList.add("active");
  })
}

function ndryshoOrarinBazeDites() {
    
    let ditaSotme = new Date();
    let ditaAktuale = ditaSotme.getDay();

    
    if (ditaAktuale === 0 || ditaAktuale === 6) {
        ditaAktuale = 1; // Dita e henes
    }

    
    if (ditaAktuale >= 1 && ditaAktuale <= 5) {
        document.querySelector(".tabs .tab-header > .active").classList.remove("active");
        document.querySelector(".tabs .tab-content > .active").classList.remove("active");

        tabHeaders[ditaAktuale - 1].classList.add("active");
        tabContents[ditaAktuale - 1].classList.add("active");
    }
}

ndryshoOrarinBazeDites();

setInterval(ndryshoOrarinBazeDites, 24 * 60 * 60 * 1000);




var loader;
function loadNow(opacity) {
    if(opacity <= 0) {
        displayContent();
    }
    else {
        loader.style.opacity = opacity;
        window.setTimeout(function() {
            loadNow(opacity - 0.2);
        }, 150);
    }
}

function displayContent () {
    loader.style.display = 'none';
    document.getElementById('content').style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
    loader = document.getElementById('loader');
    loadNow(1);
});

var icon = document.getElementById("icon");

icon.onclick = function(){
    document.body.classList.toggle("dark-theme");
    if(document.body.classList.contains("dark-theme")){
        icon.src = "light.png";
        localStorage.setItem("theme", "dark-theme"); 
    }
    else {
        icon.src = "moon.png";
        localStorage.setItem("theme", ""); 
    }
}


var currentTheme = localStorage.getItem("theme");
if (currentTheme) {
    document.body.classList.add(currentTheme);
   
    if (currentTheme === "dark-theme") {
        icon.src = "light.png";
    } else {
        icon.src = "moon.png";
    }
}