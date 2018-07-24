[![Build Status](https://travis-ci.org/the-software-factory/jquery-sticky-footer.svg?branch=master)](https://travis-ci.org/the-software-factory/jquery-sticky-footer)

# jQuery Sticky Footer
The footer is positioned at the bottom of the page but *without* an `absolute` position.

## Installation
You'll need [bower](http://bower.io/) to install jQuery Sticky Footer plugin and its dependencies.
Install the plugin and save it as a dependency in your project:
```sh
$ bower --save install jquery-sticky-footer
```

## Usage

The page structure has to match the following one:
```html
<body>
    <div>...</div>
    <div class="footer">/div>
</body>
```

- `<body>` tag must have *ONLY* two tags as children: the first one as page container and the second one as footer container.
- There are NO restrictions for tags and classes that you can use as children of the `<body>` tag.

Please run the following script to initialize a footer:
```js
$('.footer').stickyFooter();
```

## Development
The project has the following structure:
```
dist/
    *.min.js // The uglified version of the component.
src/
    *.js // The source file
test/
    src/*.js // Tests
    ...      // Task runner configuration file and test dependencies
...
```

### Installation
This project requires [node](https://nodejs.org/) for the development installation so you can
install its dependencies, build it and test it.

Please run following commands to install all dependencies:
```sh
$ npm install
$ ./node_modules/bower/bin/bower install
$ cd test && npm install
```

### Grunt Tasks
Here is a list of grunt `tasks` => `actions` mappings, see below for a deeper explanation of the actions.

|   *Grunt task*    | *jshint* | *uglify* | *usebanner* | *devserver* | *watch* | *emptyTheChangelog* | *conventionalChangelog* | *changelogCommit* |
|-------------------|:--------:|:--------:|:-----------:|:-----------:|:-------:|:-------------------:|:-----------------------:|:-----------------:|
|      grunt        |    *     |    *     |      *      |             |         |                     |                         |                   |
| grunt development |          |          |             |      *      |    *    |                     |                         |                   |
| grunt changelog   |          |          |             |             |         |          *          |           *             |         *         |

* *jshint*: Validate files with JSHint.
* *uglify*: Create the final \*.min.js.
* *usebanner*: Prepends a banner to the minified file
* *devserver*: Spawns a web server so you can rapidly test your app in action
* *watch*: Run default task when src or test files are added, changed or deleted.
* *emptyTheChangelog*: Truncates the CHANGELOG.md file as conventionalChangelog task will append fully regenerated changelog
* *conventionalChangelog*: Appends Markdown-formatted changelog history to CHANGELOG.md
* *changelogCommit*: Prepares a new commit with updated CHANGELOG.md and commit message "CHANGELOG.md Updated"

## Tests
Take a look at [`test/README.md`](test/README.md) for more details.

## Contributing
Take a look at [`CONTRIBUTING.md`](CONTRIBUTING.md) for more details.
