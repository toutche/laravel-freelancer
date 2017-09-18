<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <style type="text/css">

        /* Your custom styles go here */
        @font-face {
            font-family: "Comfortaa Light";
            src: url("../../../../public/fonts/Comfortaa-Light.ttf") format("truetype");
        }
        * {
        margin: 0;
        padding: 0;
        font-size: 100%;
        font-family: 'Comfortaa Light';
        line-height: 1.65; }
        img {
          max-width: 100%;
          margin: 0 auto;
          display: block; }
        body,
        .body-wrap {
          width: 100% !important;
          height: 100%;
          background: #efefef;
          -webkit-font-smoothing: antialiased;
          -webkit-text-size-adjust: none; }
        .btn-confirm {
            color:#000000;
            box-sizing: border-box;
            font-size: 14px;
            color: #FFF;
            text-decoration: none;
            line-height: 2em;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
            background-color: #4682b4;
            margin: 0; border-color: #4682b4;
            border-style: solid;
            border-width: 10px 20px;
        }

        a {
          color: #71bc37;
          text-decoration: none; }

        .text-center {
          text-align: center; }

        .text-right {
          text-align: right; }

        .text-left {
          text-align: left; }

        h1, h2, h3, h4, h5, h6 {
          margin-bottom: 20px;
          line-height: 1.25; }

        h1 {
          font-size: 32px; }

        h2 {
          font-size: 28px; }

        h3 {
          font-size: 24px; }

        h4 {
          font-size: 20px; }

        h5 {
          font-size: 16px; }

        p, ul, ol {
          font-size: 16px;
          font-weight: normal;
          margin-bottom: 20px; }

        .container {
          display: block !important;
          clear: both !important;
          margin: 0 auto !important;
          max-width: 580px !important; }
        .container table {
            width: 100% !important;
            border-collapse: collapse; }
        .container .masthead {
            padding: 80px 0;
            background: #71bc37;
            color: white; }
        .container .masthead h1 {
          margin: 0 auto !important;
          max-width: 90%;
          text-transform: uppercase; }
        .container .content {
            background: white;
            padding: 30px 35px; }
        .container .content.footer {
          background: none; }
        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px; }
        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold; }

    </style>
</head>
<body>
<table class="body-wrap">
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">

                        <h1>Alguma imagem grande aqui...</h1>

                    </td>
                </tr>
                <tr>
                    <td class="content">

                        <h2>Olá <b>@php echo explode(" ",$name)[0]; @endphp</b>,</h2>

                        <p>Obrigado por registrar-se conosco. A partir de agora o trabalho está nas suas mãos, veja agora mesmo algumas áreas de atuações disponíveis, basta só completar seu cadastro clicando no botão abaixo. </p>

                        <table>
                            <tr>
                                <td align="center">
                                    <p>
                                        <a href="http://www.laravel.dev/perfil/complemeto-perfil" class="btn-confirm">Completar cadastro</a>
                                    </p>
                                </td>
                            </tr>
                        </table>

                        <p><em>– Equipe Toutchê</em></p>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Enviado por <a href="#">Toutchê - Produtora Digital</a>, </p>
                        <p><a href="mailto:">contato@toutche.com.br</a> | <a href="#">Cancelar Assinatura</a></p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
</body>
</html>