CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `rfid` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `img` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
