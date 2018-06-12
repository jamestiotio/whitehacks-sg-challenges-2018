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
    echo 'AAAAAAAAAAAAAAAAAAAA' > /CTFd/.ctfd_secret_key
    docker-compose up -d
    
    # Set up WhiteHacks Challenges
    cd /vagrant/medium
    docker-compose build base-httpd base-httpd-php base-supervisord-httpd-php-mysqld
    bash /vagrant/build-medium.sh
    docker-compose up -d
    
    cd /vagrant/hard
    bash /vagrant/build-hard.sh
    docker-compose up -d
    
    echo "WHITEHACKS{V3G@_ch@1_n0_kick_l@}" > /root/flag
  SHELL
end
