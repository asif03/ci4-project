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
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `applicant_name`, `speciality_name`, 'Failed' FROM `mid_term_excel` WHERE `final_result`= 'Not Appeared' AND `written_result`!='Absent' ORDER BY `exam_log_id` ASC;

INSERT INTO `fcps_mid_term_applicants`(`midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `reg_no`, `applicant_name`, `speciality`, `exam_result`) 
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `applicant_name`, `speciality`, `final_result` FROM `mid_all` ORDER BY `midterm_year` ASC, `midterm_session` ASC;

INSERT INTO `fcps_mid_term_applicants`(`midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `reg_no`, `applicant_name`, `speciality`, `exam_result`) 
SELECT `midterm_session`, `midterm_year`, `bmdc_reg_no`, `bmdc_reg_no_org`, `roll_no`, `pen_no`, `applicant_name`, `speciality_name`, 'Failed' FROM `mid_term_excel` WHERE `final_result`= 'Not Appeared' AND `written_result`='Absent' AND `bmdc_reg_no_org`='A94144' ORDER BY `exam_log_id` ASC;

DELIMITER $$
CREATE TRIGGER `trg_update_honorarium_information` BEFORE UPDATE ON `honorarium_information`
 FOR EACH ROW BEGIN
 		INSERT INTO `honorarium_information_log`(`applicant_id`, `bmdc_reg_no`, `training_institute_id`, `department_name`, `honorarium_slot_id`, `honorarium_year`, `previous_training_inmonth`, `honorarium_position`, `eligible_status`, `bill_sl_no`, `eligiblity_date`, `eligible_by`, `payment_status`, `payment_date`, `payment_amount`, `payment_by`, `status`, `remarks`, `ref_id`)
        VALUES (OLD.`applicant_id`, OLD.`bmdc_reg_no`, OLD.`training_institute_id`, OLD.`department_name`, OLD.`honorarium_slot_id`, OLD.`honorarium_year`, OLD.`previous_training_inmonth`, OLD.`honorarium_position`, OLD.`eligible_status`, OLD.`bill_sl_no`, OLD.`eligiblity_date`, OLD.`eligible_by`, OLD.`payment_status`, OLD.`payment_date`, OLD.`payment_amount`, OLD.`payment_by`, OLD.`status`, OLD.`remarks`, OLD.`id`);
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `trg_update_applicant_information` BEFORE UPDATE ON `applicant_information`
 FOR EACH ROW BEGIN
 		INSERT INTO `applicant_information_log`(`applicant_id`, `name`, `father_spouse_name`, `mother_name`, `date_of_birth`, `nataionality`, `religion`, `nid`, `address`, `mobile`, `telephone`, `email`, `permanent_address`, `mbbs_bds_year`, `mbbs_institute_id`, `mbbs_bds_institute`, `bmdc_reg_type`, `bmdc_reg_no`, `bmdc_validity`, `speciality_id`, `fcps_speciallity`, `fcps_roll`, `fcps_year`, `fcps_month`, `fcps_reg_no`, `pen_no`, `continuing`, `continuing_start_date`, `continuing_end_date`, `continuing_fcps_traning`, `mid_term_session`, `mid_term_year`, `mid_term_result`, `mid_term_roll`, `account_name`, `bank_id`, `bank_name`, `branch_name`, `account_no`, `routing_number`, `undertaking_confirmation`, `eligible_status`, `eligible_by`, `eligiblity_date`, `reject_reason`, `rejected_by`, `reject_date`, `status`, `gander`, `action_type`)
        VALUES (OLD.`applicant_id`, OLD.`name`, OLD.`father_spouse_name`, OLD.`mother_name`, OLD.`date_of_birth`, OLD.`nataionality`, OLD.`religion`, OLD.`nid`, OLD.`address`, OLD.`mobile`, OLD.`telephone`, OLD.`email`, OLD.`permanent_address`, OLD.`mbbs_bds_year`, OLD.`mbbs_institute_id`, OLD.`mbbs_bds_institute`, OLD.`bmdc_reg_type`, OLD.`bmdc_reg_no`, OLD.`bmdc_validity`, OLD.`speciality_id`, OLD.`fcps_speciallity`, OLD.`fcps_roll`, OLD.`fcps_year`, OLD.`fcps_month`, OLD.`fcps_reg_no`, OLD.`pen_no`, OLD.`continuing`, OLD.`continuing_start_date`, OLD.`continuing_end_date`, OLD.`continuing_fcps_traning`, OLD.`mid_term_session`, OLD.`mid_term_year`, OLD.`mid_term_result`, OLD.`mid_term_roll`, OLD.`account_name`, OLD.`bank_id`, OLD.`bank_name`, OLD.`branch_name`, OLD.`account_no`, OLD.`routing_number`, OLD.`undertaking_confirmation`, OLD.`eligible_status`, OLD.`eligible_by`, OLD.`eligiblity_date`, OLD.`reject_reason`, OLD.`rejected_by`, OLD.`reject_date`, OLD.`status`, OLD.`gander`, 'UPDATE');
