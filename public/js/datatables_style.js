
var myVar;
window.onload = function () {
    myVar = setTimeout(function () {
        let datatable_buttons_filter_label_ = document.querySelectorAll('.dataTables_filter label')
        let dataTables_wrapper = document.querySelectorAll('.dataTables_wrapper')
        let buttons_pdf = document.querySelector('.buttons-pdf')
        let buttons_excel = document.querySelector('.buttons-excel')
        let buttons_copy = document.querySelector('.buttons-copy')
        // Check if the label contains the old text
        let svg_search_icon = document.createElement('div')
        svg_search_icon.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L16.657 16.657M16.657 16.657C17.3998 15.9141 17.9891 15.0322 18.3912 14.0615C18.7932 13.0909 19.0002 12.0506 19.0002 11C19.0002 9.9494 18.7932 8.90908 18.3912 7.93845C17.9891 6.96782 17.3998 6.08589 16.657 5.343C15.9141 4.60011 15.0321 4.01082 14.0615 3.60877C13.0909 3.20673 12.0506 2.99979 11 2.99979C9.94936 2.99979 8.90905 3.20673 7.93842 3.60877C6.96779 4.01082 6.08585 4.60011 5.34296 5.343C3.84263 6.84333 2.99976 8.87821 2.99976 11C2.99976 13.1218 3.84263 15.1567 5.34296 16.657C6.84329 18.1573 8.87818 19.0002 11 19.0002C13.1217 19.0002 15.1566 18.1573 16.657 16.657Z" stroke="#606368" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`
        for(let k=0; k<datatable_buttons_filter_label_.length; k++){
            datatable_buttons_filter_label_[k].append(svg_search_icon.cloneNode(true))
        }
        for(let n=0; n<dataTables_wrapper.length; n++){
            if(dataTables_wrapper[n].firstChild != undefined && dataTables_wrapper[n].firstChild != null){
                if(dataTables_wrapper[n].firstChild.firstChild != undefined && dataTables_wrapper[n].firstChild.firstChild != null){
                    dataTables_wrapper[n].firstChild.firstChild.classList.add('mb-4')
                }
                if(dataTables_wrapper[n].firstChild.lastChild != undefined && dataTables_wrapper[n].firstChild.lastChild != null){
                    dataTables_wrapper[n].firstChild.lastChild.classList.add('mb-4')
                }
            }
        }
        if(search_client_text == undefined && search_client_text == null) {
            search_client_text = ''
        }
        if(buttons_pdf != undefined && buttons_pdf != null){
            buttons_pdf.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.6667 18H19.9167C20.4687 17.9983 20.9976 17.7695 21.388 17.3635C21.7783 16.9575 21.9984 16.4074 22 15.8333V7.16667C21.9984 6.59256 21.7783 6.04245 21.388 5.6365C20.9976 5.23054 20.4687 5.00171 19.9167 5H4.08333C3.53131 5.00171 3.00236 5.23054 2.61202 5.6365C2.22167 6.04245 2.00165 6.59256 2 7.16667V15.8333C2.00165 16.4074 2.22167 16.9575 2.61202 17.3635C3.00236 17.7695 3.53131 17.9983 4.08333 18H5.33333" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M17.67 11H6.33C5.59546 11 5 11.5758 5 12.2862V20.7138C5 21.4242 5.59546 22 6.33 22H17.67C18.4045 22 19 21.4242 19 20.7138V12.2862C19 11.5758 18.4045 11 17.67 11Z" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M19 5V3.875C18.9983 3.37818 18.7672 2.90212 18.3574 2.55081C17.9475 2.1995 17.3921 2.00148 16.8125 2H7.1875C6.60787 2.00148 6.05248 2.1995 5.64262 2.55081C5.23276 2.90212 5.00173 3.37818 5 3.875V5" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M19 10C19.5523 10 20 9.32843 20 8.5C20 7.67157 19.5523 7 19 7C18.4477 7 18 7.67157 18 8.5C18 9.32843 18.4477 10 19 10Z" fill="#121212"/>
            </svg>`
        }
        if(buttons_copy != undefined && buttons_copy != null){
            buttons_copy.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.66667 17.1429C8.66667 16.9155 8.75446 16.6975 8.91074 16.5368C9.06702 16.376 9.27899 16.2857 9.5 16.2857H14.5C14.721 16.2857 14.933 16.376 15.0893 16.5368C15.2455 16.6975 15.3333 16.9155 15.3333 17.1429C15.3333 17.3702 15.2455 17.5882 15.0893 17.7489C14.933 17.9097 14.721 18 14.5 18H9.5C9.27899 18 9.06702 17.9097 8.91074 17.7489C8.75446 17.5882 8.66667 17.3702 8.66667 17.1429ZM5.33333 12C5.33333 11.7727 5.42113 11.5547 5.57741 11.3939C5.73369 11.2332 5.94565 11.1429 6.16667 11.1429H17.8333C18.0543 11.1429 18.2663 11.2332 18.4226 11.3939C18.5789 11.5547 18.6667 11.7727 18.6667 12C18.6667 12.2273 18.5789 12.4453 18.4226 12.6061C18.2663 12.7668 18.0543 12.8571 17.8333 12.8571H6.16667C5.94565 12.8571 5.73369 12.7668 5.57741 12.6061C5.42113 12.4453 5.33333 12.2273 5.33333 12ZM2 6.85714C2 6.62981 2.0878 6.4118 2.24408 6.25105C2.40036 6.09031 2.61232 6 2.83333 6H21.1667C21.3877 6 21.5996 6.09031 21.7559 6.25105C21.9122 6.4118 22 6.62981 22 6.85714C22 7.08447 21.9122 7.30249 21.7559 7.46323C21.5996 7.62398 21.3877 7.71429 21.1667 7.71429H2.83333C2.61232 7.71429 2.40036 7.62398 2.24408 7.46323C2.0878 7.30249 2 7.08447 2 6.85714Z" fill="#121212"/>
            </svg>`
        }
        if(buttons_excel != undefined && buttons_excel != null){
            buttons_excel.innerHTML = `<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" viewBox="0 0 218.000000 231.000000"
             preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,231.000000) scale(0.100000,-0.100000)"
                fill="#121212" stroke="none">
                <path d="M74 2300 c-12 -4 -31 -21 -43 -36 l-21 -27 0 -1083 0 -1084 29 -32
                29 -33 856 0 856 0 27 28 c28 27 28 29 33 180 l5 152 120 5 c131 5 155 14 185
                63 19 30 20 53 20 368 0 333 0 336 -23 370 -37 55 -76 69 -200 69 l-108 0 1
                237 1 237 -298 298 -299 298 -574 -1 c-316 0 -585 -4 -596 -9z m1076 -350 c0
                -258 6 -282 83 -319 40 -19 60 -21 255 -21 l212 0 0 -185 0 -185 -617 0 c-590
                0 -620 -1 -661 -20 -33 -15 -47 -29 -62 -62 -18 -40 -20 -68 -20 -356 0 -344
                2 -357 59 -405 l33 -27 634 0 634 0 0 -115 0 -115 -775 0 -775 0 0 1015 0
                1015 500 0 500 0 0 -220z m520 -212 c0 -5 -80 -8 -178 -8 -138 0 -183 3 -198
                14 -17 13 -19 30 -22 208 l-3 193 201 -200 c110 -110 200 -203 200 -207z m143
                -712 c21 -8 47 -22 57 -31 18 -16 46 -83 38 -89 -1 -2 -31 -6 -66 -9 -59 -5
                -64 -4 -72 18 -18 48 -110 47 -110 -2 0 -7 26 -20 58 -28 163 -45 202 -76 202
                -157 0 -66 -27 -110 -86 -138 -39 -19 -58 -22 -135 -18 -70 3 -95 9 -117 25
                -30 22 -57 65 -67 105 -7 26 -7 26 61 30 65 3 67 2 76 -25 18 -50 94 -66 122
                -25 25 35 5 54 -91 83 -113 35 -153 71 -153 139 0 82 74 135 190 135 30 0 72
                -6 93 -13z m-1056 -61 c20 -36 40 -65 43 -65 3 0 21 29 39 65 l35 65 78 0 78
                0 -27 -42 c-14 -24 -46 -73 -70 -110 l-43 -68 75 -114 c41 -62 75 -116 75
                -120 0 -3 -34 -6 -75 -6 l-75 0 -48 75 -48 74 -33 -57 c-55 -92 -55 -92 -138
                -92 -40 0 -73 2 -73 5 0 3 32 53 70 111 39 57 73 111 76 119 3 7 -22 54 -56
                104 -86 128 -86 121 4 121 l75 0 38 -65z m483 -105 l0 -170 110 0 110 0 0 -60
                0 -60 -180 0 -180 0 0 230 0 230 70 0 70 0 0 -170z"/>
                </g>
            </svg>`
        }
        let loader = document.getElementById("loader")
        let myDiv = document.getElementById("myDiv")
        if(loader != undefined && loader != null){
            if(!loader.classList.contains("d-none")){
                loader.classList.add("d-none")
            }
        }
        if(myDiv != undefined && myDiv != null){
            if(!myDiv.classList.contains("d-none")){
                myDiv.classList.add("d-none")
            }
        }
    }, 1000);
}
