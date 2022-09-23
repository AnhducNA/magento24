/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2022 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 */

define(["jquery", 'mage/storage', 'mage/translate', 'Magento_Checkout/js/model/url-builder'], function ($, storage, $t, urlBuilder) {
    "use strict";
    return function () {
        //save data
        $(document).ready(function (){
            $("#btn_save").on('click', function () {
                if ($("#btn_save").attr('isValidate')) {
                    let idQuestion = $('#btn_save').attr('data-idQuestion');
                    if(idQuestion){
                        storage.post(
                            urlBuilder.createUrl('/tigren_advancedquestion/question/save', {}),
                            JSON.stringify({
                                id: idQuestion,
                                title: $('#title').val(),
                                content: $('#content').val()
                            })
                        ).done(function (response) {
                            // location.reload();
                            window.location.href = '/tigren_advancedquestion/question/';
                        }).fail(function () {
                            alert('error save data');
                        })
                    }else{
                        storage.post(
                            urlBuilder.createUrl('/tigren_advancedquestion/question/save', {}),
                            JSON.stringify({
                                id: 0,
                                title: $('#title').val(),
                                content: $('#content').val()
                            })
                        ).done(function (response) {
                            // location.reload();
                            window.location.href = '/tigren_advancedquestion/question/';
                        }).fail(function () {
                            alert('error save data');
                        })
                    }
                }
            });
        })
    }
});
