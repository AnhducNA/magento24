require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function (
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Custom Form Popup',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };
        // debugger;
        var popup = modal(options, $('#popup-modal'));
        $('.tocart').click(function () {
            //callajax
            // debugger;
            var data_product_sku = $(this).attr('data-product-sku');
            var popupUrl = "<?php echo $this->getUrl().'tigren_advancedcheckout/index/showpopup' ?>";
            // var popupUrl = "http://magento.localhost.com/tigren_advancedcheckout/index/showpopup";
            $.ajax({
                url: popupUrl,
                data: {
                    sku: data_product_sku
                },
                type: "POST",
                dataType: 'json'
            }).done(function (response) {
                if (response.isShowPopup) {
                    $('#popup-modal').modal('openModal');
                }
            });
        });
    });

