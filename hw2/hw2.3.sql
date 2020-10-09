CREATE DEFINER=`zhugex`@`%` PROCEDURE `pHW2_3_zhugex`(in city varchar(255),out r varchar(255))
BEGIN
declare count int;
select count(guestaddress) into count from CPS3740.Guest where guestaddress like concat('%',city,'%');
if(city is null||city='') then
set r = (select 'Please input a valid city');
else if(count=0) then
set r =(select concat('No people found for city: ',city));
else 
set r =(select group_concat(guestname) from CPS3740.Guest where guestaddress like concat('%',city,'%'));
end if;
end if;
END