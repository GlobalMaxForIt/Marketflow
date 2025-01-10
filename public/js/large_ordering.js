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
let clients_total__sum = document.getElementById('clients_total__sum')
let clients_total_discount__sum = document.getElementById('clients_total_discount__sum')
let total__sum = document.getElementById('total__sum')
let total_discount = document.getElementById('total_discount')
let order_selected_product_name = document.getElementById('order_selected_product_name')
let order_selected_product_info = document.getElementById('order_selected_product_info')
let set_checklist_button = document.getElementById('set_checklist_button')

let discountInfo = []
let discountClientInfo = []

let element_id_name =''
let element_id =''
let current_data = {}
let notify_product_text = ''
let selected__product__id = ''
let selected_products_id = []
let selected_products_quantity = []
let is_removed_total_sum = false

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
    if(set_checklist_button != undefined && set_checklist_button != null) {
        set_checklist_button.disabled = false
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
    if(set_checklist_button != undefined && set_checklist_button != null) {
        set_checklist_button.disabled = true
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
            discount_content_element.classList.add('daaaa')
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
    if(clientDiscountContent.classList.contains('d-none')){
        clientDiscountContent.classList.remove('d-none')
    }
    if(discountValue_>0){
        showOnlyClientDiscount()
    }else{
        hideOnlyClientDiscount()
    }
}
function hideOnlyClientDiscount(){
    if(!clientDiscount.classList.contains('d-none')){
        clientDiscount.classList.add('d-none')
    }
    if(removeClientDiscount.classList.contains('d-none')){
        removeClientDiscount.classList.remove('d-none')
    }
}
function showOnlyClientDiscount(){
    if(removeClientDiscount.classList.contains('d-none')){
        removeClientDiscount.classList.remove('d-none')
    }
    if(clientDiscount.classList.contains('d-none')){
        clientDiscount.classList.remove('d-none')
    }
}
function format_entered_sum_func(numbers){
    if(parseInt(numbers)>0){
        return parseInt(numbers).toLocaleString()
    }else{
        return 0
    }
}

function setClientPrices() {
    total_all_left_sum = all_sum
    if (percent_v != 0) {
        clientDicountPrice = (all_sum * (1 - percent_v)).toFixed(2)
        total_all_left_sum = (all_sum * percent_v).toFixed(2)
    }else{
        clientDicountPrice = 0
        total_all_left_sum = all_sum.toFixed(2)
    }
    total_sum.innerText = all_sum_withouth_discount
    clients_discount__sum.value = clientDicountPrice
    total_left_sum.innerText = format_entered_sum_func(total_all_left_sum)
    clients_total_discount__sum.value = (productsPrice - total_all_left_sum).toFixed(2)
    total_discount.innerText = (productsPrice - total_all_left_sum).toFixed(2)
    total__sum.value = total_all_left_sum
    if(!is_removed_total_sum){
        clients_total__sum.value = new Intl.NumberFormat('ru-RU').format(parseInt(client_total_sales), 10)
    }
}

function removeClientDiscountFunc(){
    discountValue = 0
    clientDiscount.innerText = ''
    percent_v = 0
    client_id = ''
    hideClientDiscount(clientDiscountContent)
    client_select_id_2.value = ''
    clientDicountPrice = 0
    clients_discount__sum.value = 0
    clients_total__sum.value = 0
    is_removed_total_sum = true
    clients_total_discount__sum.value = 0
    total__sum.value = 0
    cashback = 0
    cashback_input.value = 0
}
removeClientDiscount.addEventListener('click', function () {
    removeClientDiscountFunc()
    setClientPrices()
    is_removed_total_sum = false
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
    clients_total__sum.value = 0
    $(document).ready(function() {
        $('#client_select_id_2').val(null).trigger('change');
    });
    if(!gift_card_content.classList.contains('d-none')){
        gift_card_content.classList.add('d-none')
    }
    removeGiftCard()

    if(!cashback_content.classList.contains('d-none')){
        cashback_content.classList.add('d-none')
    }
    removeCashback()

    if(!cashback_display_content.classList.contains('d-none')){
        cashback_display_content.classList.add('d-none')
    }
    if(!debt_display_content.classList.contains('d-none')){
        debt_display_content.classList.add('d-none')
    }

    hideClientDiscount(clientDiscountContent)
    hideHasItems()
    order_data = []
    order_data_html = setOrderHtml(order_data)
    order_data_content.innerHTML = order_data_html
}
function addToOrder(id, name, price, discount, discount_percent, last_price, amount, barcode, stock, unit, unit_id, quantity, code, this_element, fast_selling) {
    setTimeout(function () {
        checklist_changed = false
        stock_int = parseFloat(stock)
        selected__product__id = id
        is_exist = false
        order_json = {}
        current_data = {}
        element_id = ''
        if(!selected_products_id.includes(id)){
            successfullyAddToOrder('', id, name, price, discount, discount_percent, last_price, amount, barcode, stock, unit, unit_id, quantity, code, this_element, fast_selling)
        }else{
            for(let i=0; i<selected_products_id.length; i++){
                if(selected_products_id[i] == id) {
                    if(selected_products_quantity[i]>0) {
                        successfullyAddToOrder(i, id, name, price, discount, discount_percent, last_price, amount, barcode, stock, unit, unit_id, quantity, code, this_element, fast_selling)
                    }else{
                        toastr.warning(name+' '+amount +' '+selected_products_quantity[i]+' '+notify_text_left_in_stock)
                    }
                }
            }
            if(!is_exist){
                toastr.warning(name+' '+amount +' '+stock_int+' '+notify_text_left_in_stock)
            }
        }
    }, 444)
}
function successfullyAddToOrder(index_, id, name, price, discount, discount_percent, last_price, amount, barcode, stock, unit, unit_id, quantity, code, this_element, fast_selling){
    if (order_data.length > 0) {
        for (let i = 0; i < order_data.length; i++) {
            if (order_data[i].id == id) {
                order_data[i].quantity = parseFloat(order_data[i].quantity)+1
                stock_int = stock_int - parseFloat(order_data[i].quantity);
                if(!selected_products_id.includes(id)){
                    selected_products_id.push(id)
                    selected_products_quantity.push(stock_int)
                }else{
                    selected_products_quantity[index_] = stock_int
                }
                minusStockFunc(stock_int, this_element, id)
                is_exist = true
                current_data = order_data[i]
            }
        }
        if (!is_exist) {
            order_json = {
                'id': id,
                'name': name,
                'price': price,
                'code': code,
                'discount': discount,
                'discount_percent': discount_percent,
                'last_price': last_price,
                'amount': amount,
                'quantity': quantity,
                'barcode': barcode,
                'stock': stock,
                'unit': unit,
                'unit_id': unit_id
            }
            stock_int = stock_int - parseFloat(quantity);
            minusStockFunc(stock_int, this_element, id)
            current_data = order_json
        }
    } else {
        order_json = {
            'id': id,
            'name': name,
            'price': price,
            'code': code,
            'discount': discount,
            'discount_percent': discount_percent,
            'last_price': last_price,
            'amount': amount,
            'quantity': quantity,
            'barcode': barcode,
            'stock': stock,
            'unit': unit,
            'unit_id': unit_id
        }
        stock_int = stock_int - parseFloat(quantity);
        minusStockFunc(stock_int, this_element, id)
        current_data = order_json
    }
    if (Object.keys(order_json).length != 0) {
        order_data.push(order_json)
    }
    if (order_data.length > 0) {
        showHasItems()
    } else {
        hideHasItems()
    }
    order_selected_product_name.innerText = name+' '+amount
    order_selected_product_info.innerHTML = `${last_price} * ${current_data.quantity} = ${new Intl.NumberFormat('ru-RU').format(parseInt(last_price.replace(/\s/g, ''), 10)*parseFloat(current_data.quantity), 10)}`
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
    if(code == null || code == undefined || !code){
        notify_product_text = name+' '+amount + notify_text
        if(fast_selling != 'fast_selling'){
            toastr.success(notify_product_text)
        }
    }
}

function minusStockFunc(stock_int_, this_element_, id_){
    element_id_name = 'stock__'+id_
    if(parseInt(id_)>0){
        element_id = document.getElementById(element_id_name)
    }
    if(this_element_ != null && this_element_ != undefined && this_element_ != ''){
        let get_stock_element = this_element_.querySelector('.stock__quantity')
        get_stock_element.innerText = stock_int_
    }else if(element_id != null && element_id != undefined && element_id != ''){
        element_id.innerText = stock_int_
    }
}

function setOrderHtml(order_data_){
    all_sum = 0
    all_sum_withouth_discount = 0
    servicePrice = 0
    productsPrice = 0
    order_data_html_ = ''
    total_discount.innerText = ''
    let discount_html = ''
    let active_text = ''
    for(let j=0; j<order_data_.length; j++){
        if(selected__product__id == order_data_[j].id){
            active_text = 'active'
        }
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
            `\n<tr data-product='${JSON.stringify(order_data_[j])}' class="client_selected_product_row ${active_text}" onclick="editProductFunc(this)" data-bs-toggle="modal" data-bs-target="#edit_product_modal">
                <td><h6><b>${order_data_[j].barcode}</b></h6></td>
                <td><h6><b class="pre_wrap">${order_data_[j].name+' '+order_data_[j].amount}</b></h6></td>
                <td>
                    <h6><b>${discount_html}</b></h6>
                </td>
                <td><h6><b class="product__quantity">${parseInt(order_data_[j].quantity*1000)/1000 +' '+order_data_[j].unit}</b></h6></td>
                <td><h6><b class="product__sum">${new Intl.NumberFormat('ru-RU').format(parseFloat(order_data_[j].quantity)*parseInt(order_data_[j].last_price.replace(/\s/g, ''), 10))}</b></h6></td>
            </tr>`
        active_text = ''
    }
    total_sum.innerText = all_sum_withouth_discount
    setClientPrices()
    return order_data_html_
}

let html = ''