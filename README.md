# Centipede

The simplest automated testing tool on Earth.

## Idea

What is the simplest test you can think of for your web application? Maybe just check if all pages work? That's exactly what this tool is about.

## Installation

#### Local

```bash
$ composer require umpirsky/centipede:0.1.*@dev
```

#### Global

```bash
$ composer global require umpirsky/centipede:0.1.*@dev
```

Make sure you have ``~/.composer/vendor/bin`` in your ``PATH`` and
you're good to go:

```bash
$ export PATH="$PATH:$HOME/.composer/vendor/bin"
```
Don't forget to add this line in your `.bashrc` file if you want to keep this change after reboot.


## Usage

```
./bin/centipede run https://github.com
```

## Screenshot

![Centipede](https://raw.githubusercontent.com/umpirsky/centipede/master/resources/images/screenshot.png)
