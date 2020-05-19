# Практическое задание 4

Результирующая схема сохранена и выложена в файле **HW_lesson4_SukharevAV.pkt**.

## 1. (ВЫПОЛНЕНО) На всех маршрутизаторах настроить динамическую маршрутизацию с помощью протокола RIP2 и DHCP сервер для динамической настройки клиентов в LAN.

**ВЫПОЛНЕНИЕ:**

* Настройка маршрутизатора в Офис 1

        enable
        configure terminal
        
        interface gigabitEthernet 0/0
	    ip address 192.168.250.5 255.255.255.252
        no shutdown
        exit

        interface gigabitEthernet 0/1
	    ip address 192.168.250.1 255.255.255.252
        no shutdown
        exit

        router rip
        version 2
        network 192.168.250.0
        network 192.168.1.0
        passive-interface gigabitEthernet 0/2
        exit

        ip dhcp pool Office1
        network 192.168.1.0 255.255.255.0
        default-router 192.168.1.254
        exit
        ip dhcp excluded-address 192.168.1.253

        exit
        write

* Настройка маршрутизатора в Офис 2

        enable
        configure terminal
        
        interface gigabitEthernet 0/1
	    ip address 192.168.250.2 255.255.255.252
        no shutdown
        exit

        interface gigabitEthernet 0/2
	    ip address 192.168.250.9 255.255.255.252
        no shutdown
        exit

        router rip
        version 2
        network 192.168.250.0
        network 192.168.2.0
        passive-interface gigabitEthernet 0/0
        exit

        ip dhcp pool Office2
        network 192.168.2.0 255.255.255.0
        default-router 192.168.2.254
        exit
        ip dhcp excluded-address 192.168.2.253

        exit
        write

* Настройка маршрутизатора в Офис 3

        enable
        configure terminal
        
        interface gigabitEthernet 0/0
	    ip address 192.168.250.6 255.255.255.252
        no shutdown
        exit

        interface gigabitEthernet 0/2
	    ip address 192.168.250.10 255.255.255.252
        no shutdown
        exit

        router rip
        version 2
        network 192.168.250.0
        network 192.168.3.0
        passive-interface gigabitEthernet 0/1
        exit

        ip dhcp pool Office3
        network 192.168.3.0 255.255.255.0
        default-router 192.168.3.254
        exit
        ip dhcp excluded-address 192.168.3.253

        exit
        write

* Хосты во всех офисах перенастроены на автоматическое получение настроек сети по DHCP.