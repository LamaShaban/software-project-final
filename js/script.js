let navbarr = document.querySelector('.header');
let cancel = document.querySelector('.fa-circle-xmark');
let barlist = document.querySelector('.fa-bars');
let sidebars = document.querySelector('.sidebars');

window.onscroll = (e) => {
    if(window.scrollY ==0){
        navbarr.classList.remove('scrl');
        btn_top.style.bottom = '-120px';
    }
    else{
        navbarr.classList.add('scrl');
        btn_top.style.bottom = '20px';
        
    }
}
barlist.onclick = function() {
    sidebars.style.right = '0px';
    behavior: 'smooth';
}
cancel.onclick =  function() {
    sidebars.style.right = '-300px';
    behavior: 'smooth';
}