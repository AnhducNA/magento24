/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

define(["jquery", "domReady!", "Magento_Ui/js/modal/modal"], function ($, dom) {

    "use strict";
    //creating jquery widget
    $.widget('Vendor.modalForm', {
        options: {
            modalForm: '#modal-form',
            modalButton: '.tocart'
        },
        _create: function () {
            this.options.modalOption = this._getModalOptions();
            this._bind();
        },
        _getModalOptions: function () {
            /**
             * Modal options
             */
            var options = {
                type: 'popup',
                responsive: true,
                title: 'Allow multi products ',
                buttons: [{
                    text: $.mage.__('Close model'),
                    class: '',
                    click: function () {
                        this.closeModal();
                    }
                }]
            };

            return options;
        },
        _bind: function () {
            var modalOption = this.options.modalOption;
            var modalForm = this.options.modalForm;

            $(document).on('click', this.options.modalButton, function () {

                var data_product_sku = $(this).attr('data-product-sku');
                var popupUrl = window.location.origin+"/tigren_advancedcheckout/index/showpopup";
                $.ajax({
                    url: popupUrl,
                    data: {
                        sku: data_product_sku
                    },
                    type: "POST",
                    dataType: 'json'
                }).done(function (response) {
                    if (response.isShowPopup) {
                        //Initialize modal
                        $(modalForm).modal(modalOption);
                        //open modal
                        $(modalForm).trigger('openModal');
                    }
                });

            });
        }
    });

    return $.Vendor.modalForm;
})
