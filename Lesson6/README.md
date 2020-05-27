# Практическое задание 6

Результирующая схема сохранена и выложена в файле **HW_lesson6_SukharevAV.pkt**.

## 1. (ВЫПОЛНЕНО) Исправить ошибку на одном из DNS-серверов. Отследить работу DNS в Cisco Packet Tracer. Каким образом происходит процесс разрешения доменного имени?

> Офис 1 уже настроен. 
> В нём есть корпоративный портал http://office1-portal.ru. Он должен работать со всех ПК в первом офисе.
> Для удобства администрирования маршрутизатор доступен по адресу r1-of1.loc, коммутатор - sw1-of1.loc.
> Для проверки доступа в интернет со всех ПК и серверов должен быть доступен сайт inet-test.ru c IP 1.2.3.4.
> В офисе 1 настроен NAT, нужно посмотреть NAT трансляции при ping внешних ресурсов, запроcах к внешнему DNS и WEB серверам.

**ВЫПОЛНЕНИЕ**

* На внешнем сервере DNS изменена A-запись для узла inet-test.ru c 11.2.3.4 на 1.2.3.4;
* Посмотреть NAT трансляции при ping внешних ресурсов, запроcах к внешнему DNS и WEB серверам.

      **router-office1#show ip nat translations**

      Pro  Inside global     Inside local       Outside local      Outside global
      udp 195.55.5.1:1060    192.168.1.253:1060 1.1.1.1:53         1.1.1.1:53
      tcp 195.55.5.1:1030    192.168.1.1:1030   1.2.3.4:80         1.2.3.4:80
      tcp 195.55.5.1:1041    192.168.1.253:1041 1.2.3.4:80         1.2.3.4:80

* По аналогии настроить офис 2) Смотрите конфигурации имеющегося оборудования, нужно сделать максимально похоже) 
Для второго офиса можно использовать сеть 192.168.2.0/24
  * Настройка маршрутизатора

        enable
        conf t
        enable password 123

        line vty 0 15
        password qwe

        hostname router-office2
        interface gigabitEthernet 0/1
        ip address 192.168.2.254 255.255.255.0
        ip nat inside
        no shutdown
        exit

        interface gigabitEthernet 0/0
        ip address 195.55.5.2 255.255.255.0
        ip nat outside 
        no shutdown
        exit

        ip route 0.0.0.0 0.0.0.0 195.55.5.254

        ip dhcp pool office2
        network 192.168.2.0 255.255.255.0
        default-router 192.168.2.254
        dns-server 192.168.2.253
        exit
        
        ip dhcp exclude 192.168.2.252
        ip dhcp exclude 192.168.2.253

        access-list 1 permit 192.168.2.0 0.0.0.255

        ip nat inside source list 1 interface gigabitEthernet 0/0 overload 
        
        exit
        write

  * Настройка коммутатора

          enable
          conf t
          enable password 123

          line vty 0 15
          password qwe

          hostname switch-office2
          interface vlan1
          ip address 192.168.2.252 255.255.255.0
          no shutdown
          exit

          ip default-gateway 192.168.2.254

          exit
          write

  * Настройка сервера DNS

          inet-test.ru        A     1.2.3.4
          office2-portal.ru   A     192.168.2.253
          r1-of2.loc          A     192.168.2.254
          sw1-of2.loc         A     192.168.2.252

  * Посмотреть NAT трансляции при ping внешних ресурсов, запроcах к внешнему DNS и WEB серверам.

        **router-office2#show ip nat translations**
        Pro  Inside global     Inside local       Outside local      Outside global
        udp 195.55.5.2:1025    192.168.2.253:1025 1.1.1.1:53         1.1.1.1:53
        udp 195.55.5.2:1026    192.168.2.253:1026 1.1.1.1:53         1.1.1.1:53
        tcp 195.55.5.2:1024    192.168.2.253:1025 1.2.3.4:80         1.2.3.4:80
        tcp 195.55.5.2:1025    192.168.2.2:1025   1.2.3.4:80         1.2.3.4:80
        tcp 195.55.5.2:1027    192.168.2.1:1027   1.2.3.4:80         1.2.3.4:80


## 2. (ВЫПОЛНЕНО) С помощью Wireshark или Cisco Packet Tracer отследить трафик, идущий по протоколу HTTP и HTTPS. В чем разница?

    При использовании HTTPS трафик завернут в TLSv2 и трафик протокола HTTP зашифрован.

## 3. С помощью Wireshark отследить трафик при работе с обычным ftp (найти любой ftp-ресурс и подключиться к нему, через браузер). Можно ли через ftp передавать данные на сервер, как предлагают некоторые хостеры?

Данные передаются в открытом виде:

    681	83.886824931	176.223.130.41	192.168.1.6	FTP	103	Response: 220 Welcome to GB test FTP service.
    698	91.313332956	192.168.1.6	176.223.130.41	FTP	81	Request: USER test_ftp
    700	91.407443020	176.223.130.41	192.168.1.6	FTP	100	Response: 331 Please specify the password.
    842	103.407323725	192.168.1.6	176.223.130.41	FTP	80	Request: PASS FtpU$3R

## 4. * Если имеется опыт работы с Linux, купить или заказать бесплатный тестовый VDS у одного из провайдеров. Проверить разные варианты туннелирования (проброс портов через ssh, socks5-прокси, поставить на VDS OpenVPN-сервер и организовать доступ в Интернет через OpenVPN).
## 5. * Попробовать отследить трафик в Wireshark, подключаясь к сервисам Google (например, youtube.com) с помощью браузера Google Chrome. Какой протокол используется для доступа к веб-сервисам? (пояснения в обсуждениях)