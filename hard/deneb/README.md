# Deneb I

## Description
ReCon SG was a cybersecurity competition, precedent only to WhiteHacks@SG in a parallel universe. Such an 
event did not exist in our timeline, yet we have located this suspicious website as of late. The owner of 
this otherworldly website told us that he was a whitehacks co-organizer from the future! Proof of this can 
be found in a flag located in the `/home/whitehacks` folder. Find it and submit its contents for analysis.

## Solution
The website is vulnerable to LFI. It also has arbitrary file read access to the `/var/log/apache2` directory. 
Poison the log with a command shell and include it using LFI to gain access. The flag can be found in 
`/home/whitehacks/.flag`.

# Deneb II

## Description
After proving his allegiance to the WhiteHacks@SG community, he told us that he hid another flag in the root 
directory as it contains access to a message from the future. He also told us that proper enumeration and 
understanding of the operating system is crucial to gaining access to the flag. Reveal the contents of the flag.

## Solution
The system contains a `chkrootkit 0.49` backdoor vulnerability. Simply create a shell script at `/tmp/update` 
and change the root password and enable SUID bit on `su` to access the flag. The backdoor executes every 1 minute.
