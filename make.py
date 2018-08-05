#!/usr/bin/python
# -*- coding: utf8 -*-

import os

if (os.name == "nt"):
    os.system("del images\\*.png")
else:
    os.system("rm -f images/*.png")

os.system("php main.php")
os.system("ffmpeg -threads 4 -y -r 24 -i \"images\\%d.png\" -vcodec libx264 sort.mp4")