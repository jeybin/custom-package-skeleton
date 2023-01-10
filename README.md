
# Skelton for laravel custom package development

Download and run :
```sh
    composer update && composer dump-autoload
```
and add the following to the project root composer.json for testing the package in local, add the following inside require :

```sh
    "vendor/packagename": "dev-main"
```

And add the following after require-dev:

```sh
    "repositories": [
        {
            "type": "path",
            "url": "./packages/rezlive",
            "options": {
                "symlink": true
            }
        }
    ]
```

## License

MIT
