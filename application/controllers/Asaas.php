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

                $course_ids = json_encode($_SESSION['cart_items'] ?? []);

                $this->db->insert('invoices', [
                    "users_id" => $user_id ?? '',
                    "invoice_id" => $payment_id ?? '',
                    "invoice_ref" => $external_id ?? '',
                    "invoice_url" => $url_assas ?? '',
                    "invoice_code" => $code_assas ?? '',
                    "invoice_status" => $res_asaas_transation["status"] ?? '',
                    "type_curso" => $payment_details['type_curso'] ?? '',
                    "payment_type" => $res_asaas_transation["billingType"] ?? '',
                    "course_id" =>  $course_ids,
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

                if ($res_asaas_transation["billingType"] == "CREDIT_CARD") {
                    $this->success_course_payment($external_id);
                    $this->db->where('id', $user_id);
                    $this->db->update('users', [
                        "card_token" => $res_asaas_transation['creditCard']['creditCardToken'] ?? '',                        
                    ]);
                }

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

        if (in_array($data["status"], ["CONFIRMED", "RECEIVED"])) {
            $this->success_course_payment($data["reference_key"]);
        }

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

    function success_course_payment($external_id = null)
    {
        $get_ref = $_GET["ref"] ?? null;
        $ref = $external_id ? $external_id : $get_ref;

        $query = $this->db->get_where('invoices', array('invoice_ref' => $ref));
        $data_invoice = (object) $query->result_array()[0];

        $enrol = [];
        $users_id = $data_invoice->users_id;

        if ($data_invoice->type_curso == 'group') {
            $query = $this->db->get_where('course_bundle', array('id' => $data_invoice->bundle_id));
            $data_group = (object) $query->result_array()[0];            
            $this->db->insert('bundle_payment', [
                "user_id" => $users_id,
                "bundle_creator_id" => $data_invoice->bundle_creator_id,
                "bundle_id" => $data_invoice->bundle_id,
                "payment_method" => 'asaas',
                "session_id" => '',
                "transaction_id" => $data_invoice->invoice_id,
                "amount" => $data_invoice->amount,
                "date_added" => time(),
            ]);
        }

        if ($data_invoice->type_curso == 'single') {
            $enrol = json_decode($data_invoice->course_id, true);
            foreach ($enrol as $I) {
                $this->db->insert('payment', [
                    "user_id" => $users_id,
                    "payment_type" => $data_invoice->payment_type,
                    "course_id" => $I,
                    "amount" => $data_invoice->amount,
                    "date_added" => time(),
                    "last_modified" => time(),
                    "admin_revenue" => $data_invoice->admin_revenue,
                    "instructor_revenue" => $data_invoice->instructor_revenue,
                    "tax" => $data_invoice->tax,
                    "instructor_payment_status" => $data_invoice->instructor_payment_status,
                    "transaction_id" => $data_invoice->invoice_id,
                    "session_id" => '',
                    "coupon" => $data_invoice->coupon,
                ]);
            }
        }

        foreach ($enrol as $ID) {
            $this->db->insert('enrol', [
                "user_id" => $users_id,
                "course_id" => $ID,
                "date_added" => time(),
                "last_modified" => time(),
            ]);
        }

        echo json_encode([
            "ref" => $ref,
            "users_id" => $users_id,
            "enrol" => $enrol,
            "invoice" => $data_invoice,
        ]);
    }
}
