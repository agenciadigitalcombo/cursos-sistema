<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efetuar Pagamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
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

    <div class="min-h-screen">
        <div class="flex justify-center min-h-screen py-8" :style="{'background-color': cor}">
            <div class="flex items-center w-full max-w-lg mx-auto lg:w-3/6">
                <div class="flex-1">
                    <div class="bg-white rounded-md shadow-2xl p-5">
                        <h1 class="text-gray-800 font-bold text-2xl mb-1 text-center">
                            Obrigado! Sua transação foi Processada
                        </h1>
                        <?php if ($data_assas->tipo_pagamento !== "CREDIT_CARD") { ?>
                            <p class="text-sm font-normal text-gray-600 mb-8 text-center">
                                Abaixo encontra-se seu boleto / PIX
                            </p>
                        <?php } ?>
                        <?php if ($data_assas->tipo_pagamento == "PIX") { ?>
                            <div>
                                <img class="w-[250px] mx-auto" src="https://api-qrcode.digitalcombo.com.br/?code=<?php echo $data_assas->code ?>">
                            </div>
                        <?php } ?>
                        <?php if ($data_assas->tipo_pagamento == "BOLETO") { ?>
                            <div>
                                <a target="_blank" href="<?php echo $data_assas->url ?>" class="block rounded bg-green-500 text-white w-[320px] py-4 px-8 mx-auto mt-4">
                                    Clique qui para visualizar seu boleto
                                </a>
                                <span class="block text-center w-full py-4">ou copie o código abaixo</span>
                            </div>
                        <?php } ?>
                        <?php if ($data_assas->tipo_pagamento !== "CREDIT_CARD") { ?>
                            <div class="border-2 border-gray-200 flex justify-between items-center mt-4 py-2">
                                <i class="fa-solid fa-link px-4"></i>
                                <input class="w-full outline-none bg-transparent input-code" value="<?php echo $data_assas->code ?>">
                                <button onclick="copy()" class="bg-green-500 text-white rounded text-sm py-2 px-5 mr-2 hover:bg-green-600">
                                    Copiar
                                </button>
                            </div>
                        <?php } ?>
                        <a class="w-[150px] mx-auto rounded block mb-2 text-center bg-blue-800 hover:bg-blue-900 text-white py-2 mt-4" href="<?php echo site_url("home/my_courses") ?>">
                            Meus Cursos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copy() {
            let $input = document.querySelector(".input-code")
            $input.select()
            $input.setSelectionRange(0, 99999)
            document.execCommand('copy')
        }
    </script>
</body>

</html>