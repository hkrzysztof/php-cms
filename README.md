# Blog with a photo gallery and CMS

## Introduction

It was built with the use of PHP, JS, jQuery, Bootstrap, MySqli

## Getting Started

1. Create database with 4 tables
a) users (id, username, password, first_name, last_name, rights, filename, created_at, last_modified)
b) posts (id, author, title, body, created_at, last_modified)
c) photos (id, title, description, filename, alt_text, type, size, created_at, last_modified, author)
d) comments (id, photo_id, author, body, created_at)
2. Fill in DB details in /admin/includes/db_config.php
3. Ready to use
