define(
  [
      'jquery',
      'ko',
      'uiComponent'
  ],
  function ($,ko, Component) { 
      return Component.extend({
        defaults: {
            template: 'Orange_HelloWorld/list'
        },
        initialize: function(config) {
             this._super();
             this.getPostCustomers(config.items);
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