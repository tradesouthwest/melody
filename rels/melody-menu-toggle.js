/* begin Back to Top button & show menu @package melody */
document.addEventListener('DOMContentLoaded', function () {
    var width = window.innerWidth;
    const targetDiv = document.getElementById('togmenu'); 
    
    if ( width < 980 ) {
        let mode = sessionStorage.getItem('styl');
        //document.body.classList.add('mode');
        console.log(mode + "is"); 
        
        if (targetDiv.style.display !== "none") {
            targetDiv.style.display = mode;
        }

    } else {
        targetDiv.style.display = "flex";
    }

});

window.onclick = function(event){
    console.log(event.target.className);

    if(event.target.className=='primary-anchor'){
        hideMenu();
        console.log("found");
    }   
}

function hideMenu( ){
    //length = window.innerWidth;
    var expiration_date = new Date();
    expiration_date.setFullYear(expiration_date.getFullYear() + 1);
    sessionStorage.setItem('styl', 'none');
    //sessionStorage.removeItem('styl');
    //const targetDiv = document.getElementById('togmenu'); 

    
}

function handleClick() {
    const targetDiv = document.getElementById('togmenu'); 

    if (targetDiv.style.display !== "flex") {
        targetDiv.style.display = "flex";
            console.log("ok");
        } else {

        targetDiv.style.display = "none";
            console.log("not");
        }
        //return false;
}

window.addEventListener("resize", () => {
    const width = window.innerWidth;
    const targetDiv = document.getElementById('togmenu');
    
    if ( width < 979 ){
        targetDiv.style.display = "none";
    } else {
        targetDiv.style.display = "flex";
    }
}); 
