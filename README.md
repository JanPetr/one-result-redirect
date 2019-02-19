# Redict To One Product Result plugin for Algolia for Magento 2

Magento 2 module to redirect to the product, when there is only one product in a results.

## How it works

This extension adds a [Plugin class](https://github.com/JanPetr/one-result-redirect/blob/master/Plugin/RedirectOnOneResultPlugin.php) to Algolia's back-end search [Adapter class](https://github.com/algolia/algoliasearch-magento-2/blob/master/Adapter/Algolia.php), which checks the number of results returned by Algolia. 

If there is only one product returned from Algolia, the extension redirects a user to this returned product.

## Installation

Install the extension with [Composer](https://getcomposer.org/):

```sh
$ composer require janpetr/algoliasearch-magento2-one-result-redirect
$ php bin/magento module:enable JanPetr_OneResultRedirect
```
