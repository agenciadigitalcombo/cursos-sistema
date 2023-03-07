<?php

class AsaasApi
{
    const PATH = 'https://www.asaas.com/api/v3';
    const PATH_SANDBOX = 'https://sandbox.asaas.com/api/v3';
    const TYPE_PAYMENT = [
        "BOLETO", "CREDIT_CARD", "DEBIT_CARD",
        "UNDEFINED", "TRANSFER", "DEPOSIT", "PIX"
    ];
    public $api_key = NULL;
    const STATUS_PAYMENT = [
        "PAYMENT_CREATED", "PAYMENT_UPDATED", "PAYMENT_CONFIRMED",
        "PAYMENT_RECEIVED", "PAYMENT_OVERDUE", "PAYMENT_DELETED",
        "PAYMENT_RESTORED", "PAYMENT_REFUNDED", "PAYMENT_RECEIVED_IN_CASH_UNDONE",
        "PAYMENT_CHARGEBACK_REQUESTED", "PAYMENT_CHARGEBACK_DISPUTE",
        "PAYMENT_AWAITING_CHARGEBACK_REVERSAL", "PAYMENT_DUNNING_RECEIVED",
        "PAYMENT_DUNNING_REQUESTED", "PAYMENT_BANK_SLIP_VIEWED", "PAYMENT_CHECKOUT_VIEWED"
    ];
    public $sandbox;

    function __construct()
    {
        $this->sandbox = true;
    }

    public function get_path(string $path): string
    {
        if ($this->sandbox) {
            return self::PATH_SANDBOX . $path;
        }
        return self::PATH . $path;
    }

    function get_head()
    {
        $head = "Content-Type: application/json; charset=UTF-8\r\n";
        $head .= "access_token: {$this->api_key}\r\n";
        return $head;
    }

    function get_head_get()
    {
        $head = "access_token: {$this->api_key}\r\n";
        return $head;
    }

    public function post(string $path, array $payload, string $method = 'POST'): array
    {
        $full_path = $this->get_path($path);

        try {
            $defaults = [
                CURLOPT_POST           => true,
                CURLOPT_HEADER         => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => $full_path,
                CURLOPT_POSTFIELDS     => json_encode($payload),
                CURLOPT_HTTPHEADER     => [
                    'content-type: application/json',
                    "access_token: {$this->api_key}",
                    "accept: */*",
                    "content-length: " . strlen(json_encode($payload)),
                ]
            ];
            if ( !empty($method) && $method != "POST") {
                $defaults[CURLOPT_CUSTOMREQUEST] = $method;
                unset($defaults[CURLOPT_POST]);
            }
            $con = curl_init();
            curl_setopt_array($con, $defaults);
            $ex = curl_exec($con);
            $info = curl_getinfo($con);
            curl_close($con);
            return json_decode($ex, true);
        } catch (\Throwable $th) {
            http_response_code(400);
            echo json_encode([
                "next" => false,
                "message" => "error ao chamar meio pagamento",
                "payload" => [
                    "request" => [
                        "header" => $this->get_head(),
                        "full_path" => $full_path,
                        "body" => $payload
                    ],
                    "response" => [
                        "info" => $info,
                        "body" => json_decode($ex, true),
                        "error" => @curl_error($con)
                    ],
                ]
            ]);
            die;
        }
    }

    public function get(string $path, array $payload): array
    {
        $param = http_build_query($payload);
        $full_path = $this->get_path("{$path}?{$param}");
        try {
            $defaults = [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => $full_path,
                CURLOPT_HTTPHEADER     => [
                    'Content-Type:application/json',
                    "access_token: {$this->api_key}"
                ]
            ];
            $con = curl_init();
            curl_setopt_array($con, $defaults);
            $ex = curl_exec($con);
            $info = curl_getinfo($con);
            curl_close($con);
            return json_decode($ex, true);
        } catch (\Throwable $th) {
            echo json_encode([
                "next" => false,
                "message" => "error ao chamar meio pagamento",
                "payload" => [
                    "request" => [
                        "header" => $this->get_head(),
                        "full_path" => $full_path,
                        "body" => $payload
                    ],
                    "response" => [
                        "info" => $info,
                        "body" => json_decode($ex, true),
                        "error" => curl_error($con)
                    ],
                ]
            ]);
            die;
        }
    }

    public function set_api_key(string $api_key): void
    {
        $this->api_key = $api_key;
    }

    public function put(string $path, array $payload): array
    {
        return $this->post($path, $payload, 'PUT');
    }

    public function del(string $path, array $payload): array
    {
        return $this->post($path, $payload, 'DELETE');
    }

    function clearNumber(string $number): string
    {
        return preg_replace('/\D/', '', $number);
    }

    function getDDD(string $tel)
    {
        $tel = $this->clearNumber($tel);
        return stripos($tel, 0, 2);
    }

