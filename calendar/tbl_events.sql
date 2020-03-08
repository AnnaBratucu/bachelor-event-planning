

CREATE TABLE IF NOT EXISTS `tbl_events` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
)

ALTER TABLE `tbl_events`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `tbl_events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
