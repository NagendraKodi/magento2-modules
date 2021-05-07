define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            initialize: function (config) {
               this.customerName = ko.observableArray([]);
               this.customerData = ko.observable('');
               this.myFlag = '1';
               this._super();
               this.getPostCustomers(config.items);
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
                    cache: false
                });
            },
            getPostCustomers: function(items) {
              this.columnNames = ko.computed(function () {
                  if (items.length === 0)
                  { return []; }
                 return items;
              });
            }
        });
    }
);