define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            initialize: function () {
               this.customerName = ko.observableArray([]);
               this.customerData = ko.observable('');
               this._super();
            },
 
            addNewCustomer: function () {
                this.customerName.push({name:this.customerData()});
                this.ajaxCall(this.customerData());
                this.customerData(''); 
            },
            ajaxCall: function(name){
            jQuery.ajax({
                url: this.dataUrl,
                type: "POST",
                dataType: 'json',
                data: {name:name},
                showLoader: true,
                cache: false,
            });
            }
        });
    }
);