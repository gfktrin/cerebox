<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1>Mensagem da Página de Contato</h1>
        <p>Enviada por {{ $contactMessage->name }}</p>
        <p>Email: {{ $contactMessage->email }}</p>
        <p>Mensagem: {{ $contactMessage->message }}</p>
    </body>
</html>