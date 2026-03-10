
/******************************** Start Usage Details ***********************************/

/**
 * Input Html
 *   <div class="form-group">
 *       <label class="required">رقم الجوال</label>
 *       <div class="form-floating tel-input">
 *           <input  name="mobile2" class="form-control" type="tel" value="+970597401915"/>
 *       </div>
 *
 *       <span class="text-danger mobile-error-msg"></span>
 *       <span class="validation-msg text-danger ps-1 lev"></span>
 *   </div>
 *
 */

/**
 * required style
 *     @include('layouts.shop_cpanel.custom_components.tel_mobile.mobile_style', ['version' => 2])
 */

/**
 * required script
 *      @include('layouts.shop_cpanel.custom_components.tel_mobile.mobile_script', ['version' => 2])
 */


/**
 * To initialize filepond in the form. We have two ways:
 *
 * 1- initialize all inputs within the form with the same options at once
 *      CustomTelMobile.initFormTelMobiles(formId, options); // returns list of customTelMobileInstances - the key is the input name, the value is the file -
 *
 * 2- init filepond inputs separately (call the following code for each input)
 *      CustomTelMobile.initTelMobileInput(formId, inputSelector, options); // returns the customTelMobileInstance for the given input
 */

/**
 * -- options
 * you can customize any option of the tel input library
 * it will override the default options
 * Note: the input by default supports SA country only
 *  - if you want to support all countries => send with options {onlyCountries: []}
 *  - if you want to support specific countries => {onlyCountries: ['sa', 'ps', ...]}
 */


/**
 * To submit the inputs within ajax requests.
 *  1. let formData = new FormData(); Or let formData = new FormData(form); // as needed
 *  2. CustomTelMobile.appendFormTelMobilesToFormData(formId, formData);
 *
 */

/**
 * To reset inputs within the form.
 *  CustomTelMobile.resetFormTelMobiles(formId);
 *  OR you can use the general form reset function => FormHelper.resetForm(formId)
 *
 */

/**
 * to submit value manually. you can get the mobile value
 *  1. from the customTelMobile instance => customTelMobileInstance.getNumber()
 *  2. from inputName => CustomTelMobile.getTelMobileValueByInputName(formId, inputName)
 */

/**
 *  to get the customTelMobile instance given the input name
 *  CustomTelMobile.getTelMobileInstanceByInputName(formId, inputName)
 */


/******************************** End Usage Details ***********************************/


