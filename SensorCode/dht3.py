#파이썬에서 라즈베리파이의 gpio핀을 제어할 수 있도록 해주는 라이브러리
import RPi.GPIO as GPIO
import sys
import time
import Adafruit_DHT
import pymysql

sensor = Adafruit_DHT.DHT22
#.connect로 MySQL에 연결
# 호스트명, 포트, 로그인, 암호, 접속할 DB
conn= pymysql.connect(host="localhost",
                      user="pi",
                      passwd="8302",
                      db="heat_db")

#4번 출력핀
pin = 4

#컴퓨터 현재시간
start = time.time()
try :
   with conn.cursor() as cur :
    sql="insert into collect_data values(%s,%s,%s)"
    while True :
        # DHT22 센서를 이용하고, 4번 출력핀을 이용
       humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
       if humidity is not None and temperature is not None and humidity < 120 :
           print('Temp=%0.1f*C Humidity=%0.1f'%(temperature, humidity))
           time.sleep(10)
           end=time.time()
           cur.execute(sql,
                       ((end-start),
                       temperature,humidity))
           conn.commit()
except KeyboardInterrupt: # ctrl + c 눌렸을때 발생하는 interrupt
   exit()
finally : # try절의 예외 발생여부 관계없이 항상 실행되는 절
    #DB 연결을 닫는다
   conn.close()