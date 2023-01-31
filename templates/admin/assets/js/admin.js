
var menu = document.getElementById("menu-container");
var menuListItems = menu.querySelectorAll('a');
menuListItems.forEach( item => {
    item.addEventListener("mouseover", e => {
        e.target.querySelector('.item-label').classList.remove("d-none");
    })
    item.addEventListener("mouseleave", e => {
        e.target.querySelector('.item-label').classList.add("d-none");
    })
    // console.log(item)
})
var links = sidebar.querySelectorAll("a.nav-link")
links.forEach( el => {
    // console.log("piruzinho")
    el.addEventListener('mouseover', (e) => {
        e.target.classList.add('active');
        e.target.classList.remove('text-white');
    })
    el.addEventListener('mouseleave', (e) => {
        e.target.classList.remove('active');
        e.target.classList.add('text-white');
    })
});

var menu = document.getElementById("menu_btn");
menu.addEventListener("mouseover", (e) => {
    // console.log(menu)
    if(sidebar.classList.contains('d-none')){
        sidebar.classList.remove('d-none')
        e.target.classList.add('d-none')
    }else{
        sidebar.classList.add('d-none')
        e.target.classList.remove('d-none')
    }
})
sidebar.addEventListener("mouseleave", e => {
    sidebar.classList.add('d-none');
    menu.classList.remove('d-none')
})
// console.log(links);
