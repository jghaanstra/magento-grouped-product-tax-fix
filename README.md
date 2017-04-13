# Magento 2 - Grouped Products Tax Fix

Small Magento v2.x extension to fix a bug within Magento v2.1 core not showing tax for grouped products

- Upload files through root of Magento v2.x
- Run following commands through SSH client:

```sh
$ php bin/magento setup:upgrade
$ php bin/magento setup:static-content:deploy
$ php bin/magento setup:di:compile (for production only)
```
