# My Inner D(a)emon

## Description
"All of our d(a)emons must be faced sooner or later. The sooner that we do face our d(a)emons, 
the easier it will be to face our d(a)emons." ~ The Truth of Reality, Tsunyota Kohet

## Solution
Bruteforce SSH login (user:pass is 'user:user'). Use `nc localhost 21` 
to exploit the vsftpd 2.3.4 backdoor vulnerability which will open a limited 
shell on custom port 38426 printing out the flag. Use `nc` again to dump the flag.