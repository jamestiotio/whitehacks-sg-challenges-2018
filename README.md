# WhiteHacks@SG'18 Capture-The-Flag Competition Files + Solution


## Setup public access for competition / workshop

```
# vagrant up
# vagrant ssh
```

As Altair is running wordpress and requires the WP_HOST to be manually set, it is by default set to 'altair'. With that you have 2 options:

1. Change the WP_HOST to your publicly accessible IP / Hostname
2. Add a local DNS entry to your hosts file

Afterwards, manually configure admin access to the CTFd dashboard and import the 'WhiteHacks 2018.2018-03-16.zip' file to load the challenges.

If you want to enable the Trinity challenge (Altair, Deneb, Vega), you need to unhide the challenges one by one.