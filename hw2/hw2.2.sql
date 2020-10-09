CREATE DEFINER=`zhugex`@`%` PROCEDURE `pHW2_2_zhugex`(in name varchar(255))
BEGIN
declare count int default 0;
select count(hotelno) into count from CPS3740.Hotel where hotelname = name;
if(name is null||name='') then 
select 'Please input a valid hotel name' as message;
else if (count=0) then
select 'Please input a hotelname in the database ' as message;
else
select distinct type,count(type) from CPS3740.Hotel h,CPS3740.Room r, 
CPS3740.Booking b where h.hotelno=r.hotelno and (r.roomno=b.roomno and r.hotelno=b.hotelno)
and h.hotelname=name group by type;
end if;
end if;
END