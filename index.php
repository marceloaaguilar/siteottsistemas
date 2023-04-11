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
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ott Sistemas | Segurança Eletrônica</title>
   <meta name="description" content="A Ott Sistemas é especialista em Segurança Eletrônica. Estamos há mais de 30 anos mercado realizando instalações de Cerca Elétrica Residencial,
  Alarme Residencial, Concertinas e muito mais. A Ott Sistemas é pioneira em Segurança Eletrônica. Estamos há 25 anos no mercado, atendendo em toda Grande BH e Contagem. Contamos com uma 
  equipe técnica e especializada em sistemas de segurança eletrônica. Nosso lema é pontualidade e qualidade no atendimento. Estamos sempre à disposição de nossos clientes.">
   <link rel="icon" type="image/x-icon" href="/files/Imgs/icon-logo.webp">

   <!-- Google Tag Manager -->
   <script>
     (function(w, d, s, l, i) {
       w[l] = w[l] || [];
       w[l].push({
         'gtm.start': new Date().getTime(),
         event: 'gtm.js'
       });
       var f = d.getElementsByTagName(s)[0],
         j = d.createElement(s),
         dl = l != 'dataLayer' ? '&l=' + l : '';
       j.async = true;
       j.src =
         'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
       f.parentNode.insertBefore(j, f);
     })(window, document, 'script', 'dataLayer', 'GTM-P2D8ZSQ');
   </script>
   <!-- End Google Tag Manager -->

   <!----BOOTSTRAP CDN-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="style.css" media="print" onload="this.media='all'">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">

   <meta property="og-description" content="A Ott Sistemas é especialista em Segurança Eletrônica. Estamos há mais de 30 anos mercado realizando instalações de Cerca Elétrica Residencial,
    Alarme Residencial, Concertinas e muito mais. A Ott Sistemas é pioneira em Segurança Eletrônica. Estamos há 25 anos no mercado, atendendo em toda Grande BH e Contagem. Contamos com uma 
    equipe técnica e especializada em sistemas de segurança eletrônica. Nosso lema é pontualidade e qualidade no atendimento. Estamos sempre à disposição de nossos clientes.">


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
          $email = $_POST["email"];
          $mensagem = $_POST["message"];

          //Recipients
          $mail->setFrom('contato@segurancaott.com.br');
          $mail->addAddress('ottalarmes@gmail.com');     //Add a recipient
          $mail->addReplyTo($_POST["email"]);

          //Content
          $mail->isHTML(true);
          $mail->setLanguage('pt', '/optional/path/to/language/directory/');                                    //Set email format to HTML
          $mail->Subject = 'Fale Conosco - Site Ott Sistemas';
          $mail->Body    =  "Nome: $nome <br> Telefone: $telefone <br> Email: $email <br> Mensagem: $mensagem";


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



   <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top navbar-dark bg-dark">
     <div class="container">
       <a class="navbar-brand" href=""><img src="files/Imgs/icon-logo.webp" alt="Logo Ott Sistemas">Ott Sistemas</a>
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
             <a class="nav-link" href="#about">Sobre nós</a>
           </li>

           <li class="nav-item">
             <a class="nav-link" href="#contact">Fale Conosco</a>
           </li>

         </ul>
       </div>
     </div>
   </nav>

   <a class="whatsapp-link" target="_blank" href="https://api.whatsapp.com/send?phone=5531993440844">
     <i class="bi bi-whatsapp"></i>
   </a>


   <!---- CAROUSEL -->
   <div id="carouselExampleCaptions" class="carousel slide">
     <div class="carousel-indicators">
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
     </div>
     <div class="carousel-inner">
       <div class="carousel-item active">
         <img src="files/Imgs/pagCercaEletrica/newHome.webp" class="d-block w-100 carousel-img" alt="Cerca Elétrica Residencial Ott Sistemas">
         <div class="carousel-caption">
           <h2>Cercas Elétricas</h2>
           <p>Uma solução com baixo consumo de energia, maior resistência ao tempo, total segurança, alta confiabilidade
             e baixo custo.
           </p>
           <a href="/cercaeletrica.php" class="btn btn-warning btn-lg mt-3">Saiba Mais</a>
         </div>

       </div>
       <div class="carousel-item">
         <img src="files/Imgs/capaSiteAlarmes.webp" class="d-block w-100 carousel-img" alt="Alarme Residencial Intelbras AMN 24 Net ">
         <div class="carousel-caption">
           <h2>Alarmes</h2>
           <p>Soluções práticas, seguras e adequadas para todas as necessidades.
           </p>
           <a href="/alarmes.php" class="btn btn-warning btn-lg mt-3">Saiba Mais</a>
         </div>
       </div>
       <div class="carousel-item">
         <img src="files/Imgs/home3.webp" class="d-block w-100 carousel-img" alt="Concertina Laminada">
         <div class="carousel-caption">
           <h2>Concertina</h2>
           <p>Barreiras de Segurança que protegem você e seu patrimônio.</p>
           <a href="/concertina.php" class="btn btn-warning btn-lg mt-3">Saiba Mais</a>
         </div>
       </div>
     </div>
     <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="visually-hidden">Previous</span>
     </button>
     <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="visually-hidden">Next</span>
     </button>
   </div>



   <!--- services section -->
   <section id="services" class="services section-padding">
     <div class="container">
       <div class="row">
         <div class="row">
           <div class="col-md-12">
             <div class="section-header text-center pb-5">
               <h2>Nossos Serviços</h2>
               <p>Especializados em segurança eletrônica, realizamos o projeto, Instalação e Manutenção de Cercas
                 Elétricas, Alarmes e Concertinas.</p>
             </div>
           </div>
         </div>
       </div>

       <div class="row">
         <div class="col-12 col-md-12 col-lg-4">
           <div class="card text-white text-center bg-dark pb-2">
             <div class="card-body">
               <i class="bi bi-shield-lock-fill"></i>

               <h3>Cercas Elétricas</h3>
               <p>Somos especialistas em cercas elétricas. Uma solução eficiente e com baixo custo de manutenção.</p>
               <a href="/cercaeletrica.php" class="btn btn-warning text-dark">Saiba Mais</a>
             </div>
           </div>
         </div>

         <div class="col-12 col-md-12 col-lg-4">
           <div class="card text-white text-center bg-dark pb-2">
             <div class="card-body">
               <i class="bi bi-house-lock-fill"></i>
               <h3>Alarmes</h3>
               <p>O sistema de alarme é fundamental para realizar a segurança de sua residência ou empresa.</p>
               <a href="/alarmes.php" class="btn btn-warning text-dark">Saiba Mais</a>
             </div>
           </div>
         </div>

         <div class="col-12 col-md-12 col-lg-4">
           <div class="card text-white text-center bg-dark pb-2">
             <div class="card-body">
               <i class="bi bi-shield-fill-check"></i>
               <h3>Concertinas</h3>
               <p>Barreira de lâmina cortante que impede a ação de invasores. Destacam-se pelo custo-benefício.</p>
               <a href="concertina.php" class="btn btn-warning text-dark">Saiba Mais</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>

   <!-- about section-->
   <section id="about" class="about section-padding">
     <div class="container">
       <div class="row">
         <div class="col-lg-4 col-md-12 col-12">
           <div class="about-img">
             <img src="files/Imgs/about.webp" alt="Instalação e Manutenção de Cerca Elétrica Residencial" class="img-fluid">
           </div>
         </div>
         <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-m5-5">
           <div class="about-text">
             <h2>Estamos há mais de 30 anos no Mercado</h2>
             <p>Empresa de instalação e manutenção de sistemas de segurança eletrônica em Belo Horizonte. Estamos há 25
               anos no mercado, atendendo
               em toda Grande BH e Contagem. Contamos com uma equipe técnica e especializada
               em sistemas de segurança eletrônica. Nosso lema é pontualidade e qualidade no atendimento. Estamos sempre
               à disposição de nossos clientes.</p>
           </div>
         </div>
       </div>
     </div>
   </section>


   <!------------------------------contact-------------------->
   <section id="contact" class="contact section-padding">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="section-header text-center pb-5">
             <h2>Fale Conosco</h2>
             </p>
           </div>
         </div>
       </div>
       <div class="row m-0">
         <div class="col-md-12 p-0 pt-4 pb-4">
           <form class="bg-light p-4.m-auto" id="form-home" method="POST">
             <div class="row">
               <div class="col-md-12">
                 <div class="mb-3">
                   <input type="text" class="form-control" required placeholder="Nome" name="name">
                 </div>
               </div>

               <div class="col-md-12">
                 <div class="mb-3">
                   <input type="email" class="form-control" required placeholder="Email" name="email">
                 </div>
               </div>

               <div class="col-md-12">
                 <div class="mb-3">
                   <input type="tel" class="form-control" required placeholder="Celular" name="phone">
                 </div>
               </div>


               <div class="col-md-12">
                 <div class="mb-3">
                   <textarea rows="3" required class="form-control" placeholder="Mensagem" name="message"></textarea>
                 </div>
               </div>
               <input type="hidden" id="g-token" name="g-token" data-sitekey="6LdwH0AlAAAAALLLmGD7bOBFaLLjbsvDqGI7yQrn">

               <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
               <div class="modal-footer">
                 <button class="btn btn-primary" name="send-button" ; data-callback='onSubmit' data-action='submit' id="send-button" type="submit">Enviar</button>

               </div>
             </div>
           </form>
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
               <img href="index.php" src="files/Imgs/icon-logo.webp" alt="Logo Ott Sistemas">
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
               <li><a href="#about"> Sobre Nós</a></li>
               <li><a href="#contact"> Fale Conosco</a></li>
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




   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P2D8ZSQ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


   <script src="https://www.google.com/recaptcha/api.js?render=6LdwH0AlAAAAALLLmGD7bOBFaLLjbsvDqGI7yQrn"></script>
   <script src="script.js"></script>



 </body>

 </html>