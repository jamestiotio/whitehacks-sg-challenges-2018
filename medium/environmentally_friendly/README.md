# Environmentally Friendly

## Description
This web service aims to save you time and trouble of finding the flag by straight up letting you view whatever 
file you want on the system! It also saves electricity, and trees as well! Files are included locally (But batteries aren't).

## Solution
This is a straight-up LFI challenge. By including the source code of the PHP file, 
you'll notice that the flag is stored in the environment variable `FLAG`. View it by 
`cat /proc/self/environ` or `cat /dev/fd/../environ` as `/dev/fd` is a symlink to `/proc/self/fd` where * is a relevant process id. 
Inspired from https://github.com/DDOS-Attacks/ctf-writeups/tree/master/2017/Google Capture The Flag 2017 -Quals/Miscellaneous/mindreader