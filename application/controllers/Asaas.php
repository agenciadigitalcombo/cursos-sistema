<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asaas extends CI_Controller
{

    public $split = [];
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->library('AsaasApi');


        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function addSplit($carteira, $percent)
    {

        if (strlen($carteira) < 30) {
            return null;
        }
        $percent = (float) str_replace(['%', ' ', ','], ['', '', '.'], $percent);
        $this->split[] = [
            "walletId" => $carteira,
            "percentualValue" => $percent
        ];
    }

    function buy()
    {

        $user_id = $this->session->userdata('user_id');
        $payment_details = [];

        $payment_details['total'] = 0;
        $payment_details['type_curso'] = $_GET['type_curso'] ?? 'single';
        $payment_details['user_id'] = $user_id;
        $payment_details['group_name'] = null;
        $payment_details['ids'] = null;

        $cart = [];

        if ($payment_details['type_curso'] == 'single') {
            foreach ($_SESSION['cart_items'] as $ID) {
                $select = $this->db->get_where('course', array('id' => $ID));
                $data =  (object) $select->result_array()[0];
                $cart[] = (object)[
                    "id" => $ID,
                    "price" => $data->price,
                    "title" => $data->title,
                    "thumbnail" => null,
                ];
            }
            $payment_details['total'] = $_SESSION['total_price_of_checking_out'];
        }

        if ($payment_details['type_curso'] == 'group') {
            $groupId = $_GET['groupId'];

            $select = $this->db->get_where('course_bundle', array('id' => $groupId));
            $data =  (object) $select->result_array()[0];
            $creator_id = $data->user_id;
            $payment_details['total'] = $data->price;
            $cursos = json_decode($data->course_ids);

            $payment_details['group_name'] = $data->title;
            $payment_details['ids'] = $groupId;
            foreach ($cursos as $ID) {
                $select = $this->db->get_where('course', array('id' => $ID));
                $data =  (object) $select->result_array()[0];
                $cart[] = (object)[
                    "id" => $ID,
                    "price" => $data->price,
                    "title" => $data->title,
                    "thumbnail" => null,
                ];
            }
        }

        $payment_details['cart'] = $cart;


        $query = $this->db->get_where('users', array('id' => $user_id));
        $data_user_logged = (object) $query->result_array()[0];

        $query = $this->db->get_where('payment_gateways', array('identifier' => 'asaas'));
        $data_asass = (object) $query->result_array()[0];
        $asass_keys = json_decode($data_asass->keys, false);

        $sandBox = (bool) $data_asass->enabled_test_mode;
        $token = null;
        if ($sandBox) {
            $token = $asass_keys->token_sandbox;
        } else {
            $token = $asass_keys->token_production;
        }



        $this->addSplit($asass_keys->carteira_id_1, $asass_keys->split_percent_1);
        $this->addSplit($asass_keys->carteira_id_2, $asass_keys->split_percent_2);
        $this->addSplit($asass_keys->carteira_id_3, $asass_keys->split_percent_3);

        $cpf = $data_user_logged->cpf;
        $external_id = $data_user_logged->external_id;
        $customer_id = $data_user_logged->customer_id;



        $this->asaasapi->sandbox = $sandBox;
        $this->asaasapi->set_api_key($token);


        $user_name = $data_user_logged->first_name;
        $user_email = $data_user_logged->email;
        $user_phone = $data_user_logged->phone;
        $user_cpf = $data_user_logged->cpf;
        $user_cpf = preg_replace("/\D/i", "", $user_cpf);



        if (!$customer_id) {

            $response_asaas = $this->asaasapi->createCustomerID($user_name, $user_cpf);

            $external_id = "user_" . uniqid();
            $customer_id = $response_asaas["id"]; // response asa

            $this->db->where('id', $user_id);
            $this->db->update('users', [
                "external_id" => $external_id,
                "customer_id" => $customer_id,
            ]);
        }

        $response_asas = [];
        $error = null;

        if (!empty($_POST)) {

            $res_asaas_transation = [];
            $external_id = "course_" . uniqid();
            $payment_amount = $_POST['total'];
            $telefone = $user_phone;

            $numero = $_POST['numero'];
            $vencimento = $_POST['vencimento'];
            $ccv = $_POST['ccv'];
            $cep = $_POST['CEP'];
            $numero_casa = $_POST['numero_casa'];
            $tipo_pagamento = $_POST['tipo_pagamento'];
            $seven_day = date('Y-m-d', strtotime('+7 days', strtotime(date('Y-m-d'))));
            $due_date = $tipo_pagamento == "CREDIT_CARD" ? date('Y-m-d') : $seven_day;



            if ($payment_details['type_curso'] == 'single') {
                $res_asaas_transation = $this->asaasapi->single(
                    $external_id,
                    $tipo_pagamento,
                    $customer_id,
                    $payment_amount,
                    $user_name,
                    $numero,
                    $vencimento,
                    $ccv,
                    $user_name,
                    $user_cpf,
                    $telefone,
                    $user_email,
                    $cep,
                    $numero_casa,
                    '',
                    $due_date,
                    $this->split
                );
            } else {
                $res_asaas_transation = $this->asaasapi->signature(
                    $external_id,
                    $tipo_pagamento,
                    $customer_id,
                    $payment_amount,
                    $user_name,
                    $numero,
                    $vencimento,
                    $ccv,
                    $user_name,
                    $user_cpf,
                    $telefone,
                    $user_email,
                    $cep,
                    $numero_casa,
                    '',
                    $due_date,
                    $this->split
                );
            }

            $error = $res_asaas_transation["errors"][0]["description"] ?? false;

            $url_assas  = null;
            $code_assas = null;

            if (!$error) {

                $payment_id = $res_asaas_transation["id"];
                $url_assas =  $res_asaas_transation["invoiceUrl"];
                $code_assas = '';

                if ($_POST['tipo_pagamento'] == 'PIX') {
                    $code_assas = $this->asaasapi->getCodePix($payment_id);
                    $code_assas = $code_assas["payload"];
                }

                if ($_POST['tipo_pagamento'] == 'BOLETO') {
                    $code_assas = $this->asaasapi->getBarcodeBoleto($payment_id);
                    $code_assas = $code_assas["barCode"];
                    $url_assas = $res_asaas_transation["bankSlipUrl"];
                }

                $_SESSION["invoice"] = [
                    "tipo" => $tipo_pagamento,
                    "code" => $code_assas,
                    "url" => $url_assas,
                ];

                // salva invoice

                $this->db->insert('invoices', [
                    "users_id" => $user_id,
                    "invoice_id" => $payment_id,
                    "invoice_ref" => $external_id,
                    "invoice_url" => $url_assas,
                    "invoice_code" => $code_assas,
                    "invoice_status" => $res_asaas_transation["status"],
                    "type_curso" => $payment_details['type_curso'],
                    "payment_type" => $res_asaas_transation["billingType"],
                    "course_id" => $cart[0]['id'],
                    "amount" => $payment_amount,
                    "date_added" => time(),
                    "last_modified" => time(),
                    "admin_revenue" => null,
                    "instructor_revenue" => null,
                    "tax" => 0,
                    "instructor_payment_status" => null,
                    "transaction_id" => $payment_id,
                    "session_id" => '',
                    "coupon" => $_SESSION['applied_coupon'] ?? '',
                    "bundle_creator_id" => $creator_id ?? 1,
                    "bundle_id" => $groupId,
                ]);

                $this->db->insert('invoices', [
                    "users_id" => $user_id ?? '',
                    "invoice_id" => $payment_id ?? '',
                    "invoice_ref" => $external_id ?? '',
                    "invoice_url" => $url_assas ?? '',
                    "invoice_code" => $code_assas ?? '',
                    "invoice_status" => $res_asaas_transation["status"] ?? '',
                    "type_curso" => $payment_details['type_curso'] ?? '',
                    "payment_type" => $res_asaas_transation["billingType"] ?? '',
                    "course_id" => $cart[0]->id ?? '',
                    "amount" => $payment_amount ?? '',
                    "date_added" => time(),
                    "last_modified" => time(),
                    "admin_revenue" => null,
                    "instructor_revenue" => null,
                    "tax" => 0,
                    "instructor_payment_status" => null,
                    "transaction_id" => $payment_id ?? '',
                    "session_id" => '',
                    "coupon" => $_SESSION['applied_coupon'] ?? '',
                    "bundle_creator_id" => $creator_id ?? 1,
                    "bundle_id" => $groupId ?? '',
                ]);

                redirect(site_url('asaas/thank_you'), 'refresh');
            }
        }

        $payment_details['response_asas'] = $response_asas;
        $payment_details['error'] = $error;

        $this->load->view('asaas/checkout', $payment_details);
    }

    function webhook()
    {

        header("Access-Control-Allow-Headers: Authorization, Content-Type");
        header("Access-Control-Allow-Origin: *");
        header('content-type: application/json; charset=utf-8');
        date_default_timezone_set('America/Sao_Paulo');

        header("HTTP/1.1 200 OK");

        $getJson = file_get_contents('php://input');
        $getJson = (array) json_decode($getJson, true);
        $request = $_REQUEST;
        $payload = array_merge($getJson, $request);

        $data = [
            "event" => $payload['event'] ?? "",
            "reference_key" => $payload['payment']['externalReference'] ?? "",
            "dueDate" => $payload['payment']['dueDate'] ?? "",
            "status" => $payload['payment']['status'] ?? "",
            "tipo" => $payload['payment']['billingType'] ?? "",
            "url" => $payload['payment']['billingType'] = 'BOLETO' ? $payload['payment']['bankSlipUrl'] : $payload['payment']['invoiceUrl'] ?? "",
            "code" => '',
            "ID" => $payload['payment']['id'] ?? "",
            "value" => $payload['payment']['value'] ?? "",
        ];

        echo json_encode([
            "next" => true,
            "message" => "WebHook recebido com sucesso",
            "payload" => $data
        ]);
    }

    function thank_you()
    {

        $this->load->view('asaas/thank_you', [
            "data_assas" => (object) [
                "tipo_pagamento" =>  $_SESSION["invoice"]['tipo'],
                "code" =>  $_SESSION["invoice"]['code'],
                "url" =>  $_SESSION["invoice"]['url'],
            ]
        ]);
    }

    function success_course_payment($payment_method = "")
    {
        //STARTED payment model and functions are dynamic here
        $user_id = $this->session->userdata('user_id');
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
        $model_name = strtolower($payment_gateway['model_name']);
        if ($payment_gateway['is_addon'] == 1 && $model_name != null) {
            $this->load->model('addons/' . strtolower($payment_gateway['model_name']));
        }
        if ($model_name != null) {
            $payment_check_function = 'check_' . $payment_method . '_payment';
            $response = $this->$model_name->$payment_check_function($payment_method);
        } else {
            $response = true;
        }
        //ENDED payment model and functions are dynamic here

        if ($response === true) {
            $this->crud_model->enrol_student($user_id);
            $this->crud_model->course_purchase($user_id, $payment_method, $payment_details['total_payable_amount']);
            $this->email_model->course_purchase_notification($user_id, $payment_method, $payment_details['total_payable_amount']);

            $this->session->set_userdata('cart_items', array());
            $this->session->set_userdata('payment_details', '');
            $this->session->set_userdata('applied_coupon', '');

            $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
            redirect('home/my_courses', 'refresh');
        } else {
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
            redirect('home/shopping_cart', 'refresh');
        }
    }
}
