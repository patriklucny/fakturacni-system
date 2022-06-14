


<div class="row" style="margin-bottom: 25px;">
    <div class="col">
        <label class="form-label">Název</label>
        <input class="form-control" type="text" name="name">
    </div>
    <div class="col-xl-4">
        <label class="form-label">IČO</label>
        <input class="form-control" type="text" name="id_number"></div>
    <div class="col">
        <label class="form-label">DIČ</label>
        <input class="form-control" type="text" name="tax_number">
    </div>
</div>
<div class="row" style="margin-bottom: 50px;">
    <div class="col">
        <label class="form-label">Telefon</label>
        <input class="form-control" type="tel" name="phone">
    </div>
    <div class="col">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="email"></div>
    <div class="col">
        <label class="form-label">Typ firmy</label>
        <select id="company_type" name="company_type">
            <option value=""></option>
            <option value="supplier">Dodavatel</option>
            <option value="subscriber">Odběratel</option>
        </select>
    </div>
</div>
<label class="form-label">Fakturační adresa</label>
<div class="row" style="margin-bottom: 25px;">
    <div class="col" style="margin-right: 60px;">
        <select placeholder="Vyberte adresu" id="sel_saved_address" name="sel_address" onchange="onChange_comp_address()">
            <option value=""></option>
            <option value="new">* Nová adresa</option>
            <option value="1">Školní 123, Uherské Hradiště 68601</option>
            <option value="2">Nová 90, Zlín 68605</option>
        </select>
    </div>
    <div class="col">
        <label class="form-label">Ulice</label>
        <input class="form-control new_address_input" name="street" type="text" style="margin-bottom: 25px;" disabled>
        <label class="form-label">PSČ</label>
        <input class="form-control new_address_input" name="postal_code" type="text" disabled>
    </div>
    <div class="col">
        <label class="form-label">Město</label>
        <input class="form-control new_address_input" name="city" type="text" style="margin-bottom: 25px;" disabled>
        <label class="form-label">Stát</label>
        <input class="form-control new_address_input" name="country" type="text" disabled>
    </div>
</div>