CustomTelMobile = function () {
    let customTelMobiles = [];

    return {
        customTelMobiles:customTelMobiles,
        init: function (formId, inputSelector, extra_options = {}) {

            try {

                let tel_input_mobile = null;

                inputSelector = formId + " " +inputSelector;
                let tel_input = document.querySelector(inputSelector);
                let tel_group = $(inputSelector).closest('._input_group');
                let submitForm = $(formId);

                console.log('tel_group:' + inputSelector, tel_group);

                if (tel_input) {
                    //============ begin validation ===============//
                    let tel_mobileErrorMsg = tel_group.find(".mobile-error-msg");
                    helperJS.consoleLog('mobile-error-msg',tel_mobileErrorMsg);
                    // here, the index maps to the error code returned from getValidationError - see readme
                    let errorMap = [Lang.get('cpanel.invalid_mobile_number'),Lang.get('cpanel.invalid_country_code'),
                                    Lang.get('cpanel.short_mobile_number_length'),Lang.get('cpanel.long_mobile_number_length'),
                                    Lang.get('cpanel.invalid_mobile_number')];

                    // initialise plugin
                    let preferredCountries = ['AE','KW','SA','JO','PS','SY','QA','EG','BH','YE','MA','IQ','OM'];
                    if(extra_options.onlyCountries && (extra_options.onlyCountries.length === 0 || extra_options.onlyCountries.length > 1)){
                        preferredCountries = ['il','ps'];
                    }

                    tel_input_mobile = window.intlTelInput(tel_input, helperJS.merge2Objects({
                        hiddenInput: $(tel_input).attr('name'),
                        // onlyCountries: ['ps','il'],
                        initialCountry: "auto",
                        geoIpLookup: function(callback) {
                            fetch("https://ipapi.co/json")
                                .then(function(res) { return res.json(); })
                                .then(function(data) { callback(data.country_code); })
                                .catch(function() { callback("ae"); });
                        },
                        preferredCountries: preferredCountries,
                        customPlaceholder: function (placeholder, selectedCountryData) {
                            placeholder = placeholder.replace(/\s/g, "");
                            let index = placeholder.lastIndexOf("123");

                            if (index == -1) {
                                return placeholder;
                            }
                            else {
                                let num = placeholder.substr(index);
                                let x_num = num.replace(/\d/g, "x");
                                let final_placeholder = placeholder.replace(num, "") + x_num;

                                return final_placeholder;
                            }
                        },
                        utilsScript: baseUrl + "/cpanel/plugins/custom/intl-tel-input-master/js/utils.js"
                    }, extra_options));

                    tel_input_mobile.tel_mobileErrorMsg = tel_mobileErrorMsg;

                    // on blur: validate
                    $(inputSelector).on('change paste keyup', function () {
                        let input_val = tel_input.value.trim();
                        if (input_val.startsWith("00")) {
                            tel_input_mobile._setFlag(null);
                            tel_input_mobile._triggerCountryChange();

                        }
                        console.log('change paste keyup:number:' + inputSelector, tel_input.value.trim(), tel_input);
                        CustomTelMobile.validateNumber( tel_input_mobile);

                    });

                    // tel_input.addEventListener("countrychange", function () {
                    //     console.log('countrychange:number', this.value.trim())
                    //     CustomTelMobile.validateNumber( tel_input_mobile)
                    // });

                    $(inputSelector).on('countrychange', function () {
                        console.log('countrychange:number', this.value.trim())
                        CustomTelMobile.validateNumber( tel_input_mobile)
                    });


                    // submitForm.on('submit',function(event) {
                    //     event.preventDefault(); 			// Prevents the default submit
                    //     if(!CustomTelMobile.isAllFormTelInputsAreValid(formId)){
                    //         let key = CustomTelMobile.getFirstUnValidKey(formId);
                    //
                    //         let input = $(formId).find('[name="' + key + '"]');
                    //         if(input)
                    //         {
                    //             $('html, body').animate({
                    //                 scrollTop: input.offset().top-120
                    //             }, 2000);
                    //         }
                    //         throw new Error('Invalid Nubmer');
                    //
                    //     }
                    //
                    //     console.log('submit',CustomTelMobile.isAllFormTelInputsAreValid(formId))
                    // })
                    // ============ end validation ===============//

                    return tel_input_mobile;
                }
            } catch (error) {

                console.error(error)
                return null;
            }
        },
        getFirstUnValidKey: function(formId) {

            let formTelMobiles = customTelMobiles[formId];

            for(key in formTelMobiles){
                let tel_input_mobile = formTelMobiles[key];
                let is_valid = CustomTelMobile.validateNumber(tel_input_mobile);

                if (!is_valid) {
                    return key;
                }
            }
        },
        isAllFormTelInputsAreValid: function(formId) {
            let formTelMobiles = customTelMobiles[formId];

            let errors_count = 0;
            for(key in formTelMobiles){
                let tel_input_mobile = formTelMobiles[key];
                let is_valid = CustomTelMobile.validateNumber(tel_input_mobile);

                if (!is_valid) {
                    errors_count++;
                }
            }
            return errors_count === 0;
        },
        validateNumber: function( tel_input_mobile) {
            let tel_input = tel_input_mobile.telInput;
            let tel_mobileErrorMsg = tel_input_mobile.tel_mobileErrorMsg;
            let input_val = tel_input.value.trim();

            if (!input_val || tel_input_mobile.isValidNumber()) {
                tel_input.classList.remove("tel_custom_error");
                helperJS.consoleLog('!input_val',!input_val || tel_input_mobile.isValidNumber());

                tel_mobileErrorMsg.hide();
                return true;

            } else {
                tel_input.classList.add("tel_custom_error");
                // var errorCode = tel_input_mobile.getValidationError();
                // tel_mobileErrorMsg.innerHTML = errorMap[errorCode];
                helperJS.consoleLog('tel_mobileErrorMsg',tel_mobileErrorMsg);
                tel_mobileErrorMsg.html(Lang.get('cpanel.invalid_mobile_number'));
                tel_mobileErrorMsg.show();


                return false;
            }
        },
        initFormTelMobiles: function (formId, options) {
            console.log('initFormTelMobiles', formId, options)

            let formTelMobiles = [];
            $(formId + ' [type=tel]').each(function () {
                formTelMobiles[$(this).attr('name')] = CustomTelMobile.initTelMobileInput(formId, `[name="${$(this).attr('name')}"]`, options);
            });
            console.log('formTelMobiles', formTelMobiles)
            return formTelMobiles;
        },
        initTelMobileInput: function (formId, inputSelector, options) {
            console.log('initTelMobileInput', inputSelector, options)
            let customTelMobile = CustomTelMobile.init(formId, inputSelector, options);
            if (!customTelMobiles.hasOwnProperty(formId)) {
                customTelMobiles[formId] = [];
            }
            customTelMobiles[formId][customTelMobile.telInput.name] = customTelMobile;

            return customTelMobile;
        },
        resetFormTelMobiles: function (formId) {
            $(formId+" [type=tel]").val(null);
        },
        destroyFormTelMobiles: function (formId) {
            let formTelMobiles = customTelMobiles[formId];
            for (let key in formTelMobiles) {
                let tel_input_mobile = formTelMobiles[key];
                CustomTelMobile.destroyTelMobileInstance(tel_input_mobile);
                delete formTelMobiles[key];
            }

            delete customTelMobiles[formId];
            console.log('customTelMobiles',customTelMobiles);
        },
        destroyTelMobileByInputName(formId, inputName){
            let tel_input_mobile = customTelMobiles[formId][inputName];
            CustomTelMobile.destroyTelMobileInstance(tel_input_mobile);
            delete customTelMobiles[formId][inputName];

        },
        destroyTelMobileInstance(tel_input_mobile){
            let telInput = tel_input_mobile.telInput;
            $(telInput).off('change paste keyup');
            $(telInput).off('countrychange');
            tel_input_mobile.tel_mobileErrorMsg.empty();
            tel_input_mobile.tel_mobileErrorMsg.hide();
            telInput.classList.remove("tel_custom_error");
            tel_input_mobile.destroy();
        },
        getTelMobileInstanceByInputName: function (formId, inputName) {
            try {
                return customTelMobiles[formId][inputName];

            } catch (error) {
                console.error(error);
                return null;
            }
        },
        getTelMobileValueByInputName: function (formId, inputName) {
            try {
                return customTelMobiles[formId][inputName].getNumber();

            } catch (error) {
                console.error(error);
                return null;
            }
        },
        appendFormTelMobilesToFormData: function (formId, form_data) {
            console.log('initFormTelMobiles', formId)
            let formTelMobiles = customTelMobiles[formId];

            console.log('formTelMobiles',formTelMobiles)
            for (let key in formTelMobiles) {
                let customTelMobile = formTelMobiles[key];
                // alert('appendFormTelMobilesToFormData: '+key + ":" +customTelMobile.getNumber())
                form_data.set(key , customTelMobile.getNumber());

            }


            console.log('appendFormTelMobilesToFormData:form_data', form_data.entries())
            return form_data;
        },
        checkErrorsBeforeSubmit: function(formId, callback){
            if(CustomTelMobile.isAllFormTelInputsAreValid(formId)) {
                callback.apply(this);
            }else{
                let key = CustomTelMobile.getFirstUnValidKey(formId);

                let input = $(formId).find('[name="' + key + '"]');
                if(input)
                {
                    $('html, body').animate({
                        scrollTop: input.offset().top-120
                    }, 2000);
                }


            }
            return false;

        },
    }
}();


