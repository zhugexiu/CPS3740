CREATE DEFINER=`zhugex`@`%` FUNCTION `fHW2_4_zhugex`(city varchar(255)) RETURNS varchar(255) CHARSET latin1
BEGIN
declare count int;
select count(guestaddress) into count from CPS3740.Guest where guestaddress like concat('%',city,'%');
if(city is null||city='') then
return ('Please input a valid city.');
else if (count>0) then
RETURN (select group_concat(guestname) from CPS3740.Guest where guestaddress like concat('%',city,'%'));
else
return ('No result found.');
end if;
end if;
END