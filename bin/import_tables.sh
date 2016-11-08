#!/usr/bin/env bash
mkdir entities
echo `vendor/bin/doctrine orm:convert-mapping --force --from-database annotation ./entities/`
echo '--------------';
echo `vendor/bin/doctrine orm:generate-entities ./entities/ --generate-annotations=true`
echo '<================================>';
