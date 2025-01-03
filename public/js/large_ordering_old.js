var myVar;
window.onload = function () {
    myVar = setTimeout(showPage, 1400);
}
let table_id = '';

let has_items = document.getElementById('has_items')
let no_items = document.getElementById('no_items')
// let client_with_discount_button = document.getElementById('client_with_discount_button')
let stock_int = 0

let loader = document.getElementById("loader")
let myDiv = document.getElementById("myDiv")
function showPage() {
    if(loader != undefined && loader != null){
        if(!loader.classList.contains("d-none")){
            loader.classList.add("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null) {
        if (myDiv.classList.contains("d-none")) {
            myDiv.classList.remove("d-none")
        }
    }
}
order_data_content = document.getElementById('order_data_content')

let order_json = {}
let order_data = []
let is_exist = false
let clientDiscountContent = document.getElementById('clientDiscountContent')
let clientDiscount = document.getElementById('clientDiscount')

let total_sum = document.getElementById('total_sum')
let totalLeftSum = document.getElementById('totalLeftSum')

let discountValue = 0
let percent_v = 0
let clientDicountPrice = 0
let productsPrice = 0
let servicePrice = 0
let all_sum = 0
let all_sum_withouth_discount = 0
let client_id = 0
let total_all_left_sum = 0
let confirm_client_discount = document.getElementById('confirm_client_discount')
let client_select_id_2 = document.getElementById('client_select_id_2')
let total_left_sum = document.getElementById('total_left_sum')
let clientFullName = document.getElementById('clientFullName')
let removeClientDiscount = document.getElementById('removeClientDiscount')
let clients_discount__sum = document.getElementById('clients_discount__sum')
let clients_total_discount__sum = document.getElementById('clients_total_discount__sum')
let total__sum = document.getElementById('total__sum')
let total_discount = document.getElementById('total_discount')

let discountInfo = []
let discountClientInfo = []

function showHasItems(){
    if(has_items != undefined && has_items != null){
        if(has_items.classList.contains('d-none')){
            has_items.classList.remove('d-none')
        }
    }
    if(no_items != undefined && no_items != null){
        if(!no_items.classList.contains('d-none')){
            no_items.classList.add('d-none')
        }
    }
    if(client_select_id_2 != undefined && client_select_id_2 != null) {
        client_select_id_2.disabled = false
    }
}
function hideHasItems() {
    if(has_items != undefined && has_items != null){
        if(!has_items.classList.contains('d-none')){
            has_items.classList.add('d-none')
        }
    }
    if(no_items != undefined && no_items != null){
        if(no_items.classList.contains('d-none')){
            no_items.classList.remove('d-none')
        }
    }
    if(client_select_id_2 != undefined && client_select_id_2 != null) {
        client_select_id_2.disabled = true
    }
}


function showClientDiscount(discount_content_element){
    if(discount_content_element != undefined && discount_content_element != null){
        if(discount_content_element.classList.contains('d-none')){
            discount_content_element.classList.remove('d-none')
        }
    }
}
function hideClientDiscount(discount_content_element) {
    if(discount_content_element != undefined && discount_content_element != null){
        if(!discount_content_element.classList.contains('d-none')){
            discount_content_element.classList.add('d-none')
        }
    }
}
if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
    localStorage.removeItem('order_data')
    localStorage.setItem('order_data', JSON.stringify(order_data))
    order_data = JSON.parse(localStorage.getItem('order_data'))
    hideHasItems()
}else{
    hideHasItems()
    order_data = []
}

if(order_data_content != undefined && order_data_content != null){
    order_data_html = setOrderHtml(order_data)
    order_data_content.innerHTML = order_data_html
}
function confirm_client_discount_func(discountValue_){
    servicePrice = 0
    all_sum = 0
    all_sum_withouth_discount = 0
    for(let j=0; j<order_data.length; j++){
        all_sum = all_sum + order_data[j].quantity*parseInt(order_data[j].last_price.replace(/\s/g, ''), 10)
        all_sum_withouth_discount = all_sum_withouth_discount + order_data[j].quantity*parseInt(order_data[j].price.replace(/\s/g, ''), 10)
    }
    clientDiscount.innerHTML = discountValue_+' %'

    setClientPrices()
    if(discountValue_>0){
        showClientDiscount(clientDiscountContent)
    }else{
        hideClientDiscount(clientDiscountContent)
    }
}
function setClientPrices() {
    total_all_left_sum = all_sum
    if (percent_v != 0) {
        clientDicountPrice = (all_sum * (1 - percent_v)).toFixed(2)
        total_all_left_sum = (all_sum * percent_v).toFixed(2)
    }
    total_sum.innerText = all_sum_withouth_discount
    clients_discount__sum.value = clientDicountPrice
    total_left_sum.innerText = total_all_left_sum
    clients_total_discount__sum.value = (productsPrice - total_all_left_sum).toFixed(2)
    total_discount.innerText = (productsPrice - total_all_left_sum).toFixed(2)
    total__sum.value = total_all_left_sum
}

function removeClientDiscountFunc(){
    discountValue = 0
    clientDiscount.innerText = ''
    percent_v = 0
    hideClientDiscount(clientDiscountContent)
    client_select_id_2.value = ''
    clientDicountPrice = 0
    clients_discount__sum.value = 0
    clients_total_discount__sum.value = 0
    total__sum.value = 0
}

removeClientDiscount.addEventListener('click', function () {
    removeClientDiscountFunc()
    setClientPrices()
})

function truncuateCashboxFunc(){
    discountValue = 0
    clientDiscount.innerText = ''
    total_left_sum.innerText = ''
    total_sum.innerText = ''
    percent_v = 0
    clientDicountPrice = 0
    total_all_left_sum = 0
    total_left_sum.innerText = ''
    total_all_left_sum = 0
    if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null) {
        localStorage.removeItem('order_data')
    }
    all_sum = 0
    all_sum_withouth_discount = 0
    clients_discount__sum.value = 0.00
    $(document).ready(function() {
        $('#client_select_id_2').val(null).trigger('change');
    });
    hideClientDiscount(clientDiscountContent)
    hideHasItems()
    order_data = []
    order_data_html = setOrderHtml(order_data)
    order_data_content.innerHTML = order_data_html
}

