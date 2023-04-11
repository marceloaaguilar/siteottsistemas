<?php
include_once './config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A Cerca Elétrica residencial é considerada um item imprescindível e de tamanha utilidade e eficiência quando o assunto é aprimorar a proteção do seu patrimônio.
    A cerca elétrica produz um “choque moral”, ou seja, não queima e nem deixa marcas, apenas provoca uma sensação extremamente ruim.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cerca Elétrica em Belo Horizonte | Ott Sistemas Segurança Eletrônica</title>
  <link rel="icon" type="image/x-icon" href="/files/Imgs/icon-logo.webp">


  <!-- Google Tag Manager -->
  <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-P2D8ZSQ');</script> -->
  <!-- End Google Tag Manager -->

  <!----BOOTSTRAP CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


  <!----Google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">


  <meta property="og-description" content="A Cerca Elétrica residencial é considerada um item imprescindível e de tamanha utilidade e eficiência quando o assunto é aprimorar a proteção do seu patrimônio.
     A cerca elétrica produz um “choque moral”, ou seja, não queima e nem deixa marcas, apenas provoca uma sensação extremamente ruim.">

</head>

<body>

  <?php
  // Receber os dados do formulário
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  //Acessa o IF quando o usuário clicar no botão "Enviar"
  if (isset($dados['send-button'])) {

    $mail = new PHPMailer(true);
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . SECRET_KEY . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);





    if ($responseData->success) {


      try {

        //Server settings
        $mail->isSMTP();                                             //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contato@segurancaott.com.br';                     //SMTP username
        $mail->Password   = 'Ott@2023';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;
        $nome = $_POST["name"];
        $telefone = $_POST["phone"];
        $tipoResidencia = $_POST['tipoResidencia'];
        $email = $_POST["email"];
        $mensagem = $_POST["message"];

        //Recipients
        $mail->setFrom('contato@segurancaott.com.br');
        $mail->addAddress('ottalarmes@gmail.com');     //Add a recipient
        $mail->addReplyTo($_POST["email"]);

        //Content
        $mail->isHTML(true);
        $mail->setLanguage('pt', '/optional/path/to/language/directory/');                                    //Set email format to HTML
        $mail->Subject = 'Formulario Cerca Eletrica - Site Ott Sistemas';
        $mail->Body    =  "Nome: $nome <br> Telefone: $telefone <br>  Email: $email <br>  
                              Tipo de Residência: $tipoResidencia <br> Mensagem: $mensagem";


        $mail->send();
        header('Location:obrigado.html');
      } catch (Exception $e) {
        echo "Erro ao enviar o e-mail!: {$mail->ErrorInfo}";
      }
    } else {
      echo 'Erro de Validação do Captcha';
    }
  }

  ?>




  <a class="whatsapp-link" target="_blank" href="https://api.whatsapp.com/send?phone=5531993440844">
    <i class="bi bi-whatsapp"></i>
  </a>

  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/"><img src="files/Imgs/icon-logo.webp" alt="Logo Ott Sistemas | Segurança Eletrônica em Belo Horizonte">Ott Sistemas</a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="/">Início</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="cercaeletrica.php">Cerca Elétrica</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="alarmes.php">Alarmes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="concertina.php">Concertina</a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="index.php">Sobre nós</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php">Fale Conosco</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active" id="carousel-service">
        <img src="files/Imgs/pagCercaEletrica/home-cerca-eletrica-2.webp" class="d-block w-100 carousel-img" alt="Instalação e Manutenção de Cerca Elétrica Residencial  em Belo Horizonte é na Ott Sistemas">
        <div class="carousel-caption" id="carousel-caption-service">
          <h1>Cercas Elétricas</h1>
          <p>As Cercas Elétricas Ott Sistemas garantem um baixo custo de manutenção e um grande poder inibidor.
          </p>


          <button type="button" class="btn btn-warning btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#orcamentoModal">Fazer Orçamento</button>

        </div>
      </div>
    </div>
  </div>




  <!-- Modal -->

  <div class="modal fade" id="orcamentoModal" tabindex="-1" aria-hidden="true">
    <form method="POST" id="form-cercaeletrica">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Fazer Orçamento</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <input type="text" class="form-control mb-3" required placeholder="Nome" name="name">
            <input type="tel" class="form-control mb-3" required placeholder="Telefone" name="phone">
            <input type="email" class="form-control mb-3" required placeholder="E-mail" name="email">
            <label> Tipo de Residência: </label>
            <select required name="tipoResidencia" class="form-control mb-3">
              <option value="" selected>Escolha:</option>
              <option value="casa">Casa</option>
              <option value="predioResidencial">Prédio Residencial</option>
              <option value="predioComercial">Prédio Comercial</option>
              <option value="empresa">Empresa</option>
              <option value="outro">Outro</option>
            </select>
            <textarea rows="3" required class="form-control mb-3" placeholder="Mensagem" name="message"></textarea>


            <input type="hidden" id="g-token" name="g-token" data-sitekey="6LdwH0AlAAAAALLLmGD7bOBFaLLjbsvDqGI7yQrn">

            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">



          </div>

          <div class="modal-footer">
            <button class="btn btn-primary" name="send-button" data-action='submit' id="send-button" type="submit">Enviar</button>

          </div>
        </div>
      </div>
    </form>
  </div>




  <section id="info" class="info section-padding">
    <div class="section-header text-center pb-5">
      <h2>Nossos Diferenciais</h2>
    </div>

    <div class="container">
      <div class="row" id="services-info">
        <div class="col-sm-6">
          <img src="/files/Imgs/pagCercaEletrica/central.webp" id="central-de-choque" alt="Central de Choque Intelbras e Central de Choque GCP1000">
        </div>
        <div class="col-lg-6">
          <h3>Central de Choque Elétrica</h3>
          <p>Eletrificador para proteção de residências, sua alta energia permite alimentar até 1.200
            metros
            de
            fio linear. Acionada por controle remoto.</p>
        </div>
      </div>
      <hr class="featurette-divider">

      <div class="row" id="services-info">

        <div class="col-lg-8">
          <h3>Bateria Gelatinosa 12v</h3>
          <p>É um item fundamental para o sistema, pois, caso haja falta de energia elétrica para o
            funcionamento da central,
            a bateria atua para fornecer a energia necessária durante um determinado período.</p>
        </div>

        <div class="col-sm-4">
          <img src="/files/Imgs/pagCercaEletrica/bateria.webp" alt="Bateria Gelatinosa para Cerca Elétrica Residencial em Belo Horizonte">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row" id="services-info">
        <div class="col-sm-4">
          <img src="/files/Imgs/pagCercaEletrica/hastes.webp" alt="Haste de Ferro Galvanizada para Cerca Elétrica em Belo Horizonte">
        </div>
        <div class="col-lg-8">
          <h3>Hastes de Ferro Galvanizadas</h3>
          <p>As Hastes Galvanizadas além de serem simples de instalar, não enferrujam, assim, garantem uma
            longa vida útil.
            O material é rígido e impede possíveis quebras que ocorrem com outros tipos de materiais.</p>
        </div>
      </div>

      <hr class="featurette-divider">


      <div class="row" id="services-info">

        <div class="col-lg-8">
          <h3>Arame Galvanizado</h3>
          <p>É um arame específico para construção de cercas elétricas e possui camada pesada de zinco, necessária para
            proporcionar maior proteção contra a corrosão ao arame e maior eficiência na condutibilidade da corrente elétrica da cerca​</p>
        </div>

        <div class="col-sm-4">
          <img src="/files/Imgs/pagCercaEletrica/arame.webp" alt="Arame para Cerca Elétrica em Belo Horizonte">
        </div>
      </div>

      <hr class="featurette-divider">


      <div class="row" id="services-info">
        <div class="col-sm-4">
          <img src="/files/Imgs/pagCercaEletrica/sirene.webp" alt="Sirene PiezoElétrica 120dB para Cerca Elétrica em Belo Horizonte">
        </div>
        <div class="col-lg-8">
          <h3>Sirene PiezoElétrica 120dB​</h3>
          <p>Emite um sinal sonoro em caso de violação do sistema, e ao ligar e desligar o sistema.</p>
        </div>
      </div>

      <hr class="featurette-divider">
    </div>

  </section>

  <!------------------- differentials-->

  <section id="differentials--" class="differentials section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-4">
          <div class="card text-white text-center bg-dark pb-3">
            <div class="card-body">
              <i class="bi bi-bookmark-check-fill"></i>

              <h3>Garantia de <br>1 Ano</h3>


            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
          <div class="card text-white text-center bg-dark pb-3">
            <div class="card-body">
              <i class="bi bi-award-fill"></i>
              <h3>Instalação seguindo <br> todas as normas</h3>

            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
          <div class="card text-white text-center bg-dark pb-3">
            <div class="card-body">
              <i class="bi bi-gear-fill"></i>
              <h3>Materiais qualidade <br> e durabilidade</h3>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="cta">
    <div class="container">
      <div class="row" id="cta-itens">
        <div class="col-lg-8">
          <h3> Faça agora o seu orçamento e proteja seu patrimônio!</h3>
        </div>
        <div class="col-lg-4">
          <button type="button" class="btn btn-warning btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#orcamentoModal">Fazer Orçamento</button>
        </div>



      </div>
    </div>
  </section>

  <!------------------footer ----------------------->
  <footer class="p-2 text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="div" id="logo-footer">
            <a href="index.php">
              <img href="index.php" src="files/Imgs/icon-logo.webp" alt="Logo Ott Sistemas | Segurança Eletrônica em Belo Horizonte">
            </a>
            <p>Ott Sistemas</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-text">

            <ul style="list-style:none">
              <h4>Links</h4>
              <li><a href="index.php"> Início</a></li>
              <li><a href="cercaeletrica.php"> Cerca Elétrica</a></li>
              <li><a href="alarmes.php"> Alarmes</a></li>
              <li><a href="concertina.php"> Concertina</a></li>
              <li><a href="index.php"> Sobre Nós</a></li>
              <li><a href="index.php"> Fale Conosco</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3">

          <ul style="list-style:none">
            <h4>Privacidade</h4>
            <li><a href="">Política de Privacidade</a></li>
            <li><a href="">Termos e Condições</a></li>

          </ul>
        </div>

        <div class="col-md-3">
          <ul>
            <h4>Entre em contato conosco</h4>
            <p> (31) 3373-8913 <br />
              contato@segurancaott.com.br
            </p>
            <ul class="socials">
              <li> <a href="https://instagram.com/ottsistemas" target="_blank"> <i class="bi bi-instagram"></i></a>
              </li>
              <li> <a href="https://facebook.com/ottsistemas" target="_blank"> <i class="bi bi-facebook"></i></a></li>
            </ul>

          </ul>

        </div>


      </div>



      <div class="copyright">
        <small>Copyright &copy; 2023 Ott Sistemas | Segurança Eletrônica </small>
      </div>
    </div>


  </footer>



  <!----- MODAL CDN -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

  <!-- RECAPTCHA -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LdwH0AlAAAAALLLmGD7bOBFaLLjbsvDqGI7yQrn"></script>
  <script src="script.js"></script>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2D8ZSQ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->


</body>

</html>