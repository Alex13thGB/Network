# Практическое задание 5

Результирующая схема сохранена и выложена в файле **HW_lesson5_SukharevAV.pkt**.

## 1. Работа в Wireshark. Запустить Wireshark, выбрать любой веб-сайт, определить IP-адрес сервера, отфильтровать в Wireshark трафик по этому IP-адресу. Набрать адрес сервера в строке браузера. В работе можно использовать источник 1 из списка дополнительных материалов.

## 2. Настроить перегруженный NAT в предложенной схеме в Cisco Packet Tracer. С помощью режима симуляции удостовериться, что при подключении на веб-сервер происходит подмена IP-адресов и портов. Посмотреть таблицу трансляции NAT на маршрутизаторе.

**ВЫПОЛНЕНИЕ:**

* Собрана схема в соответствии с методичкой;
* Настроены ip-адреса хостов и сервера;
* Настройка маршрутизатора Router0

        enable
        configure terminal
        
        interface fastEthernet 0/0
        ip address 192.168.1.1 255.255.255.0
        ip nat inside 
        no shutdown
        exit

        interface fastEthernet 5/0
        ip address 70.70.70.70 255.255.255.0
        ip nat outside
        no shutdown
        exit

        router rip
        version 2
        network 192.168.1.0
        network 70.70.70.0
        passive-interface fastEthernet 0/0
        exit

        access-list 1 permit 192.168.1.0 0.0.0.255
        ip nat inside source list 1 int fa5/0 overload

        exit
        write


* Настройка маршрутизатора Router1

        enable
        configure terminal
        
        interface fastEthernet 0/0
        ip address 80.80.80.70 255.255.255.0
        no shutdown
        exit

        interface fastEthernet 5/0
        ip address 70.70.70.80 255.255.255.0
        no shutdown
        exit

        router rip
        version 2
        network 80.80.80.0
        network 70.70.70.0
        passive-interface fastEthernet 0/0
        exit

        exit
        write

**ПРОВЕРКА:**

C хостов 192.168.1.1 и 192.168.1.2 запущен **ping 80.80.80.100**.

На маршрутизаторе Router0 проверена таблица трансляции адресов:

**show ip nat translations**

        Pro  Inside global     Inside local       Outside local      Outside global
        icmp 70.70.70.70:1     192.168.1.3:1      80.80.80.100:1     80.80.80.100:1
        icmp 70.70.70.70:2     192.168.1.3:2      80.80.80.100:2     80.80.80.100:2
        icmp 70.70.70.70:3     192.168.1.3:3      80.80.80.100:3     80.80.80.100:3
        icmp 70.70.70.70:44    192.168.1.2:44     80.80.80.100:44    80.80.80.100:44
        icmp 70.70.70.70:45    192.168.1.2:45     80.80.80.100:45    80.80.80.100:45
        icmp 70.70.70.70:46    192.168.1.2:46     80.80.80.100:46    80.80.80.100:46
        icmp 70.70.70.70:4     192.168.1.3:4      80.80.80.100:4     80.80.80.100:4