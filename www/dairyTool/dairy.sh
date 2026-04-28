#!/bin/sh
find /var/www/re.sp-labelle.com/www/htdocs/img/girl_image -regex '.*\(jpg\|gif\|png\)$' -a -type f -exec rm -f \{\} \;

##空のフォルダを削除
#find . -type d -empty -delete
find /var/www/re.sp-labelle.com/www/htdocs/img/girl_image -type d -empty -delete
