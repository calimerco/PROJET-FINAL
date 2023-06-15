// icon burger
const burger = document.querySelector('.burger');

burger.addEventListener('click', () => 
{ burger.classList.toggle('active'); });

// nav responsive


const navlinks_cont = document.querySelector('.navlinks_cont');

burger.addEventListener('click', () => 
{ navlinks_cont.classList.toggle('affiche'); });
