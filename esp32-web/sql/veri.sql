CREATE TABLE `veri` (
  `ID` int(11) NOT NULL,
  `temp` varchar(30) DEFAULT NULL,
  `hum` varchar(30) DEFAULT NULL,
  `rfCode` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `veri`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `veri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1693;
COMMIT;


