# Magento 2 Cart Update

Magento 2 Orange_CartUpdate module by [Nagendra Kodi](https://www.linkedin.com/in/nagendrakodi/)

**Module Name:** Orange_CartUpdate

**Version:** 1.0.0
 
**Description:** Update the config product options on cart page. To update the product options, Please select the options and then click Update Shopping Cart button.
<img src="https://i.imgur.com/H8Ff6Cy.gif" width="823" height="421" />

**Overriden the below event, layout, and template and Block:**
```
checkout_cart_update_items_after event
vendor/magento/module-configurable-product/view/frontend/layout/checkout_cart_item_renderers.xml
vendor/magento/module-checkout/view/frontend/templates/cart/item/default.phtml
vendor/magento/module-configurable-product/Block/Cart/Item/Renderer/Configurable.php
```