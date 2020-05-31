# Практическое задание 7

## 1. (ВЫПОЛНЕНО) Домашняя работа на закрепление принципов работы с беспроводной точкой доступа.

Результирующая схема сохранена и выложена в файле **HW_lesson7_1_SukharevAV.pkt**.

- [x] Разворачиваем сеть Wi-Fi.
*
      Подключен интерфейс Internet точки доступа к коммутатору.
      Настроен интерфейс Internet точки доступа:
            IP: 192.168.1.252
            MASK: 255.255.255.0
            GW: 192.168.1.254
            DNS1: 33.33.33.3

- [x] Откройте файл с заданием.
[x] Проверьте доступность сайта geekbrains.ru через смартфон

      Проверен доступ к сайту

- [x] Подключитесь к маршрутизатору, используя пк, через веб-интерфейс.

      На точке доступа включен доступ у удаленному управлению.
      Проверен доступ к веб-интерфейсу с ПК.

- [x] Настройте безопасную беспроводную сеть.
> Для этого установите шифрование сети и смените стандартное название сети.
> ssid – geekbrains
> тип шифрования:WPA2
> пароль: Geekbrain$

      Изменены настройки точки доступа

- [x] Проверьте работоспособность сайта через смартфон.
- [x] Восстановите работу беспроводной сети на телефоне, применив корректные настройки.
- [x] Проверьте доступность сервера с ноутбука.
- [x] Произведите замену сетевой карты ноутбука. Для этого отключите устройство, замените плату.

- [x] После замены платы повторно включите устройство.

- [x] Перейдите в раздел сетевых настроек и произведите конфигурацию беспроводной сети согласно заданным параметрам.

> Для этого перейдите в раздел профиль и создайте новое сетевое подключение с необходимым именем сети, паролем и типом шифрования. После установления
> соединения с точкой доступа, вы увидите во вкладке Link Information сообщение об успешном установление связи.

- [x] После подключения настройте сетевой адрес устройства на работу в автоматическом режиме (DHCP).
- [x] После получения адреса проверьте связь с сервером и убедитесь в работоспособности сайта.


## 2. Не обязательное задание.

**Примечание:** Не смог разобраться почему при включении VTP EtherChannel перестает агрегироваться. Без VTP все выглядит красиво.


На предложенной схеме:
- [x] настроить по 3 VLAN'а для каждого офиса.

      1. Коммутатор Switch0
            
            en
            conf t

            hostname sw-of1-0

            interface fastEthernet 0/1
            switchport mode access
            switchport access vlan 10
            exit

            interface fastEthernet 0/2
            switchport mode access 
            switchport access vlan 20
            exit

            interface fastEthernet 0/3
            switchport mode access
            switchport access vlan 30
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            exit
            write

      2. Коммутатор Switch1
            
            en
            conf t

            hostname sw-of1-1

            interface fastEthernet 0/1
            switchport mode access
            switchport access vlan 20
            exit

            interface fastEthernet 0/2
            switchport mode access 
            switchport access vlan 30
            exit

            interface fastEthernet 0/3
            switchport mode access
            switchport access vlan 10
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            vtp domain of1

            exit
            write

      3. Коммутатор Switch2

            en
            conf t

            hostname sw-of1-2

            interface fastEthernet 0/21
            switchport mode trunk 
            exit

            interface fastEthernet 0/22
            switchport mode trunk 
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            vtp mode client 

            interface gigabitEthernet 0/1
            switchport mode trunk 

            exit
            write


      4. Маршрутизатор Router0

            en
            conf t

            hostname rt-of1

            interface gigabitEthernet 0/0
            no shutdown 
            exit

            interface gigabitEthernet 0/0.10
            encapsulation dot1Q 10
            ip address 192.168.10.254 255.255.255.0
            exit

            interface gigabitEthernet 0/0.20
            encapsulation dot1Q 20
            ip address 192.168.20.254 255.255.255.0
            exit            switchport mode trunk 

            interface gigabitEthernet 0/1
            no shutdown
            exit

            exit
            write

      5. Коммутатор Switch3
            
            en            switchport mode trunk 

            switchport access vlan 15
            exit

            interface fastEthernet 0/2
            switchport mode access 
            switchport access vlan 25
            exit

            interface fastEthernet 0/3
            switchport mode access
            switchport access vlan 35
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            vtp domain of2

            exit
            write


      6. Коммутатор Switch4
                        switchport mode trunk 

            switchport access vlan 25
            exit

            interface fastEthernet 0/2
            switchport mode access 
            switchport access vlan 35
            exit

            interface fastEthernet 0/3
            switchport mode access
            switchport access vlan 15
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            exit
            write


      7. Коммутатор Multilayer Switch1

            en
            conf t

            hostname sw-of2-ML

            interface fastEthernet 0/21
            switchport mode trunk 
            exit

            interface fastEthernet 0/22
            switchport mode trunk 
            exit

            interface fastEthernet 0/23
            switchport mode trunk 
            exit

            interface fastEthernet 0/24
            switchport mode trunk 
            exit

            vtp mode client 

            interface vlan 15
            ip address 192.168.15.254 255.255.255.0
            exit

            interface vlan 25
            ip address 192.168.25.254 255.255.255.0
            exit

            interface vlan 35
            ip address 192.168.35.254 255.255.255.0
            exit

            ip routing

            exit
            write



