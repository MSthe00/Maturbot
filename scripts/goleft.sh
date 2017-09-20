echo 200 > /sys/class/tacho-motor/motor0/speed_sp
echo run-forever > /sys/class/tacho-motor/motor0/command
sleep 0.5
echo stop > /sys/class/tacho-motor/motor0/command