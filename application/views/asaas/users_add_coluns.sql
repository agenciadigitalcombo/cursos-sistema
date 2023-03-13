ALTER TABLE users
ADD COLUMN card_token varchar(255),
ADD COLUMN cpf varchar(255),
ADD COLUMN phone varchar(255),
ADD COLUMN customer_id varchar(255);

CREATE TABLE invoices (
    id int NOT NULL AUTO_INCREMENT,
    users_id int,
    invoice_id varchar(255),
    invoice_ref varchar(255),
    invoice_url varchar(255),
    invoice_code varchar(255),
    invoice_status varchar(255),
    type_curso varchar(255),
    payment_type varchar(255),
    course_id varchar(255),
    amount float,
    date_added int,
    last_modified int,
    admin_revenue varchar(255),
    instructor_revenue varchar(255),
    tax float,
    instructor_payment_status int,
    transaction_id varchar(255),
    session_id varchar(255),
    coupon varchar(255),
    bundle_creator_id int,
    bundle_id int,
    PRIMARY KEY (id)
);

INSERT INTO `payment_gateways` (`id`, `identifier`, `currency`, `title`, `description`, `keys`, `model_name`, `enabled_test_mode`, `status`, `is_addon`, `created_at`, `updated_at`) 
VALUES (NULL, 'asaas', 'BRL', 'Asaas', '', '{\r\n \"token_production\": \"$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwMjQ4MDM6OiRhYWNoX2ZjOTY2ZmRjLWJiZGYtNGVjYi1iNzk2LWY2NjRiOTk4OTU5MA==\",\r\n \"token_sandbox\": \"$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwMjQ4MDM6OiRhYWNoX2ZjOTY2ZmRjLWJiZGYtNGVjYi1iNzk2LWY2NjRiOTk4OTU5MA==\",\r\n \"split_percent_1\": \"3,5%\",\r\n \"carteira_id_1\": \"1854fa4d-da97-4ab0-8a51-152ec2c17833\", \r\n \"split_percent_2\": \"3,5%\",\r\n \"carteira_id_2\": \"1854fa4d-da97-4ab0-8a51-152ec2c17833\",\r\n \"split_percent_3\": \"3,5%\",\r\n \"carteira_id_3\": \"1854fa4d-da97-4ab0-8a51-152ec2c17833\"\r\n}', 'Payment_model', '1', '1', '0', '', '1678214464');