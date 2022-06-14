let database_data;

$(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
    });

    $.get('data', function (data){
        database_data = data;
    })
});

function onChange_supplier(){
    let supp_id = document.getElementById('select-supp').value;
    let addr_id = database_data.suppliers.find(e => e.id == supp_id).address_id;
    let address = database_data.addresses.find(e => e.id == addr_id)
    document.getElementById('supplier-address').innerHTML = address.street + '<br>' + address.postal_code + " " + address.city + '<br>' + address.country;
}

function onChange_subscriber(){
    let subs_id = document.getElementById('select-subs').value;
    let addr_id = database_data.suppliers.find(e => e.id == subs_id).address_id;
    let address = database_data.addresses.find(e => e.id == addr_id)
    document.getElementById('subscriber-address').innerHTML = address.street + '<br>' + address.postal_code + " " + address.city + '<br>' + address.country;
}

function onChange_comp_address(){
    let inputs = document.getElementsByClassName('new_address_input');
    if(document.getElementById('sel_saved_address').value == "new"){
        for(let i = 0; i <inputs.length; i++){
            inputs[i].disabled = false;
        }
    }
    else{
        for(let i = 0; i <inputs.length; i++){
            inputs[i].disabled = true;
        }
    }
}

let list_of_products = [];

function addProduct() {
    let table = document.getElementById("products_table_body");
    let quantity = document.getElementById("add_product_quantity").value;
    let product_id = document.getElementById("add_product_name").value;

    let name = database_data.products.find(e => e.id == product_id).name;
    let price1 = database_data.products.find(e => e.id == product_id).price;
    let price2 = quantity * price1;
    let index;
    list_of_products.length != 0 ? index = (Math.max(...list_of_products.map(o => o.index))) + 1 : index = 0;

    console.log(quantity);
    console.log(product_id);

    let x_button = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="width: 20px;height: 20px;" onClick="deleteProductFromInvoice(this, ' + index + ')" class="pointer">\n' +
        '                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>\n' +
        '            </svg>';

    if(quantity != "" && product_id != "") {
        table.innerHTML += "<tr><td>" + quantity + "</td><td>" + name + '</td><td style="text-align: right;">' +
            price1 + ' Kč</td><td style="text-align: right;">' + price2 + ' Kč</td><td style="text-align: right;">' +
            x_button + "</td></tr>";


        list_of_products.push({
            "index":list_of_products.length,
            "id":product_id,
            "quantity":quantity
        });

        document.getElementById("add_product_quantity").value = "";
        document.getElementById("add_product_name").selectize.clear(true);
    }
}

function sendProducts(){
    if(list_of_products.length != 0) {
        document.getElementById("list_of_products").value += JSON.stringify(list_of_products);
        return true;
    }
    else {
        return false;
    }
}

function deleteProductFromInvoice(btn, index) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);

    list_of_products = list_of_products.filter(e => e.index !== index);
}

function openInvoice(id){
    document.cookie = "invoice_id=" + id;
    window.location.href = "/invoice";
}

function openProduct(id){
    document.cookie = "product_id=" + id;
    window.location.href = "/product";
}

function openCompany(id, type){
    document.cookie = "company_id=" + id;
    document.cookie = "company_type=" + type;
    window.location.href = "/company";
}

function deleteInvoice(){
    if(confirm("Opravdu si přejete tuto fakturu smazat?")){
        window.location.href = "/delete_invoice";
    }
}