- [x] настроить маршрутизацию между офисами.

      1. Маршрутизатор Router0

            en
            conf t

            interface gigabitEthernet 0/1
            ip address 192.168.250.1 255.255.255.252
            exit

            router rip
            version 2
            network 192.168.250.0
            network 192.168.10.0 
            network 192.168.20.0 
            network 192.168.30.0 
            exit

            exit
            write

      2. Маршрутизатор Multilayer Switch1

            en
            conf t

            interface gigabitEthernet 0/1
            switchport mode access 
            switchport access vlan 5
            exit

            interface vlan 5
            ip address 192.168.250.2 255.255.255.252
            exit

            router rip
            version 2
            network 192.168.250.0
            network 192.168.15.0 
            network 192.168.25.0 
            network 192.168.35.0 
            exit

            exit
            write

- [x] настроить агрегирование при использовании 2-х линков.

      1. Коммутатор Switch0
            
            en
            conf t

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            exit
            write

      2. Коммутатор Switch1
            
            en
            conf t

            hostname sw-of1-1

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            exit
            write

      3. Коммутатор Switch2

            en
            conf t

            interface fastEthernet 0/21
            channel-group 2 mode auto 
            exit

            interface fastEthernet 0/22
            channel-group 2 mode auto 
            exit

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            interface port-channel 2
            switchport mode trunk 
            exit

            exit
            write


      4. Коммутатор Switch3
            
            en
            conf t

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            exit
            write

      5. Коммутатор Switch4
            
            en
            conf t

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            exit
            write


      6. Коммутатор Multilayer Switch1

            en
            conf t

            interface fastEthernet 0/21
            channel-group 2 mode auto 
            exit

            interface fastEthernet 0/22
            channel-group 2 mode auto 
            exit

            interface fastEthernet 0/23
            channel-group 1 mode auto 
            exit

            interface fastEthernet 0/24
            channel-group 1 mode auto 
            exit

            interface port-channel 1
            switchport mode trunk 
            exit

            interface port-channel 2
            switchport mode trunk 
            exit

            exit
            write


- [x] настроить STP portfast на агрегировании и для линков к ПК.

      1. Коммутатор Switch0
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            spanning-tree portfast 
            exit

            interface port-channel 1
            spanning-tree portfast 
            exit

            exit
            write

      2. Коммутатор Switch1
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            spanning-tree portfast 
            exit

            interface port-channel 1
            spanning-tree portfast 
            exit

            exit
            write

      3. Коммутатор Switch2

            en
            conf t

            interface port-channel 1
            spanning-tree portfast 
            exit

            interface port-channel 2
            spanning-tree portfast 
            exit

            exit
            write


      4. Коммутатор Switch3
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            spanning-tree portfast 
            exit

            interface port-channel 1
            spanning-tree portfast 
            exit

            exit
            write

      5. Коммутатор Switch4
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            spanning-tree portfast 
            exit

            interface port-channel 1
            spanning-tree portfast 
            exit

            exit
            write


      6. Коммутатор Multilayer Switch1

            en
            conf t

            interface port-channel 1
            spanning-tree portfast 
            exit

            interface port-channel 2
            spanning-tree portfast 
            exit

            exit
            write


- [x] настроить port secutiy для линков к ПК, попробовать подключить другой ПК.

      1. Коммутатор Switch0
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            switchport port-security
            switchport port-security mac-address sticky 
            exit

            exit
            write

      2. Коммутатор Switch1
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            switchport port-security
            switchport port-security mac-address sticky 
            exit

            exit
            write

      3. Коммутатор Switch3
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            switchport port-security
            switchport port-security mac-address sticky 
            exit

            exit
            write

      4. Коммутатор Switch4
            
            en
            conf t

            interface range fastEthernet 0/1 - 3
            switchport port-security
            switchport port-security mac-address sticky 
            exit

            exit
            write
