CREATE TABLE if not exists `pa`.`papps_osn_raports`(
    `id` int(11) not null auto_increment primary key, 
    `z` int(11) not null, 
    `mm` decimal(8,3) not null, 
    `is_uses`  tinyint(1) not null default `0`, 
    index `Z`(`z`),
    index `MM`(`mm`)
    );
