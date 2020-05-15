# Практическое задание 3

Результирующая схема сохранена и выложена в файле **HW_lesson3_SukharevAV.pkt**.

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



## 2. (ВЫПОЛНЕНО) Проследить в Cisco Packet Tracer, Wireshark работу протоколов arp, icmp (например, используя tracert или traceroute -I)

**ВЫПОЛНЕНИЕ:**

* Маршрут от (PC-PT 192.168.1.1) до (PC-PT 192.168.1.2)

        C:\> tracert 192.168.1.2

        Tracing route to 192.168.1.2 over a maximum of 30 hops: 
          1   0 ms      0 ms      0 ms      192.168.1.2

        Trace complete.

        C:\>arp -a
        Internet Address      Physical Address      Type
        192.168.1.2           0090.219e.9bd9        dynamic
        192.168.1.254         00d0.9729.6203        dynamic

* Маршрут от (PC-PT 192.168.1.1) до (PC-PT 192.168.2.1)

        C:\> tracert 192.168.2.1

        Tracing route to 192.168.2.1 over a maximum of 30 hops: 

        1   0 ms      0 ms      0 ms      192.168.1.254
        2   0 ms      0 ms      0 ms      192.168.250.2
        3   0 ms      0 ms      1 ms      192.168.2.1

        Trace complete.

* Маршрут от (PC-PT 192.168.1.1) до (PC-PT 192.168.3.1)

        C:\> tracert 192.168.3.1

        Tracing route to 192.168.3.1 over a maximum of 30 hops: 

        1   0 ms      0 ms      0 ms      192.168.1.254
        2   0 ms      0 ms      0 ms      192.168.251.3
        3   0 ms      0 ms      0 ms      192.168.3.1

        Trace complete.


* Маршрут от (PC-PT 192.168.2.1) до (PC-PT 192.168.3.1)

        C:\>tracert 192.168.3.1

        Tracing route to 192.168.3.1 over a maximum of 30 hops: 

        1   0 ms      0 ms      0 ms      192.168.2.254
        2   1 ms      0 ms      0 ms      192.168.252.3
        3   0 ms      0 ms      0 ms      192.168.3.1

        Trace complete.


## 3.* (ВЫПОЛНЕНО) Настроить удалённый доступ из офиса 1 ко всем коммутаторам и проверить работоспособность.

* Настройка коммутатора в Офис 1

        enable
        configure terminal 

        interface vlan 1
        ip address 192.168.1.253 255.255.255.0
        no shutdown
        exit

        ip default-gateway 192.168.1.254

        enable password qwe

        line vty 0 15
        password asd
        exit
        exit

        write

* Настройка коммутатора в Офис 2

        enable
        configure terminal 

        interface vlan 1
        ip address 192.168.2.253 255.255.255.0
        no shutdown
        exit

        ip default-gateway 192.168.2.254

        enable password qwe

        line vty 0 15
        password asd
        exit
        exit
        
        write

* Настройка коммутатора в Офис 3

        enable
        configure terminal 

        interface vlan 1
        ip address 192.168.3.253 255.255.255.0
        no shutdown
        exit

        ip default-gateway 192.168.3.254

        enable password qwe

        line vty 0 15
        password asd
        exit
        exit
        
        write

* Проверка доступа к коммутатору в Офис 3

        C:\>telnet 192.168.3.253
        Trying 192.168.3.253 ...Open


        User Access Verification

        Password: 
        Switch>enable
        Password: 
        Switch#

## 4.* (ВЫПОЛНЕНО) Настроить маршруты таким образом, чтобы трафик между офисами 1 и 3 отправлялся через общую транспортную сеть. В случае её недоступности - через офис 2. Как только она снова становилась доступна - опять напрямую.

* Настройка маршрутизатора в Офис 1

        enable
        configure terminal

        ip route 192.168.3.0 255.255.255.0 192.168.250.2 20
        exit

        write


* Настройка маршрутизатора в Офис 3

        enable
        configure terminal
        
        ip route 192.168.1.0 255.255.255.0 192.168.252.2 20
        exit

        write

* Проверка задания:

        1. Маршрут от (PC-PT 192.168.1.1) до (PC-PT 192.168.3.1) при включеном линке:

        C:\>tracert 192.168.3.1

        Tracing route to 192.168.3.1 over a maximum of 30 hops: 

        1   0 ms      0 ms      0 ms      192.168.1.254
        2   0 ms      0 ms      0 ms      192.168.251.3
        3   0 ms      0 ms      0 ms      192.168.3.1

        Trace complete.

        2. Маршрут от (PC-PT 192.168.1.1) до (PC-PT 192.168.3.1) при выключеном линке:

        Tracing route to 192.168.3.1 over a maximum of 30 hops: 

        1   0 ms      0 ms      0 ms      192.168.1.254
        2   0 ms      0 ms      0 ms      192.168.250.2
        3   0 ms      0 ms      0 ms      192.168.252.3
        4   0 ms      0 ms      0 ms      192.168.3.1

        Trace complete.

