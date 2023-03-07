ALTER TABLE users
ADD COLUMN card_token varchar(255),
ADD COLUMN cpf varchar(255),
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
    course_id int,
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
VALUES (NULL, 'asaas', 'BRL', 'Asaas', '', '{\r\n \"token_production\": \"\",\r\n \"token_sandbox\": \"\",\r\n \"split_percent\": \"0\",\r\n \"carteira_id\": \"\"\r\n}', 'Payment_model', '1', '1', '0', '', '1673264610');