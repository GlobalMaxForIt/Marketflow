//light mode or dark mode
let light_mode = document.getElementById('light-mode-check')
let dark_mode = document.getElementById('dark-mode-check')
let body_layout = document.getElementById('body_layout')
let wrapper = document.getElementById('wrapper')
let content_page = document.querySelector('.content-page')
let modal_content = document.querySelector('.modal-content')
let layout_local = localStorage.getItem('layout_local')
light_mode.addEventListener('click', function (){
    localStorage.setItem('layout_local', 'light')
    removeDarkContainer(content_page)
    removeDarkContainer(modal_content)
})
dark_mode.addEventListener('click', function (){
    localStorage.setItem('layout_local', 'dark')
    setDarkContainer(content_page)
    setDarkContainer(modal_content)
})

if(layout_local == undefined || layout_local == null){
    body_layout.setAttribute('data-layout-color', 'default')
}else{
    body_layout.setAttribute('data-layout-color', layout_local)
    if(layout_local == 'light'){
        removeDarkContainer(content_page)
        removeDarkContainer(modal_content)
    }else if(layout_local == 'dark'){
        setDarkContainer(content_page)
        setDarkContainer(modal_content)
    }
}

function removeDarkContainer(modal_container){
    if(modal_container != undefined && modal_container != null){
        if(modal_container.classList.contains('back_dark')){
            modal_container.classList.remove('back_dark')
        }
    }
    if(wrapper != undefined && wrapper != null){
        if(wrapper.classList.contains('back_dark')){
            wrapper.classList.remove('back_dark')
        }
    }
}
function setDarkContainer(modal_container){
    if(modal_container != undefined && modal_container != null){
        if(!modal_container.classList.contains('back_dark')){
            modal_container.classList.add('back_dark')
        }
    }
    if(wrapper != undefined && wrapper != null){
        if(!wrapper.classList.contains('back_dark')){
            wrapper.classList.add('back_dark')
        }
    }
}


//fluid or boxed
let fluid = document.getElementById('fluid')
let boxed = document.getElementById('boxed')
fluid.addEventListener('click', function (){
    localStorage.setItem('fluid_or_boxed', 'fluid')
})
boxed.addEventListener('click', function (){
    localStorage.setItem('fluid_or_boxed', 'boxed')
})
if(localStorage.getItem('fluid_or_boxed') == undefined || localStorage.getItem('fluid_or_boxed') == null){
    body_layout.setAttribute('data-layout-size', 'fluid')
}else{
    body_layout.setAttribute('data-layout-size', localStorage.getItem('fluid_or_boxed'))
}

//fixed or scrollable
let fixed_check = document.getElementById('fixed-check')
let scrollable_check = document.getElementById('scrollable-check')
fixed_check.addEventListener('click', function (){
    localStorage.setItem('fixed_or_scrollable', 'fixed')
})
scrollable_check.addEventListener('click', function (){
    localStorage.setItem('fixed_or_scrollable', 'scrollable')
})
if(localStorage.getItem('fixed_or_scrollable') == undefined || localStorage.getItem('fixed_or_scrollable') == null){
    body_layout.setAttribute('data-leftbar-positione', 'fixed')
}else{
    body_layout.setAttribute('data-leftbar-position', localStorage.getItem('fixed_or_scrollable'))
}

//fixed or scrollable
let light = document.getElementById('light')
let dark = document.getElementById('dark')
let brand = document.getElementById('brand')
let gradient = document.getElementById('gradient')
light.addEventListener('click', function (){
    localStorage.setItem('leftbar_color', 'light')
})
dark.addEventListener('click', function (){
    localStorage.setItem('leftbar_color', 'dark')
})
brand.addEventListener('click', function (){
    localStorage.setItem('leftbar_color', 'brand')
})
gradient.addEventListener('click', function (){
    localStorage.setItem('leftbar_color', 'gradient')
})
if(localStorage.getItem('leftbar_color') == undefined || localStorage.getItem('leftbar_color') == null){
    body_layout.setAttribute('data-leftbar-color', 'light')
}else{
    body_layout.setAttribute('data-leftbar-color', localStorage.getItem('leftbar_color'))
}

//fixed or scrollable
let default_size_check = document.getElementById('default-size-check')
let condensed_check = document.getElementById('condensed-check')
let compact_check = document.getElementById('compact-check')
default_size_check.addEventListener('click', function (){
    localStorage.setItem('leftbar_size', 'default')
})
condensed_check.addEventListener('click', function (){
    localStorage.setItem('leftbar_size', 'condensed')
})
compact_check.addEventListener('click', function (){
    localStorage.setItem('leftbar_size', 'compact')
})
if(localStorage.getItem('leftbar_size') == undefined || localStorage.getItem('leftbar_size') == null){
    body_layout.setAttribute('data-leftbar-size', 'default')
}else{
    body_layout.setAttribute('data-leftbar-size', localStorage.getItem('leftbar_size'))
}

//Topbar color
let darktopbar_check = document.getElementById('darktopbar-check')
let lighttopbar_check = document.getElementById('lighttopbar-check')
darktopbar_check.addEventListener('click', function (){
    localStorage.setItem('topbar_color', 'dark')
})
lighttopbar_check.addEventListener('click', function (){
    localStorage.setItem('topbar_color', 'light')
})
if(localStorage.getItem('topbar_color') == undefined || localStorage.getItem('topbar_color') == null){
    body_layout.setAttribute('data-topbar-color', 'light')
}else{
    body_layout.setAttribute('data-topbar-color', localStorage.getItem('topbar_color'))
}

// Reset to default
let resetBtn = document.getElementById('resetBtn')
resetBtn.addEventListener('click', function (){
    if(localStorage.getItem('topbar_color') != undefined || localStorage.getItem('topbar_color') != null){
        localStorage.removeItem('topbar_color')
    }
    if(localStorage.getItem('leftbar_size') != undefined || localStorage.getItem('leftbar_size') != null){
        localStorage.removeItem('leftbar_size')
    }
    if(localStorage.getItem('leftbar_color') != undefined || localStorage.getItem('leftbar_color') != null){
        localStorage.removeItem('leftbar_color')
    }
    if(localStorage.getItem('fixed_or_scrollable') != undefined || localStorage.getItem('fixed_or_scrollable') != null){
        localStorage.removeItem('fixed_or_scrollable')
    }
    if(localStorage.getItem('fluid_or_boxed') != undefined || localStorage.getItem('fluid_or_boxed') != null){
        localStorage.removeItem('fluid_or_boxed')
    }
    if(localStorage.getItem('layout_local') != undefined || localStorage.getItem('layout_local') != null){
        localStorage.removeItem('layout_local')
    }
    location.reload();
})