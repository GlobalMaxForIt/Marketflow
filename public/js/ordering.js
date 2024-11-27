var myVar;
window.onload = function () {
    myVar = setTimeout(showPage, 1400);
}
let table_id = '';

let has_items = document.getElementById('has_items')
let no_items = document.getElementById('no_items')
let client_with_discount_button = document.getElementById('client_with_discount_button')

function showPage() {
    let loader = document.getElementById("loader")
    let myDiv = document.getElementById("myDiv")
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
    if(client_with_discount_button != undefined && client_with_discount_button != null) {
        client_with_discount_button.disabled = false
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
    if(client_with_discount_button != undefined && client_with_discount_button != null) {
        client_with_discount_button.disabled = true
    }
}


function showClientDiscount(){
    if(clientDiscountContent != undefined && clientDiscountContent != null){
        if(clientDiscountContent.classList.contains('d-none')){
            clientDiscountContent.classList.remove('d-none')
        }
    }
    if(totalLeftSum != undefined && totalLeftSum != null){
        if(totalLeftSum.classList.contains('d-none')){
            totalLeftSum.classList.remove('d-none')
        }
    }
}
function hideClientDiscount() {
    if(clientDiscountContent != undefined && clientDiscount != null){
        if(!clientDiscountContent.classList.contains('d-none')){
            clientDiscountContent.classList.add('d-none')
        }
    }
    if(totalLeftSum != undefined && totalLeftSum != null){
        if(!totalLeftSum.classList.contains('d-none')){
            totalLeftSum.classList.add('d-none')
        }
    }
}
if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
    order_data = JSON.parse(localStorage.getItem('order_data'))
    if(order_data.length>0){
        showHasItems()
    }else{
        hideHasItems()
    }
}else{
    hideHasItems()
    order_data = []
}

let discountValue = 0
let percent_v = 0
let clientDicountPrice = 0
let servicePrice = 0
let all_sum = 0
let client_id = 0
let total_all_left_sum = 0
let confirm_client_discount = document.getElementById('confirm_client_discount')
let client_select_id_2 = document.getElementById('client_select_id_2')
let total_left_sum = document.getElementById('total_left_sum')
let clientFullName = document.getElementById('clientFullName')
let removeClientDiscount = document.getElementById('removeClientDiscount')

let discountInfo = []
let discountClientInfo = []

if(order_data_content != undefined && order_data_content != null){
    order_data_html = setOrderHtml(order_data)
    order_data_content.innerHTML = order_data_html
}
function confirm_client_discount_func(discountValue_){
    servicePrice = 0
    all_sum = 0
    for(let j=0; j<order_data.length; j++){
        all_sum = all_sum + order_data[j].quantity*parseInt(order_data[j].last_price.replace(/\s/g, ''), 10)
    }
    clientDiscount.innerHTML = discountValue_+' %'

    setClientPrices()
    if(discountValue_>0){
        showClientDiscount()
    }else{
        hideClientDiscount()
    }
}
confirm_client_discount.addEventListener('click', function () {
    let discountInfo = client_select_id_2.value.split(" ")
    let discountClientInfo = client_select_id_2.value.split("/")
    if(discountInfo[1] != undefined && discountInfo[1] != null){
        discountValue = discountInfo[1]
        client_id = discountInfo[0]
    }
    if(parseInt(discountValue) != 0){
        percent_v = (100 - discountValue)/100
    }
    if(discountClientInfo[1] != undefined && discountClientInfo[1] != null){
        clientFullName.innerText = ' '+discountClientInfo[1]
    }
    confirm_client_discount_func(discountValue)
    setClientPrices()
})

function setClientPrices(){
    total_all_left_sum = all_sum
    if(percent_v != 0){
        clientDicountPrice = all_sum*(1-percent_v)
        total_all_left_sum = all_sum*percent_v
    }
}
function removeClientDiscountFunc(){
    discountValue = 0
    clientDiscount.innerText = ''
    total_left_sum.innerText = ''
    percent_v = 0
    takeAwayFunc()
    hideClientDiscount()
}
removeClientDiscount.addEventListener('click', function () {
    removeClientDiscountFunc()
})

