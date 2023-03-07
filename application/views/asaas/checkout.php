<?php

$method_pix = true;
$method_boleto = true;
$method_card = true;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efetuar Pagamento</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="<?php echo site_url("assets/payment/js/main.js") ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#EEE] pt-8">


    <div class="w-[380px] mx-auto p-4 rounded shadow bg-[#F5F5F5] mb-[3px]">
        <?php foreach ($items as $i) { ?>
            <div class="flex justify-between gap-4 mb-[5px] border-b-2 pb-[5px] rounded">
                <div class="flex gap-2">
                    <img class="w-[30px] h-30px rounded" src="<?php echo $i['thumbnail'] ?>" alt="">
                    <b class="w-auto"><?php echo $i['title'] ?></b>
                </div>
                <span class="w-60px">R$<?php echo number_format($i['actual_price'], 2, ',', '.')  ?></span>
            </div>
        <?php } ?>
        <span class="flex gap-2 justify-end">
            Total: <strong>R$<?php echo number_format($total_payable_amount, 2, ',', '.')  ?></strong>
        </span>

    </div>

    <form action="" class="w-[380px] mx-auto p-4 rounded shadow bg-[#F5F5F5]">

        <div class="w-full mb-1 px-3 md:w-2/2 lg:w-3/3">
            <div>
                <label class="block text-base font-medium text-black text-center my-4 text-[20px]">
                    Selecione a forma de pagamento
                </label>
            </div>
        </div>



        <ul class="flex gap-2 max-w-md mx-auto">
            <?php if ($method_pix) { ?>
                <li class="relative w-full">
                    <input checked onchange="setMethodPay(this)" class="sr-only peer" type="radio" value="PIX" name="tipo_pagamento" id="tipo_pix">
                    <label class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent" for="tipo_pix">
                        PIX
                    </label>
                    <div class="absolute w-5 h-5 peer-checked:block top-6 right-3">
                        <i class="fa fa-qrcode" style="font-size:24px;"></i>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($method_boleto) { ?>
                <li class="relative w-full">
                    <input onchange="setMethodPay(this)" class="sr-only peer" type="radio" value="BOLETO" name="tipo_pagamento" id="tipo_boleto">
                    <label class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent" for="tipo_boleto">
                        Boleto
                    </label>
                    <div class="absolute w-5 h-5 peer-checked:block top-6 right-3">
                        <i class="fa fa-barcode" style="font-size:20px;"></i>
                    </div>
                </li>
            <?php  } ?>
            <?php if ($method_card) { ?>
                <li class="relative w-full">
                    <input onchange="setMethodPay(this)" class="sr-only peer" type="radio" value="CREDIT_CARD" name="tipo_pagamento" id="tipo_card">
                    <label class="flex p-5 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-green-500 peer-checked:ring-2 peer-checked:border-transparent" for="tipo_card">
                        Cartão
                    </label>
                    <div class="absolute  w-5 h-5 peer-checked:block top-6 right-3">
                        <i class="fa fa-credit-card-alt" style="font-size:18px;"></i>
                    </div>
                </li>
            <?php  } ?>
        </ul> <br>

        <div class="hidden" id="optCard">
            <div class="w-full mb-1 px-3 md:w-2/2 lg:w-3/3">
                <div>
                    <label class="block text-base font-medium text-black text-[12px] text-center pb-2">
                        Informe os dados do cartão <br> <small>(Cartões Aceitos)</small> 
                    </label>
                </div>
                <img src=" <?php echo site_url("assets/payment/img/bandeiras-aceitas.png") ?>" class="w-full block" alt="bandeira">
            </div>

            <div class="w-full md:w-2/2 lg:w-3/3 mb-2">
                <div class="px-3">
                    <label class="mb-1 px-3block text-base font-medium text-black">
                        Nome igual no cartão
                    </label>
                    <div class="relative">
                        <input name="nome" placeholder="Nome igual no cartão" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/2 lg:w-3/3 mb-2">
                <div class="px-3">
                    <label class="mb-1 block text-base font-medium text-black">
                        Número cartão
                    </label>
                    <div class="relative">
                        <input name="numero" oninput="maskNumero(this)" placeholder="0000 0000 0000 0000" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mb-4">
                <div class="">
                    <div class=" px-3">
                        <label class=" block text-base font-medium text-black">
                            Vencimento
                        </label>
                        <div class="relative">
                            <input name="vencimento" oninput="maskValidade(this)" placeholder="MM/AA" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class=" px-3">
                        <label class=" block text-base font-medium text-black">
                            CCV
                        </label>
                        <div class="relative">
                            <input name="ccv" oninput="maskCvv(this)" placeholder="123" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full mb-1 px-3 md:w-2/2 lg:w-3/3">
                <div>
                    <label class="block text-base font-medium text-black text-[12px] text-center pb-2">
                        Informe o endereço
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-2 mb-4">
                <div class="">
                    <div class=" px-3">
                        <label class=" block text-base font-medium text-black">
                            CEP
                        </label>
                        <div class="relative">
                            <input name="CEP" oninput="maskCep(this)" placeholder="00000-000" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class=" px-3">
                        <label class=" block text-base font-medium text-black">
                            Número
                        </label>
                        <div class="relative">
                            <input name="numero_casa" type="number" placeholder="0" class="w-full rounded-md border border-danger py-3 pl-5 pr-12 text-black placeholder-[#929DA7] outline-none transition">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input class="cursor-pointer block w-full  bg-green-600 mt-0 py-2 rounded-2xl hover:bg-green-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2" type="submit" value="Efetuar Pagamento">
        <?php if ($isError) { ?>
            <div class="block my-4 rounded text-center bg-[#C00] text-white py-2">
                <?php echo $isError ?>
            </div>
        <?php } ?>
    </form>



</body>

</html>