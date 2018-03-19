#!/bin/bash

export DEBIAN_FRONTEND=noninteractive
apt-get update -m
apt-get install --no-install-recommends -y \
    nmap \
    wireshark \
    nikto \
    file

# what is the hostname of the machine?
echo "WhiteHacksSG" > /etc/hostname
sed -i 's/$/ WhiteHacksSG/' /etc/hosts
hostname "WhiteHacksSG"

# what is the currently logged in user?
useradd whitehacks -s /bin/bash -m -G sudo
echo whitehacks:whitehacks | chpasswd
echo 'whitehacks ALL=(ALL) NOPASSWD: /usr/bin/gimme_flag' > /etc/sudoers.d/whitehacks

# what type of file is /home/whitehacks/file? (replace it)
echo "WhiteHacks@SG" > /home/whitehacks/file
chown whitehacks:whitehacks /home/whitehacks/file
chmod 444 /home/whitehacks/file

# there is a hidden file in /home/whitehacks. Find it and submit the flag in it.
echo "WHITEHACKS{0NE_D0T_iS_@LL_iT_T@K3S}" > /home/whitehacks/.flag
chown whitehacks:whitehacks /home/whitehacks/.flag
chmod 444 /home/whitehacks/.flag

# which user on this system is the equivalent of superuser besides 'root'?
useradd -u 0 -o -m buzhixiaoli

# this user can run several programs with root privileges. One of them enables you to get the flag. Submit the flag provided by that binary
echo -e "#!/bin/bash\necho WHITEHACKS{sUD0?_SuG0I!}" > /usr/bin/gimme_flag
chown root:root /usr/bin/gimme_flag
chmod 500 /usr/bin/gimme_flag

# which user does not have a home directory that belongs to them?
useradd -m wozhixiaoli
chown root:root /home/wozhixiaoli

# at /home/suspicious_file (replace), there is a suspiciously large file. Find and submit anything interesting inside it. [lots of duplicates, and a flag] [use uniq]
cp /vagrant/suspicious_file /home/wozhixiaoli/suspicious_file

# find a way to reset the root password of your liking. Afterwards, submit the contents of /root/flag.txt
echo "WHITEHACKS{PHYS1C@L_@CC3SS_3QU@LS_PWNeD}" > /root/flag.txt

# I noticed that this machine is running a suspicious in an obscure port. What port is it running on?
# Obtain the flag from the suspicious service and submit it.
cp /vagrant/nmap_banner.py /usr/local/bin/nmap_banner.py
cp /vagrant/nmap_banner /etc/init.d/nmap_banner
chmod +x /usr/local/bin/nmap_banner.py
chmod +x /etc/init.d/nmap_banner
update-rc.d nmap_banner defaults


# setup autologin of whitehacks user
sed -i 's/autologin-user=vagrant/autologin-user=whitehacks/g' /etc/lightdm/lightdm.conf
    
# Setup desktop background
mv /usr/share/backgrounds/warty-final-ubuntu.png /usr/share/backgrounds/warty-final-ubuntu.bak.png
cp /vagrant/whitehacks_wallpaper.png /usr/share/backgrounds/warty-final-ubuntu.png

# Cleanup and reboot to view changes
NEW_UUID=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 32 | head -n 1)
echo "vagrant:$NEW_UUID" | chpasswd
apt-get clean
reboot