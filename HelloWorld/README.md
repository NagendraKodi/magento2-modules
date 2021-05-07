# Magento 2 sample module

**Magento 2 Module development** or **Magento 2 Hello World Simple Module** trends is increase rapidly while Magento release official version. That why we - **Example** - are wring about a topic that introduces how to create a simple **Hello World module in Magento 2**.
As you know, the module is a  directory that contains `blocks, controllers, models, helper`, etc - that are related to a specific business feature. In Magento 2, modules will be live in `app/code` directory of a Magento installation, with this format: `app/code/<Vendor>/<ModuleName>`. Now we will follow this steps to create a simple module which work on Magento 2 and display `Hello World`.



## Magento 2 Hello World module by Example.com

Explanation of module

How to write README.md using [GitHub Pages](https://help.github.com/articles/basic-writing-and-formatting-syntax/).


1. Sample API
   URL:- /rest/V1/hello/id/1
   - etc
     - webapi.xml
     - di.xml
   - Api
     - PostsInterface.php
   - Model
     - Posts.php

2. Events
   - etc
     - events.xml
   - Model
    - Observer
      - ChangeDisplayText.php
      - Customersaveafter.php
  - Controller
    - Sample
      - Event.php

3. Plugins
    - etc
      - di.xml
    - Plugin
      - SamplePlugin.php
    - Controller
      - Sample
        - Plugin.php

4. Preference
  - etc
    - di.xml
   - Model
    - Catalog
      - Product.php

5. Php Unit Test
  - Test
    - Unit
      - Model
        - PostTest.php

6. Setup scripts for Add attribute and install schema and data
   - InstallData.php
   - InstallSchema.php
   - Uninstall.php
   - UpgradeSchema.php

7. Front end

   http://example.com/helloworld

   http://example.com/helloworld/knockout

   http://example.com/helloworld/knockout/ajax
