# Практическое задание 2

## 1. (ВЫПОЛНЕНО) Исправить проблемы с линками на всех хостах.

**ВЫПОЛНЕНИЕ:**

Результирующая схема сохранена и выложена в файле **HW_lesson2_SukharevAV.pkt**.

* Восстановление линка (Switch1 10.0.1.101) - (PC-PT 10.0.1.2)

    - на (Switch1 10.0.1.101) включен порт интерфейса **FastEthernet0/1** (изменена настройка **port status** на **on**)

* Восстановление линка (Switch2 10.0.1.102) - (PC-PT 10.0.1.4)

    - на (Switch2 10.0.1.102) изменена настройка **duplex** на **auto** интерфейса **FastEthernet0/1**;

## 2. (ВЫПОЛНЕНО) Настроить сетевые интерфейсы на всех хостах и менеджмент на свитчах, используя только консольный кабель.

**ВЫПОЛНЕНИЕ:**

Результирующая схема сохранена и выложена в файле **HW_lesson2_SukharevAV.pkt**.

* Настройка хостов выполнена (описывать процедуру не стал);

* Настройка (Switch0 10.0.1.100) был настроен.

        switch0>ping 10.0.1.1

        Type escape sequence to abort.
        Sending 5, 100-byte ICMP Echos to 10.0.1.1, timeout is 2 seconds:
        !!!!!
        Success rate is 100 percent (5/5), round-trip min/avg/max = 0/0/0 ms

* Настройка (Switch1 10.0.1.101)

        Switch(config-if)#exit
        Switch(config)#int vlan1
        Switch(config-if)#ip address 10.0.1.101 255.255.255.0
        Switch(config-if)#no shutdown
        Switch(config-if)#do write
        vSwitch(config-if)#do ping 10.0.1.1

        Type escape sequence to abort.
        Sending 5, 100-byte ICMP Echos to 10.0.1.1, timeout is 2 seconds:
        !!!!!
        Success rate is 100 percent (5/5), round-trip min/avg/max = 0/0/0 ms

**Примечание:** Консоль коммутатора находилась в привелегированном режиме, а также был осуществлен переход в режим конфигурирования интерфейса FastEthernet0/1. На всякий случай сохранил конфигурацию;

* Настройка (Switch2 10.0.1.102)

        Switch#en
        Switch#conf t
        Switch(config)#int vlan1
        Switch(config-if)#ip address 10.0.1.102 255.255.255.0
        Switch(config-if)#no shutdown
        Switch(config-if)#do write
        Switch(config-if)#do ping 10.0.1.1

        Type escape sequence to abort.
        Sending 5, 100-byte ICMP Echos to 10.0.1.1, timeout is 2 seconds:
        !!!!!
        Success rate is 80 percent (4/5), round-trip min/avg/max = 0/0/1 ms

**Примечание:** На всякий случай сохранил конфигурацию;

* Настройка (Switch3 10.0.1.103)

        Switch#en
        Switch#conf t
        Switch(config)#int vlan1
        Switch(config-if)#ip address 10.0.1.103 255.255.255.0
        Switch(config-if)#no shutdown

        Switch(config-if)#
        Switch(config-if)#do write
        Switch(config-if)#do ping 10.0.1.1

        Type escape sequence to abort.
        Sending 5, 100-byte ICMP Echos to 10.0.1.1, timeout is 2 seconds:
        !!!!!
        Success rate is 80 percent (4/5), round-trip min/avg/max = 0/0/1 ms

## 3. (ВЫПОЛНЕНО) Обвести синим цветом все широковещательные домены, а красным все домены коллизий. (см. картинку в методичке)

* Результирующая схема - scheme1_sukharevav.png