CREATE DEFINER=`zhugex`@`%` FUNCTION `fHW2_1_zhugex`(n varchar(12),gender char(10)) RETURNS varchar(255) CHARSET latin1
BEGIN
declare countf int;
declare countm int;
select count(branchNo) into countf from CPS3740.Staff where sex = 'F' and branchNo =n;
select count(branchNo) into countm from CPS3740.Staff where sex = 'M' and branchNo =n;
if(gender = binary 'F') then
if(countf>0) then
return (select concat('Female max salary at ',branchno,' is ', salary) from CPS3740.Staff
where salary in (select max(salary) from CPS3740.Staff where branchNo = n and sex = 'F'));
else
return ('NULL');
end if;
else if(gender = binary 'M') then
if(countm>0) then 
return (select concat('Male min salary at ',branchno,' is ', salary) from CPS3740.Staff 
where salary in (select min(salary) from CPS3740.Staff where branchNo = n and sex ='M'));
else
return ('NULL');
end if;
else
return (select concat('No such gender: ',gender));
end if;
end if;

end