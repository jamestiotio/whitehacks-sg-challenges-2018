# WhiteHacks@SG'18 Capture-The-Flag Competition Files + Solution


## Setup public access for competition / workshop

Assuming that your public IP is 123.123.123.123 running on port 8000,

```
# vagrant up
# vagrant ssh
vagrant@base-debootstrap:~$ docker-compose exec -T altair "/setup_for_public_access.sh 127.0.0.1 123.123.123.123:8000"
```

As Altair is running wordpress and requires the WP_HOST to be manually set, we need to modify the WP_HOST value after provisioning.

Afterwards, manually configure admin access to the CTFd dashboard and import the 'WhiteHacks 2018.2018-03-16.zip' file to load the challenges.

If you want to enable the Trinity challenge (Altair, Deneb, Vega), you need to unhide the challenges one by one.