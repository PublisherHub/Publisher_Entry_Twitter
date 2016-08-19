# TwitterEntry
Provides Entries for publisher/publisher to post to Twitter.

TwitterUserEntry: post a status message as a user.
-> implements publisher/recommendation


# Installation
The recommended way to install this is through [composer](http://getcomposer.org).

Edit your `composer.json` and add:

```json
{
    "require": {
        "publisher/twitter-entry": "dev-master"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```