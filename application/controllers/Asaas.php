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
        $payment_details = $this->session->userdata('payment_details');



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
