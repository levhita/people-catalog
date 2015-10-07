#!/bin/bash
rm *.templates.js
for directory in *; do
    if [[ -d $directory ]]; then
	  handlebars $directory/ -e hbs -n HandlebarsTemplates.$directory -m > $directory.templates.js
    fi
done
