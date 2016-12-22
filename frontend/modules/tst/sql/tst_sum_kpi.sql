SELECT p.HOSPCODE,t.cid,p.`NAME`,p.LNAME,p.BIRTH,p.SEX,p.TYPEAREA
,amp.ampurname amp,tmb.tambonname tmb,RIGHT(p.vhid,2) vill,'' addr

,(SELECT 'yes' FROM tst_kpi44 a WHERE a.cid=t.cid AND a.byear=2560) k
,(SELECT 'yes' FROM tst_kpi45 a WHERE a.cid=t.cid AND a.byear=2560) k
,(SELECT 'yes' FROM tst_kpi46 a WHERE a.cid=t.cid AND a.byear=2560) k

FROM tst_pop t 
LEFT JOIN t_person_cid p on t.cid = p.cid
LEFT JOIN campur amp on amp.ampurcodefull = LEFT(p.vhid,4)
LEFT JOIN ctambon_amp tmb ON tmb.tamboncodefull = LEFT(p.vhid,6)
WHERE FIND_IN_SET('27',t.pop_group)
