Vagrant.configure("2") do |config|
  config.vm.box = "envimation/ubuntu-xenial-docker"
  
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "1024"
    vb.cpus = 2
  end

  config.vm.provision "shell", inline: <<-SHELL
    # Install git
    apt-get update
    apt-get install -y git
    apt-get autoclean
    
    # Set up CTFd
    git clone https://github.com/CTFd/CTFd.git /CTFd
    cd /CTFd
    sed -i 's/8000:8000/80:8000/g' /CTFd/docker-compose.yml
    sed -i 's/redis:4/redis:4-alpine/g' /CTFd/docker-compose.yml
    sed -i 's/mariadb:10.2/yobasystems\\/alpine-mariadb/g' /CTFd/docker-compose.yml
    echo 'WHITEHATSSUPERSECURE' > /CTFd/.ctfd_secret_key
    docker-compose up -d
    
    # Set up WhiteHacks Challenges
    cd /vagrant/medium
    docker-compose build base-httpd base-httpd-php base-supervisord-httpd-php-mysqld
    docker-compose up -d
    docker-compose stop base-httpd base-httpd-php base-supervisord-httpd-php-mysqld
    
    cd /vagrant/hard
    docker-compose up -d
    docker cp altair/setup_for_public_access.sh hard_altair_1:/setup_for_public_access.sh
    docker exec hard_altair_1 chmod +x /setup_for_public_access.sh
    docker ps -aq | xargs docker rm 2> /dev/null
    
    echo "WHITEHACKS{V3G@_ch@1_n0_kick_l@}" > /root/flag
  SHELL
end
