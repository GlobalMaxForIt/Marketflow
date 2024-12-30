let floatingSelect = document.getElementById('floatingSelect')

let company_content = document.getElementById('company_content')
let organization_content = document.getElementById('organization_content')
let store_content = document.getElementById('store_content')

let company = document.getElementById('company')
let organization = document.getElementById('organization')
let store = document.getElementById('store')

floatingSelect.addEventListener('change', function () {
    switch(floatingSelect.value){
        case '1':
            if(!company_content.classList.contains('d-none')){
                company_content.classList.add('d-none')
            }
            if(!organization_content.classList.contains('d-none')){
                organization_content.classList.add('d-none')
            }
            if(!store_content.classList.contains('d-none')){
                store_content.classList.add('d-none')
            }
            if(company.required == true){
                company.required = false
            }
            if(organization.required == true){
                organization.required = false
            }
            if(store.required == true){
                store.required = false
            }
            break;
        case '2':
            if(!company_content.classList.contains('d-none')){
                company_content.classList.add('d-none')
            }
            if(company.required == true){
                company.required = false
            }
            if(organization_content.classList.contains('d-none')){
                organization_content.classList.remove('d-none')
            }
            organization.required = true
            break;
        case '3':
            if(!organization_content.classList.contains('d-none')){
                organization_content.classList.add('d-none')
            }
            if(!store_content.classList.contains('d-none')){
                store_content.classList.add('d-none')
            }
            if(organization.required == true){
                organization.required = false
            }
            if(store.required == true){
                store.required = false
            }
            if(company_content.classList.contains('d-none')){
                company_content.classList.remove('d-none')
            }
            company.required = true
            break;
        case '4':
            if(!company_content.classList.contains('d-none')){
                company_content.classList.add('d-none')
            }
            if(company.required == true){
                company.required = false
            }
            if(organization_content.classList.contains('d-none')){
                organization_content.classList.remove('d-none')
            }
            organization.required = true
            break;
        case '5':
            if(!organization_content.classList.contains('d-none')){
                organization_content.classList.add('d-none')
            }
            if(!store_content.classList.contains('d-none')){
                store_content.classList.add('d-none')
            }
            if(organization.required == true){
                organization.required = false
            }
            if(store.required == true){
                store.required = false
            }
            if(company_content.classList.contains('d-none')){
                company_content.classList.remove('d-none')
            }
            company.required = true
            break;
    }
})


function add_option(item, index){
    let store_option = document.createElement('option')
    store_option.value = item.id
    store_option.text = item.name
    store.add(store_option)
}

organization.addEventListener('change', function () {
    store.innerHTML = ''
    if(!company_content.classList.contains('d-none')){
        company_content.classList.add('d-none')
    }
    if(store_content.classList.contains('d-none')){
        store_content.classList.remove('d-none')
    }
    if(organization.required == false){
        organization.required = true
    }
    store.required = true
    $(document).ready(function () {
        $.ajax({
            url:`/../api/get-stores/${organization.value}`,
            type:'GET',
            success: function (data) {
                if(data.status == true){
                    data.data.forEach(add_option)
                }
            }
        });
    });

})
