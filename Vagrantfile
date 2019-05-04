Vagrant.configure("2") do |config|
    config.vm.provision "shell", inline: <<-SHELL
        # Make master and slave point to our IPs
        echo "192.168.1.10 mysql0" >> /etc/hosts
		
    SHELL

    config.vm.define "mysql0" do |mysql0|
        mysql0.vm.box = "ubuntu/bionic64"
        mysql0.vm.network "private_network", ip: "192.168.1.10"
        mysql0.vm.provision "shell", inline: <<-SHELL
		echo "I am up"
		
		sudo apt-get update -y
		sudo apt-get install mysql-server -y
		sudo apt-get install apache2 -y
		sudo apt-get install php libapache2-mod-php -y
		sudo apt-get install php-mysqli -y
		
		
		#https://askubuntu.com/questions/668734/the-requested-url-phpmyadmin-was-not-found-on-this-server
		
		git clone https://github.com/ssjokhla/Library_Project.git
		
		git config --global user.email "ssjokhla@gmail.com"
		git config --global user.name "ssjokhla"
		
        SHELL
    end

end
