#!/usr/bin/python
# -*- coding: utf8 -*-

import os

if (os.name == "nt"):
    os.system("del images\\*.jpg")
    os.system("php main.php")
    os.system("ffmpeg -threads 4 -y -r 24 -i \"images\\%d.jpg\" -q 99 sort.ogg")
else:
    os.system("rm -f images/*.jpg")
    os.system("php main.php")
    os.system("ffmpeg -threads 4 -y -r 24 -i \"images/%d.jpg\" -q 99 sort.ogg")
