Usage:

Add the following to your `phpunit.xml` file:

```xml
  <extensions>
    <bootstrap class="ggrptrr\PHPUnitPrinter\Extension\Bootstrap" />
  </extensions>
```

For using from the git repository, you have to add the repository to your `composer.json` file:

```json
      "repositories": [{
            "type": "vcs",
            "url": "git@github.com:ggrptr/phpunit-printer.git",

    }]
```

and then add to the required the packages:

```json 
  "require-dev": {
    "ggrptr/phpunit-printer": "dev-main"
  }
```

