# PHP safe/secure image upload 

PHP safe/secure image upload code snippet  
Copyright 2021 Maxim Masiutin  
maxim@masiutin.com  

This code saves an uploaded file under the original file name,
as provided by the uploader. It does not use a hash as a
destination filename or similar technique but preserves the
file name instead.

If you manage to find vulnerabilities or weaknesses in this code,
please send me a note. This code is just an example that
illustrates the issues that may arise during PHP file upload.
The code serves educational purposes and is not intended for
direct use.

This program is free software; you can redistribute it and/or
modify it under the terms of version 3 of the GNU Lesser General
Public License (LGPL) as published by the Free Software Foundation.

his program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with this program; if not, write to the Free Software Foundation,
Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

## Usage

Go to the directory with the `upload.php` and `index.html` and run:

```
php -S 127.0.0.1:8080
```

Then open http://127.0.0.1:8080/ in your web browser.

