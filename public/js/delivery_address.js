let delivery_region_id = document.getElementById('delivery_region_id')
let delivery_district_id = document.getElementById('delivery_district_id')
let delivery_region = document.getElementById('delivery_region')
let delivery_district = document.getElementById('delivery_district')
let delivery_current_region_index = -1
let delivery_edit_changed = false

function addOptionDelivery(item, index){
    let region_option_delivery = document.createElement('option')
    region_option_delivery.value = index
    region_option_delivery.text = item.name
    if(localStorage.getItem('delivery_region_id') != undefined && localStorage.getItem('delivery_region_id') != null && localStorage.getItem('delivery_region_id') == index){
        region_option_delivery.selected = true
        delivery_edit_changed = true
    }else if(delivery_edit_changed == false){
        if(current_region == item.id){
            region_option_delivery.selected = true
            delivery_current_region_index = index
        }
    }
    delivery_region_id.add(region_option_delivery)
}
$(document).ready(function () {
    $.ajax({
        url:"/../api/get-districts",
        type:'GET',
        success: function (data) {
            data.data.forEach(addOptionDelivery)
            if(page == false && localStorage.getItem('delivery_region_id') != undefined && localStorage.getItem('delivery_region_id') != null &&
                localStorage.getItem('delivery_district_id') != undefined && localStorage.getItem('delivery_district_id') != null) {
                districts_ = data.data[localStorage.getItem('delivery_region_id')].cities
                Object.keys(districts_).forEach(function (key) {
                    let district_selected_option_delivery = document.createElement('option')
                    district_selected_option_delivery.value = key
                    district_selected_option_delivery.text = districts_[key].name
                    if (localStorage.getItem('delivery_district_id') != undefined && localStorage.getItem('delivery_district_id') != null && localStorage.getItem('delivery_district_id') == key) {
                        district_selected_option_delivery.selected = true
                    }
                    delivery_district_id.add(district_selected_option_delivery)
                })
            }else if(page == true){
                if(delivery_current_region_index != -1){
                    districts_ = data.data[delivery_current_region_index].cities
                    Object.keys(districts_).forEach(function (key) {
                        let district_selected_option_delivery = document.createElement('option')
                        district_selected_option_delivery.value = key
                        district_selected_option_delivery.text = districts_[key].name
                        if (districts_[key].id == current_district) {
                            district_selected_option_delivery.selected = true
                        }
                        delivery_district_id.add(district_selected_option_delivery)
                    })
                }
            }
            delivery_region_id.addEventListener('change', function () {
                localStorage.setItem('delivery_region_id', delivery_region_id.value)
                delivery_district_id.innerHTML = ""
                let district_option_delivery_disabled_delivery = document.createElement('option')
                district_option_delivery_disabled_delivery.text = "Select district or city of "+ data.data[delivery_region_id.value].name
                district_option_delivery_disabled_delivery.disabled = true
                district_option_delivery_disabled_delivery.selected = true
                district_option_delivery_disabled_delivery.value = ''
                delivery_district_id.add(district_option_delivery_disabled_delivery)
                districts = data.data[delivery_region_id.value].cities
                Object.keys(districts).forEach(function (key) {
                    let district_option_delivery = document.createElement('option')
                    district_option_delivery.text = districts[key].name
                    district_option_delivery.value = key
                    delivery_district_id.add(district_option_delivery)
                })
            })
            delivery_district_id.addEventListener('change', function () {
                localStorage.setItem('delivery_region', data.data[delivery_region_id.value].id)
                localStorage.setItem('delivery_district', data.data[delivery_region_id.value].cities[delivery_district_id.value].id)
                localStorage.setItem('delivery_district_id', delivery_district_id.value)
                delivery_region.value = data.data[delivery_region_id.value].id
                delivery_district.value = data.data[delivery_region_id.value].cities[delivery_district_id.value].id
            })
        }
    });
});

delivery_edit_changed = false
