var target = document.getElementById('book-conteiner');
console.log(target)
target.addEventListener("mouseover", remove_class, false);
target.addEventListener("mouseout", add_class, false);



function add_class() {
    console.log("here")
    target.classList.add('mouseover')
    setTimeout(()=>{
        target.classList.remove('mouseover')
    } , 400)
 }
 
 function remove_class() {  
    target.classList.remove('mouseover')

 }


