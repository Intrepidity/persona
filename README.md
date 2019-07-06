# Persona

Persona is a library to generate realistic but fake personal data to use in testing PHP projects.

## Usage

This project is currently still in development. As of now there are no tagged versions and packagist has not been setup as of yet. If you want to play around with it regardless, use as follows:

```php
$generator = new Intrepidity\Persona\Generator\PersonGenerator();

$person = $generator->generate($locale);
```

The `$locale` variable should contain one of the supported locales, in other words, a directory under `/data`

## Adding a new locale

If you wish to add a new locale, create a directory named after that locale in `/data` with the following file structure:

parameters.json: Contains settings for the locale, such as the TLD and parsing rules

names.json: Contains a list of common names for the locale, split up into family names and female and male first names.

