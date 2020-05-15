# Практическое задание 3


## 1. (ВЫПОЛНЕНО) В приложенном файле в Cisco Packet Tracer связать файлы с помощью статической маршрутизации.

**ВЫПОЛНЕНИЕ:**

* Настройка маршрутизатора в Офис 1

        enable
        configure terminal

        interface gigabitEthernet 0/1
        ip address 192.168.250.1 255.255.255.0
        no shutdown 
        exit
        
        interface gigabitEthernet 0/0
        ip address 192.168.251.1 255.255.255.0
        no shutdown
        exit

        ip route 192.168.2.0 255.255.255.0 192.168.250.2
        ip route 192.168.3.0 255.255.255.0 192.168.251.3
        exit

        write

* Настройка маршрутизатора в Офис 2

        enable
        configure terminal

        interface gigabitEthernet 0/1
        ip address 192.168.250.2 255.255.255.0
        no shutdown 
        exit
        
        interface gigabitEthernet 0/2
        ip address 192.168.252.2 255.255.255.0
        no shutdown
        exit

        ip route 192.168.1.0 255.255.255.0 192.168.250.1
        ip route 192.168.3.0 255.255.255.0 192.168.252.3
        exit

        write

* Настройка маршрутизатора в Офис 3

        enable
        configure terminal
        
        interface gigabitEthernet 0/1
        ip address 192.168.3.254 255.255.255.0
        no shutdown 
        exit

        interface gigabitEthernet 0/0
        ip address 192.168.251.3 255.255.255.0
        no shutdown 
        exit
        
        interface gigabitEthernet 0/2
        ip address 192.168.252.3 255.255.255.0
        no shutdown
        exit

        ip route 192.168.1.0 255.255.255.0 192.168.251.1
        ip route 192.168.2.0 255.255.255.0 192.168.252.2
        exit

        write



## 2. Проследить в Cisco Packet Tracer, Wireshark работу протоколов arp, icmp (например, используя tracert или traceroute -I)

## 3.* Настроить удалённый доступ из офиса 1 ко всем коммутаторам и проверить работоспособность.


## 4.* Настроить маршруты таким образом, чтобы трафик между офисами 1 и 3 отправлялся через общую транспортную сеть. В случае её недоступности - через офис 2. Как только она снова становилась доступна - опять напрямую.

* Настройка маршрутизатора в Офис 1

        enable
        configure terminal

        interface gigabitEthernet 0/1
        ip address 192.168.250.1 255.255.255.0
        no shutdown 
        exit
        
        interface gigabitEthernet 0/0
        ip address 192.168.251.1 255.255.255.0
        no shutdown
        exit

        ip route 192.168.2.0 255.255.255.0 192.168.250.2
        ip route 192.168.3.0 255.255.255.0 192.168.251.3

        ip route 192.168.3.0 255.255.255.0 192.168.250.2 20
        ip route 192.168.2.0 255.255.255.0 192.168.251.3 20
        exit

        write

* Настройка маршрутизатора в Офис 2

        enable
        configure terminal

        interface gigabitEthernet 0/1
        ip address 192.168.250.2 255.255.255.0
        no shutdown 
        exit
        
        interface gigabitEthernet 0/2
        ip address 192.168.252.2 255.255.255.0
        no shutdown
        exit

        ip route 192.168.1.0 255.255.255.0 192.168.250.1
        ip route 192.168.3.0 255.255.255.0 192.168.252.3

        ip route 192.168.1.0 255.255.255.0 192.168.252.3 20
        ip route 192.168.3.0 255.255.255.0 192.168.250.1 20
        exit

        write

* Настройка маршрутизатора в Офис 3

        enable
        configure terminal
        
        ip route 192.168.1.0 255.255.255.0 192.168.252.2 20
        ip route 192.168.2.0 255.255.255.0 192.168.251.1 20
        exit

        write
