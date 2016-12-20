
SET	@b_year:=(SELECT yearprocess FROM sys_config LIMIT 1);
SET	@start_d:=concat(@b_year-1,'1001');
SET @end_d:=concat(@b_year,'0930');

TRUNCATE tst_pop;
REPLACE INTO tst_pop (
SELECT t.CID,t.BIRTH,t.SEX
,TIMESTAMPDIFF(MONTH,t.BIRTH,@start_d)/12
,TIMESTAMPDIFF(MONTH,t.BIRTH,@end_d)/12
,'' FROM t_person_cid t WHERE t.TYPEAREA in (1,3)
AND t.DISCHARGE =9
);

#1
UPDATE tst_pop t,tmp_labor a set t.pop_group = CONCAT(t.pop_group,',',1)
WHERE (a.cid = t.cid) AND (a.BDATE BETWEEN @start_d AND @end_d);

#2
UPDATE tst_pop t,tmp_labor a set t.pop_group = CONCAT(t.pop_group,',',2)
WHERE (a.cid = t.cid) AND a.BTYPE <> '6' AND  (a.BDATE BETWEEN @start_d AND @end_d);

#3
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',3)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 5 YEAR) AND DATE_SUB(@end_d,INTERVAL 5 YEAR);

#4
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',4)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 4 MONTH) AND DATE_SUB(@end_d,INTERVAL 4 MONTH);

#5
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',5)
WHERE  t.birth > DATE_SUB(@start_d,INTERVAL 5 YEAR);

#6
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',6)
WHERE  t.birth > DATE_SUB(@start_d,INTERVAL 7 YEAR);

#7
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',7)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 1 YEAR) AND DATE_SUB(@end_d,INTERVAL 1 YEAR);

#8
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',8)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 2 YEAR) AND DATE_SUB(@end_d,INTERVAL 2 YEAR);

#9
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',9)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 3 YEAR) AND DATE_SUB(@end_d,INTERVAL 3 YEAR);

#10
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',10)
WHERE  t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 5 YEAR) AND DATE_SUB(@end_d,INTERVAL 5 YEAR);

#11
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',11)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 12 YEAR) AND DATE_SUB(@end_d,INTERVAL 6 YEAR);

#12
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',12)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 7 YEAR) AND DATE_SUB(@end_d,INTERVAL 7 YEAR);

#13
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',13)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 8 YEAR) AND DATE_SUB(@end_d,INTERVAL 8 YEAR);

#14
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',14)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 12 YEAR) AND DATE_SUB(@end_d,INTERVAL 12 YEAR);

#15
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',15)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 12 YEAR) AND DATE_SUB(@end_d,INTERVAL 6 YEAR);

#16
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',16)
WHERE   t.birth >  DATE_SUB(@start_d,INTERVAL 12 YEAR);

#17
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',17)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 18 YEAR) AND DATE_SUB(@end_d,INTERVAL 18 YEAR);

#18
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',18)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 19 YEAR) AND DATE_SUB(@end_d,INTERVAL 15 YEAR)
AND t.sex=2;

#19
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',19)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 20 YEAR) AND DATE_SUB(@end_d,INTERVAL 15 YEAR)
AND t.sex=2;

#20
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',20)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 60 YEAR) AND DATE_SUB(@end_d,INTERVAL 30 YEAR)
AND t.sex=2;

#21
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',21)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 70 YEAR) AND DATE_SUB(@end_d,INTERVAL 30 YEAR)
AND t.sex=2;

#22
UPDATE tst_pop t SET t.pop_group = CONCAT(t.pop_group,',',22)
WHERE   t.birth BETWEEN  DATE_SUB(@start_d,INTERVAL 120 YEAR) AND DATE_SUB(@end_d,INTERVAL 35 YEAR);





