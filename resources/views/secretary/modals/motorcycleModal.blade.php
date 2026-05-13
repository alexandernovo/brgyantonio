<div class="modal fade" data-bs-backdrop="static" id="motorcycleModal" tabindex="-1" aria-labelledby="motorcycleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 730px">
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body p-2">
                <div class="text-center p-4 position-relative rounded" style="background-color: #1b3f2f;">
                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;"></button>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 120px; height: auto; margin-bottom: 10px;">
                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: 1px;">
                        MOTORCYCLE CERTIFICATION FORM
                    </h3>
                </div>

                <div class="py-3 px-2">
                    <h5 class="fw-semibold mb-4" style="color: #000;">REQUESTER INFORMATION:</h5>

                    <form id="certificationForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="certification_type" value="piggery" id="certification_type">
                        <input type="hidden" name="certification_id" value="0" id="certification_id">

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Complete Name:</label>
                            <div class="d-flex gap-2 w-100">
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="First Name" style="border: 2px solid #1b3f2f; border-radius: 6px;"
                                    required>
                                <input type="text" name="middle_name" id="middle_name" class="form-control"
                                    placeholder="Middle Name" style="border: 2px solid #1b3f2f; border-radius: 6px;">
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Last Name" style="border: 2px solid #1b3f2f; border-radius: 6px;"
                                    required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Civil Status:</label>
                                <div class="input-group me-2" style=" width: 244px">
                                    <select name="civil_status" id="civil_status" class="form-select rounded"
                                        style="border: 2px solid #1b3f2f;" required>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <label class="fw-semibold text-nowrap">Sex:</label>

                                <div class="form-check d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="sex" id="male"
                                        value="Male" style="border: 2px solid #1b3f2f; width: 1.2em; height: 1.2em;"
                                        required>

                                    <label class="form-check-label fw-medium mb-0" for="male">
                                        Male
                                    </label>
                                </div>

                                <div class="form-check d-flex align-items-center gap-2 mb-0">
                                    <input class="form-check-input" type="radio" name="sex" id="female"
                                        value="Female" style="border: 2px solid #1b3f2f; width: 1.2em; height: 1.2em;">

                                    <label class="form-check-label fw-medium mb-0" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-grow-1 mb-3">
                            <label class="fw-semibold text-nowrap" style="width: 140px; flex-shrink: 0;">
                                Citizenship:
                            </label>
                            <select name="nationality" id="nationality" class="form-select w-100"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;">
                                <option value="Afghan">Afghan</option>
                                <option value="Albanian">Albanian</option>
                                <option value="Algerian">Algerian</option>
                                <option value="American">American</option>
                                <option value="Andorran">Andorran</option>
                                <option value="Angolan">Angolan</option>
                                <option value="Argentine">Argentine</option>
                                <option value="Armenian">Armenian</option>
                                <option value="Australian">Australian</option>
                                <option value="Austrian">Austrian</option>
                                <option value="Azerbaijani">Azerbaijani</option>
                                <option value="Bahamian">Bahamian</option>
                                <option value="Bahraini">Bahraini</option>
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Barbadian">Barbadian</option>
                                <option value="Belarusian">Belarusian</option>
                                <option value="Belgian">Belgian</option>
                                <option value="Belizean">Belizean</option>
                                <option value="Beninese">Beninese</option>
                                <option value="Bhutanese">Bhutanese</option>
                                <option value="Bolivian">Bolivian</option>
                                <option value="Bosnian">Bosnian</option>
                                <option value="Botswanan">Botswanan</option>
                                <option value="Brazilian">Brazilian</option>
                                <option value="British">British</option>
                                <option value="Bruneian">Bruneian</option>
                                <option value="Bulgarian">Bulgarian</option>
                                <option value="Burkinabe">Burkinabe</option>
                                <option value="Burmese">Burmese</option>
                                <option value="Burundian">Burundian</option>
                                <option value="Cambodian">Cambodian</option>
                                <option value="Cameroonian">Cameroonian</option>
                                <option value="Canadian">Canadian</option>
                                <option value="Chadian">Chadian</option>
                                <option value="Chilean">Chilean</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Colombian">Colombian</option>
                                <option value="Congolese">Congolese</option>
                                <option value="Costa Rican">Costa Rican</option>
                                <option value="Croatian">Croatian</option>
                                <option value="Cuban">Cuban</option>
                                <option value="Cypriot">Cypriot</option>
                                <option value="Czech">Czech</option>
                                <option value="Danish">Danish</option>
                                <option value="Djiboutian">Djiboutian</option>
                                <option value="Dominican">Dominican</option>
                                <option value="Dutch">Dutch</option>
                                <option value="Ecuadorian">Ecuadorian</option>
                                <option value="Egyptian">Egyptian</option>
                                <option value="Emirati">Emirati</option>
                                <option value="English">English</option>
                                <option value="Equatorial Guinean">Equatorial Guinean</option>
                                <option value="Eritrean">Eritrean</option>
                                <option value="Estonian">Estonian</option>
                                <option value="Ethiopian">Ethiopian</option>
                                <option value="Fijian">Fijian</option>
                                <option value="Filipino" selected>Filipino</option>
                                <option value="Finnish">Finnish</option>
                                <option value="French">French</option>
                                <option value="Gabonese">Gabonese</option>
                                <option value="Gambian">Gambian</option>
                                <option value="Georgian">Georgian</option>
                                <option value="German">German</option>
                                <option value="Ghanaian">Ghanaian</option>
                                <option value="Greek">Greek</option>
                                <option value="Guatemalan">Guatemalan</option>
                                <option value="Guinean">Guinean</option>
                                <option value="Haitian">Haitian</option>
                                <option value="Honduran">Honduran</option>
                                <option value="Hungarian">Hungarian</option>
                                <option value="Icelandic">Icelandic</option>
                                <option value="Indian">Indian</option>
                                <option value="Indonesian">Indonesian</option>
                                <option value="Iranian">Iranian</option>
                                <option value="Iraqi">Iraqi</option>
                                <option value="Irish">Irish</option>
                                <option value="Israeli">Israeli</option>
                                <option value="Italian">Italian</option>
                                <option value="Jamaican">Jamaican</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Jordanian">Jordanian</option>
                                <option value="Kazakh">Kazakh</option>
                                <option value="Kenyan">Kenyan</option>
                                <option value="Korean">Korean</option>
                                <option value="Kuwaiti">Kuwaiti</option>
                                <option value="Kyrgyz">Kyrgyz</option>
                                <option value="Laotian">Laotian</option>
                                <option value="Latvian">Latvian</option>
                                <option value="Lebanese">Lebanese</option>
                                <option value="Liberian">Liberian</option>
                                <option value="Libyan">Libyan</option>
                                <option value="Lithuanian">Lithuanian</option>
                                <option value="Luxembourger">Luxembourger</option>
                                <option value="Malaysian">Malaysian</option>
                                <option value="Maldivian">Maldivian</option>
                                <option value="Malian">Malian</option>
                                <option value="Maltese">Maltese</option>
                                <option value="Mexican">Mexican</option>
                                <option value="Mongolian">Mongolian</option>
                                <option value="Moroccan">Moroccan</option>
                                <option value="Mozambican">Mozambican</option>
                                <option value="Namibian">Namibian</option>
                                <option value="Nepalese">Nepalese</option>
                                <option value="New Zealander">New Zealander</option>
                                <option value="Nicaraguan">Nicaraguan</option>
                                <option value="Nigerian">Nigerian</option>
                                <option value="Norwegian">Norwegian</option>
                                <option value="Omani">Omani</option>
                                <option value="Pakistani">Pakistani</option>
                                <option value="Palestinian">Palestinian</option>
                                <option value="Panamanian">Panamanian</option>
                                <option value="Paraguayan">Paraguayan</option>
                                <option value="Peruvian">Peruvian</option>
                                <option value="Polish">Polish</option>
                                <option value="Portuguese">Portuguese</option>
                                <option value="Qatari">Qatari</option>
                                <option value="Romanian">Romanian</option>
                                <option value="Russian">Russian</option>
                                <option value="Rwandan">Rwandan</option>
                                <option value="Saudi">Saudi</option>
                                <option value="Scottish">Scottish</option>
                                <option value="Senegalese">Senegalese</option>
                                <option value="Serbian">Serbian</option>
                                <option value="Singaporean">Singaporean</option>
                                <option value="Slovak">Slovak</option>
                                <option value="Slovenian">Slovenian</option>
                                <option value="Somali">Somali</option>
                                <option value="South African">South African</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Sri Lankan">Sri Lankan</option>
                                <option value="Sudanese">Sudanese</option>
                                <option value="Swedish">Swedish</option>
                                <option value="Swiss">Swiss</option>
                                <option value="Syrian">Syrian</option>
                                <option value="Taiwanese">Taiwanese</option>
                                <option value="Tajik">Tajik</option>
                                <option value="Tanzanian">Tanzanian</option>
                                <option value="Thai">Thai</option>
                                <option value="Tunisian">Tunisian</option>
                                <option value="Turkish">Turkish</option>
                                <option value="Ugandan">Ugandan</option>
                                <option value="Ukrainian">Ukrainian</option>
                                <option value="Uruguayan">Uruguayan</option>
                                <option value="Uzbek">Uzbek</option>
                                <option value="Venezuelan">Venezuelan</option>
                                <option value="Vietnamese">Vietnamese</option>
                                <option value="Welsh">Welsh</option>
                                <option value="Yemeni">Yemeni</option>
                                <option value="Zambian">Zambian</option>
                                <option value="Zimbabwean">Zimbabwean</option>
                            </select>
                            <label class="fw-semibold text-end px-3 text-nowrap" style="width: 130px;">
                                Date Issued
                            </label>
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;"><i
                                        class="bi bi-calendar-event"></i></span>
                                <input type="date" name="date_issued" id="date_issued" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-grow-1 mb-3">
                            <label class="fw-semibold text-nowrap" style="width: 140px; flex-shrink: 0;">
                                Monthly Salary:
                            </label>
                            <div class="input-group" style="width: 750px;">
                                <input type="number" name="monthlysalary" id="monthlysalary" class="form-control"
                                    style="border: 2px solid #1b3f2f;" required>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1a222b; border-radius: 6px;">Save</button>
                            <button type="button" class="btn w-100 text-white fw-semibold py-2"
                                data-bs-dismiss="modal"
                                style="background-color: #8b0000; border-radius: 6px;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
