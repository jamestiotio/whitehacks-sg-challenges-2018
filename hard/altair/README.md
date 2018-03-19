# Altair I

## Description
I received a report that the website has been hacked before. The perpetrator has broken a flag into 3 
parts and scattered them all throughout the site. We need to find them in order to obtain proof of compromise.

## Solution
The first subflag can be found in the HTTP response headers. The second subflag can be located 
in `/robots.txt`. The last subflag can be found in `/wp-content/debug.log`. All 3 subflags can 
be easily revealed using `wpscan`.

# Altair II

## Description
The owner of this site has hidden his plans for world domination in the blog. Unfortunately, 
our flag seems to be mixed up in it. Retrieve it and return the flag to us, the rightful owners.

## Solution
Simple guessing will reveal that the username and the password are one and the same (`altair`). 
The flag can be found in a unpublished draft post.

# Altair III

## Description
Sources tell us that the root flag is at `/root/flag`. Intuitive, isn't it?

## Solution
`vim` has SUID enabled. So simply using `vim /root/flag` will let us read the flag.