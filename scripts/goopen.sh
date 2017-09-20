echo 50 > /sys/class/tacho-motor/motor1/speed_sp
echo run-forever > /sys/class/tacho-motor/motor1/command
sleep 0.5
echo stop > /sys/class/tacho-motor/motor1/command