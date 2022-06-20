 //nav bar 
 let toggle_icon = document.getElementsByClassName('icon')[0]
 const toggleNavBar = ()=> {
     let x = document.getElementById("myTopnav");
     x.classList.toggle('responsive')
 }
 toggle_icon.addEventListener('click' , toggleNavBar)
 
 
 //Back to top button
 mybutton = document.getElementById("myBtn");
 window.onscroll = function() {scrollFunction()};
 function scrollFunction() {
     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
       mybutton.style.display = "block";
     } else {
       mybutton.style.display = "none";
     }
   }
 function topFunction() {
     document.body.scrollTop = 0;
     document.documentElement.scrollTop = 0; 
 }