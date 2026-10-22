# PHP OOP Image Uploading

A small PHP exercise that uploads images to the server, records their paths in MySQL through a reusable OOP database class, shows them as a gallery and deletes them on click.

![PHP](https://img.shields.io/badge/PHP-OOP-777BB4?logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-mysqli-4479A1?logo=mysql&logoColor=white)

## Overview

Built in May 2021 as a learning project to practice file uploads and an object-oriented mysqli wrapper.

## Features

- Upload form for a single image
- Validation: file required, max size about 1 MB, allowed types jpg, jpeg, png and gif
- Unique file names generated from an md5 of the current time
- File path saved to the `tbl_image` table; file moved to `uploads/`
- Thumbnail gallery of all uploaded images
- Click a thumbnail to delete it from both the database and the disk
- `Database` class with connect, select, insert, update and delete methods

## Tech Stack

- PHP (OOP)
- MySQL via mysqli
- HTML/CSS

## Getting Started

1. Copy the project to your web root, e.g. `htdocs/PHP_OOP_IMGUPLOADING`.
2. Create the database and table (the config expects a database named `test`):

   ```sql
   CREATE TABLE tbl_image (
     id INT AUTO_INCREMENT PRIMARY KEY,
     img VARCHAR(255) NOT NULL
   );
   ```

3. Update `lib/config.php` with your credentials.
4. Create a writable `uploads/` folder in the project root (it is not included in the repo).
5. Open `http://localhost/PHP_OOP_IMGUPLOADING/`.

## Project Structure

```text
index.php         # Upload form, gallery and delete handler
lib/
├── config.php    # DB constants
└── Database.php  # mysqli wrapper
inc/              # header, footer
```

## Author

Built by **Ashraf Siddik**, Shopify developer & CRO specialist.
- Website: [ashraf-siddik.com](https://ashraf-siddik.com)
- GitHub: [@coderasraf](https://github.com/coderasraf)