END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `trg_delete_applicant_information` BEFORE DELETE ON `applicant_information`
 FOR EACH ROW BEGIN
 		INSERT INTO `applicant_information_log`(`applicant_id`, `name`, `father_spouse_name`, `mother_name`, `date_of_birth`, `nataionality`, `religion`, `nid`, `address`, `mobile`, `telephone`, `email`, `permanent_address`, `mbbs_bds_year`, `mbbs_institute_id`, `mbbs_bds_institute`, `bmdc_reg_type`, `bmdc_reg_no`, `bmdc_validity`, `speciality_id`, `fcps_speciallity`, `fcps_roll`, `fcps_year`, `fcps_month`, `fcps_reg_no`, `pen_no`, `continuing`, `continuing_start_date`, `continuing_end_date`, `continuing_fcps_traning`, `mid_term_session`, `mid_term_year`, `mid_term_result`, `mid_term_roll`, `account_name`, `bank_id`, `bank_name`, `branch_name`, `account_no`, `routing_number`, `undertaking_confirmation`, `eligible_status`, `eligible_by`, `eligiblity_date`, `reject_reason`, `rejected_by`, `reject_date`, `status`, `gander`, `action_type`)
        VALUES (OLD.`applicant_id`, OLD.`name`, OLD.`father_spouse_name`, OLD.`mother_name`, OLD.`date_of_birth`, OLD.`nataionality`, OLD.`religion`, OLD.`nid`, OLD.`address`, OLD.`mobile`, OLD.`telephone`, OLD.`email`, OLD.`permanent_address`, OLD.`mbbs_bds_year`, OLD.`mbbs_institute_id`, OLD.`mbbs_bds_institute`, OLD.`bmdc_reg_type`, OLD.`bmdc_reg_no`, OLD.`bmdc_validity`, OLD.`speciality_id`, OLD.`fcps_speciallity`, OLD.`fcps_roll`, OLD.`fcps_year`, OLD.`fcps_month`, OLD.`fcps_reg_no`, OLD.`pen_no`, OLD.`continuing`, OLD.`continuing_start_date`, OLD.`continuing_end_date`, OLD.`continuing_fcps_traning`, OLD.`mid_term_session`, OLD.`mid_term_year`, OLD.`mid_term_result`, OLD.`mid_term_roll`, OLD.`account_name`, OLD.`bank_id`, OLD.`bank_name`, OLD.`branch_name`, OLD.`account_no`, OLD.`routing_number`, OLD.`undertaking_confirmation`, OLD.`eligible_status`, OLD.`eligible_by`, OLD.`eligiblity_date`, OLD.`reject_reason`, OLD.`rejected_by`, OLD.`reject_date`, OLD.`status`, OLD.`gander`, 'DELETE');
END
$$
DELIMITER ;