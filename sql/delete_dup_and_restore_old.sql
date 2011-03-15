DROP PROCEDURE IF EXISTS delete_dup_message;
DELETE FROM message WHERE service_messageid IS NULL AND message IS NULL;
DELIMITER //
CREATE PROCEDURE delete_dup_message()
BEGIN
  DECLARE eor INT DEFAULT 0;
  DECLARE idx INT DEFAULT 0;
  DECLARE status_id VARCHAR(255);
  DECLARE message_id BIGINT(20) UNSIGNED;
  DECLARE dup_id_cur CURSOR FOR SELECT service_messageid FROM message GROUP BY service_messageid;
  DECLARE message_cur CURSOR FOR SELECT id FROM message WHERE service_messageid = status_id ORDER BY id ASC;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET eor = 1;

  OPEN dup_id_cur;
  dup_id_cur: LOOP
    FETCH dup_id_cur INTO status_id;
    IF eor THEN
      LEAVE dup_id_cur;
    END IF;
    OPEN message_cur;
    SET idx = 0;
    message_cur: LOOP
      FETCH message_cur INTO message_id;
      IF eor THEN
        LEAVE message_cur;
      END IF;
      IF idx > 0 THEN
        DELETE FROM message WHERE id = message_id;
      END IF;
      SET idx = idx + 1;
    END LOOP;
    CLOSE message_cur;
    SET eor = 0;
  END LOOP;
  CLOSE dup_id_cur;
END;
//
CALL delete_dup_message();
DROP PROCEDURE delete_dup_message;
ALTER TABLE message ADD UNIQUE(service_messageid);
UPDATE message SET message_type = 1 WHERE message_type = 3 AND message NOT LIKE '%RT%' AND message_date < '2011-03-12 00:00:00';