function addToOrder(id, name, price, discount, discount_percent, last_price, amount) {
    is_exist = false
    order_json = {}
    if(order_data.length>0){
        for(let i = 0; i<order_data.length; i++){
            if(order_data[i].id == id){
                order_data[i].quantity = order_data[i].quantity + 1
                is_exist = true
            }
        }
        if(!is_exist){
            order_json = {'id':id, 'name':name, 'price':price, 'discount':discount, 'discount_percent':discount_percent, 'last_price':last_price, 'amount':amount, 'quantity':1}
        }
    }else{
        order_json = {'id':id, 'name':name, 'price':price, 'discount':discount, 'discount_percent':discount_percent, 'last_price':last_price, 'amount':amount, 'quantity':1}
    }
    if(Object.keys(order_json).length != 0){
        order_data.push(order_json)
    }
    if(order_data.length>0){
        showHasItems()
    }else{
        hideHasItems()
    }
    if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
        localStorage.setItem('order_data', JSON.stringify(order_data))
    }else{
        localStorage.removeItem('order_data')
        localStorage.setItem('order_data', JSON.stringify(order_data))
    }
    if(order_data_content != undefined && order_data_content != null){
        order_data_html = setOrderHtml(order_data)
        order_data_content.innerHTML = order_data_html
    }
}

function plusProduct(id) {
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
}
function minusProduct(id) {
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
}

function setOrderHtml(order_data_){
    all_sum = 0
    servicePrice = 0
    order_data_html_ = ''
    let discount_html = ''
    for(let j=0; j<order_data_.length; j++){
        discount_html = ''
        all_sum = all_sum + order_data_[j].quantity*parseInt(order_data_[j].last_price.replace(/\s/g, ''), 10)

        if(parseInt(order_data_[j].discount.replace(/\s/g, ''), 10)>0){
            discount_html = `<div>${order_data_[j].last_price}</div><del>${order_data_[j].price}</del>`
        }else{
            discount_html = `${order_data_[j].price}`
        }
        order_data_html_ = order_data_html_ +
            `\n<tr>
                    <td>${order_data_[j].name+' '+order_data_[j].amount}</td>
                    <td>${order_data_[j].quantity}</td>
                    <td>
                        ${discount_html}
                    </td>
                    <td>${order_data_[j].quantity*parseInt(order_data_[j].last_price.replace(/\s/g, ''), 10)}</td>
                    <td>
                        <div class="d-flex">
                            <button class="edit_button btn" onclick="plusProduct(${order_data_[j].id})">+</button>
                            <button class="ms-2 edit_button btn" onclick="minusProduct(${order_data_[j].id})">-</button>
                        </div>
                    </td>
                </tr>`
    }
    total_sum.innerText = all_sum
    setClientPrices()

    return order_data_html_
}
let html = ''
function takeAwayFunc() {
    let take_away_content = document.getElementById('take_away_content')
    setTakeAwayHtml(take_away_content)
}
function setTakeAwayHtml(content) {
    setClientPrices()
    html = `<div class="d-flex justify-content-center">
                <div class="width_60_percent">
                    <h4 class="d-flex justify-content-between">
                        <span>${total_price_text}:</span>
                        <span><b>${total_all_left_sum} </b>${sum_text}</span>
                    </h4>
                </div>
            </div>`
    content.innerHTML = html
}

function takeAwayConfirm() {
    if(loader != undefined && loader != null){
        if(loader.classList.contains("d-none")){
            loader.classList.remove("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null){
        if(!myDiv.classList.contains("d-none")){
            myDiv.classList.add("d-none")
        }
    }
    $(document).ready(function () {
        if(order_data.length>0){
            try{
                $.ajax({
                    url: "/../api/take-away",
                    method: 'POST',
                    data:{
                        'order_data':order_data,
                        'client_id':client_id,
                        'client_dicount_price':clientDicountPrice,
                    },
                    success: function (data) {
                        hideHasItems()
                        if(loader != undefined && loader != null){
                            if(!loader.classList.contains("d-none")){
                                loader.classList.add("d-none")
                            }
                        }
                        if(myDiv != undefined && myDiv != null){
                            if(myDiv.classList.contains("d-none")){
                                myDiv.classList.remove("d-none")
                            }
                        }
                        if(data.status == true){
                            if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
                                localStorage.removeItem('order_data')
                            }
                            window.location.href = kitchen_index+'?id='+data.order_id
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.log(xhr.responseText); // Log the error response from the server
                        toastr.error('An error occurred: ' + xhr.status + ' ' + error); // Show error message
                    }
                })
            }catch (e) {
                console.log(e)
            }
        }else{
            toastr.warning(ordered_fail_text)
        }
    })
}
