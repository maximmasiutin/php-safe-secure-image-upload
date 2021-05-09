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

## Usage

Go to the directory with the `upload.php` and `index.html` and run:

```
php -S 127.0.0.0:8080
```

Then open http://127.0.0.0:8080/ in your web browser.