function addToOrder(id, name, price, discount, discount_percent, last_price, amount, barcode, stock) {
    stock_int = parseInt(stock)
    is_exist = false
    order_json = {}
    if(stock_int > 0) {
        if (order_data.length > 0) {
            for (let i = 0; i < order_data.length; i++) {
                if (order_data[i].id == id) {
                    order_data[i].quantity = order_data[i].quantity + 1
                    is_exist = true
                }
            }
            if (!is_exist) {
                order_json = {
                    'id': id,
                    'name': name,
                    'price': price,
                    'discount': discount,
                    'discount_percent': discount_percent,
                    'last_price': last_price,
                    'amount': amount,
                    'quantity': 1,
                    'barcode': barcode,
                    'stock': stock
                }
            }
        } else {
            order_json = {
                'id': id,
                'name': name,
                'price': price,
                'discount': discount,
                'discount_percent': discount_percent,
                'last_price': last_price,
                'amount': amount,
                'quantity': 1,
                'barcode': barcode,
                'stock': stock
            }
        }
        if (Object.keys(order_json).length != 0) {
            order_data.push(order_json)
        }
        if (order_data.length > 0) {
            showHasItems()
        } else {
            hideHasItems()
        }
        if (localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null) {
            localStorage.setItem('order_data', JSON.stringify(order_data))
        } else {
            localStorage.removeItem('order_data')
            localStorage.setItem('order_data', JSON.stringify(order_data))
        }
        if (order_data_content != undefined && order_data_content != null) {
            order_data_html = setOrderHtml(order_data)
            order_data_content.innerHTML = order_data_html
        }
        stock_int = stock_int - 1;
    }
}

function plusProduct(id, stock) {
    stock_int = parseInt(stock)
    if(stock_int > 0) {
        if(order_data.length>0) {
            for (let i = 0; i < order_data.length; i++) {
                if (order_data[i].id == id) {
                    order_data[i].quantity = order_data[i].quantity + 1
                }
            }
            order_data_html = setOrderHtml(order_data)
            order_data_content.innerHTML = order_data_html
            if (localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null) {
                localStorage.setItem('order_data', JSON.stringify(order_data))
            } else {
                localStorage.removeItem('order_data')
                localStorage.setItem('order_data', JSON.stringify(order_data))
            }
        }
        stock_int = stock_int - 1;
    }
}
function minusProduct(id, stock) {
    stock_int = parseInt(stock)
    if(order_data.length>0){
        for(let i = 0; i<order_data.length; i++){
            if(order_data[i].id == id){
                order_data[i].quantity = order_data[i].quantity - 1
                if(order_data[i].quantity == 0){
                    order_data.splice(i, 1)
                }
            }
        }
        if(order_data.length>0){
            showHasItems()
        }else{
            hideHasItems()
        }
    }else{
        hideHasItems()
    }
    order_data_html = setOrderHtml(order_data)
    order_data_content.innerHTML = order_data_html
    if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
        localStorage.setItem('order_data', JSON.stringify(order_data))
    }else{
        localStorage.removeItem('order_data')
        localStorage.setItem('order_data', JSON.stringify(order_data))
    }
    stock_int = stock_int + 1;
}

function setOrderHtml(order_data_){
    all_sum = 0
    all_sum_withouth_discount = 0
    servicePrice = 0
    productsPrice = 0
    order_data_html_ = ''
    total_discount.innerText = ''
    let discount_html = ''
    for(let j=0; j<order_data_.length; j++){
        productsPrice = productsPrice + order_data_[j].quantity*parseInt(order_data_[j].price.replace(/\s/g, ''), 10)
        discount_html = ''
        all_sum = all_sum + order_data_[j].quantity*parseInt(order_data_[j].last_price.replace(/\s/g, ''), 10)
        all_sum_withouth_discount = all_sum_withouth_discount + order_data_[j].quantity*parseInt(order_data_[j].price.replace(/\s/g, ''), 10)

        if(parseInt(order_data_[j].discount.replace(/\s/g, ''), 10)>0){
            discount_html = `<div><h6>${order_data_[j].last_price}</h6></div><del><h6>${order_data_[j].price}</h6></del>`
        }else{
            discount_html = `${order_data_[j].price}`
        }
        order_data_html_ = order_data_html_ +
            `\n<tr>
                <td><h6><b>${order_data_[j].barcode}</b></h6></td>
                <td><h6><b>${order_data_[j].name+' '+order_data_[j].amount}</b></h6></td>
                <td>
                    <h6><b>${discount_html}</b></h6>
                </td>
                <td><h6><b>${order_data_[j].quantity}</b></h6></td>
                <td><h6><b>${order_data_[j].quantity*parseInt(order_data_[j].last_price.replace(/\s/g, ''), 10)}</b></h6></td>
                <td>
                    <div class="d-flex">
                        <button class="edit_button btn" onclick="plusProduct(${order_data_[j].id}, ${order_data_[j].stock})">+</button>
                        <button class="ms-2 edit_button btn" onclick="minusProduct(${order_data_[j].id}, ${order_data_[j].stock})">-</button>
                    </div>
                </td>
            </tr>`
    }
    total_sum.innerText = all_sum_withouth_discount
    setClientPrices()
    return order_data_html_
}

let html = ''