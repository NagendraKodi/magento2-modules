# Magento 2 GraphQl Demo Module


**Magento 2 Orange_DemoGraphQl by Nagendra Kodi**

InPut:
```
{
  salesOrder(id: 1) {
    increment_id
    grand_total
    customer_name
    is_guest_customer	    
    address_array
  }
}
```


OutPut:
```
{
  "data": {
    "salesOrder": {
      "increment_id": "000000001",
      "grand_total": "78.6100",
      "customer_name": "Veronica Costello",
      "is_guest_customer": false,
      "address_array": [
        "Veronica Costello",
        "Calder",
        "49628-7978",
        "Michigan"
      ]
    }
  }
}
```
<img src="https://i.imgur.com/OCRvXDS.png" width="823" height="421" />


Ref: https://www.rakeshjesadiya.com/graphql-in-magento-2/
