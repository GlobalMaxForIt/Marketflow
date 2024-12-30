//light mode or dark mode
let light_mode = document.getElementById('light-mode-check')
let dark_mode = document.getElementById('dark-mode-check')
let body_layout = document.getElementById('body_layout')
let wrapper = document.getElementById('wrapper')
let keyboard_heading = document.querySelector('#keyboard_heading button')
let keyboard_body = document.getElementById('keyboard_body')
let content_page = document.querySelector('.content-page')
let modal_content = document.querySelector('.modal-content')
let layout_local = localStorage.getItem('layout_local')
if(layout_local == undefined || layout_local == null){
    localStorage.setItem('layout_local', 'light')
    layout_local = 'light'
}
let keys_keyboard = document.getElementsByClassName('key')
let keys_keyboard_big = document.getElementsByClassName('key_big')
let keys_keyboard_big_fast = document.getElementsByClassName('key_big_fast')
let key_space = document.getElementsByClassName('key_space_big')
let key_space_big = document.getElementsByClassName('key_space')
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
    if(keyboard_body != undefined && keyboard_body != null){
        if(keyboard_body.classList.contains('back_dark')){
            keyboard_body.classList.remove('back_dark')
        }
    }
    if(keyboard_heading != undefined && keyboard_heading != null){
        if(keyboard_heading.classList.contains('dark_header_keyboard')){
            keyboard_heading.classList.remove('dark_header_keyboard')
        }
    }
    for(let k=0; k<key_space.length; k++){
        if(key_space[k].classList.contains('dark_keyboard')){
            key_space[k].classList.remove('dark_keyboard')
        }
    }
    for(let k=0; k<keys_keyboard.length; k++){
        if(keys_keyboard[k].classList.contains('dark_keyboard')){
            keys_keyboard[k].classList.remove('dark_keyboard')
        }
    }
    for(let k=0; k<key_space_big.length; k++){
        if(key_space_big[k].classList.contains('dark_keyboard')){
            key_space_big[k].classList.remove('dark_keyboard')
        }
    }
    for(let k=0; k<keys_keyboard_big.length; k++){
        if(keys_keyboard_big[k].classList.contains('dark_keyboard')){
            keys_keyboard_big[k].classList.remove('dark_keyboard')
        }
    }
    for(let k=0; k<keys_keyboard_big_fast.length; k++){
        if(keys_keyboard_big_fast[k].classList.contains('dark_keyboard')){
            keys_keyboard_big_fast[k].classList.remove('dark_keyboard')
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
    if(keyboard_body != undefined && keyboard_body != null){
        if(!keyboard_body.classList.contains('back_dark')){
            keyboard_body.classList.add('back_dark')
        }
    }
    for(let k=0; k<keys_keyboard.length; k++){
        if(!keys_keyboard[k].classList.contains('dark_keyboard')){
            keys_keyboard[k].classList.add('dark_keyboard')
        }
    }
    for(let k=0; k<key_space.length; k++){
        if(!key_space[k].classList.contains('dark_keyboard')){
            key_space[k].classList.add('dark_keyboard')
        }
    }
    for(let k=0; k<keys_keyboard_big_fast.length; k++){
        if(!keys_keyboard_big_fast[k].classList.contains('dark_keyboard')){
            keys_keyboard_big_fast[k].classList.add('dark_keyboard')
        }
    }
    for(let k=0; k<keys_keyboard_big.length; k++){
        if(!keys_keyboard_big[k].classList.contains('dark_keyboard')){
            keys_keyboard_big[k].classList.add('dark_keyboard')
        }
    }
    for(let k=0; k<key_space_big.length; k++){
        if(!key_space_big[k].classList.contains('dark_keyboard')){
            key_space_big[k].classList.add('dark_keyboard')
        }
    }
    if(keyboard_heading != undefined && keyboard_heading != null){
        if(!keyboard_heading.classList.contains('dark_header_keyboard')){
            keyboard_heading.classList.add('dark_header_keyboard')
        }
    }
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

let barcode_on_or_off = document.getElementById('barcode_on_or_off')

let all_products_list_for_selling = document.getElementById('all_products_list_for_selling')
let all_products_list_for_selling_title_barcode = ''
let all_products_list_for_selling_tbody_barcodes = ''
let barcode_checked = ''
if(all_products_list_for_selling != undefined && all_products_list_for_selling != null){
    all_products_list_for_selling_title_barcode = all_products_list_for_selling.querySelector('.barcode_title_column')
    all_products_list_for_selling_tbody_barcodes = all_products_list_for_selling.querySelectorAll('.barcode_number_column')
}

let barcode_status = localStorage.getItem('barcode')
if(barcode_status != undefined && barcode_status != null){
    barcodeOnFunc()
    if(barcode_on_or_off != undefined && barcode_on_or_off != null){
        barcode_on_or_off.checked = true
    }
    if(barcode_checked != undefined && barcode_checked != null){
        barcode_checked.checked = true
    }
}else if(barcode_status == 'true'){
    barcodeOnFunc()
    if(barcode_on_or_off != undefined && barcode_on_or_off != null){
        if(!barcode_on_or_off.checked){
            barcode_on_or_off.checked = true
            barcode_checked = true
        }
    }
}else if(barcode_status == 'false'){
    barcodeOffFunc()
    if(barcode_checked != undefined && barcode_checked != null){
        if(barcode_on_or_off.checked){
            barcode_on_or_off.checked = false
            barcode_checked = false
        }
    }
}

if(barcode_on_or_off != undefined && barcode_on_or_off != null){
    barcode_on_or_off.addEventListener('click', function (event) {
        if(barcode_checked){
            barcodeOffFunc()
            localStorage.setItem('barcode', 'false')
        }else{
            barcodeOnFunc()
            localStorage.setItem('barcode', 'true')
        }
    })
}

function barcodeOnFunc(){
    if(all_products_list_for_selling_title_barcode != undefined && all_products_list_for_selling_title_barcode != null && all_products_list_for_selling_title_barcode != ''){
        if(all_products_list_for_selling_title_barcode.classList.contains('d-none')){
            all_products_list_for_selling_title_barcode.classList.remove('d-none')
        }
    }
    if(all_products_list_for_selling_tbody_barcodes != undefined && all_products_list_for_selling_tbody_barcodes != null && all_products_list_for_selling_tbody_barcodes != ''){
        for(let l=0; l<all_products_list_for_selling_tbody_barcodes.length; l++){
            if(all_products_list_for_selling_tbody_barcodes[l].classList.contains('d-none')){
                all_products_list_for_selling_tbody_barcodes[l].classList.remove('d-none')
            }
        }
    }
    if(barcode_on_or_off != undefined && barcode_on_or_off != null){
        if(!barcode_on_or_off.classList.contains('checkbox_checked')){
            barcode_on_or_off.classList.add('checkbox_checked')
        }
        if(barcode_on_or_off.classList.contains('checkbox_unchecked')){
            barcode_on_or_off.classList.remove('checkbox_unchecked')
        }
        barcode_on_or_off.checked = true
    }
    if(barcode_checked != undefined && barcode_checked != null){
        barcode_checked = true
    }
}
function barcodeOffFunc(){
    if(all_products_list_for_selling_title_barcode != undefined && all_products_list_for_selling_title_barcode != null && all_products_list_for_selling_title_barcode != ''){
        if(!all_products_list_for_selling_title_barcode.classList.contains('d-none')){
            all_products_list_for_selling_title_barcode.classList.add('d-none')
        }
    }
    if(all_products_list_for_selling_tbody_barcodes != undefined && all_products_list_for_selling_tbody_barcodes != null && all_products_list_for_selling_tbody_barcodes != ''){
        for(let l=0; l<all_products_list_for_selling_tbody_barcodes.length; l++){
            if(!all_products_list_for_selling_tbody_barcodes[l].classList.contains('d-none')){
                all_products_list_for_selling_tbody_barcodes[l].classList.add('d-none')
            }
        }
    }
    if(barcode_on_or_off != undefined && barcode_on_or_off != null){
        if(!barcode_on_or_off.classList.contains('checkbox_unchecked')){
            barcode_on_or_off.classList.add('checkbox_unchecked')
        }
        if(barcode_on_or_off.classList.contains('checkbox_checked')){
            barcode_on_or_off.classList.remove('checkbox_checked')
        }
        barcode_on_or_off.checked = false
    }
    if(barcode_checked != undefined && barcode_checked != null){
        barcode_checked = false
    }
}