    function excludeDDD(string $tel)
    {
        $tel = $this->clearNumber($tel);
        return stripos($tel, 2, 9);
    }

    public function createCustomerID(        
        string $name,
        string $cpfCnpj       
    ): array {
        $payload = [
            'name' => $name,            
            "cpfCnpj" => $this->clearNumber($cpfCnpj),                 
        ];
        return $this->post('/customers', $payload, false);
    }

    function typeValid($type): bool
    {
        $list = ["BOLETO", "CREDIT_CARD", "PIX"];
        return in_array($type, $list);
    }

    function getBarcodeBoleto(string $fatura_id): array
    {
        $payload = [
            "id" => $fatura_id
        ];
        return $this->get("/payments/{$fatura_id}/identificationField", $payload);
    }

    function getCodePix(string $fatura_id): array
    {
        return $this->get("/payments/{$fatura_id}/pixQrCode", []);
    }


    function single(
        string $external_fk,
        string $tipo_pagamento,
        string $customer,
        string $valor,
        string $card_nome,
        string $card_numero,
        string $card_validade,
        string $card_cvv,
        string $nome,
        string $cpf,
        string $telefone,
        string $email,
        string $cep,
        string $numero,
        string $complemento,
        string $nextDueDate,
        array $split = []
    ) {

        $payload = [
            "customer" => $customer,
            "billingType" => $tipo_pagamento,
            "value" => $valor,
            "dueDate" => $nextDueDate,
            "description" => "fatura",
            "externalReference" => $external_fk,
            "postalService" => false,
        ];
        if ($tipo_pagamento == "BOLETO") {
            $payload["discount"] = [
                "value" => 0,
                "dueDateLimitDays" => 0
            ];
            $payload["interest"] = ["value" => 0];
        }
        if ($tipo_pagamento == "CREDIT_CARD") {
            $payload["creditCard"] = [
                "holderName" => $card_nome,
                "number" => $card_numero,
                "expiryMonth" => substr($this->clearNumber($card_validade), 0, 2),
                "expiryYear" => substr($this->clearNumber($card_validade), 2, 4),
                "ccv" => $this->clearNumber($card_cvv)
            ];
            $payload["creditCardHolderInfo"] = [
                "name" => $nome,
                "email" => $email,
                "cpfCnpj" => $cpf,
                "postalCode" => $cep,
                "addressNumber" => $numero,
                "addressComplement" => $complemento,
                "phone" => $this->clearNumber($telefone),
                "mobilePhone" => $this->clearNumber($telefone)
            ];
            $payload["dueDate"] = date('Y-m-d');
            $payload["remoteIp"] = $_SERVER['REMOTE_ADDR'];
        }
        if (!empty($split)) {
            $payload['split'] = $split;
        }
        return $this->post('/payments', $payload);
    }

    function signature(
        string $external_fk,
        string $tipo_pagamento,
        string $customer,
        string $valor,
        string $card_nome,
        string $card_numero,
        string $card_validade,
        string $card_cvv,
        string $nome,
        string $cpf,
        string $telefone,
        string $email,
        string $cep,
        string $numero,
        string $complemento,
        string $nextDueDate,
        array $split = []
    ) {
        $payload = [
            "customer" => $customer,
            "billingType" => $tipo_pagamento,
            "value" => $valor,
            "description" => "Assinatura",
            "externalReference" => $external_fk,
            "postalService" => false,
            "nextDueDate" => $nextDueDate,
            "cycle" => "MONTHLY",
        ];
        if ($tipo_pagamento == "BOLETO") {
            $payload["discount"] = [
                "value" => 0,
                "dueDateLimitDays" => 0
            ];
            $payload["interest"] = ["value" => 0];
        }
        if ($tipo_pagamento == "CREDIT_CARD") {
            $payload["creditCard"] = [
                "holderName" => $card_nome,
                "number" => $card_numero,
                "expiryMonth" => substr($this->clearNumber($card_validade), 0, 2),
                "expiryYear" => substr($this->clearNumber($card_validade), 2, 4),
                "ccv" => $this->clearNumber($card_cvv)
            ];
            $payload["creditCardHolderInfo"] = [
                "name" => $nome,
                "email" => $email,
                "cpfCnpj" => $cpf,
                "postalCode" => $cep,
                "addressNumber" => $numero,
                "addressComplement" => $complemento,
                "phone" => $this->clearNumber($telefone),
                "mobilePhone" => $this->clearNumber($telefone)
            ];
            $payload["remoteIp"] = $_SERVER['REMOTE_ADDR'];
            $payload["maxPayments"] = 24;
            $payload["nextDueDate"] = date('Y-m-d');
        }
        if (!empty($split)) {
            $payload['split'] = $split;
        }
        return $this->post('/subscriptions', $payload);
    }

}