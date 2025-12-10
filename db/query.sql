INSERT INTO `fcps_mid_term_applicants`(`midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `reg_no`, `applicant_name`, `speciality`, `exam_result`) 
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `name`, `speciality_name`, `final_result` FROM `mid-term-excel` ORDER BY `midterm_year` ASC, `midterm_session` ASC;

INSERT INTO `mid_term_excel` (`midterm_session`, `midterm_year`, `exam_log_id`, `bmdc_reg_no_org`, `name_old`, `roll_no`, `pen_no`, `eligibility_status`, `speciality_name`, `email`, `written_result`, `final_result`, `is_fifteen_grade`, `is_ten_grade`)
SELECT 'July', 2025, `COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`, `COL 9`, `COL 10`, `COL 11`, `COL 12` FROM `mid_july_25` ORDER BY `COL 1` ASC;

UPDATE `fcps_mid_term_applicants` t1
JOIN `fcps_mid_term_applicants` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.bmdc_reg_no = SUBSTRING(t2.`bmdc_reg_no_org`, 2)
WHERE t1.`bmdc_reg_no_org` LIKE 'A%';

UPDATE `fcps_mid_term_applicants` t1
JOIN `fcps_mid_term_applicants` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.bmdc_reg_no = SUBSTRING(t2.`bmdc_reg_no_org`, 2)
WHERE t1.`bmdc_reg_no` IS NULL;


UPDATE `mid_term_excel` t1
JOIN `mid_term_excel` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.bmdc_reg_no = SUBSTRING(t2.`bmdc_reg_no_org`, 2)
WHERE t1.`bmdc_reg_no_org` LIKE 'A%';

UPDATE `mid_term_excel` t1
JOIN `mid_term_excel` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.bmdc_reg_no = t2.`bmdc_reg_no_org`
WHERE t1.`bmdc_reg_no` IS NULL;

UPDATE `mid_term_excel` t1
JOIN `mid_term_excel` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.`name` = LEFT(t1.`name_old`, CHAR_LENGTH(t1.`name_old`) - 12)
WHERE t1.`name_old` IS NOT NULL;


UPDATE `mid_term_excel` t1
JOIN `mid_term_excel` t2 ON t1.bmdc_reg_no_org = t2.bmdc_reg_no_org
SET t1.`mobile` = SUBSTR(t1.`name_old`, -12, 12)
WHERE t1.`name_old` IS NOT NULL;


SELECT *
FROM (
    SELECT 
        `midterm_session`, 
        `midterm_year`, 
        `bmdc_reg_no`, 
        `exam_result`, 
        DENSE_RANK() OVER (
            PARTITION BY `bmdc_reg_no` 
            ORDER BY `midterm_year` DESC, `midterm_session` DESC
        ) AS ranking
    FROM fcps_mid_term_applicants
) AS ranked
WHERE ranked.ranking = 1;


INSERT INTO `fcps_mid_term_applicants`(`midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `reg_no`, `applicant_name`, `speciality`, `exam_result`) 
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `applicant_name`, `speciality_name`, `final_result` FROM `mid_term_excel` WHERE `final_result`!= 'Not Appeared' ORDER BY `exam_log_id` ASC;

INSERT INTO `fcps_mid_term_applicants`(`midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `reg_no`, `applicant_name`, `speciality`, `exam_result`) 
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `applicant_name`, `speciality`, `final_result` FROM `mid_all` ORDER BY `midterm_year` ASC, `midterm_session` ASC;

DELIMITER $$
CREATE TRIGGER `trg_update_honorarium_information` BEFORE UPDATE ON `honorarium_information`
 FOR EACH ROW BEGIN
 		INSERT INTO `honorarium_information_log`(`applicant_id`, `bmdc_reg_no`, `training_institute_id`, `department_name`, `honorarium_slot_id`, `honorarium_year`, `previous_training_inmonth`, `honorarium_position`, `eligible_status`, `bill_sl_no`, `eligiblity_date`, `eligible_by`, `payment_status`, `payment_date`, `payment_amount`, `payment_by`, `status`, `remarks`, `ref_id`)
        VALUES (OLD.`applicant_id`, OLD.`bmdc_reg_no`, OLD.`training_institute_id`, OLD.`department_name`, OLD.`honorarium_slot_id`, OLD.`honorarium_year`, OLD.`previous_training_inmonth`, OLD.`honorarium_position`, OLD.`eligible_status`, OLD.`bill_sl_no`, OLD.`eligiblity_date`, OLD.`eligible_by`, OLD.`payment_status`, OLD.`payment_date`, OLD.`payment_amount`, OLD.`payment_by`, OLD.`status`, OLD.`remarks`, OLD.`id`);
END
$$
DELIMITER ;