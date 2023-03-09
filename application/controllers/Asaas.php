<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asaas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');


        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function buy()
    {

        $user_id = $this->session->userdata('user_id');
        $payment_details = [];
        
        
        
        
        $payment_details['total'] = 0;
        $payment_details['type_curso'] = $_GET['type_curso'] ?? 'single';
        $payment_details['user_id'] = $user_id ;
        $payment_details['group_name'] = null;
        $payment_details['ids'] = null;

        $cart = [];

        if( $payment_details['type_curso'] == 'single' ) {
            foreach($_SESSION['cart_items'] as $ID ) {
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

        if( $payment_details['type_curso'] == 'group' ) {
            $groupId = $_GET['groupId'];
            
            $select = $this->db->get_where('course_bundle', array('id' => $groupId));
            $data =  (object) $select->result_array()[0];
            $payment_details['total'] = $data->price;
            $cursos = json_decode($data->course_ids);
           
            $payment_details['group_name'] = $data->title;
            $payment_details['ids'] = $groupId;
            foreach($cursos as $ID ) {
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
        
        $payment_details['cart'] = $cart ;
        

        $query = $this->db->get_where('users', array('id' => $user_id));
        $data_user_logged = (object) $query->result_array()[0];
        
        $query = $this->db->get_where('payment_gateways', array('identifier' => 'asaas'));
        $data_asass = (object) $query->result_array()[0];
        $asass_keys = json_decode( $data_asass->keys, false );
        
        $cpf = $data_user_logged->cpf;
        $external_id = $data_user_logged->external_id;
        $customer_id = $data_user_logged->customer_id;        

        if(!$customer_id) {

            $external_id = "user_" . uniqid();
            $customer_id = "cus_lkasjdaihsdklanslkdhakshndkl"; // response asa
            
            $this->db->where('id', $user_id);
            $debug = $this->db->update('users', [
                "external_id" => $external_id,
                "customer_id" => $customer_id,
            ]);

        }

        $response_asas = [];
        $error = null;
        
        if( !empty($_POST) ) {
            
            // chama http asaas
            $response_asas = [];
            $error = "Cartão invalido";
            
            $tipo = "BOLETO";
            $code = "0000 0000 0000 000 ";
            $url = "http://google.com";

            $_SESSION["invoice"] = [
                "tipo" => $tipo,
                "code" => $code,
                "url" => $url,
            ];
            
            // redirecionar a thank you
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

    function thank_you() {
        $this->load->view('asaas/thank_you', [
            "data_assas" => (object) [
                "tipo_pagamento" => "CREDIT_CARD",
                "code" => "00000 000000 00000 00000",
                "url" => "http://google.com"
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
